@extends('layouts/contentLayoutMaster')

@section('title', 'Usuarios')

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
                    <h1><strong >Lista de usuarios</strong></h1>
                    <table class="table nowrap scroll-horizontal-vertical myTable table-striped mt-2">
                        <thead>
                            <tr class="text-center ">
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>telefono</th>
                                <th>Estado</th>
                                <th>Nivel</th>
                                <th>Ingreso</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                            <tr class="text-center">
                                <td>{{$item->id}}</td>
                                <td>{{$item->firstname}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->phonel}}</td>

                                @if ($item->status == '0')
                                <td> <a class=" btn btn-danger text-white text-bold-600">Inactivo</a></td>
                                @elseif($item->status == '1')
                                <td> <a class=" btn btn-success text-white text-bold-600">Activo</a></td>
                                @elseif($item->status == '2')
                                <td> <a class=" btn btn-warning text-white text-bold-600">Suspendido</a></td>
                                @elseif($item->status == '3')
                                <td> <a class=" btn btn-danger text-white text-bold-600">Bloqueado</a></td>
                                @elseif($item->status == '4')
                                <td> <a class=" btn btn-danger text-white text-bold-600">Caducado</a></td>
                                @elseif($item->status == '5')
                                <td> <a class=" btn btn-danger text-white text-bold-600">Eliminado</a></td>
                                @endif
                                <td>{{$item->nivel}}</td>
                                <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
                                <td>
                                    <form action="{{route('impersonate.start', $item)}}" method="POST" class="btn">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary text-bold-600">
                                            <i data-feather='eye'></i>
                                        </button>

                                    </form>
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
@include('panels.custom-js')
@endsection


@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
@endsection


