@extends('layouts/contentLayoutMaster')


@section('content')
<div id="logs-list">
  <div class="col-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body card-dashboard">
          <div class="table-responsive">
            <h1 class="">Retiros</h1>
            <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100 text-white ">
              <thead class="">

                <tr class="text-center  text-dark">
                  <th>ID</th>
                  <th>Usuario</th>
                  <th>Monto</th>
                  <th>Estado</th>
                  <th>Hash</th>
                  <th>Fecha</th>
                </tr>

              </thead>

              <tbody>

                @foreach ($payments as $item)
                <tr class="text-center">
                  <td>{{$item->id}}</td>
                  <td>{{ $item->fullname}}</td>
                  <td>{{$item->monto_bruto}}</td>
                  @if ($item->status == '0')
                  <td>En espera</td>
                  @elseif($item->status == '1')
                  <td>Pagado</td>
                  @elseif($item->status == '2')
                  <td>Cancelado</td>
                  @endif
                  @if($item->hash === NULL)
                  <td> - </td>
                  @else
                  {{$item->hash}}
                  @endif




                  <td>{{$item->created_at}}</td>
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