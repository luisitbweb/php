<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/produtos/{idProduct?}/details', function ($idProduct = ''){
    return "Produto(s) {$idProduct}";
});
Route::get('/categoria/{flag}/posts', function ($flag){
    return "Posts da categoria: {$flag}";
});

Route::get('/categorias/{flag}', function ($flag){
    return "Produtos da categoria: {$flag}";
});

Route::match(['post', 'get'], '/match', function (){
    return 'match';
});

Route::any('/any', function (){
    return 'any';
});

Route::post('/register', function () {
    return'welcome';
});

Route::get('/contato', function () {
    return view('contact');
});

Route::get('/empresa', function () {
    return 'Sobre a Empresa';
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('redirect2', function (){
    return 'Redirect 02';
});

Route::redirect('redirect1', '/redirect2');

Route::get('/view', function (){
    return view('teste');
});

Route::middleware([])->group(function (){

    Route::prefix('admin')->group(function (){

        Route::namespace('Admin')->group(function (){

            Route::name('admin.')->group(function () {
                
                Route::get('/dashboard', 'TesteController@teste')->name('dashboard');

                Route::get('/financeiro', 'TesteController@teste')->name('financeiro');
                Route::get('/produtos', 'TesteController@teste')->name('products');

                Route::get('/', function (){
                    return redirect()->route('admin.dashboard');
                })->name('home');
            });
        });
    });
});

Route::get('/login', function(){
    return 'Login';
})->name('login');
