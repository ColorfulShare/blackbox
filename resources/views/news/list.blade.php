@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de noticias')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-end">
        <a href="{{ route('news.create') }}" class="btn btn-primary">Crear nueva noticia</a>
    </div>
    <table class="table">
        <thead>
            <tr class="text-center">
                <th>id</th>
                <th>titulo</th>
                <th>Estado</th>
                <th>Fecha de creación</th>
                <th>Acción</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($news as $item)
            <tr class="text-center">
                <td>N° {{ $item->id}}</td>
                <td>{{ $item->title}}</td>

                @if ($item->status == '1')
                <td> <a class="badge rounded-pill badge-light-success">Activo</a></td>
                @else
                <td> <a class="badge rounded-pill badge-light-danger">Inactivo</a></td>
                @endif

                <td>{{ date('d-m-Y', strtotime($item->created_at))}}</td>
                <td>
                    <a href="{{ route('news.edit', $item->id) }}" class="item-edit"><i class="text-primary"
                            data-feather='edit'></i></a>

                    <a href="javascript:;" class="item-edit delete"><i class="text-danger" data-feather='trash'></i>
                        <form id="delete" action="{{ route('news.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
