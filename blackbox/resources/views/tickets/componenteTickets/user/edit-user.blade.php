@extends('layouts/contentLayoutMaster')

@section('title', 'Editando ticket')

@section('content')


<div class="col-6 col-md-4">
    <a href="{{ route('ticket.list-user')}}" class="btn btn-danger mb-2 waves-effect waves-light">Volver Atrás <i class="fas fa-chevron-left"></i></a>
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

                                <section class="chat-app-window mb-2" style="border: 1px solid #000;">
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

                                <span class="text-dark">Respuesta</span>
                                <textarea class="text-tex form-control" type="text" id="message" name="message" required rows="3"></textarea>
                            </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="col-12 btn btn-danger  mb-1 waves-effect waves- float-right">Actualizar
                            Ticket</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    </div>
</section>


@endsection