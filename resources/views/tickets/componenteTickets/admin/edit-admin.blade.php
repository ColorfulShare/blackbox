@extends('layouts/contentLayoutMaster')

@section('title', 'Atendiendo el Ticket')

@section('content')
 <div class="row breadcrumbs-top">
    <div class="col-8">
        <div class="content-header-title " style="padding: 0.5rem 0 0.5rem 1rem ">DETALLES DEL USUARIO # {{$ticket->getUser->id}}</div>
    </div>
    <div class="col-4  pr-2" style="padding-left: 17%">
        <a href="{{ route('ticket.list-admin')}}" class="btn btn-danger  mb-2 waves-effect waves-light">Volver Atrás</a>
    </div>
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
                            <div class="form-body">
                                <div class="row">
                                 <div class="pl-2 pr-2"> 
                                    @if (Auth::user()->photo === NULL)
                                       <a><img class="rounded-circle ml-2" src="{{asset('/images/avatars/1-small.png')}}" alt="avatar" height="60" width="60"></a>
                                    @else
                                       <a><img class="rounded-circle ml-2"  src="{{ asset('storage/photo-profile/'.$user->photo) }}" alt="" width="55px" height="55px"></a>
                                    @endif
                                    <div class="row mt-3 pl-2 pr-2">  
                                        <div class="col-md-3 col-sm-1">
                                            <div class="project-detail-titles">Nombre :</div>
                                            <div class="mt-1 project-detail-dates">
                                                <span><b>{{ $ticket->getUser->firstname }} {{ $ticket->getUser->lastname }}</b></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-1">
                                            <div class="project-detail-titles">Correo :</div>
                                            <div class="mt-1 project-detail-dates">
                                               <span><b>{{ $ticket->getUser->email }}</b></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-1">
                                            <div class="project-detail-titles">Paquete :</div>
                                            <div class="mt-1 project-detail-dates">
                                               @if($ticket->getUser->package === null)
                                                   <span><b>Sin paquetes asignados</b></span>
                                               @else
                                                   <span><b>{{ $ticket->getUser->package }}</b></span>
                                               @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content-header-title mt-2">DETALLES DEL TICKET</div>  
                                    <div class="col-12 mt-2">
                                        <div class="form-group mb-1">
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
                                                        <div class="card-body chat-care  rounded" style=" background: rgb(240, 230, 140) ">
                                                            <ul class="chat">
                                                                @foreach ( $message as $item )
                                                                {{-- user --}}
                                                                @if ($item->type == 0)
                                                                <li class="agent clearfix">
                                                                    <div class="chat-body clearfix">
                                                                        <div class="header clearfix">
                                                                            <strong class="primary-font">{{ $item->getUser->firstname}} {{$item->getUser->lastname}}</strong>
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
                                                                            <strong class="right primary-font">{{ $item->getAdmin->firstname}} {{$item->getAdmin->lastname}}</strong>
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
                                        <textarea class="form-control  chat-window-message" type="text" id="message" name="message"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="col-12 btn btn-danger mb-1 waves-effect waves-light float-right">Enviar Ticket</button>
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