<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    public function category()
    {
        return view('categories.category');

    }

    public function addcategory(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'category' => 'required',

        ]);
           $category = new Category();
           $category->category = $request->input('category');
           $category->save();
           return redirect()->to('/category')->with('response','Category Added Successfully');


           }

}
