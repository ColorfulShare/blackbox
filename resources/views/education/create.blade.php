@extends('layouts/contentLayoutMaster')

@section('content')

<div class="card text-center">
  <div class="card-body">
    <h2 class="text-center mb-5">Crear Nueva educacion</h2>

    <form method="POST" action="{{ route('education.store') }}" enctype="multipart/form-data" novalidate>
      @csrf
      <div class="form-group">
        <label for="description" style="float:left;" class="h4"><strong>Descripcion</strong> :</label>
        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror " placeholder="Agregar Descripcion">
        @error('description')
        <span class="invalid-feedback d-block" role="alert">
          <strong>{{$message}}</strong>
        </span>
        @enderror
      </div>
      <div class="form-group mt-3">
        <label for="link" style="float:left;" class="h4"><strong>Link</strong> :</label>
        <input type="text" name="link" class="form-control @error('link') is-invalid @enderror " placeholder="Agregar Link">

        @error('link')
        <span class="invalid-feedback d-block" role="alert">
          <strong>{{$message}}</strong>
        </span>
        @enderror
      </div>
      <div class="form-group mt-3">
        <label for="image" style="float:left;" class="h4"><strong>Elige la imagen</strong> :</label>

        <input id="image" accept="image/*" type="file" class="form-control mb-5 @error('image') is-invalid @enderror " name="image" value="{{ old('image') }}">

        @error('image')
        <span class="invalid-feedback d-block" role="alert">
          <strong>{{$message}}</strong>
        </span>
        @enderror
      </div>

    <div class="card-footer text-muted" >
      <button class="btn btn-primary" style="font-weight: bold;">Añadir nueva educacion</button>
    </div>
    </form>
  </div>

  @endsection