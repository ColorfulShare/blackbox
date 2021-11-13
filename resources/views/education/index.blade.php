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
  @endsection

@section('content')
<div class="col-12">
    <div class="card bg-lp">
        <div class="card-content">
            <div class="card-body ">
                <div class="table-responsive">
                    <h1><strong >Lista de Educacion</strong></h1>
                    <table class="table nowrap scroll-horizontal-vertical myTable2 table-striped mt-2">
                        <thead>
                            <tr class="text-center ">
                                <th>#</th>
                                <th>descripcion</th>
                                <th>Imagen</th>
                                <th>Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($education as $item)
                            <tr class="text-center">
                                <td>{{$item->id}}</td>
                                <td>{{$item->description}}</td>
                                @if ($item->image === null)
                                <td><p>Informacion no disponible</p></td>
                                @else
                                <td></td>
                                @endif
                                <td>{{$item->link}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
@endsection
{{-- CONFIGURACIÓN DE DATATABLE --}}
@include('panels.datatables-config')
