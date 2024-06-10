<?php

namespace App\Http\Controllers;

use App\Models\Export;
use App\Models\Supplier;

use App\Models\Warehouse;
use App\Models\Product;
use App\Models\Category;



use Illuminate\Http\Request;
use PDF;

class ExportController extends Controller
{
    public function generatePDF($id , Request $request)
    {
        $product = Product::find($id);
        $supplier = Supplier::where('id' , $product->supplier_id)->first();
        $category = Category::where('id' , $product->category_id)->first();
        $warehouse = Warehouse::where('id' , $product->house_id)->first();


        if(isset( $product)){

            $data = [
                'title' => 'Xuất hoá hoá đơn ',
                'name_supplier' => $supplier->name,
                'name_product' => $product->name,
                'date' => date('m/d/Y'),
                'path' =>  $product->path,
                'quantity' => $product->quantity,
                'category' => $category->name,
                'house' => $warehouse->name,


            ];

            $pdf = PDF::loadView('layouts.pages.exports.myPDF', $data);

               // Kiểm tra hành động dựa trên tham số 'action' trong yêu cầu
            if ($request->query('action') === 'download') {

                Export::create([
                    'product_name' =>  $product->name,
                    'product_id' =>  $product->id,
                    'category_id' =>  $category->id,
                    'path' => $product->path,
                    'supplier_id' =>  $supplier->id,
                    'house_id' =>  $warehouse->id,



                ]);

                    // Lưu file PDF vào một biến để tải xuống sau đó
                $pdfOutput = $pdf->download('bill.pdf');

                // Xóa sản phẩm
                $product->delete();

                    // Sử dụng session flash message để lưu thông báo
                session()->flash('msg', 'Xuất thành công');

                // Trả về file PDF đã tải xuống
                return $pdfOutput;
            } else {
                return $pdf->stream('bill.pdf');
            }
        } else {
            return back();
        }




    }


    public function index(){
            // lấy danh sách xoá mềm
        $products = Product::onlyTrashed()->get();

        $suppliers = Supplier::all();
        $categories = Category::all();
        $warehouses = Warehouse::all();
        $exports = Export::latest()->paginate(7);



        return view('layouts.pages.exports.index' ,compact('exports', 'warehouses', 'suppliers', 'categories' ,'products') );
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::onlyTrashed()->get();

        $suppliers = Supplier::all();
        $categories = Category::all();
        $warehouses = Warehouse::all();




        if ($query) {
            $exports = Export::where('product_name', 'LIKE', "%{$query}%")->paginate(7);
        } else {
            $exports = Export::latest()->paginate(7);
        }

        return view('layouts.pages.exports.export_list', compact('exports','warehouses', 'suppliers', 'categories' ,'products'));
    }
}

