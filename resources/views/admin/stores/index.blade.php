@extends('layouts.app')
@section('content')

    <table class="table table-striped">
        <a href="{{route('admin.stores.create')}}" class="btn btn-lg btn-success">Criar Loja</a>
        <thead>
            <tr>
                <th>#</th>
                <th>Loja</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stores as $store)  
                <tr>
                    <td>{{$store->id}}</td>
                    <td>{{$store->name}}</td>
                    <td>
                    <div class="btn-group-horizontal">
                            <a href="{{route('admin.stores.edit' , ['store' => $store->id])}}" class="btn btn-sm btn-primary">Editar</a>
                            <form class="btn" action="{{route('admin.stores.destroy' , ['store' => $store->id])}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

{{$stores->links()}}
@endsection