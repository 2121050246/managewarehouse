<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;


use App\Http\Requests\ProductRequest;



class ProductController extends Controller
{
    public function create(){
        $categories = Category::all();
        $suppliers = Supplier::all();
        $warehouses = Warehouse::all();


        return view('layouts.pages.products.create' , compact('categories', 'suppliers', 'warehouses'));

    }

    public function created(ProductRequest $request)  {


        $file = $request->file('file');

        $name = $file->getClientOriginalName();

        $path = $file->storeAs('public/products', $name);




        Product::create([
            'name' =>  $request->product,
            'category_id' =>  $request->category,
            'supplier_id' =>  $request->supplier,
            'house_id' =>  $request->warehouse,
            'quantity' =>  $request->number,
            'path' =>    Storage::url($path),
            'path_name' => Str::slug($name) ,
            'path_delete'  => $name,

            'description' =>  $request->description,

        ]);
        return redirect()->route('products.create')->with('msg', 'Thêm thành công');
    }


    public function index()  {

        $products = Product::latest()->paginate(7);
        $warehouses = Warehouse::all();
        $suppliers = Supplier::all();
        $categories = Category::all();



        return view('layouts.pages.products.index' , compact('products','warehouses', 'suppliers' , 'categories'));
    }

    public function indexed(Request $request)  {

            $warehouses = Warehouse::all();
            $suppliers = Supplier::all();
            $categories = Category::all();


            if( $request->category_id == 0 ){

                $products = Product::latest()->paginate(7);


            } else if($request->category_id != 0) {
                $categories_array = Category::pluck('id')->toArray();

                $products = Product::whereIn('category_id', $categories_array)
                ->where('category_id', $request->category_id)
                ->paginate(7);
            }

        return view('layouts.pages.products.index' , compact('products','warehouses', 'suppliers' , 'categories' ));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');

        $warehouses = Warehouse::all();
        $suppliers = Supplier::all();
        $categories = Category::all();

        if ($query) {
            $products = Product::where('name', 'LIKE', "%{$query}%")->paginate(7);
        } else {
            $products = Product::latest()->paginate(7);
        }

        return view('layouts.pages.products.product_list', compact('products', 'warehouses', 'suppliers', 'categories'));
    }









    public function edit($id){
        $product = Product::find($id);
        $categories = Category::all();
        $suppliers = Supplier::all();
        $warehouses = Warehouse::all();


        return view('layouts.pages.products.edit' , compact('categories', 'suppliers', 'warehouses', 'product'));
    }

    public function edited($id , Request $request){


        $product = Product::find($id);
        if(isset($request->file)){

            $file = $request->file('file');

            $name = $file->getClientOriginalName();

            $path = $file->storeAs('public/products', $name);


            Storage::delete('public/products/'.$product->path_delete);

            $product->update([
                'name' =>  $request->product,
                'category_id' =>  $request->category,
                'supplier_id' =>  $request->supplier,
                'house_id' =>  $request->warehouse,
                'quantity' =>  $request->number,
                'path' =>    Storage::url($path),
                'path_name' => Str::slug($name) ,
                'path_delete'  => $name,

                'description' =>  $request->description,

            ]);
        } else {

            $product->update([
                'name' =>  $request->product,
                'category_id' =>  $request->category,
                'supplier_id' =>  $request->supplier,
                'house_id' =>  $request->warehouse,
                'quantity' =>  $request->number,
                'description' =>  $request->description,

            ]);
        }

        return redirect()->route('products.index')->with('msg', 'Cập nhật thành công');

    }

    public function back_index(){
        return redirect()->route('products.index');
    }




    public function delete($id){
        $product = Product::find($id);




        if ($product) {

            if(isset($product->path_delete)){
                Storage::delete('public/products/'.$product->path_delete);
            }
            $product->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }


    }
}
