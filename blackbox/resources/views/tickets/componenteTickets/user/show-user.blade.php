@extends('layouts/contentLayoutMaster')

@section('title', 'Revisando Ticket')

@section('content')

<div class="col-3"><a href="{{ route('ticket.list-user')}}" class="btn btn-danger mb-2 waves-effect waves-light">Volver Atrás</a>
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

                            <div class="form-body">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label  mb-1" id="form-label" for="issue"><b>Sujeto</b></label>
                                        <input class="form-control" type="text" readonly id="names" name="issue" value="{{ $ticket->issue }}" rows="3" />

                                    </div>

                                    <div class="col-12 mt-2 mb-2">
                                        <label class="form-label  mb-1" id="form-label" for="message"><b>Conversación con el
                                                administrador</b></label>

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
                                                                        <img src="{{asset('images/avatars/1-small.png')}}" alt="avatar" class="img-circle" height="60" width="60">
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
                                                                        <img src="{{asset('images/avatars/2-small.png')}}" alt="avatar" class="img-circle" height="60" width="60">
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