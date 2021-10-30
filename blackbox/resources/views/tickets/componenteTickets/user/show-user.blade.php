@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de ordenes')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="text-white">Revisando Ticket #{{ $ticket->id}}</h1>
        </div>
        <div class="col-3"><a id="boton-ticket" href="{{ route('ticket.list-user')}}" class="btn  mb-2 waves-effect waves-light">Volver Atrás <i class="fas fa-chevron-left"></i></a>
        </div>
        <div class="col-3">
            <button id="IDref" class="btn mb-2" onclick="getlink()">ID de
                referido: XXXX {{Auth::user()->id}} <i class="fas fa-link"></i></button>
        </div>
    </div>

</div>

<section>
    <div class="row match-height d-flex justify-content-center">
        <div class="col-md-12 col-12">
            <div class="card" style="
background: linear-gradient(180deg, #0F1522 0%, rgba(15, 21, 34, 0) 100%);
border-radius: 8px;">
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{route('ticket.update-user', $ticket->id)}}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-body">
                                <div class="row">



                                    <div class="col-6">
                                        <label class="form-label  mb-1" id="form-label" for="issue"><b>Sujeto</b></label>
                                        <input class="form-control" type="text" readonly id="names" name="issue" value="{{ $ticket->issue }}" rows="3" />

                                    </div>



                                    <div class="col-12 mt-2 mb-2">
                                        <label class="form-label  mb-1" id="form-label" for="message"><b>Conversación con el
                                                administrador</b></label>

                                        <section class="chat-app-window mb-2" style="border: 2px solid rgba(0, 246, 225, 0.77);">
                                            <div class="active-chat">
                                                <div class="user-chats ps ps--active-y">
                                                    <div class="chats chat-thread">

                                                        {{-- admin --}}
                                                        <div class="chat chat-left">
                                                            <div class="chat-avatar">
                                                                <span class="avatar ">
                                                                    <img src="{{asset('assets/img/sistema/favicon.png')}}" alt="avatar" height="40" width="40" style="background-color: black;" alt="avatar" height="40" width="40">
                                                                </span>
                                                            </div>
                                                            <div class="chat-body " id="form-labels">
                                                                <div class="chat-content">
                                                                    <div class="email-admin mb-1">{{$admin}}</div>
                                                                    <p>¿Cómo podemos ayudarle? </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @foreach ( $message as $item )

                                                        {{-- user --}}
                                                        @if ($item->type == 0)
                                                        <div class="chat">
                                                            <div class="chat-avatar">
                                                                <span class="avatar ">
                                                                    @if (Auth::user()->photoDB != NULL)
                                                                    <img src="{{asset('storage/'.Auth::user()->photoDB)}}" alt="avatar" height="40" width="40">
                                                                    @else
                                                                    <img src="{{asset('assets/img/sistema/favicon.png')}}" alt="avatar" height="40" width="40" style="background-color:black ;">
                                                                    @endif
                                                                </span>
                                                            </div>
                                                            <div class="chat-body" id="form-labels">
                                                                <div class="chat-content">
                                                                    <div class="email-user mb-1">{{ $item->getUser->email}}</div>
                                                                    <p>{{ $item->message }}</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- admin --}}
                                                        @elseif ($item->type == 1)
                                                        <div class="chat chat-left">
                                                            <div class="chat-avatar">
                                                                <span class="avatar ">
                                                                    <img src="{{asset('assets/img/sistema/favicon.png')}}" alt="avatar" height="40" width="40" style="background-color: black;" alt="avatar" height="40" width="40">
                                                                </span>
                                                            </div>
                                                            <div class="chat-body" id="form-labels">
                                                                <div class="chat-content">
                                                                    <div class="email-admin mb-1">{{ $item->getAdmin->email}}</div>
                                                                    <p>{{ $item->message }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif

                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </section>


                                    </div>
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