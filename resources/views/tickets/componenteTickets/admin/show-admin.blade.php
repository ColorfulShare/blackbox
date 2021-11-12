@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de ordenes')

@section('content')

<section>
    <div class="row match-height d-flex justify-content-center">
        <div class="col-md-9 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title ">Editando el Ticket #{{ $ticket->id}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{route('ticket.update-user', $ticket->id)}}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-body">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label  mb-1" for="issue"><b>Asunto <del></del> ticket</b></label>
                                        <input class="form-control border  rounded-0" type="text" readonly id="issue" name="issue" value="{{ $ticket->issue }}" rows="3" />

                                    </div>

                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="priority" class="">Prioridad del
                                                    Ticket</label>
                                                <span class="text-danger text-bold-600">OBLIGATORIO</span>
                                                <select name="priority" id="priority" class="custom-select priority form-control  rounded-0 @error('priority') is-invalid @enderror" required data-toggle="select" disabled>
                                                    <option value="0" @if($ticket->priority == '0') selected
                                                        @endif>Alto</option>
                                                    <option value="1" @if($ticket->priority == '1') selected
                                                        @endif>Medio</option>
                                                    <option value="2" @if($ticket->priority == '2') selected
                                                        @endif>Bajo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2 mb-2">
                                        <label class="form-label  mb-1" for="message"><b>Chat con el
                                                administrador</b></label>

                                        <section class="chat-app-window mb-2 border  rounded-0">
                                            <div class="active-chat">
                                                <div class="user-chats ps ps--active-y bg-lp">
                                                    <div class="chats chat-thread">

                                                        {{-- admin --}}
                                                        <div class="chat">
                                                            <div class="chat-avatar">
                                                                <span class="avatar ">
                                                                <img src="{{asset('images/avatars/2-small.png')}}" alt="avatar" class="img-circle" height="60" width="60">


                                                                </span>
                                                            </div>
                                                            <div class="chat-body">
                                                                <div class="chat-content">

                                                                    <div class="email-admin mb-1">{{$admin}}</div>
                                                                    <p>¿Cómo podemos ayudarle? </p>
                                                                    <p> </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @foreach ( $message as $item )

                                                        {{-- user --}}
                                                        @if ($item->type == 0)
                                                        <div class="chat chat-left">
                                                            <div class="chat-avatar">
                                                                <span class="avatar">
                                                                    @if (Auth::user()->photoDB != NULL)
                                                                    <img src="{{asset('storage/'.Auth::user()->photoDB)}}" alt="avatar" height="40" width="40">
                                                                    @else
                                                                    <img src="{{asset('images/avatars/1-small.png')}}" alt="avatar" class="img-circle" height="60" width="60">
                                                                    @endif
                                                                </span>
                                                            </div>
                                                            <div class="chat-body">
                                                                <div class="chat-content">
                                                                    <div class="email-user mb-1">{{ $item->getUser->email}}</div>
                                                                    <p>{{ $item->message }}</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- admin --}}
                                                        @elseif ($item->type == 1)
                                                        <div class="chat">
                                                            <div class="chat-avatar">
                                                                <span class="avatar ">
                                                                    <img src="{{asset('assets/img/sistema/favicon.png')}}" alt="avatar" height="40" width="40" style="background-color: white;" alt="avatar" height="40" width="40">


                                                                </span>
                                                            </div>
                                                            <div class="chat-body">
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

                                        <span class="text-danger text-bold-600">Aqui podra escribir el mensaje para el admin</span>
                                        <textarea class="form-control border  rounded-0" type="text" id="message" name="message" disabled rows="3"></textarea>
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