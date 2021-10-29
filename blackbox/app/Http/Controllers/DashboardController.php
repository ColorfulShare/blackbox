<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Porcentaje;
use App\Models\User;

class DashboardController extends Controller
{
  public function index()
  {
    $linkReferido = route('referral.link', ['referralCode' => auth()->user()->referral_code]);
    $linkAdminRed = route('referral.Admin.Red.link', ['referral_admin_red_code' => auth()->user()->referral_admin_red_code]);

    $porcentaje = Porcentaje::orderBy('id', 'desc')->first();
    $users = null;
    if($porcentaje == null){
      $porcentaje = 0.00;
    }else{
      $porcentaje = $porcentaje->porcentaje;

      if($porcentaje >= 0.20){
        $users = User::orderBy('id', 'desc')->where('status', '1')->get();
      }
    }
    if(Auth::user()->admin != 1){
      return view('/content/dashboard/dashboard-analytics', compact('porcentaje','linkReferido','linkAdminRed'));
    }else{
      // El dashboard del admin
      return view('/content/dashboard/dashboard-analytics', compact('porcentaje', 'users','linkReferido','linkAdminRed'));
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
}
