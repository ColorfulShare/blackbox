@extends('layouts/contentLayoutMaster')

@section('title', 'Editando noticia')

@section('content')

<div class="row d-flex justify-content-center">
    <div class="card col-12">

        <div class="card-header">
            <h1>Noticia N° {{ $news->id }}</h1>
        </div>

        <div class="card-content">
            <div class="card-body">
                <form action="{{route('news.update', $news->id)}}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="title"><b>Titulo</b></label>
                                <input type="text" name="title" class="form-control" required value="{{ $news->title}}">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="status"><b>Estado de la noticia</b></label>
                                <select name="status" class="form-control custom-select" required>
                                    <option value="0" @if($news->status == '0') selected @endif>Activo</option>
                                    <option value="1" @if($news->status == '1') selected @endif>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <label class="form-label" for="content"><b>Contenido de la noticia</b></label>
                                <textarea name="content" id="tiny" class="form-control" cols="30" rows="5" required>{{ $news->content }}</textarea>
                            </div>
                        </div>

                        <div class="col-12 mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mx-1">Actualizar</button>
                            <a href="{{ route('news.list')}}" class="btn btn-secondary mx-1">Volver Atrás</a>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

