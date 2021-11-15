@extends('layouts/contentLayoutMaster')

@section('title', 'Editando ticket')

@section('content')

 <div class="row breadcrumbs-top">
   <div class="col-6 col-md-4" style="padding-left: 90%">
        <a href="{{ route('ticket.list-user')}}" class="btn btn-danger  mb-2  waves-effect waves-light">Volver Atrás</a>             
  </div>
</div>


<section>

    <div class="row match-height d-flex justify-content-center">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{route('ticket.update-user', $ticket->id)}}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="col-12 mt-1">
                                <label class="form-label text-dark mb-1" for="issue"><b>Sujeto</b></label>
                                <input class="form-control" type="text" name="issue" value="{{ $ticket->issue }}" rows="3" disabled />
                            </div>


                            <div class="col-12 mt-2 mb-2">
                                <label class="form-label text-dark mb-1" for="message"><b>Chat con el administrador</b></label>

                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 mx-auto ">
                                            <div class="card">

                                                <div class="card-body chat-care rounded" style=" background: rgb(240, 230, 140) ">
                                                    <ul class="chat">
                                                        @foreach ( $message as $item )
                                                        {{-- user --}}
                                                        @if ($item->type == 0)
                                                        <li class="agent clearfix">
                                                            <div class="chat-body clearfix">
                                                                <div class="header clearfix">
                                                                    <strong class="primary-font">{{ $item->getUser->firstname}} {{ $item->getUser->lastname}}</strong>
                                                                </div>
                                                                <p>
                                                                    {{ $item->message }}
                                                                </p>
                                                            </div>
                                                        </li>

                                                        {{-- admin --}}
                                                        @elseif ($item->type == 1)
                                                        <li class="admin clearfix">
                                                            <div class="chat-body clearfix">
                                                                <div class="header clearfix">

                                                                    <strong class="right primary-font">{{ $item->getAdmin->firstname }} {{ $item->getAdmin->lastname}}</strong>
                                                                </div>
                                                                <p>
                                                                    {{ $item->message }}
                                                                </p>
                                                            </div>
                                                        </li>
                                                        @endif
                                                        @endforeach
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <span class="text-dark">Respuesta</span>
                                <textarea class="text-tex form-control" type="text" name="message" rows="3"></textarea>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="col-12 btn btn-danger  mb-1 waves-effect waves- float-right">Actualizar
                                    Ticket</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
</section>


@endsection