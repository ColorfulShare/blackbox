@extends('layouts/contentLayoutMaster')

@section('title', 'Editando noticia')

@section('content')

<div class="row d-flex justify-content-center">
    <div class="card col-12">

        <div class="card-header d-flex justify-content-center">
            <h1 class=" text-uppercase">{{ $news->title }}</h1>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row ">
                    <div class="col-12 mt-2 d-flex justify-content-center">
                        <p>{!! $news->description !!}</p>
                    </div>
                    @if ($news->banner != null)
                    <div class="col-12 mt-2 d-flex justify-content-center">
                        <img src="{{asset('storage/news-banner/'.$news->banner)}}" alt="" width="50%" class="img-fluid">
                    </div>  
                    @endif
                    <div class="col-12 mt-3 d-flex justify-content-end">
                        <a href="{{ route('news.list')}}" class="btn btn-secondary mx-1">Volver a la lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
