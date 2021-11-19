@extends('layouts/contentLayoutMaster')

@section('title', 'Creación de ticket')

@section('content')


<div style="padding-left:87%">
    <a href="{{ route('ticket.list-user')}}" class="btn btn-danger  mb-2 waves-effect waves-light">Volver Atrás <i class="fas fa-chevron-left"></i></a>
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
                                </div>
                                <div class="col-12 mt-2">
                                    <button type="submit" class="col-12 btn btn-danger  mr-1 mb-1 waves-effect waves-light">Enviar
                                    Ticket</button>
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