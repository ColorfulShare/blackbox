
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

  <style>
    #tracker{
      width: 30%;
    }
  </style>
  @endsection
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

</script>
@section('content')
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
                  {{--
                    @if(($porcentaje * 100) < 20)
                      <button class="btn btn-primary bg-white mt-1 waves-effect waves-light text-white ml-auto" data-bs-toggle="modal" data-bs-target="#modalPorcentajeGanancia">Cambiar %</button>
                    @else
                  --}}
                      <button class="btn btn-success bg-white mt-1 waves-effect waves-light text-white ml-auto" data-bs-toggle="modal" data-bs-target="#modalUsuariosActivos">Usuarios activos</button>
                    {{--@endif--}}
                </div>
              @endif
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
          <h2 class="fw-bolder mt-1">Ordenes hoy</h2>
          <p class="card-text fw-bold fs-2">{{$ordenes}}</p>


        </div>
    </div>
    </div>
    <!-- Orders Chart Card ends -->
  </div>

  <div class="row match-height">
    <!-- Avg Sessions Chart Card starts -->
    <div class="col-lg-6 col-12">
      <div class="card">
        <div class="card-body">
          <div class="row pb-50">
            <div class="col-sm-6 col-12 d-flex justify-content-between flex-column order-sm-1 order-2 mt-1 mt-sm-0">
              <div class="mb-1 mb-sm-0">
                <h2 class="fw-bolder mb-25">2.7K</h2>
                <p class="card-text fw-bold mb-2">Avg Sessions</p>
                <div class="font-medium-2">
                  <span class="text-success me-25">+5.2%</span>
                  <span>vs last 7 days</span>
                </div>
              </div>
              <button type="button" class="btn btn-primary">View Details</button>
            </div>
            <div class="col-sm-6 col-12 d-flex justify-content-between flex-column text-end order-sm-2 order-1">
              <div class="dropdown chart-dropdown">
                <button
                  class="btn btn-sm border-0 dropdown-toggle p-50"
                  type="button"
                  id="dropdownItem5"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  Last 7 Days
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownItem5">
                  <a class="dropdown-item" href="#">Last 28 Days</a>
                  <a class="dropdown-item" href="#">Last Month</a>
                  <a class="dropdown-item" href="#">Last Year</a>
                </div>
              </div>
              <div id="avg-sessions-chart"></div>
            </div>
          </div>
          <hr />
          <div class="row avg-sessions pt-50">
            <div class="col-6 mb-2">
              <p class="mb-50">Goal: $100000</p>
              <div class="progress progress-bar-primary" style="height: 6px">
                <div
                  class="progress-bar"
                  role="progressbar"
                  aria-valuenow="50"
                  aria-valuemin="50"
                  aria-valuemax="100"
                  style="width: 50%"
                ></div>
              </div>
            </div>
            <div class="col-6 mb-2">
              <p class="mb-50">Users: 100K</p>
              <div class="progress progress-bar-warning" style="height: 6px">
                <div
                  class="progress-bar"
                  role="progressbar"
                  aria-valuenow="60"
                  aria-valuemin="60"
                  aria-valuemax="100"
                  style="width: 60%"
                ></div>
              </div>
            </div>
            <div class="col-6">
              <p class="mb-50">Retention: 90%</p>
              <div class="progress progress-bar-danger" style="height: 6px">
                <div
                  class="progress-bar"
                  role="progressbar"
                  aria-valuenow="70"
                  aria-valuemin="70"
                  aria-valuemax="100"
                  style="width: 70%"
                ></div>
              </div>
            </div>
            <div class="col-6">
              <p class="mb-50">Duration: 1yr</p>
              <div class="progress progress-bar-success" style="height: 6px">
                <div
                  class="progress-bar"
                  role="progressbar"
                  aria-valuenow="90"
                  aria-valuemin="90"
                  aria-valuemax="100"
                  style="width: 90%"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Avg Sessions Chart Card ends -->

    <!-- Support Tracker Chart Card starts -->
    <div class="col-lg-6 col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between pb-0">
          <h4 class="card-title">Rastreador de soporte</h4>
          <select name="tracker" id="tracker" class="form-select">
            <option value="1">ultimos 7 dias</option>
            <option value="2">ultimo mes</option>
            <option value="3">ultimos año</option>
          </select>
          
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
              <h1 class="font-large-2 fw-bolder mt-2 mb-0" id="totalTracker"></h1>
              <p class="card-text">Tickets</p>
            </div>
            <div class="col-sm-10 col-12 d-flex justify-content-center">
              <div id="support-trackers-chart-custom"></div>
            </div>
          </div>
          <div class="d-flex justify-content-between mt-1">
            <div class="text-center">
              <p class="card-text mb-50">Nuevos</p>
              <span class="font-large-1 fw-bold" id="newTracker"></span>
            </div>
            <div class="text-center">
              <p class="card-text mb-50">Abiertos</p>
              <span class="font-large-1 fw-bold" id="openTracker"></span>
            </div>
            <div class="text-center">
              <p class="card-text mb-50">Cerrados</p>
              <span class="font-large-1 fw-bold" id="closeTracker"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Support Tracker Chart Card ends -->
  </div>

  <div class="row match-height">

    <!-- Sales Stats Chart Card starts -->
    <div class="col-lg-4 col-md-6 col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-start pb-1">
          <div>
            <h4 class="card-title mb-25">Sales</h4>
            <p class="card-text">Last 6 months</p>
          </div>
          <div class="dropdown chart-dropdown">
            <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>
            <div class="dropdown-menu dropdown-menu-end">
              <a class="dropdown-item" href="#">Last 28 Days</a>
              <a class="dropdown-item" href="#">Last Month</a>
              <a class="dropdown-item" href="#">Last Year</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="d-inline-block me-1">
            <div class="d-flex align-items-center">
              <i data-feather="circle" class="font-small-3 text-primary me-50"></i>
              <h6 class="mb-0">Sales</h6>
            </div>
          </div>
          <div class="d-inline-block">
            <div class="d-flex align-items-center">
              <i data-feather="circle" class="font-small-3 text-info me-50"></i>
              <h6 class="mb-0">Visits</h6>
            </div>
          </div>
          <div id="sales-visit-chart" class="mt-50"></div>
        </div>
      </div>
    </div>
    <!-- Sales Stats Chart Card ends -->
  </div>

  <!-- List DataTable -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h6>Ordenes</h6>
          <div class="card-datatable table-responsive">
            <table class="table myTable">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Usuario</th>
                  <th>Monto</th>
                  <th>Comprobante</th>
                  <th>Pago</th>
                  <th >Estatus</th>
                  <th>Fecha</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($listOrdenes as $order)
                  <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->user_id}}</td>
                    <td>{{$order->amount}}</td>
                    <td>  
                      @if($order->comprobante != null)
                      <a class="btn btn-danger" target="_blank" href="{{asset('/storage/'.$order->user_id .'/comprobante/'.$order->comprobante)}}"><i data-feather='file-text'></i></a>
                      @endif
                    </td>
                    <td>{{str_replace('_', ' ', $order->type_payment)}}</td>
                    <td>
                      <button type="button"
                            class="@if ($order->status == '0') btn btn-info text-white text-bold-600  @elseif($order->status == '1') btn btn-warning text-white text-bold-600 @elseif($order->status == '2') btn btn-success text-white text-bold-600 @elseif($order->status == '3') btn btn-danger text-white text-bold-600 @endif">{{$order->status()}}
                      </button>
                    </td>
                    <td>{{$order->created_at->format('Y/m/d')}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ List DataTable -->
</section>
<!-- Dashboard Analytics end -->

<!-- MODAL PARA ACTUALIZAR PORCENTAJE DE GANANCIA -->

@if(auth()->user()->admin == 1)
    {{--
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
    --}}
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
  <script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/app-invoice-list.js')) }}"></script>

  <script>
    //TRACKER
    $('#tracker').change(function(e){
      let tipo = e.target.value
      getTracker(tipo);
    });

    function getTracker(tipo = 1){
      
      fetch('/api/dashboard/tracker/'+tipo)
      .then(response => response.json())
      .then(response => {
        $('#totalTracker').text(response.total);
        $('#newTracker').text(response.new);
        $('#openTracker').text(response.open);
        $('#closeTracker').text(response.close);
        apexTracker(response.porcentaje);
      })
      .catch(e => console.log(e));
      
    }

    function apexTracker(porcentaje)
    {
      var $supportTrackerChart = document.querySelector('#support-trackers-chart-custom');
      var supportTrackerChartOptions;
      var supportTrackerChart;
      var $avgSessionStrokeColor2 = '#ebf0f7';
      var $textHeadingColor = '#5e5873';
      var $white = '#fff';
      var $strokeColor = '#ebe9f1';

      supportTrackerChartOptions = {
      chart: {
        height: 270,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          size: 150,
          offsetY: 20,
          startAngle: -150,
          endAngle: 150,
          hollow: {
            size: '65%'
          },
          track: {
            background: $white,
            strokeWidth: '100%'
          },
          dataLabels: {
            name: {
              offsetY: -5,
              color: $textHeadingColor,
              fontSize: '1rem'
            },
            value: {
              offsetY: 15,
              color: $textHeadingColor,
              fontSize: '1.714rem'
            }
          }
        }
      },
      colors: [window.colors.solid.danger],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          type: 'horizontal',
          shadeIntensity: 0.5,
          gradientToColors: [window.colors.solid.primary],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100]
        }
      },
      stroke: {
        dashArray: 8
      },
      series: [porcentaje],
      labels: ['Tickets completados']
    };
    supportTrackerChart = new ApexCharts($supportTrackerChart, supportTrackerChartOptions);
    supportTrackerChart.render();
    }
    getTracker();


    //datataables ordenes 
    $('.myTable').DataTable({
        responsive: true,
        order: [[ 0, "desc" ]],
    })
  </script>
@endsection
