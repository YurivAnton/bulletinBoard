<?php

namespace App\Http\Controllers;

use App\Bulletin;
use App\Category;
use App\Subcategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Delete extends Controller
{
    public function delete(Request $request)
    {
        if($request->has('bulletin')){
            $id = $request->bulletin;
            $bulletin = Bulletin::find($id);
            $bulletin->delete();

            return redirect("/admin?bulletin=all")->with('status', 'Delete successful');
        }

        if ($request->has('user')){
            $id = $request->user;
            if ($id == Auth::id()){
                return redirect("/admin?user=all")->with('status', 'You cannot delete yourself');
            }else{
                $user = User::find($id);
                $user->delete();

                return redirect("/admin?user=all")->with('status', 'Delete successful');
            }
        }

        if ($request->has('category')){
            $id = $request->category;
            $category = Category::find($id);
            $category->delete();

            return redirect("/admin")->with('status', 'Delete successful');
        }

        if ($request->has('subCategory')){
            $id = $request->subCategory;
            $subCategory = Subcategory::find($id);
            $subCategory->delete();

            return redirect("/admin")->with('status', 'Delete successful');
        }
    }
}
