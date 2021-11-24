
@extends('layouts/contentLayoutMaster')

@section('title', 'Lista referidos')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/tree-matriz.css')}}"/>
@endsection

@section('content')
<div class="row">

    @include('genealogy.component.unilevel')
</div>

    <div class="col-12">
        <div class="padre">
            <ul>
                <li class="baseli">
                    <a class="base" href="#">
                        <img src="{{asset('img/logo/blackbox.png')}}" alt="{{$base->firstname}}"
                            title="{{$base->firstname}}" class="rounded-circle"
                            style="width: 100%;height: 100%;">
                    </a>
                    {{-- Nivel 1 --}}
                    <ul>
                        @foreach ($trees as $child)
                        {{-- genera el lado binario derecho haciendo vacio --}}
                        {{--@include('genealogy.component.sideEmpty', ['side' => 'D', 'cant' => count($trees)])--}}
                        <li href="#prestamo" data-toggle="modal">
                            @include('genealogy.component.subniveles', ['data' => $child])
                            {{--LOS PROFESIONALES SOLO TIENEN DIRECTOS--}}
                            @if (!empty($child->children) && Auth::user()->type != 'profesional')
                            {{-- nivel 2 --}}
                            <ul>
                                @foreach ($child->children as $child2)
                                {{-- genera el lado binario derecho haciendo vacio --}}
                                {{--@include('genealogy.component.sideEmpty', ['cant' =>
                                count($child->children)])--}}
                                <li>
                                    @include('genealogy.component.subniveles', ['data' => $child2])
                                    @if (!empty($child2->children))
                                    {{-- nivel 3 --}}
                                    <ul>
                                        @foreach ($child2->children as $child3)
                                        {{-- genera el lado binario derecho haciendo vacio --}}
                                        {{--@include('genealogy.component.sideEmpty', ['cant' =>
                                        count($child2->children)])--}}
                                        <li>
                                            @include('genealogy.component.subniveles', ['data' => $child3])
                                            @if (!empty($child->children))
                                            {{-- nivel 4 
                                            <ul>
                                                @foreach ($child->children as $child)
                                                <li>
                                                    @include('genealogy.component.subniveles', ['data' => $child])
                                                    @if (!empty($child->children))
                                                     nivel 5 
                                                    <ul>
                                                        @foreach ($child->children as $child)
                                                        <li>
                                                            @include('genealogy.component.subniveles', ['data' => $child])
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    fin nivel 5
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                             fin nivel 4  --}}
                                            @endif
                                        </li>
                                        {{-- genera el lado binario izquierdo haciendo vacio --}}
                                        {{--@include('genealogy.component.sideEmpty', ['cant' =>
                                        count($child2->children)])--}}
                                        @endforeach
                                    </ul>
                                    {{-- fin nivel 3 --}}
                                    @endif
                                </li>
                                {{-- genera el lado binario izquierdo haciendo vacio --}}
                                {{--@include('genealogy.component.sideEmpty', ['cant' =>
                                count($child->children)])--}}
                                @endforeach
                            </ul>
                            {{-- fin nivel 2 --}}
                            @endif
                        </li>
                        {{-- genera el lado binario izquierdo haciendo vacio --}}
                        {{--@include('genealogy.component.sideEmpty', ['side' => 'I', 'cant' => count($trees)])--}}
                        @endforeach
                    </ul>
                    {{-- fin nivel 1 --}}
                </li>
            </ul>
        </div>
    </div>

    @if (Auth::id() != $base->id)
        @if(!Request::get('audit'))
        <div class="col-12 text-center">
            <a class="btn btn-outline-primary border-primary rounded" href="{{route('genealogy_type')}}">Regresar a mi arbol</a>
        </div>
        @endif
    @endif


@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
@endsection

@section('page-script')
<script type="text/javascript">

    @if(request()->get('audit'))
        document.addEventListener("DOMContentLoaded", function(){
            let idUser = '{{request()->get('audit')}}';
            idUser = parseInt(atob(idUser));
            let url = '{{route('audit.get.puntos', ['temp'])}}';
            url = url.replace('temp', idUser);
            let puntosI = document.querySelector("#puntosI");
            let puntosD = document.querySelector("#puntosD");
            fetch(url, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": window.csrf_token
                    },
                    method: 'get',
                })
                .then( response => response.text() )
                .then( resultText => (
                    data = JSON.parse(resultText),
                    console.log(data),
                    puntosI.innerHTML = data.totali,
                    puntosD.innerHTML = data.totald
    
                    
                ))
                .catch(function(error) {
                    console.log(error);
                });
        })
    @endif
    
        function tarjeta(data, url, img) {
    
            // console.log(data);
    
            $('#nombre').text(data.fullname);
            /*
            if (data.photoDB == null) {
                $('#imagen').attr('src', img);
            } else {
                $('#imagen').attr('src', '/storage/photo/' + data.photoDB);
            }
            */
            var date_db = new Date(data.created_at);
            var year = date_db.getFullYear();
            var month = (1 + date_db.getMonth()).toString();
            month = month.length > 1 ? month : '0' + month;
            var day = date_db.getDate().toString();
            day = day.length > 1 ? day : '0' + day;
            var date = month + '/' + day + '/' + year;
            $('#fecha_ingreso').text(date);
    
            $('#email').text(data.email);
    
            if (data.status == 0) {
                $('#estado').html('<span class="badge bg-warning text-dark">Inactivo</span>');
            } else if (data.status == 1) {
                $('#estado').html('<span class="badge bg-success"">Activo</span>');
            } else if (data.status == 2) {
                $('#estado').html('<span class="badge bg-danger">Eliminado</span>');
            }
    
            // if(data.inversion != ' '){
            //     $('#inversion').text(data.inversion);
            // }else{
            //     $('#inversion').text('Sin inversion');
            // }
    
            $('#ver_arbol').attr('href', url);
            $('#ver_arbol').removeClass('d-none');
            $('#tarjeta').removeClass('d-none');
        }
    
    </script>
@endsection
