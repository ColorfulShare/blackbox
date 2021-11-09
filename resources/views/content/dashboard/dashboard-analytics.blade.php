
@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard | BlackBox')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-list.css')) }}">
@endsection
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
@section('content')

@include('components.tranding-view')

<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
  <div class="row match-height">
    <!-- Greetings Card starts -->
    <div class="col-lg-6 col-md-12 col-sm-12">
      <div class="card ">
        <div class="card-body text-center">
          <div class="card-header d-flex align-items-center text-right pb-0 pt-0 white">
            <h2 class="mt-1 mb-0"><b>Ganacia Actual</b></h2>
              @if(auth()->user()->admin == 1)
                <div class="">
                    @if(($porcentaje * 100) < 20)
                      <button class="btn btn-primary bg-white mt-1 waves-effect waves-light text-white ml-auto" data-bs-toggle="modal" data-bs-target="#modalPorcentajeGanancia">Cambiar %</button>
                    @else
                      <button class="btn btn-success bg-white mt-1 waves-effect waves-light text-white ml-auto" data-bs-toggle="modal" data-bs-target="#modalUsuariosActivos">Usuarios activos</button>
                    @endif
                </div>
              @endif
          </div>

          <div class="card-sub d-flex align-items-center ">
              <h1 class="gold text-bold-700 mb-0"><b>$ </b></h1>
          </div>

          <div class="d-flex align-items-center">

              <div class="progress ml-2 mt-5" style="height: 25px;width: 100%;">
                  <div id="bar" class="progress-bar active" role="progressbar" aria-valuenow="0"
                      aria-valuemin="0" aria-valuemax="100" style="width: {{($porcentaje * 10000) / 20}}%">
                  </div>
              </div>

              <div class="card-sub d-flex align-items-center mt-5">
                  <p class="text-bold-700 mb-0">{{$porcentaje * 100}}% </p>
              </div>

          </div>

          <div class="card-sub align-items-center mt-0 ">
              <h6 class="text-bold-700 mb-0"><b>Activo </b></h6>
          </div>
        </div>
      </div>
    </div>
    <!-- Greetings Card ends -->

    <!-- Subscribers Chart Card starts -->
    <div class="col-lg-3 col-sm-6 col-12">
      <div class="card">
        <div class="card-header flex-column align-items-start pb-0">
          <div class="avatar bg-light-primary p-50 m-0">
            <div class="avatar-content">
              <i data-feather="users" class="font-medium-5"></i>
            </div>
          </div>
          <h2 class="fw-bolder mt-1">Link de referido</h2>
          <p class="card-text">Subscribers Gained</p>

<!-- botone para link de referidos -->
          <div class="btn-group mb-1">
          <button class="btn btn-sm btn-primary" onclick="link()">normal referred</button>
          <button class="btn btn-sm btn-danger" onclick=" linkAdmin()">Admin Red</button>
          </div>

        </div>
      </div>
    </div>
    <!-- Subscribers Chart Card ends -->

    <!-- Orders Chart Card starts -->
    <div class="col-lg-3 col-sm-6 col-12">
      <div class="card">
        <div class="card-header flex-column align-items-start pb-0">
          <div class="avatar bg-light-warning p-50 m-0">
            <div class="avatar-content">
              <i data-feather="package" class="font-medium-5"></i>
            </div>
          </div>
          <h2 class="fw-bolder mt-1">Wallet</h2>
          <p class="card-text"> {{$user->saldoDisponibleFormat()}}</p>
        </div>
    </div>
    </div>
  </div>

  <div class="row match-height">
    <!-- Avg Sessions Chart Card starts -->
    <div class="col-lg-3 col-sm-6 col-12">
      <div class="card">
        <div class="card-body">
          <h2 class="fw-bolder mt-1">{{$user->estado()}}</h2>
          @if($user->status == '1')
            <h2 class="fw-bolder mt-1"> por <span class="text-primary">{{$user->contadorExpiredStatus()}}</span> dias</h2>
          @endif
        </div>
      </div>
    </div>
 

    <!-- Support Tracker Chart Card starts -->
    <div class="col-lg-6 col-12">
      <div class="card">
        <div class="card-body">
          <h6 class="mt-1 mb-0 text-white font-weight-bold">Ganancias:</h6>
          <div id="chart"></div>
        </div>
      </div>
    </div>
    <!-- Support Tracker Chart Card ends -->
  </div>

  <div class="row match-height">
    <!-- Timeline Card -->
    <div class="col-lg-6 col-12">
      <div class="card card-user-timeline">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <i data-feather="list" class="user-timeline-title-icon"></i>
            <h4 class="card-title">User Timeline</h4>
          </div>
        </div>
        <div class="card-body">
          <ul class="timeline ms-50">
            <li class="timeline-item">
              <span class="timeline-point timeline-point-indicator"></span>
              <div class="timeline-event">
                <h6>12 Invoices have been paid</h6>
                <p>Invoices are paid to the company</p>
                <div class="d-flex align-items-center">
                  <img class="me-1" src="{{asset('images/icons/json.png')}}" alt="data.json" height="23" />
                  <h6 class="more-info mb-0">data.json</h6>
                </div>
              </div>
            </li>
            <li class="timeline-item">
              <span class="timeline-point timeline-point-warning timeline-point-indicator"></span>
              <div class="timeline-event">
                <h6>Client Meeting</h6>
                <p>Project meeting with Carl</p>
                <div class="d-flex align-items-center">
                  <div class="avatar me-50">
                    <img
                      src="{{asset('images/portrait/small/avatar-s-9.jpg')}}"
                      alt="Avatar"
                      width="38"
                      height="38"
                    />
                  </div>
                  <div class="more-info">
                    <h6 class="mb-0">Carl Roy (Client)</h6>
                    <p class="mb-0">CEO of Infibeam</p>
                  </div>
                </div>
              </div>
            </li>
            <li class="timeline-item">
              <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
              <div class="timeline-event">
                <h6>Create a new project</h6>
                <p>Add files to new design folder</p>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="bottom"
                    title="Billy Hopkins"
                    class="avatar pull-up"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-9.jpg')}}"
                      alt="Avatar"
                      width="33"
                      height="33"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="bottom"
                    title="Amy Carson"
                    class="avatar pull-up"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      width="33"
                      height="33"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="bottom"
                    title="Brandon Miles"
                    class="avatar pull-up"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-8.jpg')}}"
                      alt="Avatar"
                      width="33"
                      height="33"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="bottom"
                    title="Daisy Weber"
                    class="avatar pull-up"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      width="33"
                      height="33"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="bottom"
                    title="Jenny Looper"
                    class="avatar pull-up"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-20.jpg')}}"
                      alt="Avatar"
                      width="33"
                      height="33"
                    />
                  </div>
                </div>
              </div>
            </li>
            <li class="timeline-item">
              <span class="timeline-point timeline-point-danger timeline-point-indicator"></span>
              <div class="timeline-event">
                <h6>Update project for client</h6>
                <p class="mb-0">Update files as per new design</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!--/ Timeline Card -->

    <!-- Sales Stats Chart Card starts -->
    <div class="col-lg-6 col-md-6 col-12">
      <div class="card">
        <div class="card-body">
          <h1>Empresa</h1>
        </div>
      </div>
    </div>
    <!-- Sales Stats Chart Card ends -->
  </div>

  <!--  -->
  <div class="row">
    <div class="col-lg-4 col-12">
      <div class="card ">
        <div class="card-header d-flex align-items-center text-right">
            <h3 class=""><b>Conviertete en :</b></h3>
        </div>
        <div class="row g-0 card-header align-items-center h-100">

          <div class="col">
            <div class="d-grid gap-2">
              <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRed">
                  Agente red
              </a>
            </div>
          </div>
          <div class="col">
            <div class="d-grid gap-2">
              <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalProfesional">
                Profesional
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Agente de red-->
  <div class="modal fade" id="modalRed" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agente de red</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('dashboard.convertir')}}" method="POST">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="type" value="red">
          <label for="monto">Monto a invertir:</label>
          <input type="number" id="monto" name="monto" class="form-control" required >
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal profesional-->
  <div class="modal fade" id="modalProfesional" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Profesional</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('dashboard.convertir')}}" method="POST">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="type" value="profesional">
          <label for="monto2">Monto a invertir:</label>
          <input type="number" id="monto2" class="form-control" name="monto" required >
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!--/ List DataTable -->
</section>
<!-- Dashboard Analytics end -->

<!-- MODAL PARA ACTUALIZAR PORCENTAJE DE GANANCIA -->
@if(auth()->user()->admin == 1)
    <div class="modal fade" id="modalPorcentajeGanancia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content bg-lp" >
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Porcentaje</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('cambiarPorcentaje')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body bg-lp" >
                    <label for="porcentaje" class="text-white">Ingrese el nuevo porcentaje de ganancia</label>
                    <input type="number" step="any" name="porcentaje" class="form-control" required>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary text-white">Guardar</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- MODAL PARA LA LISTA DE USUARIOS -->

    <div class="modal fade" id="modalUsuariosActivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Lista de usuarios activos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{route('pagarRed')}}" method="POST">
          @csrf
          <div class="modal-body">
            <table class="table">
              <thead>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Número de cuenta</th>
                <th>Pagar red</th>
              </thead>
              <tbody>
                @if($users != null)
                  @forelse($users as $user)
                  <tr>
                    <td>{{$user->firstname}} {{$user->lastname}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->wallet}}</td>
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" name="user{{$user->id}}" type="checkbox" value="{{$user->id}}" id="checkPagarRed{{$user->id}}" checked>
                      </div>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="4" class="text-center">No hay usuarios activos</td>
                  </tr>
                  @endforelse
                @else
                  <td colspan="4" class="text-center">No hay usuarios activos</td>
                @endif
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Pagar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

@endif
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  {{--
  <script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/app-invoice-list.js')) }}"></script>
    --}}
  <script>
    const linkReferido = @json($linkReferido);
    const linkAdminRed = @json($linkAdminRed);

   function link(){
      let aux = document.createElement('input');
      aux.setAttribute('value',linkReferido);
      document.body.appendChild(aux);
      aux.select();
      document.execCommand('copy');
      document.body.removeChild(aux);
      Swal.fire({
           title: "Link Copiado",
           icon: 'success',
           text: "Ya puedes pegarlo en su navegador",
           type: "success",
           confirmButtonClass: 'btn btn-outline-primary',
       })
}

function linkAdmin(){
      let aux = document.createElement('input');
      aux.setAttribute('value',linkAdminRed);
      document.body.appendChild(aux);
      aux.select();
      document.execCommand('copy');
      document.body.removeChild(aux);
      Swal.fire({
           title: "Link Administrador de Red Copiado",
           icon: 'success',
           text: "Ya puedes pegarlo en su navegador",
           type: "success",
           confirmButtonClass: 'btn btn-outline-primary',
       })
}

fetch('/user/dataGrafica').then( function(response){
 return response.json();
}).then(function(response){
 console.log(response);
 
 var options = {
     //colors: ['#fff'],
     series: [{
       name: "Numero de ventas",
       data: response.valores
   }],
     chart: {
     height: 350,
     type: 'line',
     zoom: {
       enabled: false
     },
   },
   dataLabels: {
     enabled: true,
   },
   
   //colors: ['#fff'],

   stroke: {
     curve: 'smooth'
   },
   title: {
     text: '',
     align: 'left',
     style:{
       //color: '#fff'
     }
   },
   grid: {
   row: {
     colors: [], // takes an array which will be repeated on columns
     opacity: 0.5
   },
 },
 xaxis: {
   categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
   labels: {
     style: {
         //colors: ['#fff', '#fff', '#fff', '#fff', '#fff', '#fff' ,'#fff', '#fff', '#fff', '#fff', '#fff', '#fff']
     },               
   }
 },
 yaxis: {
     type:'category',
     axisTicks: {
       show: true,
       width: 1,
     },
     labels: {
       style: {
           //colors: ['#fff', '#fff', '#fff', '#fff', '#fff', '#fff' ,'#fff', '#fff', '#fff']
       },               
     }
 },
 tooltip: {
   enabled: true,
   style:{
     colors: ['#fff']
   }
 }
 };

 var chart = new ApexCharts(document.querySelector("#chart"), options);
 chart.render();
 
}).catch(e => console.log(e))

</script>
@endsection