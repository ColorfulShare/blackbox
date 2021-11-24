@extends('layouts/contentLayoutMaster')


{{-- contenido --}}
@section('content')

<div class="row">
    <div class="col-sm-3 col-10 mt-1">
        <div class="card p-1">
            <div class="card-header d-flex ">
                <h2 class="font-weight-light"><b>Saldo disponible</b></h2>
            </div>
            
            <div class="d-flex">
                <h1 class="px-2"><b>$ {{$saldoDisponible}}</b></h1>
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
                        <table class="table nowrap scroll-horizontal-vertical myTable2">
                            <thead>

                                <tr class="text-center text-dark text-uppercase pl-2">
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                    <th>Email</th>
                                    <th>Monto</th>
                                </tr>

                            </thead>
                            <tbody >
                                @foreach($wallets as $orden)
                                <tr class="text-center">
                                    <td>{{date('d-m-Y', strtotime($orden->created_at));}}</td>
                                    <td>
                                        <div class="d-flex flex-column ">
                                            {{$orden->descripcion}}
                                            <br>
                                        
                                               <p>
                                                    @if ($orden->status == '0')
                                                    <span class="dot en espera "></span>En Espera
                                                    @elseif($orden->status == '1')
                                                    <span class="dot completado"></span> Completado
                                                    @elseif($orden->status >= '2')
                                                    <span class="dot cancelado"></span> Cancelado
                                                    @endif
                                               </p>
                                        </div>
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