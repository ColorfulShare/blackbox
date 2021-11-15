@extends('layouts/contentLayoutMaster')
@section('content')
<h2 class="text-center mb-5">Crear Nueva educacion</h2>
<div class="row justify-content-center mt-5">
 <div class="col-md-8">
   <form method="POST" action="{{ route('education.store') }}" enctype="multipart/form-data" novalidate>
   @csrf
     <div class="form-group">
       <label for="description">Descripcion :</label>
       <input type="text" name="description" class="form-control @error('description') is-invalid @enderror " placeholder="Agregar Descripcion"  > 
        @error('description')
          <span class="invalid-feedback d-block" role="alert">
            <strong>{{$message}}</strong>
          </span>
        @enderror
    </div>
    <div class="form-group mt-3">
       <label for="link">Link :</label>
       <input type="text" name="link" class="form-control @error('link') is-invalid @enderror "  placeholder="Agregar Link"  > 

        @error('link')
          <span class="invalid-feedback d-block" role="alert">
            <strong>{{$message}}</strong>
          </span>
        @enderror
    </div>
    <div class="form-group mt-3">
       <label for="image">Elige la imagen :</label>

       <input id="image" accept="image/*" type="file" class="form-control @error('image') is-invalid @enderror " name="image" value="{{ old('image') }}">

        @error('image')
          <span class="invalid-feedback d-block" role="alert">
            <strong>{{$message}}</strong>
          </span>
        @enderror 
      </div> 

     <div class="form-group mt-3" style="padding-left: 75%">
       <input type="submit" class="btn btn-primary" value="Agregar educacion">
    </div>   
   </form> 
 </div>
</div>
@endsection

