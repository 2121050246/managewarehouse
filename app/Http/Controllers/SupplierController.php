<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\SupplierRequest;


class SupplierController extends Controller
{
    public $city = [];
    public $districts = [];
    public $wards = [];

    public function supplier_index(){
        $suppliers = Supplier::latest()->paginate(7);
        return view('layouts.pages.suppliers.index' , compact('suppliers'));
    }



    public function search(Request $request)
    {
        $query = $request->input('query');



        if ($query) {
            $suppliers = Supplier::where('name', 'LIKE', "%{$query}%")->paginate(7);
        } else {
            $suppliers = Supplier::latest()->paginate(7);
        }

        return view('layouts.pages.suppliers.suppliers_list', compact('suppliers'));
    }

    public function back_index(){
        return redirect()->route('supplier.index');
    }







    public function supplier_create() {
        // Lấy dữ liệu và lưu vào cache nếu chưa có
        $data = Cache::remember('api_data', 72000, function () {
            return Http::get('https://esgoo.net/api-tinhthanh/4/0.htm')->json();
        });

        // Lấy dữ liệu từ cache và thêm vào danh sách
        $this->city = $data['data'];
        // foreach ($this->city as $city) {
        //     if ($city['id'] == 02) {
        //         dd($city);
        // }}


        return view('layouts.pages.suppliers.create', ['cities' => $this->city]);
    }


    public function getDistricts($cityId ) {

        $this->supplier_create();

        // Duyệt qua danh sách các thành phố
        foreach ($this->city as $city) {
            // Kiểm tra ID của thành phố
            if ($city['id'] == $cityId) {
                // Kiểm tra sự tồn tại của 'data2'
                $this->districts = $city['data2'];
                break; // Thoát khỏi vòng lặp khi tìm thấy thành phố
            }
        }
        return response()->json(['data' => $this->districts]);
    }


    public function getWards( $cityId, $districtId) {
        $this->getDistricts($cityId);
        foreach($this->districts as $ward) {
            if($ward['id'] == $districtId){
                $this->wards = $ward['data3'];
                break;
            }
        }


        return response()->json(['data' =>  $this->wards]);
    }







    public function supplier_created(SupplierRequest $request){

        $this->supplier_create();

        foreach($this->city as $d ){
            if($d['id'] ==  $request->city){
                foreach($d['data2'] as $d2){
                    if($d2['id']  == $request->district){
                        foreach($d2['data3'] as $d3){
                            if($d3['id']  == $request->ward){
                                Supplier::create([
                                    'name' => $request->name,
                                    'city' => $d['name'],
                                    'district' => $d2['name'],
                                    'ward' => $d3['name'],
                                    'address' => $request->address,
                                    'phone' => $request->phone,

                                ]);
                            }
                        }
                    }
                }

                }
            }



        return redirect()->route('supplier.index')->with('msg', 'Thêm thành công');
    }


    public function supplier_edit($id){
        $this->supplier_create();

        $cities = $this->city;

        $supplier = Supplier::find($id);


        return view('layouts.pages.suppliers.edit' , compact('cities','supplier'));
    }


    public function supplier_edited($id , SupplierRequest $request){
        $this->supplier_create();
        $supplier = Supplier::find($id);



        foreach($this->city as $d ){
            if($d['id'] ==  $request->city){
                foreach($d['data2'] as $d2){
                    if($d2['id']  == $request->district){
                        foreach($d2['data3'] as $d3){

                            if($d3['id']  == $request->ward){
                                $supplier->update([
                                    'name' => $request->name,
                                    'city' => $d['name'],
                                    'district' => $d2['name'],
                                    'ward' => $d3['name'],
                                    'address' => $request->address,
                                    'phone' => $request->phone,

                                ]);
                            }
                        }
                    }
                }

                }
            }

            return redirect()->route('supplier.index')->with('msg', 'Cập nhật thành công');
    }


    public function supplier_delete($id){
        $supplier = Supplier::find($id);

        if ($supplier) {
            $supplier->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
