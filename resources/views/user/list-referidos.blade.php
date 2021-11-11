
@extends('layouts/contentLayoutMaster')

@section('title', 'Lista referidos')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
<div id="record">
   
    <div class="card">
        <div class="card-content">
            <div class="card-body card-dashboard">
                <div class="table-responsive">
                    <h1>Lista de referidos</h1>
                    <table class="table myTable">
                        
                        <thead class="">
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Estado</th>
                                <th>Nivel</th>
                            </tr>
                        </thead>

                        <tbody>
                             @foreach ($referidos as $item)
                            <tr class="text-center">
                                <td>{{ $item->id}}</td>
                                <td>{{ $item->fullName()}}</td>
                                <td>{{ $item->email}}</td>
                                @if ($item->status == '0')
                                <td><a class=" btn btn-warning text-bold-600">Inactivo</a></td>
                                @elseif($item->status == '1')
                                <td><a class=" btn btn-success text-bold-600">Activo</a></td>
                                @elseif($item->status == '2')
                                <td><a class=" btn btn-danger text-bold-600">Suspendido</a></td>
                                @endif
                                <td>
                                   {{$item->nivel}}
                                </td>
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

