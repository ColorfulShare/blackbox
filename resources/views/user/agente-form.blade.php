.......
@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard | Invertir')

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

                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts" class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-md-8 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Convierte en una agente de red o profesional:</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" action="{{route('dashboard.convertir')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="monto">Monto a invertir:</label>
                                            <input
                                            type="number"
                                            id="monto"
                                            class="form-control"
                                            name="monto"
                                            placeholder="Monto a invertir"
                                            min="500"
                                            />
                                        </div>
                                        </div>
                                        <div class="col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="type">Tipo</label>
                                            <select class="form-select" name="type" id="type" required>
                                                <option value="">Seleccione que tipo desea ser:</option>
                                                <option value="red">Agente de red</option>
                                                <option value="profesional">Profesional</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="col-12">
                                        <button type="submit" class="btn btn-primary me-1">Invertir</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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
@section('page-script')
    <script>
        //datataables ordenes
    $('.myTable').DataTable({
        responsive: true,
        order: [[ 0, "desc" ]],
    })
    </script>
@endsection
