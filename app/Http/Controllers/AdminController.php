<?php

namespace App\Http\Controllers;

use App\Bulletin;
use App\User;
use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $table = '';
    private $form = '';

    public function admin(Request $request)
    {
        $users = User::all();
        $bulletins = Bulletin::all();
        $categories = Category::all();
        $subCategories = Subcategory::all();
        $view = 'admin';
        $addSub = '';

        if ($request->has('user')){
            $view = 'user';
            $this->show('user', $request->get('user'), $request->get('banned'));
        }elseif ($request->has('bulletin')){
            $view = 'bulletin';
            $this->show('bulletin', $request->get('bulletin'), $request->get('status'));
        }elseif ($request->has('add')){
            $view = 'add';

            if ($request->get('add') == 'subCategory'){
                $addSub = '+';
            }
        }

        if ($request->has('ban')){
            if($request->has('userId')) {
                $id = $request->userId;
                $user = User::find($id);
                $user->banned = $request->ban;
                $user->save();

                return redirect('/admin?user=all');
            }else{
                $id = $request->bulletinId;
                $bulletin = Bulletin::find($id);
                $bulletin->status = $request->ban;
                $bulletin->save();

                return redirect('/admin?bulletin=all');
            }
        }



        return view($view, [
            'users'=>$users,
            'bulletins'=>$bulletins,
            'categories'=>$categories,
            'subCategories'=>$subCategories,
            'table'=>$this->table,
            'form'=>$this->form,
            'addSub'=>$addSub,
        ]);
    }

    private function show($what, $name, $status)
    {
        if ($name == 'all'){
            if ($status == 1){
                if ($what == 'user') {
                    $this->table = User::where('banned', '!=', 0)->get();
                }elseif ($what == 'bulletin'){
                    $this->table = Bulletin::where('status', '==', 0)->get();
                }
            }else{
                if ($what == 'user') {
                    $this->table = User::all();
                }elseif ($what == 'bulletin'){
                    $this->table = Bulletin::all();
                }
            }
        }else{
            if ($what == 'user') {
                $this->form = User::where('name', '=', $name)->first();
            }else{

                if (preg_match_all('#edit-(\d+)#', $name, $editId)){
                    $id = $editId[1][0];
                    $this->form = Bulletin::find($id);
                }else{
                    $preg = preg_match('#^\d+$#', $name);
                    if ($preg) {
                        $this->table = Category::find($name)->bulletins;;
                    } else {
                        $this->table = Subcategory::where('name', '=', $name)->first()->bulletins;
                    }
                }
            }
        }
    }
}
