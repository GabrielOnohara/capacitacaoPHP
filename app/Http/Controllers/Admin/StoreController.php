<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Store;

class StoreController extends Controller
{   
    private $store;
    public function __construct(Store $store){
        $this->store = $store;
    }

    public function index()
    {
        $stores = $this->store->paginate(10);
        return view('admin.stores.index', compact('stores'));
    }

    public function create()
    {
        $users = \App\User::all(['id','name']);
        return view('admin.stores.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();

        $store =  $user->store()->create($data);

        flash('Loja Criada com Sucesso')->success();
        return redirect()->route('admin.stores.index');
    }

    public function edit($store)
    {
        $store = $this->store->findOrFail($store);
        return view('admin.stores.edit', compact('store'));
    }

    public function update(Request $request, $store)
    {
        $data = $request->all();
        $store = $this->store->find($store);
        $store->update($data);

       flash('Loja Atualizada com Sucesso')->success();
       return redirect()->route('admin.stores.index');
    }    
    public function destroy($store)
    {
        $store = $this->store->find($store);
        $store->delete();
        flash('Loja Removida com Sucesso')->success();
        return redirect()->route('admin.stores.index');
    }
}
