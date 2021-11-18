@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de documentos')

@section('content')

<div class="card p-2">
    <div class="card-header d-flex justify-content-end">
        <a href="{{ route('documents.create') }}" class="btn btn-primary">Subir nueva documento</a>
    </div>
    <table class="table myTable border rounded">
        <thead>
            <tr class="text-center">
                <th>id</th>
                <th>nombre</th>
                <th>tipo de archivo</th>
                <th>Fecha de Subida</th>
                <th>Acción</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($documents as $item)
            <tr class="text-center">
                <td>N° {{ $item->id}}</td>
                <td>{{ $item->name}}</td>

                @if ($item->type == 'pdf')
                <td> <a class="badge rounded-pill badge-light-danger">PDF</a></td>
                @else
                <td> <a class="badge rounded-pill badge-light-info">Video</a></td>
                @endif

                <td>{{ date('d-m-Y', strtotime($item->created_at))}}</td>
                <td>
                    <a href="{{ route('documents.edit', $item->id) }}"><i class="text-primary font-medium-3"
                            data-feather='edit'></i></a>

                    <a href="#" class="delete"><i class="text-danger font-medium-3" data-feather='trash'></i>
                        <form id="delete" action="{{ route('documents.destroy', $item->id) }}" method="POST">
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
