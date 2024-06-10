<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\Status;
class WarehouseController extends Controller
{



    public function index(){
        $status = Status::all();

        $warehouses = Warehouse::latest()->paginate(7);
        return view('layouts.pages.warehouses.index' , compact('warehouses', 'status'));
    }

    public function indexed(Request $request ){

        $status = Status::all();
        if(isset($request->status_id) && $request->status_id != 0){
            $warehouses = Warehouse::where('status_id', $request->status_id)->latest()->paginate(7);
        } else {
            $warehouses = Warehouse::latest()->paginate(7);
        }



        return view('layouts.pages.warehouses.index' , compact('warehouses', 'status' , 'request'));
    }



    public function search(Request $request)
    {
        $status = Status::all();
        $query = $request->input('query');



        if ($query) {

            $warehouses = Warehouse::where('name', 'LIKE', "%{$query}%")->paginate(7);
        } else {

            $warehouses = Warehouse::latest()->paginate(7);
        }

        return view('layouts.pages.warehouses.warehouse_list', compact('warehouses','status'));
    }




    public function back_index(){
        return redirect()->route('warehouse');
    }

    public function create(){
        $status = Status::all();
        return view('layouts.pages.warehouses.create' , compact('status'));
    }

    public function created(Request $request){

        // dd($request->status_id);
        Warehouse::create([
            'name' => $request->name,
            'location' => $request->address,
            'status_id' => $request->status_id,
            'description' => $request->description,

        ]);

        return redirect()->route('warehouse')->with('msg', 'Thêm thành công');

    }

    public function edit($id){

        $warehouse = Warehouse::find($id);
        $status = Status::all();


        return view('layouts.pages.warehouses.edit', compact('warehouse', 'status'));
    }

    public function edited($id , Request $request){

        $warehouse = Warehouse::find($id);
        $status = Status::all();

        $warehouse->update([
            'name' => $request->name,
            'location' => $request->address,
            'status_id' => $request->status_id,
            'description' => $request->description,

        ]);

        return redirect()->route('warehouse')->with('msg', 'Cập nhật thành công');
    }

    public function delete($id){
        $warehouse = Warehouse::find($id);


        // $warehouse->delete();
        // return redirect()->route('warehouse')->with('msg', 'Xoá thành công');
        if ($warehouse) {
            $warehouse->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }

    }
}
