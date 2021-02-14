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

Route::get('/', function () {
    return view('welcome');
});

Route:: get('/model', function(){
    //$products = \App\Product::all(); // select * from products
    //return $products;

    // $user = new \App\User();
    // $user->name = 'Usuario Teste';
    // $user->email = 'email@teste.com';
    // $user->password = bcrypt('12345678');
    // $user->save();
    
    //Mass Asignment
    // $user = \App\User::create([
    //     'name' => 'Nanderson Costa',
    //     'email' => 'email100@email.com',
    //     'password' => bcrypt('12345678')
    // ]);

    //Mass Update
    // $user = \App\User::find(42);
    // $user->update([
    //     'name' => 'Nanderson Costa atualizado'
    // ]); //true ou false

    
    //return \App\User::find(14); retorna conforme o id
    //return \App\User::where('name', 'Prof. Jarvis Waters I')->get(); //select * from users where name = 'Prof. Jarvis Waters I', poderia usar o ->first primeiro resultado
    //return \App\User::paginate(10); paginar dados com laravel

    //Como faria para pegar a loja de um usuario
    // $user = \App\User::find(4);

    // dd($user->store()->count());  //se for chamado como atributo retorn todos os valores
    
    //como pegar produtos de uma loja
    // $store = \App\Store::find(1);
    // return $store->products; //caso queira um esepcifico $store ->products()->where('id, num)->get();
    
    //pegar produtos por categoria
    // $category = \App\Category::find(10);
    // return $category->products;
    
    //criado loja apra usuario
    // $user = \App\User::find(10);
    // $store = $user->store()->create([
    //     'name' => 'Loja Teste',
    //     'description' => 'Loja Teste de produtos de informatica',
    //     'mobile_phone' => 'xx-xxxx-xxxx',
    //     'phone' => 'xx-xxxx-xxxx',
    //     'phone' => 'Loja Teste',
    //     'slug' => 'loja-teste',
    // ]);

    //criar produto para loja
    // $store = \App\Store::find(41);
    // $product = $store->products()->create([
    //     'name' => 'Notebook Dell',
    //     'description' => 'CORE I5 10GB',
    //     'body' => 'qualquer coisa',
    //     'price' => '2999.99',
    //     'slug' => 'notebook-dell',
    // ]);
    // dd($product);

    //criando categorias
    // $category = \App\Category::create([
    //     'name' => 'Games',
    //     'description' => null,
    //     'slug' => 'games',
    // ]);
    // $category = \App\Category::create([
    //     'name' => 'Notebooks',
    //     'description' => null,
    //     'slug' => 'notebooks',
    // ]);
    // return \App\Category::all();
    // $product =  \App\Product::find(49);
    // $product->categories()->sync([1,2]); //attach adiciona e detach remove
    //sync [1,2] adicionou caso nao existia  [2] removeu a relacao 1

    $product =  \App\Product::find(49);
    return $product->categories;
});



Route::prefix('admin')->namespace('Admin')->group(function()
{   
    Route::prefix('stores')->group(function(){
        Route:: get('/', 'StoreController@index');
        Route:: get('/create', 'StoreController@create');
        Route:: post('/store', 'StoreController@store');
    });
});

/*
rotas laravel
Route::get
Route::post
Route::put
Route::patch
Route::delete
Route::options
*/