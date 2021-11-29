@extends('layouts/contentLayoutMaster')


@section('title', 'Retiros')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection

@section('page-style')
  <!-- Page css files -->

@endsection
{{-- contenido --}}
@section('content')

<div class="row">
    <div class="col-sm-3 col-10 mt-1">
        <div class="card p-1">
            <div class="card-header d-flex ">
                <h2 class="font-weight-light"><b>Saldo disponible</b></h2>
            </div>
            
            <div class="d-flex">
                <h1 class="px-2"><b>$ {{ number_format($saldoDisponible, 2, ',', '.')}}</b></h1>
            </div>

            @if(!Request::post('user_id'))

            <div class="d-grid gap-2 mt-1 col-12 mx-auto">
                <a class="btn btn-primary" href="{{route('wallet.withdraw')}}"><span style="font-weight:bold;">RETIRAR</span></a>
            </div>
            @endif
        </div>
     </div>

    <div class="col-sm-9 col-12 mt-1">
        <div class="card bg-lp">
            <div class="card-content">
                <div class="card-body card-dashboard p-0">
                    <div class="table-responsive">
                        <h3 class=" p-1">Billetera</h3>
                        <table class="table  myTable">
                            <thead>

                                <tr class="text-center text-dark text-uppercase pl-2">
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Email</th>
                                    <th>Monto</th>
                                </tr>

                            </thead>
                            <tbody >
                                @foreach($wallets as $orden)
                                <tr class="text-center">
                                    <td>{{date('d-m-Y', strtotime($orden->created_at));}}</td>
                                    <td>
                                        {{$orden->descripcion}}        
                                    </td>
                                    <td>
                                        <button type="button"
                                            class="@if ($orden->status == '0') btn btn-warning text-white text-bold-600 @elseif($orden->status == '1') btn btn-success text-white text-bold-600 @elseif($orden->status == '3') btn btn-danger text-white text-bold-600 @endif">{{$orden->status()}}
                                        </button>
                                    </td>
                                    <td>
                                        @if(isset($orden->getWalletReferred))
                                            {{$orden->getWalletReferred->email}}
                                        @else
                                         Sin referido
                                        @endif
                                    </td>
                                    <td>{{ number_format($orden->amount, 2, ',', '.') }}</td>
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
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
 
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