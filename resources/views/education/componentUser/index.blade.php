@extends('layouts/contentLayoutMaster')

@section('title', 'Educacion')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-list.css')) }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" />
@endsection

@section('content')
<div class="content-body mb-5 mt-2">
  <div class="card">
    <h3 class="card-header mb-2"><strong>Lista de educacion</h3></strong></h3>
    <div class="container">
      <div class="row">
        @foreach ($education as $item)
        <div class="card container-fluid" style="width: 18rem;">
          <a href="/storage/education/{{$item->image}}" data-lightbox="image" data-title="Link : {{$item->link}}">
            <img src="/storage/education/{{$item->image}}" class="card-img-top rounded" height="160" width="90px">
          </a>
          <div class="card-body">
            <div class=" h4   text-white" id="shadow">
              <div style="position: relative;" class="">{{$item->description}}</div>
              <hr>
            </div>
            <div class="d-grid gap-2 col-12 mx-auto">
              <a href="{{ $item->link }}" target="_blank" class="btn btn-primary">LINK ZOOM</a>

            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endsection
{{-- CONFIGURACIÓN DE DATATABLE --}}
@include('panels.datatables-config')