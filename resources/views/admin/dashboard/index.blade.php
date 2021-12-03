
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



    .fit-image{
width: 100%;
object-fit: cover;
height: 300px; /* only if you want fixed height */
}
  </style>
  @endsection
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
            background:'#283046',
            confirmButtonClass: 'btn btn-outline-primary',
        })
    }

</script>
@section('content')
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
  <div class="row match-height">

      
       <!-- Greetings Card starts -->
       <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
          <div class="card-body text-center banner">
            @if ($banner != null)
      
            <img src="{{asset('storage/banner/'.$banner->banner)}}" class="img-responsive fit-image" alt="">
      
            @else
            <img src="{{asset('img/logo/diseño_w.jpg')}}" class="img-responsive fit-image" alt="">
            @endif
          </div>
        </div>
      </div>
      <!-- Greetings Card ends -->

    <!-- Greetings Card starts -->
    <div class="col-lg-6 col-md-12 col-sm-12">
      <div class="card banner">
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
          <h2 class="fw-bolder mt-1">Ordenes hoy</h2>
          <p class="card-text fw-bold fs-2">{{$ordenes}}</p>


        </div>
      </div>
    </div>
    <!-- Orders Chart Card ends -->
  </div>

  <div class="row match-height">
    <!-- Sales Stats Chart Card starts -->
    <div class="col-lg-4 col-md-6 col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-start pb-1">
          <div>
            <h4 class="card-title mb-25">Total vendidos</h4>
            <p class="card-text" id="sale-ultimaSemana">Última semana</p>
          </div>
          <div class="dropdown chart-dropdown">
            <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>
            <div class="dropdown-menu dropdown-menu-end">
              <a class="dropdown-item saleDropdown" value="1">Última semana</a>
              <a class="dropdown-item saleDropdown" value="2">Últimos 28 dias</a>
              <a class="dropdown-item saleDropdown" value="3">Ultimo año</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="d-inline-block me-1">
            <div class="d-flex align-items-center">
              <i data-feather="circle" class="font-small-3 text-primary me-50"></i>
              <h6 class="mb-0">Paquetes</h6>
            </div>
          </div>
          <div class="d-inline-block">
            <div class="d-flex align-items-center">
              <i data-feather="circle" class="font-small-3 text-info me-50"></i>
              <h6 class="mb-0">Comisiones unilevel</h6>
            </div>
          </div>
          <div id="sales-visit-chart" class="mt-50"></div>
        </div>
      </div>
    </div>
    <!-- Sales Stats Chart Card ends -->
    <!-- Support Tracker Chart Card starts -->
    <div class="col-lg-5 col-md-6 col-12">
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
    <!-- Orders Chart Card starts -->
    <div class="col-lg-3 col-md-6 col-sm-12">
      <div class="card card-light">
        <div class="card-body text-left">
          <div class="row">
              <div class="col-12">
                  <h4 class="mb-1 text-dark texto-card-1">Estadísticas</h4>
              </div>
              <div class="col-12 d-flex justify-content-between flex-wrap">
                  <div class="d-flex mt-2">
                      <div>
                        <i data-feather='user' style="width: 6em; height: 3.5em;"></i>
                      </div>
                      <div class="pl-1">
                          <h3 class="my-0"><span >{{$estadisticas['activos']}}</span> </h3>
                          <p><small class="small">Usuarios Activos</small></p>
                      </div>
                  </div>
                  <div class="d-flex mt-2">
                      <div>
                        <i data-feather='dollar-sign' style="width: 6em; height: 3.5em;"></i>
                      </div>
                      <div class="pl-1">
                          <h3 class="my-0">$ <span >{{$estadisticas['comisionesPagadas']}}</span> </h3>
                          <p><small class="small">Comisiones pagadas (último mes)</small></p>
                      </div>
                  </div>
                  <div class="d-flex mt-2">
                    <div>
                      <i data-feather='corner-down-left' style="width: 6em; height: 3.5em;"></i>
                    </div>
                    <div class="pl-1">
                        <h3 class="my-0"><span >{{$estadisticas['totalPedidos']}}</span> </h3>
                        <p><small class="small">Total pedidos</small></p>
                    </div>
                </div>
                <div class="d-flex mt-2">
                  <div>
                    <i data-feather='check-circle' style="width: 6em; height: 3.5em;"></i>
                  </div>
                  <div class="pl-1">
                      <h3 class="my-0"><span >$ {{$estadisticas['totalInvertido']}}</span> </h3>
                      <p><small class="small">Total invertido</small></p>
                  </div>
              </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Orders Chart Card ends -->
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
                <th>Pagar bono directo</th>
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
                        <input class="form-check-input" name="checkPagarRed-{{$user->id}}" type="checkbox" value="{{$user->id}}" id="checkPagarRed-{{$user->id}}">
                      </div>
                    </td>
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" name="checkPagarBono-{{$user->id}}" type="checkbox" value="{{$user->id}}" id="checkPagarBono-{{$user->id}}" @if($user->hasBonoDirecto()) checked @endif>
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

  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection
@section('page-script')

  <script src="{{ asset(mix('js/scripts/extensions/ext-component-sweet-alerts.js')) }}"></script>
  <script>
    //TRACKER
    $('#tracker').change(function(e){
      let tipo = e.target.value
      getTracker(tipo);
    });

    function getTracker(tipo = 1){

      fetch('{{url("/api/dashboard/tracker")}}/'+tipo)
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

    
    function getSale(tipo = 1){
      
      fetch('{{url("/api/dashboard/sale")}}/'+tipo)
      .then(response => response.json())
      .then(response => {
        $('#sale-ultimaSemana').text(response.nombre)
        apexSale(response);
      })
      .catch(e => console.log(e));
      
    }

    var renderizado = false
    //GRAFICO DE SALEs
    var $salesVisitChart = document.querySelector('#sales-visit-chart');
    var salesVisitChartOptions;
    var salesVisitChart;
    var $white = '#fff';
    var $strokeColor = '#ebe9f1';    

    function apexSale(response = null){
  
      // Sales Chart
      // -----------------------------
      salesVisitChartOptions = {
        chart: {
          height: 300,
          type: 'radar',
          dropShadow: {
            enabled: true,
            blur: 8,
            left: 1,
            top: 1,
            opacity: 0.2
          },
          toolbar: {
            show: false
          },
          offsetY: 5
        },
        series: [
          {
            name: 'Paquetes',
            data: response.ordenes
          },
          {
            name: 'Comisiones unilevel',
            data: response.bonos
          }
        ],
        stroke: {
          width: 0
        },
        colors: [window.colors.solid.primary, window.colors.solid.info],
        plotOptions: {
          radar: {
            polygons: {
              strokeColors: [$strokeColor, 'transparent', 'transparent', 'transparent', 'transparent', 'transparent'],
              connectorColors: 'transparent'
            }
          }
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'dark',
            gradientToColors: [window.colors.solid.primary, window.colors.solid.info],
            shadeIntensity: 1,
            type: 'horizontal',
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100, 100, 100]
          }
        },
        markers: {
          size: 0
        },
        legend: {
          show: false
        },
        labels: response.head,
        dataLabels: {
          background: {
            foreColor: [$strokeColor, $strokeColor, $strokeColor, $strokeColor, $strokeColor, $strokeColor]
          }
        },
        yaxis: {
          show: false
        },
        grid: {
          show: false,
          padding: {
            bottom: -27
          }
        }
      };
      
      salesVisitChart = new ApexCharts($salesVisitChart, salesVisitChartOptions);
      salesVisitChart.render().then(() => renderizado = true);
      
    }
    getSale();

    $('.saleDropdown').click(function(e){
      if(renderizado == true){
        salesVisitChart.destroy();
      }
      getSale(e.target.attributes[1].value);
      
    });

  </script>
@endsection
