<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category = null)
    {       
        return view('categories.index',[
                'categories' => Category::all()
            ]); 
    }

    public function addCategory(Request $request){

        $attributes = $request->validate([
            'category' => ['required', 'max:255', 'unique:categories,name']
        ]);
        
        try {
            DB::table('categories')->insert([
                'name' => request()->input('category')
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
        
        $allCategories = Category::all();

        // Return all categories:
        return response()->json($allCategories);

        // Return inserted category:
        // return response()->json(request()->input('param1'));  
        
    }

    public function deleteCategory(){
        
        try {
            // DB::table('categories')->delete([
            //     'name' => request()->input('category')
            // ]);
            DB::table('categories')->where('name', '=', request()->input('category'))->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
        
        $allCategories = Category::all();

        // Return all categories:
        return response()->json($allCategories);

        // Return inserted category:
        // return response()->json(request()->input('param1'));  
    }
}