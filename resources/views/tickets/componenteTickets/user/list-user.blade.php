@extends('layouts/contentLayoutMaster')

@section('title', 'Soporte de ticket')

@section('content')

<div class="card">
    <div class="my-2 mx-2"><a href="{{ route('ticket.create')}}" class="btn btn-danger mb-2 waves-effect waves-light"> Nuevo Ticket <i class="fas fa-ticket-alt"></i></a>

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
            @foreach ($ticket as $item)
            <tr class="text-center">
                <td># {{ $item->id}}</td>
                <td>[Ticket #{{ $item->user_id}}] {{$item->issue}}</td>

                @if ($item->status == '0')
                <td> <a class=" btn text-bold-600 text-white" style="background: rgba(0, 246, 225, 0.77);border-radius: 8px;">Abierto</a></td>
                @elseif($item->status == '1')
                <td> <a class=" btn  text-bold-600 text-white" style="background: rgba(246, 74, 0, 0.77);border-radius: 8px;">Cerrado</a></td>
                @endif

                @if ($item->send == '')
                <td>Esperando Respuesta</td>
                @else
                <td>{{$item->send}}</td>
                @endif


                @if ($item->status == '0')
                <td><a href="{{ route('ticket.edit-user',$item->id) }}">
                        <buttom class=" btn text-bold-600 text-white" style="background: rgba(246, 74, 0, 0.77);border-radius: 8px;">Editar</buttom>
                    </a></td>
                @else
                <td><a href="{{ route('ticket.show-user',$item->id) }}">
                        <buttom class=" btn text-bold-600 text-white" style="background: rgba(246, 74, 0, 0.77);border-radius: 8px;">Editar</buttom>
                    </a></td>
                @endif

            </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection