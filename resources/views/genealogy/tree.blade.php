
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
                        @if (empty($base->photoDB))
                        <img src="{{asset('assets/img/royal_green/logos/logo.svg')}}" alt="{{$base->firstname}}"
                            title="{{$base->firstname}}" class="rounded-circle"
                            style="width: 100%;height: 100%;">
                        @else
                        <img src="{{asset('storage/photo/'.$base->photoDB)}}" alt="{{$base->firstname}}"
                            title="{{$base->firstname}}" class="rounded-circle"
                            style="width: 100%;height: 100%;">
                        @endif
                    </a>
                    {{-- Nivel 1 --}}
                    <ul>
                        @foreach ($trees as $child)
                        {{-- genera el lado binario derecho haciendo vacio --}}
                        @include('genealogy.component.sideEmpty', ['side' => 'D', 'cant' => count($trees)])
                        <li href="#prestamo" data-toggle="modal">
                            @include('genealogy.component.subniveles', ['data' => $child])
                            @if (!empty($child->children))
                            {{-- nivel 2 --}}
                            <ul>
                                @foreach ($child->children as $child2)
                                {{-- genera el lado binario derecho haciendo vacio --}}
                                @include('genealogy.component.sideEmpty', ['cant' =>
                                count($child->children)])
                                <li>
                                    @include('genealogy.component.subniveles', ['data' => $child2])
                                    @if (!empty($child2->children))
                                    {{-- nivel 3 --}}
                                    <ul>
                                        @foreach ($child2->children as $child3)
                                        {{-- genera el lado binario derecho haciendo vacio --}}
                                        @include('genealogy.component.sideEmpty', ['cant' =>
                                        count($child2->children)])
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
                                        @include('genealogy.component.sideEmpty', ['cant' =>
                                        count($child2->children)])
                                        @endforeach
                                    </ul>
                                    {{-- fin nivel 3 --}}
                                    @endif
                                </li>
                                {{-- genera el lado binario izquierdo haciendo vacio --}}
                                @include('genealogy.component.sideEmpty', ['cant' =>
                                count($child->children)])
                                @endforeach
                            </ul>
                            {{-- fin nivel 2 --}}
                            @endif
                        </li>
                        {{-- genera el lado binario izquierdo haciendo vacio --}}
                        @include('genealogy.component.sideEmpty', ['side' => 'I', 'cant' => count($trees)])
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

{{-- CONFIGURACIÓN DE DATATABLE --}}
@include('panels.datatables-config')

