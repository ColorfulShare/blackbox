@extends('layouts/contentLayoutMaster')

@section('title', 'Profile')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-profile.css')) }}">
@endsection

@section('content')
<script>
    function v(){
      alert('verificando');
    }
</script>
<div id="user-profile">
  <!-- profile header -->
  <div class="row">
    <div class="col-12">
      <div class="card profile-header mb-2">
        <!-- profile cover photo -->
        <img
          class="card-img-top text-center "
          src="{{asset('/img/logo/blackbox.png')}}" style="width: 500px;  display:block; margin:auto; "
          alt="User Profile Image"
        />

        <!--/ profile cover photo -->

        <div class="position-relative">
          <!-- profile picture -->
          <div class="profile-img-container d-flex align-items-center">
            <div class="profile-img">
                @if(Auth::user()->photoDB != null)
                <img
              src="{{asset('storage/photo/'.Auth::user()->photoDB)}}"
                class="rounded img-fluid"
                alt="Card image"
              />
               @else
              <img
                src="{{asset('images/portrait/small/avatar-s-2.jpg')}}"
                class="rounded img-fluid"
                alt="Card image"
              />
              @endif
            </div>
            <!-- profile title -->
            <div class="profile-title ms-3">
              <h2 class="text-white">{{ucfirst($user->firstname)}}</h2>
            </div>
          </div>
        </div>

        <!-- tabs pill -->
        <div class="profile-header-nav">
          <!-- navbar -->
          <nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
            <button
              class="btn btn-icon navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <i data-feather="align-justify" class="font-medium-5"></i>
            </button>

            <!-- collapse  -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
                <ul class="nav nav-pills mb-0">
                  <li class="nav-item">
                    <a class="nav-link fw-bold active" href="#">
                      <span class="d-none d-md-block">Feed</span>
                      <i data-feather="rss" class="d-block d-md-none"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">
                      <span class="d-none d-md-block">About</span>
                      <i data-feather="info" class="d-block d-md-none"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">
                      <span class="d-none d-md-block">Photos</span>
                      <i data-feather="image" class="d-block d-md-none"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">
                      <span class="d-none d-md-block">Friends</span>
                      <i data-feather="users" class="d-block d-md-none"></i>
                    </a>
                  </li>
                </ul>
                <!-- edit button -->
                <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <i data-feather="edit" class="d-block d-md-none" ></i>
                  <span class="fw-bold d-none d-md-block">Editar perfil</span>
                </button>
              </div>
            </div>
            <!--/ collapse  -->
          </nav>
          <!--/ navbar -->
        </div>
      </div>
    </div>
  </div>
  <!--/ profile header -->

<!-- profile info section -->
  <div class="container">
    <div class="row">
      <div class="col-sm-9">

        <div class="card">
            <div class="card-body">
                <div class="container ">
                    <h2 class="mb-2">Datos Personales</h2>
                    <div class="row">
                      <div class="col-sm-4">

                        <div class="form-group">
                            <label for="fullname">Nombre Completo</label>
                            <input type="text" class="form-control border border-primary rounded" name="fullname" disabled
                                value="{{ $user->firstname }}">
                        </div>
                      </div>

                      <div class="col-sm-4">

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control border border-primary rounded" name="email" disabled
                                value="{{ $user->email }}">
                        </div>

                      </div>
                      <div class="col-sm-4">

                        <div class="form-group">
                            <label for="whatsapp">Telefono</label>
                            <input type="text" class="form-control border border-primary rounded" name="whatsapp" disabled
                                value="{{ $user->phone }}">
                        </div>

                      </div>
                      <div class="col-sm-4 mt-1">

                        <div class="form-group">
                            <label for="fullname">Cuenta Broker</label>
                            <input type="text" class="form-control border border-primary rounded" name="Broker" disabled
                                value="12345678">
                        </div>
                      </div>
                      <div class="col-sm-8 mt-1">

                        <div class="form-group">
                            <label for="Wallet">Wallet</label>
                            <input type="text" class="form-control border border-primary rounded" name="wallet" disabled
                                value="sklamklasmlqwñleqwelkwokfioerf2384sdlfkñ">
                        </div>
                      </div>
                      <div class="col-sm-12 mt-1">
                        <div class="form-group">
                            <label for="address">Dirección</label>
                            <textarea class="form-control border border-primary rounded"
                                name="address"></textarea>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
      </div>

  <!-- right profile info section -->
  <div class="col-lg-3 col-sm-3 order-3">
    <!-- latest profile pictures -->
    <div class="card">
      <div class="card-body">
        <h5 class="mb-0 text-center">Administradores de Red</h5>
        <div class="row">

            @if($referidos == 'vacio')
            <h4 class="mt-1 text-center">Sin Administrador</h4>
          @else

          @foreach ($referidos as $item)
          <div class="col-md-4 col-6 profile-latest-img">
              @if($item->photoDB != null)
            <a href="#">
              <img
              src="{{asset('storage/photo/'.$item->photoDB)}}"
                class="img-fluid rounded"
                alt="avatar img"
              />
            </a>
            <h6 class="text-center" style="font-size: 12px">{{Str::limit(ucfirst($item->firstname), 5)}}</h6>
            @else
            <a href="#">
                <img
                src="{{asset('images/portrait/small/avatar-s-2.jpg')}}"
                  class="img-fluid rounded"
                  alt="avatar img"
                />
              </a>
              <h6 class="text-center" style="font-size: 12px">{{Str::limit(ucfirst($item->firstname), 4)}}</h6>
            @endif
          </div>
          @endforeach
          @endif
        </div>
      </div>
    </div>
    <!--/ latest profile pictures -->

    <!-- latest profile pictures -->
    <div class="card">
        <div class="card-body">
          <h5 class="mb-0 text-center">Referidos</h5>
          <div class="row">

              @if($referidos == 'vacio')
              <h2 class="mt-1 text-center">Sin Referidos</h2>
            @else

            @foreach ($referidos as $item)
            <div class="col-md-4 col-6 profile-latest-img">
                @if($item->photoDB != null)
              <a href="#">
                <img
                src="{{asset('storage/photo/'.$item->photoDB)}}"
                  class="img-fluid rounded"
                  alt="avatar img"
                />
              </a>
              <h6 class="text-center" style="font-size: 12px">{{Str::limit(ucfirst($item->firstname), 5)}}</h6>
              @else
              <a href="#">
                  <img
                  src="{{asset('images/portrait/small/avatar-s-2.jpg')}}"
                    class="img-fluid rounded"
                    alt="avatar img"
                  />
                </a>
                <h6 class="text-center" style="font-size: 12px">{{Str::limit(ucfirst($item->firstname), 4)}}</h6>
              @endif
            </div>
            @endforeach
            @endif
          </div>
        </div>
      </div>
      <!--/ latest profile pictures -->


      </div>

  </div>

 <!-- Modal de autenticacion -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Se necesita verificacion para editar tus datos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <div class="row">

                    <div class="card">
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                            <img
                            class="card-img-top text-center "
                            src="{{asset('/img/logo/blackbox.png')}}" style="width: 300px;  display:block; margin:auto; "
                            alt="User Profile Image"
                          />
                                <div class="row">
                                    <form class="auth-login-form mt-2" action="{{ route('2fact.post') }}" method="POST">
                                    <div class="col-sm-12">
                                        <h2 class="card-title fw-bold mb-1">Verificar 2Fact</h2>

                                            @csrf
                                            @if (!empty($urlQr))
                                            <div class="mb-1 text-center">
                                                <img src="{{$urlQr}}" alt="codigo qr google" class="d-inline">
                                            </div>
                                            @endif
                                            <div class="mb-1">
                                                <label class="form-label" for="username">Codigo 2Fact</label>
                                                <input class="form-control border border-warning rounded-0" id="username" type="text" required name="code"
                                                    placeholder="000000" aria-describedby="username" autofocus="" tabindex="1" />
                                            </div>

                                        {{-- <p class="text-center mt-2"><span>¿Nuevo en la plataforma?</span><a
                                                href="{{ route('register') }}"><span>&nbsp;<b>Crea una cuenta</b></span></a></p> --}}
                                    </div>
                                    <div class="col-sm-12 ">

                                        @if (!$user->activar_2fact)

                                            <div class="mt-4 max-w-xl text-sm text-gray-600">
                                                <p class="font-semibold">
                                                    {{ __('La autenticación de dos factores ahora está deshabilitada. Escanee el siguiente código QR usando la aplicación de Google authenticator de su teléfono.') }}
                                                </p>
                                            </div>
                                        @endif
                                        @if ($user->activar_2fact)
                                        <p class="font-semibold">{{ __('Ha habilitado la autenticación de dos factores.') }}</p>
                                        @else
                                        <p class="font-semibold">{{ __('No ha habilitado la autenticación de dos factores.') }}</p>
                                        @endif

                                        <div class="mt-1 max-w-xl text-sm text-gray-600">
                                            <p>
                                                {{ __('Cuando la autenticación de dos factores está habilitada, se le solicitará un token aleatorio seguro durante la autenticación. Puede recuperar este token de la aplicación Google Authenticator de su teléfono.') }}
                                            </p>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary w-100 rounded-5 mt-2" onclick="v()" type="submit" tabindex="4">Verificar</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>

        </div>
    </div>
    </div>
</div>
 <!-- Fin Modal Autenticacion -->
                    <!-- Modal -->
               {{--     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form action="{{ route('profile-user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                            <h5 class="modal-title" id="exampleModalLabel">Edicion de Perfil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                    <div class="row">

                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h4 class="font-weight-bold text-white">Foto de perfil {{$user->id}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="formFile" class="form-label">Seleccione su
                                                        Foto <b>(Se permiten JPG o PNG.
                                                            Tamaño máximo de 800kB)</label>
                                                    <input type="file" id="photoDB" class="form-control" name="photoDB"
                                                    onchange="previewFile(this, 'photo_preview')" accept="image/*">
                                                </div>


                                                <div class="row">
                                                    <div class="col-sm-12 mt-1 mb-1 center-block" id="photo_preview_wrapper">
                                                            <img id="photo_preview" class="img-fluid rounded " width="100" />
                                                    </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="fullname">Nombre Completo</label>
                                                        <input type="text" class="form-control border border-primary rounded" name="firstname"
                                                            value="{{ $user->firstname}}">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control border border-primary rounded" name="email"
                                                            value="{{ $user->email }}">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group mt-1">
                                                        <label for="whatsapp">Telefono</label>
                                                        <input type="text" class="form-control border border-primary rounded" name="phone"
                                                            value="{{ $user->phone }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                        </div>
                    </form>
                    </div> --}}
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/page-profile.js')) }}"></script>
@endsection
