@extends('layouts/contentLayoutMaster')

@section('title', 'Historial de Tickets')

@section('content')


<div class="card">
    <table class="table">
        <thead>
            <tr class="text-center">
                <th>SL</th>
                <th>Sujeto</th>
                <th>Estado</th>
                <th>Última Respuesta</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($ticket as $item)
            <tr class="text-center">
                <td># {{ $item->id}}</td>
                <td>[Ticket #{{ $item->iduser}}] {{$item->issue}}</td>


                @if ($item->status == '0')
                <td> <a class=" btn text-bold-600 text-white" style="background: rgba(0, 246, 225, 0.77);border-radius: 8px;">Abierto</a></td>
                @elseif($item->status == '1')
                <td> <a class=" btn  text-bold-600 text-white" style="background: rgba(246, 74, 0, 0.77);border-radius: 8px;">Cerrado</a></td>
                @endif

                <td>{{$item->send}}</td>

                <td><a href="{{ route('ticket.edit-admin',$item->id) }}">
                        <buttom class=" btn  text-bold-600 text-white" style="background: rgba(246, 74, 0, 0.77);border-radius: 8px;">Revisar</buttom>
                    </a></td>
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