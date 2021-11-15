@extends('layouts/contentLayoutMaster')

@section('title', 'Profile')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-profile.css')) }}">
@endsection

@section('content')
<div id="user-profile">
  <!-- profile header -->
  <div class="row">
    <div class="col-12">
      <div class="card profile-header mb-2">
        <!-- profile cover photo -->
        <img
          class="card-img-top"
          src="{{asset('images/profile/user-uploads/timeline.jpg')}}"
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
                            <input type="text" class="form-control border border-primary rounded" name="fullname" disabled
                                value="12345678">
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
        <h5 class="mb-0">Referidos</h5>
        <div class="row">
            @foreach ($referidos as $item)
          <div class="col-md-4 col-6 profile-latest-img">
            <a href="#">
              <img
              src="{{asset('storage/photo/'.$item->photoDB)}}"
                class="img-fluid rounded"
                alt="avatar img"
              />
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <!--/ latest profile pictures -->



      </div>

  </div>




        <!--/ suggestion -->



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{ route('profile.update',$user->id) }}" method="POST" enctype="multipart/form-data">
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
                            <h4 class="font-weight-bold text-white">Foto de perfil</h4>
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
  </div>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/page-profile.js')) }}"></script>
@endsection
