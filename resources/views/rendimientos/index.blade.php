
@extends('layouts/contentLayoutMaster')

@section('title', 'Tienda')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
    
<div id="logs-list">
    <div class="card">
        <div class="card-content">
            <div class="card-body card-dashboard">
                <div class="col-12">
                    <form action="{{route('rendimiento.save.porcentage')}}" method="post">
                        @csrf
                        <h4>Porcentage de Rendimiento</h4>
                        <div class="form-group">
                            <label for="">Rendimiento a pagar</label>
                            <input type="number" name="porcentage" step="any" class="form-control mb-2" onkeyup="calcular(this.value)">
                            <h5>El porcentaje de dividira automaticamente en el sistema</h5>
                            <h5>Porcentaje real a pagar: <span id="mostrar"></span> %</h5>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary">Pagar</button>
                        </div>
                    </form>
                </div>
                <div class="col-12 mt-5">
                    <div class="table-responsive">
                        <table class="table  myTable">
                            <thead class="">

                                <tr class="text-center">
                                    <th>Porcentaje Pagado</th>
                                    <th>Fecha de Pago</th>
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($rendimientos as $rendi)
                                <tr class="text-center">
                                    <td>{{$rendi->monto}} %</td>
                                    <td>{{$rendi->created_at->format('Y-m-d')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
    <script>
        function calcular(valor) {
            
            let result = (valor / 100)
            $('#mostrar').html(result)
        }
    </script>
@endsection



