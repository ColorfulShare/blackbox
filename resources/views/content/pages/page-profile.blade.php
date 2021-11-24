@extends('layouts/contentLayoutMaster')

@section('title', 'Profile')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-profile.css')) }}">

@endsection
@section('page-style')
<link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}">
@endsection

<!--Sweealert2 -->
@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection
@section('page-script')
  <script src="{{ asset(mix('js/scripts/extensions/ext-component-sweet-alerts.js')) }}"></script>

  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script>



          function proccess(){

              var laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
              axios.post('/2fact-perfil', {
                  code: document.getElementById('code').value,
              }).then(function (response) {
                  if(response.data.valores.verificado == 'true'){
                      let timerInterval
                  Swal.fire({
                  icon: 'success',
                  title: 'Verficado',
                  background:'#283046',
                  footer: '<h3 class="text-center">Ya puede cambiar los datos de su perfil</h3>',
                  timer: 2300,
                  timerProgressBar: true,
                      didOpen: () => {
                          Swal.showLoading()
                          const b = Swal.getHtmlContainer().querySelector('b')
                          timerInterval = setInterval(() => {
                          b.textContent = Swal.getTimerLeft()
                          }, 100)
                      },willClose: () => {
                          clearInterval(timerInterval)
                      }
                  })
                  let formulario = document.getElementById("formulario");
                  let Towfa = document.getElementById("Towfa");

                  let reemplazar = document.getElementById('modal2fa').replaceChild(formulario, Towfa);

              }else{
                  let timerInterval
                  Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  background:'#283046',
                  footer: '<h1 class="text-center">Codigo incorrecto</h1>',
                  timer: 2000,
                  timerProgressBar: true,
                      didOpen: () => {
                          Swal.showLoading()
                          const b = Swal.getHtmlContainer().querySelector('b')
                          timerInterval = setInterval(() => {
                          b.textContent = Swal.getTimerLeft()
                          }, 100)
                      },willClose: () => {
                          clearInterval(timerInterval)
                      }
                  })
              }
                  console.log(response.data.valores.verificado);
              })
              .catch(function (error) {
                  console.log(error);
              });
              ;
              };
  </script>
@endsection
<!--------------->
@section('content')
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
                <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modal2fa">
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
      <div class="col-sm-12">

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

 <!-- Modal de autenticacion -->
  <div class="modal fade" id="modal2fa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="Towfa">
    <div class="modal-content" id="padre">
        <div class="modal-header" id="head2fa">
        <h5 class="modal-title" >Se necesita verificacion para editar tus datos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" >
                <div class="row" >

                        @csrf
                    <div class="card" >
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                            <img
                            class="card-img-top text-center "
                            src="{{asset('/img/logo/blackbox.png')}}" style="width: 300px;  display:block; margin:auto; "
                            alt="User Profile Image"
                          />
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h2 class="card-title fw-bold mb-1">Verificacion 2Fact</h2>

                                            @csrf
                                            @if (!empty($urlQr))
                                            <div class="mb-1 text-center">
                                                <img src="{{$urlQr}}" alt="codigo qr google" class="d-inline">
                                            </div>
                                            @endif
                                            <div class="mb-1">
                                                <label class="code" >Codigo 2Fact</label>

                                                <input class="form-control border border-warning rounded-0" id="code" type="text" required name="code"
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
                                    <button class="btn btn-primary w-100 rounded-5 mt-2" onclick="proccess();" type="submit">Verificar</button>

                                </div>

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
                  <div class="modal fade" id="ModalEdicion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <div class="modal-dialog" id="formulario">
                        <div class="modal-content">
                            <div class="modal-header" id="modal">
                            <h4 class="modal-title text-center" id="FormularioPerfil">Edicion de Perfil</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" >
                                <form action="{{ route('profile-user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">

                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mt-1">
                                                <h5 class="font-weight-bold text-white">Foto de perfil</h5>
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
                                                    onchange="previewFile(this, 'photo_preview')" accept="image/jpg, image/jpeg, image/png" >
                                                </div>


                                                <div class="row">
                                                    <div class="col-sm-12 mt-1 mb-1 center-block" id="photo_preview_wrapper">
                                                            <img id="photo_preview" class="img-fluid rounded " width="100" style=" display:block; margin:auto; " />
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
                                                <div class="col-sm-6">

                                                    <div class="form-group mt-1">
                                                        <label for="Broker">Cuenta Broker</label>
                                                        <input type="text" class="form-control border border-primary rounded" name="Broker"
                                                            value="">
                                                    </div>
                                                  </div>

                                                  <div class="col-sm-12">

                                                    <div class="form-group mt-1">
                                                        <label for="Wallet">Wallet</label>
                                                        <input type="text" class="form-control border border-primary rounded" name="wallet"
                                                            value="{{ $user->wallet != null ? $user->wallet : ''}}">
                                                    </div>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer mt-1">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>

                        </form>
                            </div>
                        </div>
                        </div>

                    </div>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/page-profile.js')) }}"></script>
@endsection
