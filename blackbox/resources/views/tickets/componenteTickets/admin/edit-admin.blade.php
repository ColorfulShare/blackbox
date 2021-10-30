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

                                    <section class="chat-app-window mb-2 py-2 px-2" style="border: 1px solid #000;">
                                        <div class="active-chat">
                                            <div class="user-chats ps ps--active-y ">
                                                <div class="chats chat-thread">

                                                    @foreach ( $message as $item )


                                                    {{-- user --}}

                                                    @if ($item->type == 0)

                                                    <div class="card" style="max-width: 400px;">
                                                        <div class="row g-0">
                                                            <div class="col-md-3">
                                                                @if (Auth::user()->photoDB != NULL)
                                                                <img src="{{asset('storage/'.Auth::user()->photoDB)}}" alt="avatar" height="20" width="20" class="rounded-circle">
                                                                @else
                                                                <img src="{{asset('assets/img/sistema/favicon.png')}}" alt="avatar" height="40" width="40" style="background-color: black;" class="rounded-circle">
                                                                @endif
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="card-body">
                                                                    <div class="email-user mb-1 text-dark">{{ $item->getUser->email}}</div>
                                                                    <p class="text-dark">{{ $item->message }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    {{-- admin --}}
                                                    @elseif ($item->type == 1)
                                                    <div class="card" style="max-width: 400px;">
                                                        <div class="row g-0">
                                                            <div class="col-md-3">
                                                                @if (Auth::user()->photoDB != NULL)
                                                                <img src="{{asset('storage/'.Auth::user()->photoDB)}}" alt="avatar" height="20" width="20" class="rounded-circle">
                                                                @else
                                                                <img src="{{asset('assets/img/sistema/favicon.png')}}" alt="avatar" height="40" width="40" style="background-color: black;" class="rounded-circle">
                                                                @endif
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="card-body">
                                                                    <div class="email-user mb-1 text-dark">{{ $item->getAdmin->email}}</div>
                                                                    <p class="text-dark">{{ $item->message }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <span class="text-bold-600">Respuesta para el usuario</span>
                                    <textarea class="form-control  chat-window-message" required type="text" id="message" name="message"></textarea>
                                </div>

                            </div>

                            <div class="col-12">
                                <button type="submit"  class="col-12 btn btn-danger mb-1 waves-effect waves-light float-right">Enviar
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