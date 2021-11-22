@extends('layouts/contentLayoutMaster')


@section('content')
<div id="settlement">
    <div class="col-12">
        <div class="card bg-lp">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <h1 class="">Solicitudes de Retiros Realizados</h1>
                        <table class="table nowrap scroll-horizontal-vertical myTable table-striped">
                            <thead class="">
                                <tr class="text-center bg-purple-alt2">
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    {{--<th>Total</th>--}}
                                    <th>Monto</th>
                                    {{--<th>Feed</th>--}}
                                    <th>Hash</th>
                                    <th>Billetera</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($liquidaciones as $liqui)
                                <tr class="text-center ">
                                    <td>{{$liqui->id}}</td>
                                    <td>{{$liqui->fullname}}</td>
                                    {{--<td>{{$liqui->total}}</td>--}}
                                    <td>{{$liqui->monto_bruto}}</td>
                                    {{--<td>{{$liqui->feed}}</td>--}}
                                    <td> @if($liqui->hash == NULL)
                                        -
                                        @else
                                        {{$liqui->hash}}
                                        @endif
                                    </td>
                                    <td>{{$liqui->wallet_used}}</td>
                                    <td>
                                        @if($liqui->status == 0)
                                        En Espera
                                        @elseif($liqui->status == 1)
                                        Liquidado
                                        @endif
                                    </td>
                                    <td>{{date('Y-m-d', strtotime($liqui->created_at))}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--@include('settlement.componentes.modalDetalles', ['all' => false])
    @include('settlement.componentes.modalAction')--}}
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
