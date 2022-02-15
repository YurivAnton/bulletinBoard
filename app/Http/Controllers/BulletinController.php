<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BulletinController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $subCategories = Subcategory::all();

        if (!empty($categories)) {
            return view('index', [
                'categories' => $categories,
                'subCategories' => $subCategories
            ]);
        }else{
            return view('index', [
                'categories' => [],
                'subCategories' => []
            ]);
        }
    }

    public function showSubCategory($category, $subCategory = null)
    {
        $categories = Category::all();
        $subCategories = Subcategory::all();
        $cat = Category::where('name', '=', $category)->first();
        $sub = Subcategory::where('name', '=', $subCategory)->first();
        $user = Auth::user();

        if (empty($sub)){
            $id = $cat->id;
            $bulletins = Category::find($id)->bulletins;
        }else{
            $id = $sub->id;
            $bulletins = Subcategory::find($id)->bulletins;
        }

        return view('show', [
            'cat'=>$cat,
            'sub'=>$sub,
            'user'=>$user,
            'bulletins'=>$bulletins,
            'categories'=>$categories,
            'subCategories'=>$subCategories
        ]);
    }
}
