<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

//Route::get('/home', 'HomeController@index');

Route::get('/', 'BulletinController@index');
Route::get('/admin', 'AdminController@admin')->middleware('auth', 'CheckRole:admin');
Route::get('/edit', 'EditController@edit')->middleware('auth', 'CheckRole:admin');
Route::get('/delete', 'Delete@delete')->middleware('auth', 'CheckRole:admin');
Route::get('/add', 'AddController@add')->middleware('auth');
Route::get('/{category?}/{subCategory?}', 'BulletinController@showSubCategory');

Route::get('/{category}/{subCategory?}', function ($category){
   if ($category == 'admin'){
       return redirect()->action('AdminController@admin');
   }elseif ($category == 'add'){
       return redirect()->action('AddController@add');
   }elseif ($category == 'edit'){
       return redirect()->action('EditController@edit');
   }elseif($category == 'delete'){
       return redirect()->action('Delete@delete');
   }else{
       return redirect()->action('BulletinController@showSubCategory');
   }
});


