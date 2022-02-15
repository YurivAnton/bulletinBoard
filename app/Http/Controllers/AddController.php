<?php

namespace App\Http\Controllers;

use App\Bulletin;
use App\Category;
use App\Subcategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddController extends Controller
{
    public function add(Request $request)
    {
        if ($request->has('author')) {
            $user = Auth::user();
            if ($user->banned == null) {
                $bulletin = new Bulletin();
                $bulletin->author = $request->author;
                $bulletin->text = $request->text;
                $bulletin->subcategory_id = $request->subcategoryId;
                $bulletin->status = 1;
                $bulletin->save();
                if ($request->has('subcategory')) {
                    return redirect("/$request->category/$request->subcategory")->with('status', 'add successful');
                } else {
                    return redirect("/$request->category")->with('status', 'add successful');
                }
            } else {
                if ($request->has('subcategory')) {
                    return redirect("/$request->category/$request->subcategory")->with('status', 'you are banned');
                } else {
                    return redirect("/$request->category")->with('status', 'you are banned');
                }
            }
        }

        if ($request->has('editUserId')){
            $rules = [
                'editName'=>'required|alpha_num',
                'editEmail'=>'required|email'
            ];
            $this->validate($request, $rules);

            $id = $request->editUserId;
            $user = User::find($id);
            $user->name = $request->editName;
            $user->banned = $request->banned;
            $user->email = $request->editEmail;
            $user->save();

            return redirect("/admin?user=$user->name")->with('status', 'Edit successful');
        }

        if ($request->has('editBulletinId')){
            $id = $request->editBulletinId;
            $bulletin = Bulletin::find($id);
            $bulletin->author = $request->editAuthor;
            $bulletin->status = $request->status;
            $bulletin->text = $request->editText;
            $bulletin->save();

            return redirect("/admin?bulletin=$bulletin->id")->with('status', 'Edit successful');
        }

        if ($request->has('newCategoryName')){
            $rules = [
                'newCategoryName'=>'required|alpha_num',
            ];
            $this->validate($request, $rules);

            $category = new Category();
            $category->name = $request->newCategoryName;
            $category->save();

            return redirect('/admin')->with('status', 'Add new category successful');
        }

        if ($request->has('newSubCategoryName')){
            $rules = [
                'newSubCategoryName'=>'required|alpha_num',
            ];
            $this->validate($request, $rules);

            $subCategory = new Subcategory();
            $subCategory->name = $request->newSubCategoryName;
            if ($request->has('newCategory')){
                $category = new Category();
                $category->name = $request->newCategory;
                $category->save();
                $categoryId = Category::max('id');
                $subCategory->category_id = $categoryId;
            }else{
                $subCategory->category_id = $request->oldCategory;
            }
            $subCategory->save();

            return redirect('/admin')->with('status', 'Add new subCategory successful');
        }
    }
}
