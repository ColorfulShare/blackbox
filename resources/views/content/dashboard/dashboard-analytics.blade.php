
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
    <!-- RETIROS -->
    <div class="col-sm-6 col-12">
      <div class="card">
        <div class="card-body">
          <div class="card-header d-flex align-items-center text-right pb-0 pt-0">
              <h2 class="mt-1 mb-0 font-weight-light"><b>Saldo disponible</b></h2>
          </div>
          
          <div class="card-sub d-flex align-items-center">
              <h1 class="mb-0"><b >$ {{Auth::user()->saldoDisponible()}}</b></h1>
          </div>

          <div class="card-header d-flex align-items-center mt-3">
              <a class="btn btn-primary" href=""><b>RETIRAR</b></a>
          </div>
        </div>
      </div>
    </div>
    <!-- Greetings Card starts -->
    <div class="col-lg-6 col-md-12 col-sm-12">
      <div class="card ">
        <div class="card-body text-center">
          <div class="card-header d-flex align-items-center text-right pb-0 pt-0 white">
            <h2 class="mt-1 mb-0"><b>Ganacia Actual</b></h2>
        
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
          
          <div class="mb-1 d-grid gap-2 w-100">
            <button class="btn btn-primary" onclick="link()">Copiar link de referido</button>
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
          <p class="card-text"> {{Auth::user()->saldoDisponible()}}</p>
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
  <div class="row container">
    <div class="col-lg-4 col-12">
      <div class="card ">
        <div class="card-header d-flex align-items-center text-right">
            <h3 class=""><b>Conviertete en profesional o agente de red:</b></h3>
        </div>
        <div class="row g-0 card-header align-items-center h-100">

          <div class="col-12">
            <a class="btn btn-primary" href="{{route('user.agenteInvertir')}}">
              Invertir
          </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--/ List DataTable -->
</section>
<!-- Dashboard Analytics end -->

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
