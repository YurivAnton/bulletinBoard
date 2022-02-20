<?php

namespace App\Http\Controllers;

use App\Bulletin;
use App\Category;
use App\Subcategory;
use App\User;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function edit(Request $request)
    {
        if ($request->has('editUserId')) {
            $rules = [
                'editName' => 'required|alpha_num',
                'editEmail' => 'required|email'
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

        if ($request->has('editBulletinId')) {
            $id = $request->editBulletinId;
            $bulletin = Bulletin::find($id);
            $bulletin->author = $request->editAuthor;
            $bulletin->status = $request->status;
            $bulletin->text = $request->editText;
            $bulletin->save();

            return redirect("/admin?bulletin=$bulletin->id")->with('status', 'Edit successful');
        }

        if ($request->has('editCategoryId')){
            $id = $request->get('editCategoryId');
            $category = Category::find($id);
            $category->name = $request->name;
            $category->save();

            return redirect("/admin")->with('status', 'Edit successful');
        }

        if ($request->has('editSubCategoryId')){
            $id = $request->get('editSubCategoryId');
            $subCategory = Subcategory::find($id);
            $subCategory->name = $request->name;
            $subCategory->save();

            return redirect("/admin")->with('status', 'Edit successful');
        }
    }
}
