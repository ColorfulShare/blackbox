@extends('layouts/contentLayoutMaster')

@section('title', 'Documentos')

@section('content')

@push('css')
<style>
    html .content.app-content {
        height: 150% !important;
    }

</style>
@endpush

<div class="row"></div>
<div class="col-12 d-flex justify-content-between">
    <h1>{{ $documents->name }}</h1>
    <a href="{{ route('documents.show')}}" class="btn btn-secondary mx-1">Volver a la lista</a>
</div>
</div>
<div class="row d-flex justify-content-center mt-3">
    <div class="container-fluid mb-3">
        <iframe src="{{ asset('storage/documents/'.$documents->file) }}" class=" d-block w-100" height="600%"
            frameborder="0"></iframe>
    </div>
</div>

@endsection
