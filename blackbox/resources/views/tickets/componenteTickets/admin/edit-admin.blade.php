@extends('layouts/contentLayoutMaster')

@section('title', 'Atendiendo el Ticket')

@section('content')

<div class="col-6 col-md-4">

    <a href="{{ route('ticket.list-admin')}}" class="btn btn-danger  mb-2 waves-effect waves-light">Volver Atrás</a>
</div>

<section id="basic-vertical-layouts">
    <div class="row match-height d-flex justify-content-center">
        <div class="col-md-12 col-12">
            <div class="card">

                <div class="card-content">
                    <div class="card-body">
                        <form action="{{route('ticket.update-admin', $ticket->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="issue"><b>Sujeto</b></label>
                                        <input type="text" readonly class="form-control" value="{{ $ticket->issue}}" name="asunto">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label class="form-label" for="status"><b>Estado del ticket</b></label>
                                            <select name="status" class="custom-select status form-control @error('status') is-invalid @enderror" required data-toggle="select">
                                                <option value="0" @if($ticket->status == '0') selected
                                                    @endif>Abierto</option>
                                                <option value="1" @if($ticket->status == '1') selected
                                                    @endif>Cerrado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 mt-2 mb-2">
                                    <label class="form-label " for="note"><b>Chat con el usuario</b></label>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12 mx-auto ">
                                                <div class="card">

                                                    <div class="card-body chat-care">
                                                        <ul class="chat">
                                                            @foreach ( $message as $item )
                                                            {{-- user --}}
                                                            @if ($item->type == 0)
                                                            <li class="agent clearfix">
                                                                <span class="chat-img left clearfix mx-2">
                                                                    @if (Auth::user()->photoDB != NULL)
                                                                    <img src="{{asset('storage/'.Auth::user()->photoDB)}}" alt="avatar" class="img-circle">
                                                                    @else
                                                                    <img src="{{asset('assets/img/sistema/favicon.png')}}" alt="avatar" class="img-circle">
                                                                    @endif
                                                                </span>
                                                                <div class="chat-body clearfix">
                                                                    <div class="header clearfix">
                                                                        <strong class="primary-font">{{ $item->getUser->email}}</strong>
                                                                    </div>
                                                                    <p>
                                                                        {{ $item->message }}
                                                                    </p>
                                                                </div>
                                                            </li>

                                                            {{-- admin --}}
                                                            @elseif ($item->type == 1)
                                                            <li class="admin clearfix">
                                                                <span class="chat-img right clearfix  mx-2">
                                                                    @if (Auth::user()->photoDB != NULL)
                                                                    <img src="{{asset('storage/'.Auth::user()->photoDB)}}" alt="avatar" class="img-circle">
                                                                    @else
                                                                    <img src="{{asset('assets/img/sistema/favicon.png')}}" alt="avatar" class="img-circle">
                                                                    @endif
                                                                </span>
                                                                <div class="chat-body clearfix">
                                                                    <div class="header clearfix">

                                                                        <strong class="right primary-font">{{ $item->getAdmin->email}}</strong>
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



                                    <span class="text-bold-600">Respuesta para el usuario</span>
                                    <textarea class="form-control  chat-window-message" required type="text" id="message" name="message"></textarea>
                                </div>

                            </div>

                            <div class="col-12">
                                <button type="submit" class="col-12 btn btn-danger mb-1 waves-effect waves-light float-right">Enviar
                                    Ticket</button>
                            </div>
                    </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
    </div>
</section>

@endsection