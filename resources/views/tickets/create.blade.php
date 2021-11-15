@extends('layouts/contentLayoutMaster')

@section('title', 'Creación de ticket')

@section('content')


<div class="col-3" style="padding-left: 89%"><a href="{{ route('ticket.list-user')}}" class="btn btn-danger  mb-2 waves-effect waves-light">Volver Atrás <i class="fas fa-chevron-left"></i></a>
</div>

<section id="basic-vertical-layouts">
    <div class="row match-height d-flex justify-content-center">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{route('ticket.store')}}" method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label mt-2" for="issue"><b>Sujeto</b></label>
                                        <input class="form-control" required type="text" name="issue" rows="3" />
                                    </div>

                                    <div class="col-12 mt-2 mb-2">
                                        <label class="form-label  mb-1" for="message"><b>Mensaje</b></label>


                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12 mx-auto ">
                                                    <div class="card">
                                                        <div class="card-body chat-care">


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <span class=" text-bold-600">Escriba Su Pregunta</span>
                                        <textarea class="form-control chat-window-message" type="text" id="message" name="message" required rows="3"></textarea>
                                    </div>


                                    <div class="col-12">
                                        <button type="submit" class="col-12 btn btn-danger  mr-1 mb-1 waves-effect waves-light">Enviar
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