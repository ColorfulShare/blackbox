@extends('layouts/contentLayoutMaster')

@section('title', 'Editando noticia')

@section('content')

<div class="row d-flex justify-content-center">
    <div class="card col-12">

        <div class="card-header d-flex justify-content-between">
            <h1>Noticia N° {{ $news->id }}</h1>
            <a href="{{ route('news.list')}}" class="btn btn-secondary mx-1">Volver a la lista</a>
        </div>

        <div class="card-content">
            <div class="card-body">
                <form action="{{route('news.update', $news->id)}}" id="validate" method="POST" enctype="multipart/form-data">
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
                                <select name="status" class="form-select custom-select" required>
                                    <option value="0" @if($news->status == '0') selected @endif>Inactivo</option>
                                    <option value="1" @if($news->status == '1') selected @endif>Activo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <label class="form-label" for="description"><b>Contenido de la noticia</b></label>
                                <textarea name="description" id="tiny" class="form-control" cols="30" rows="5">{{ $news->description }}</textarea>
                            </div>
                        </div>


                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-12 d-flex justify-content-center my-2">
                                        <label class="btn btn-primary btn-lg btn-block" for="banner">Selecciona una imagen de portada</label>
                                    </div>
                                    <div class="col-12">
                                        <input type="file" name="banner" id="banner" class="form-control d-none" onchange="previewFile(this, 'photo_preview')" accept="image/*">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center p-3">
                                        <img id="photo_preview" class="img-fluid rounded" width="400px" />
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mx-1">Actualizar</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function() {
        @if($news->banner != NULL)
            previewPersistedFile("{{asset('storage/news-banner/'.$news->banner)}}", 'photo_preview');
        @endif
    });
</script>
@endpush