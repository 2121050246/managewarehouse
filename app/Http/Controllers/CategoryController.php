<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\SortTable;

class CategoryController extends Controller
{
    use SortTable;

    public function index(Request $request){

            $categories = Category::latest()->paginate(7);


        return view('layouts.pages.categories.index', compact('categories' ));
    }


    public function search(Request $request)
    {

        $query = $request->input('query');



        if ($query) {

            $categories = Category::where('name', 'LIKE', "%{$query}%")->paginate(7);
        } else {

            $categories = Category::latest()->paginate(7);
        }

        return view('layouts.pages.categories.category_list', compact('categories'));
    }




    public function getCategory(){
        return view('layouts.pages.categories.create');
    }

    public function back_index(){

        return redirect()->route('category');
    }

    public function postCategory(Request $request){


        $numbers = '0123456789';
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $index = rand(0, strlen($numbers) - 1);
            $randomString .= $numbers[$index];
        }



        Category::create(
            [
                'code' => $randomString,
                'name' => $request->name,
            ]
        );

        return redirect()->route('category')->with('msg', 'Thêm thành công ');
    }


    public function getEdit($id){

        $category = Category::find($id);
        return view('layouts.pages.categories.edit' , compact('category'));
    }


    public function postEdit($id , Request $request){

        $category = Category::find($id);

        $category->update(
            [
                'name' => $request->name,
            ]
        );

        return redirect()->route('category')->with('msg', 'Cập nhật  thành công ');
    }




    public function deleteCategory($id){
        $category = Category::find($id);


        if ($category) {
            $category->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }


    }
}
