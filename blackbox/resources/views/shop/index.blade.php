
@extends('layouts/contentLayoutMaster')

@section('title', 'Tienda')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
    <div id="adminServices">
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="row">
                        @foreach ($packages as $items)


                            <div class="col col-md-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <div class="card-header d-flex align-items-center p-2">
                                            <img src="{{asset('assets/img/packages/'.$items->price.'.jpeg')}}" alt="" style="width: 100%; heigh:100%;">
                                        </div>
                                        
                                        
                                        <form action="{{route('shop.proccess')}}" method="POST" target="_blank" class="">
                                            @csrf
                                            <input type="hidden" name="idproduct" value="{{$items->id}}">
                                            <button class="w-100 btn btn-block btn-primary"type="submit">Comprar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
@endsection
