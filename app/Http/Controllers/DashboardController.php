<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Porcentaje;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\InversionController;
use App\Notifications\userActivacionExitosa;
use App\Models\OrdenPurchase;
use App\Models\Inversion;
use App\Models\Ticket;

class DashboardController extends Controller
{

  public function __construct()
    {
        $this->inversionController = new InversionController();
    }
    
  public function index()
  {
    $linkReferido = route('referral.link', ['referralCode' => auth()->user()->referral_code]);
    $linkAdminRed = route('referral.Admin.Red.link', ['referral_admin_red_code' => auth()->user()->referral_admin_red_code]);

    if(Auth::user()->admin == '1'){

      $users = User::orderBy('id', 'desc')->where('status', '1')->whereHas('inversiones', function($inversion){
        $inversion->where('progress', '>=', 0.20);
      })->get();

      $porcentaje = 0;

      //ORDENES HOY 
      $hoy = Carbon::now();
      $ordenes = OrdenPurchase::whereDate('created_at', $hoy)->count();
      
    }else{
      $inversion = Auth::user()->inversionMasAlta();
      $users = null;
      if($inversion == null){
        $porcentaje = 0.00;
      }else{
        $porcentaje = $inversion->progress;
      }
    }

    $user = Auth::user();

    if($user->admin != 1){
      return view('/content/dashboard/dashboard-analytics', compact('porcentaje','linkReferido','linkAdminRed', 'user'));
    }else{
      // El dashboard del admin
      return view('/admin/dashboard/index', compact('porcentaje', 'users','linkReferido','linkAdminRed', 'user', 'ordenes'));
    }
  }


  // Dashboard - Analytics
  public function dashboardAnalytics()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-analytics', ['pageConfigs' => $pageConfigs]);
  }

  // Dashboard - Ecommerce
  public function dashboardEcommerce()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
  }

  public function dataGrafica()
    {
        $anno = Carbon::now()->format('Y');
        $fecha_ini = Carbon::createFromDate($anno,1,1)->startOfDay();
        $fecha_fin = Carbon::createFromDate($anno, 12,1)->endOfMonth()->endOfDay();
        
      
        $ordenes = Wallet::select(
                        
                        DB::raw('date_format(created_at,"%m/%Y") as created'),
                        DB::raw('SUM(amount) as montos'),
                    );
                    
        /*
        if( (Auth::user()->admin != 1) ){
            $ordenes = $ordenes->whereIn('user_id', $usuarios);
        }
        */
        $ordenes = $ordenes->whereBetween('created_at', [$fecha_ini, $fecha_fin])
                        ->groupBy('created')
                        ->get()
                        ->toArray();
        $valores = [];
      
        for ( $date = $fecha_ini->copy(); $date->lt( $fecha_fin) ; $date->addMonth(1) ) {

            $valores[$date->format('m/Y')] = 0;
     
        }
        
        foreach($ordenes as $key => $orden){
            $valores[$orden['created']] = $orden['montos'];
        }
        //arreglado
        $data = [];
        foreach($valores as $valor){
            $data[] = floatVal($valor);
        }
     
        return response()->json(['valores' => $data]);
    }

    public function convertir(Request $request)
    {
    
      try {
        DB::beginTransaction();
        
        $user = Auth::User();
        $user->type = $request->type;
        $user->save();
        
        $orden = OrdenPurchase::create([
            'user_id' => $user->id,
            'amount' => $request->monto,
            'fee' => 0,
            'package_id' => null,
            'status' => '2'
        ]);

        
        DB::commit();

        return view('shop.transaction', compact('user', 'orden'));
      } catch (\Throwable $th) {

          DB::rollback();

          Log::error('DashboardController - convertir -> Error: '.$th);
          abort(500, "Ocurrio un error, contacte con el administrador");
      }
    }

    public function getTracker($tipo = 1)
    {
      $fecha_fin = Carbon::now();

      if($tipo == 1){
        $fecha_ini = $fecha_fin->copy()->subDay(7);
      }else if($tipo == 2){
        $fecha_ini = $fecha_fin->copy()->subMonth(1);
      }else if($tipo == 3){
        $fecha_ini = $fecha_fin->copy()->subYear(1);
      }
      
      $tickets = Ticket::whereBetween('created_at', [$fecha_ini, $fecha_fin])->get();
      
      $total = $tickets->count();
      $new = Ticket::whereDate('created_at', $fecha_fin)->count();
      $open = $tickets->where('status', 0)->count();
      $close = $tickets->where('status', 1)->count();
      //EVITA EL ERROR DE LA DIVISION ENTRE CERO
      if($total > 0){
        $porcentaje = ($close * 100 ) / $total;
      }else{
        $porcentaje = 0;
      }
      

      return response()->json([
        'total' => $total,
        'new' => $new,
        'open' => $open,
        'close' => $close,
        'porcentaje' => $porcentaje
      ]);
    }
}
