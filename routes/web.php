<?php

use App\Models\OrdenPurchase;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AppsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\PageLayoutController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\UserInterfaceController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\OrdenPurchasesController;
use App\Http\Controllers\DoubleAutenticationController;
use App\Http\Controllers\InversionController;
use App\Http\Controllers\ImpersonateController;
use App\Http\Controllers\LiquidationController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\RendimientoController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TreController;
use App\Http\Controllers\EducationController;
use App\Models\Liquidation;
use App\Http\Controllers\ComisionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main Page Route
// Route::get('/', [DashboardController::class,'dashboardEcommerce'])->name('dashboard-ecommerce')->middleware('verified');

Route::get('/clear', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    // Mail::send('correo.subcripcion', ['data' => []], function ($correo2)
    //     {
    //         $correo2->subject('Limpio el sistema');
    //         $correo2->to('cgonzalez.byob@gmail.com');
    //     });
    return 'DONE'; //Return anything
});
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return 'DONE'; //Return anything
});
Route::get('/storage-link', function () {
    $exitCode = Artisan::call('storage:link');
    return 'DONE'; //Return anything
});

/* */
//Route::get('checkEmail/{id}', [UserController::class, 'checkEmail'])->name('checkemail');
/*  */

Route::middleware('auth')->group(function () {




    Route::group(['prefix' => 'dashboard'], function () {
        //Route::get('/send-email-verification', [UserController::class, 'sendCodeEmail'])->name('user.send.code');
        Route::get('/verification', [UserController::class, 'verificationEmail'])->name('user.verification.email');
        Route::patch('/verifyAccount/{user}', [UserController::class, 'verifyAccount'])->name('verify-account');
    });

    //RUTAS ADMIN
    Route::middleware('admin')->group(function () {

        Route::put('/cambiar-porcentaje', [UserController::class, 'cambiarPorcentaje'])->name('cambiarPorcentaje');
        Route::post('/pagar-red', [InversionController::class, 'pagarRed'])->name('pagarRed');

        //USER
        Route::prefix('user')->group(function () {
            Route::get('user-list', [UserController::class, 'listUser'])->name('users.list-user');
            Route::post('/impersonate/{user}/start', [ImpersonateController::class, 'start'])->name('impersonate.start');
            Route::get('/activacion', [UserController::class, 'activacion'])->name('user.activacion');
            Route::post('/activar', [UserController::class, 'activar'])->name('user.activar');
            Route::patch('/profile-Update', [UserController::class, 'ProfileUpdate'])->name('profile.update');
        });

        //RENDIMIENTOS
        Route::prefix('rendimientos')->group(function () {
            Route::get('/', [RendimientoController::class, 'index'])->name('rendimiento.index');
            Route::post('/pagarrendimiento', [RendimientoController::class, 'savePorcentage'])->name('rendimiento.save.porcentage');
        });

        //EDUCACION
        Route::prefix('education')->group(function () {
            Route::get('/', [EducationController::class, 'index'])->name('education.componentAdmin.index');
            Route::get('/create', [EducationController::class, 'create'])->name('education.create');
            Route::post('/', [EducationController::class, 'store'])->name('education.store');
        });

        //GENEALOGY
        Route::prefix('genealogy')->group(function () {
            Route::get('/buscar', [TreController::class, 'buscar'])->name('genealogy.buscar');
            Route::post('/buscar', [TreController::class, 'search'])->name('genealogy.search');
        });


        //COMISIONES
        Route::prefix('comisions')->group( function() {
          Route::get('/', [ComisionController::class, 'index'])->name('comision.index');
        });    
        
        //NOTICIAS
        Route::group(['prefix' => 'news'], function () {
            Route::get('list', [NewsController::class, 'list'])->name('news.list');
            Route::get('create', [NewsController::class, 'create'])->name('news.create');
            Route::post('store', [NewsController::class, 'store'])->name('news.store');
            Route::get('edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
            Route::delete('destroy/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
            Route::patch('update/{id}', [NewsController::class, 'update'])->name('news.update');
        });
        
        //DOCUMENTOS
        Route::group(['prefix' => 'documents'], function () {
            Route::get('list', [DocumentsController::class, 'list'])->name('documents.list');
            Route::get('show', [DocumentsController::class, 'show'])->name('documents.show');
            Route::get('create', [DocumentsController::class, 'create'])->name('documents.create');
            Route::post('store', [DocumentsController::class, 'store'])->name('documents.store');
            Route::get('edit/{id}', [DocumentsController::class, 'edit'])->name('documents.edit');
            Route::delete('destroy/{id}', [DocumentsController::class, 'destroy'])->name('documents.destroy');
            Route::patch('update/{id}', [DocumentsController::class, 'update'])->name('documents.update');
        });
    });
    //
    // Red de usuario
    Route::prefix('genealogy')->group(function () {
        // Ruta para ver la lista de usuarios
        //Route::get('users/{network}', [TreController::class, 'indexNewtwork'])->name('genealogy_list_network');
        // Ruta para visualizar el arbol o la matriz
        Route::get('/', [TreController::class, 'index'])->name('genealogy_type');
        // Ruta para visualizar el arbol o la matriz de un usuario en especifico
        Route::get('/{id}', [TreController::class, 'moretree'])->name('genealogy_type_id');

        /*
        Route::post('{type}', 'TreeController@moretreeEmail')->name('genealogy_type_email');
        */
    });

    //User
    Route::prefix('user')->group(function () {
        Route::get('/impersonate/stop', [ImpersonateController::class, 'stop'])->name('impersonate.stop');
        Route::get('dataGrafica', [DashboardController::class, 'dataGrafica'])->name('dataGrafica');
        Route::patch('/profile-user-Update',[UserController::class, 'ProfileUpdate'])->name('profile-user.update');
        Route::get('list/referidos', [UserController::class, 'referidos'])->name('list.referidos');
    });

    //EDUCACION USER
    Route::prefix('educations')->group(function () {
        Route::get('/', [EducationController::class, 'index'])->name('education.componentUser.index');
    });

    // 2fact
    Route::get('/2fact', [DoubleAutenticationController::class, 'index'])->name('2fact');
    Route::post('/2fact', [DoubleAutenticationController::class, 'checkCodeLogin'])->name('2fact.post');
    Route::post('/2fact-perfil', [DoubleAutenticationController::class, 'checkCodePerfil'])->name('2fact-perfil.post');


    //DASHBOARD

    //Route::get('/', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard')->middleware('check.email');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('check.email');

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('analytics', [DashboardController::class, 'dashboardAnalytics'])->name('dashboard-analytics');
        Route::post('convertir', [DashboardController::class, 'convertir'])->name('dashboard.convertir');
    });


    //DOCUMENTOS
    Route::group(['prefix' => 'documents'], function () {
        Route::get('show', [DocumentsController::class, 'show'])->name('documents.show');
        Route::get('pdf/{id}', [DocumentsController::class, 'pdf'])->name('documents.pdf');
    });
    
    //TIENDA
    Route::prefix('shop')->group(function () {
        Route::get('/', [TiendaController::class, 'index'])->name('shop');
        Route::post('/', [TiendaController::class, 'proccess'])->name('shop.proccess');
        Route::post('/store', [TiendaController::class, 'store'])->name('shop.store');
    });

    Route::group(['prefix' => 'ordenes'], function () {
        Route::get('/', [OrdenPurchasesController::class, 'index'])->name('orders.index');
        Route::post('/cambiarStatus', [OrdenPurchasesController::class, 'cambiar_status'])->name('orders.cambiarStatus');
    });

    //INVERSIONES
    Route::group(['prefix' => 'inversiones'], function () {
        Route::get('/', [InversionController::class, 'index'])->name('inversiones.index');
    });
});
//BONOSS
Route::get('/bonoContruccion', [InversionController::class, 'bonoContruccion'])->name('bonoContruccion');

Auth::routes(['verify' => true]);


/* Route Dashboards */

/* Route Dashboards */

/* Route Apps */
Route::group(['prefix' => 'app'], function () {
    Route::get('email', [AppsController::class, 'emailApp'])->name('app-email');
    Route::get('chat', [AppsController::class, 'chatApp'])->name('app-chat');
    Route::get('todo', [AppsController::class, 'todoApp'])->name('app-todo');
    Route::get('calendar', [AppsController::class, 'calendarApp'])->name('app-calendar');
    Route::get('kanban', [AppsController::class, 'kanbanApp'])->name('app-kanban');
    Route::get('invoice/list', [AppsController::class, 'invoice_list'])->name('app-invoice-list');
    Route::get('invoice/preview', [AppsController::class, 'invoice_preview'])->name('app-invoice-preview');
    Route::get('invoice/edit', [AppsController::class, 'invoice_edit'])->name('app-invoice-edit');
    Route::get('invoice/add', [AppsController::class, 'invoice_add'])->name('app-invoice-add');
    Route::get('invoice/print', [AppsController::class, 'invoice_print'])->name('app-invoice-print');
    Route::get('ecommerce/shop', [AppsController::class, 'ecommerce_shop'])->name('app-ecommerce-shop');
    Route::get('ecommerce/details', [AppsController::class, 'ecommerce_details'])->name('app-ecommerce-details');
    Route::get('ecommerce/wishlist', [AppsController::class, 'ecommerce_wishlist'])->name('app-ecommerce-wishlist');
    Route::get('ecommerce/checkout', [AppsController::class, 'ecommerce_checkout'])->name('app-ecommerce-checkout');
    Route::get('file-manager', [AppsController::class, 'file_manager'])->name('app-file-manager');
    Route::get('user/list', [AppsController::class, 'user_list'])->name('app-user-list');
    Route::get('user/view', [AppsController::class, 'user_view'])->name('app-user-view');
    Route::get('user/edit', [AppsController::class, 'user_edit'])->name('app-user-edit');
});
/* Route Apps */

/* Route UI */
Route::group(['prefix' => 'ui'], function () {
    Route::get('typography', [UserInterfaceController::class, 'typography'])->name('ui-typography');
});
/* Route UI */

/* Route Icons */
Route::group(['prefix' => 'icons'], function () {
    Route::get('feather', [UserInterfaceController::class, 'icons_feather'])->name('icons-feather');
});
/* Route Icons */

/* Route Cards */
Route::group(['prefix' => 'card'], function () {
    Route::get('basic', [CardsController::class, 'card_basic'])->name('card-basic');
    Route::get('advance', [CardsController::class, 'card_advance'])->name('card-advance');
    Route::get('statistics', [CardsController::class, 'card_statistics'])->name('card-statistics');
    Route::get('analytics', [CardsController::class, 'card_analytics'])->name('card-analytics');
    Route::get('actions', [CardsController::class, 'card_actions'])->name('card-actions');
});
/* Route Cards */

/* Route Components */
Route::group(['prefix' => 'component'], function () {
    Route::get('accordion', [ComponentsController::class, 'accordion'])->name('component-accordion');
    Route::get('alert', [ComponentsController::class, 'alert'])->name('component-alert');
    Route::get('avatar', [ComponentsController::class, 'avatar'])->name('component-avatar');
    Route::get('badges', [ComponentsController::class, 'badges'])->name('component-badges');
    Route::get('breadcrumbs', [ComponentsController::class, 'breadcrumbs'])->name('component-breadcrumbs');
    Route::get('buttons', [ComponentsController::class, 'buttons'])->name('component-buttons');
    Route::get('carousel', [ComponentsController::class, 'carousel'])->name('component-carousel');
    Route::get('collapse', [ComponentsController::class, 'collapse'])->name('component-collapse');
    Route::get('divider', [ComponentsController::class, 'divider'])->name('component-divider');
    Route::get('dropdowns', [ComponentsController::class, 'dropdowns'])->name('component-dropdowns');
    Route::get('list-group', [ComponentsController::class, 'list_group'])->name('component-list-group');
    Route::get('modals', [ComponentsController::class, 'modals'])->name('component-modals');
    Route::get('pagination', [ComponentsController::class, 'pagination'])->name('component-pagination');
    Route::get('navs', [ComponentsController::class, 'navs'])->name('component-navs');
    Route::get('offcanvas', [ComponentsController::class, 'offcanvas'])->name('component-offcanvas');
    Route::get('tabs', [ComponentsController::class, 'tabs'])->name('component-tabs');
    Route::get('timeline', [ComponentsController::class, 'timeline'])->name('component-timeline');
    Route::get('pills', [ComponentsController::class, 'pills'])->name('component-pills');
    Route::get('tooltips', [ComponentsController::class, 'tooltips'])->name('component-tooltips');
    Route::get('popovers', [ComponentsController::class, 'popovers'])->name('component-popovers');
    Route::get('pill-badges', [ComponentsController::class, 'pill_badges'])->name('component-pill-badges');
    Route::get('progress', [ComponentsController::class, 'progress'])->name('component-progress');
    Route::get('spinner', [ComponentsController::class, 'spinner'])->name('component-spinner');
    Route::get('toast', [ComponentsController::class, 'toast'])->name('component-bs-toast');
});
/* Route Components */

/* Route Extensions */
Route::group(['prefix' => 'ext-component'], function () {
    Route::get('sweet-alerts', [ExtensionController::class, 'sweet_alert'])->name('ext-component-sweet-alerts');
    Route::get('block-ui', [ExtensionController::class, 'block_ui'])->name('ext-component-block-ui');
    Route::get('toastr', [ExtensionController::class, 'toastr'])->name('ext-component-toastr');
    Route::get('sliders', [ExtensionController::class, 'sliders'])->name('ext-component-sliders');
    Route::get('drag-drop', [ExtensionController::class, 'drag_drop'])->name('ext-component-drag-drop');
    Route::get('tour', [ExtensionController::class, 'tour'])->name('ext-component-tour');
    Route::get('clipboard', [ExtensionController::class, 'clipboard'])->name('ext-component-clipboard');
    Route::get('plyr', [ExtensionController::class, 'plyr'])->name('ext-component-plyr');
    Route::get('context-menu', [ExtensionController::class, 'context_menu'])->name('ext-component-context-menu');
    Route::get('swiper', [ExtensionController::class, 'swiper'])->name('ext-component-swiper');
    Route::get('tree', [ExtensionController::class, 'tree'])->name('ext-component-tree');
    Route::get('ratings', [ExtensionController::class, 'ratings'])->name('ext-component-ratings');
    Route::get('locale', [ExtensionController::class, 'locale'])->name('ext-component-locale');
});
/* Route Extensions */

/* Route Page Layouts */
Route::group(['prefix' => 'page-layouts'], function () {
    Route::get('collapsed-menu', [PageLayoutController::class, 'layout_collapsed_menu'])->name('layout-collapsed-menu');
    Route::get('full', [PageLayoutController::class, 'layout_full'])->name('layout-full');
    Route::get('without-menu', [PageLayoutController::class, 'layout_without_menu'])->name('layout-without-menu');
    Route::get('empty', [PageLayoutController::class, 'layout_empty'])->name('layout-empty');
    Route::get('blank', [PageLayoutController::class, 'layout_blank'])->name('layout-blank');
});
/* Route Page Layouts */

/* Route Forms */
Route::group(['prefix' => 'form'], function () {
    Route::get('input', [FormsController::class, 'input'])->name('form-input');
    Route::get('input-groups', [FormsController::class, 'input_groups'])->name('form-input-groups');
    Route::get('input-mask', [FormsController::class, 'input_mask'])->name('form-input-mask');
    Route::get('textarea', [FormsController::class, 'textarea'])->name('form-textarea');
    Route::get('checkbox', [FormsController::class, 'checkbox'])->name('form-checkbox');
    Route::get('radio', [FormsController::class, 'radio'])->name('form-radio');
    Route::get('switch', [FormsController::class, 'switch'])->name('form-switch');
    Route::get('select', [FormsController::class, 'select'])->name('form-select');
    Route::get('number-input', [FormsController::class, 'number_input'])->name('form-number-input');
    Route::get('file-uploader', [FormsController::class, 'file_uploader'])->name('form-file-uploader');
    Route::get('quill-editor', [FormsController::class, 'quill_editor'])->name('form-quill-editor');
    Route::get('date-time-picker', [FormsController::class, 'date_time_picker'])->name('form-date-time-picker');
    Route::get('layout', [FormsController::class, 'layouts'])->name('form-layout');
    Route::get('wizard', [FormsController::class, 'wizard'])->name('form-wizard');
    Route::get('validation', [FormsController::class, 'validation'])->name('form-validation');
    Route::get('repeater', [FormsController::class, 'form_repeater'])->name('form-repeater');
});
/* Route Forms */

//Ruta de los Tickets
Route::group(['prefix' => 'tickets'], function () {
    Route::get('ticket-create', [TicketsController::class, 'create'])->name('ticket.create');
    Route::post('ticket-store', [TicketsController::class, 'store'])->name('ticket.store');

    // Para el usuario
    Route::get('ticket-edit-user/{id}', [TicketsController::class, 'editUser'])->name('ticket.edit-user');
    Route::patch('ticket-update-user/{id}', [TicketsController::class, 'updateUser'])->name('ticket.update-user');
    Route::get('ticket-list-user', [TicketsController::class, 'listUser'])->name('ticket.list-user');
    Route::get('ticket-show-user/{id}', [TicketsController::class, 'showUser'])->name('ticket.show-user');

    // Para el Admin
    Route::get('ticket-edit-admin/{id}', [TicketsController::class, 'editAdmin'])->name('ticket.edit-admin');
    Route::patch('ticket-update-admin/{id}', [TicketsController::class, 'updateAdmin'])->name('ticket.update-admin');
    Route::get('ticket-list-admin', [TicketsController::class, 'listAdmin'])->name('ticket.list-admin');
    Route::get('ticket-show-admin/{id}',  [TicketsController::class, 'showAdmin'])->name('ticket.show-admin');
});




/* Route Tables */
Route::group(['prefix' => 'table'], function () {
    Route::get('', [TableController::class, 'table'])->name('table');
    Route::get('datatable/basic', [TableController::class, 'datatable_basic'])->name('datatable-basic');
    Route::get('datatable/advance', [TableController::class, 'datatable_advance'])->name('datatable-advance');
});


/* Wallets */
Route::group(['prefix' => 'wallet'], function () {
    Route::get('IndexWallet', [WalletController::class, 'indexWallet'])->name('wallet.IndexWallet');

    Route::get('withdraw', [LiquidationController::class, 'withdraw'])->name('wallet.withdraw');

    Route::post('/process', [LiquidationController::class, 'procesarLiquidacion'])->name('settlement.process');

    Route::get('{wallet}/sendcodeemail', [LiquidationController::class, 'sendCodeEmail'])->name('send-code-email');
});


/* Withdraw */
Route::group(['prefix' => 'withdraw'], function () {

    Route::get('/pending', [LiquidationController::class, 'indexPendientes'])->name('withdraw.pending');

    Route::get('retiros', [LiquidationController::class, 'retiroHistory'])->name('withdraw.retiros');
});

/* Route Tables */

/* Route Pages */
Route::group(['prefix' => 'page'], function () {
    Route::get('account-settings', [PagesController::class, 'account_settings'])->name('page-account-settings');
    Route::get('profile', [PagesController::class, 'profile'])->name('page-profile');
    Route::get('faq', [PagesController::class, 'faq'])->name('page-faq');
    Route::get('knowledge-base', [PagesController::class, 'knowledge_base'])->name('page-knowledge-base');
    Route::get('knowledge-base/category', [PagesController::class, 'kb_category'])->name('page-knowledge-category');
    Route::get('knowledge-base/category/question', [PagesController::class, 'kb_question'])->name('page-knowledge-base-question');
    Route::get('pricing', [PagesController::class, 'pricing'])->name('page-pricing');
    Route::get('blog/list', [PagesController::class, 'blog_list'])->name('page-blog-list');
    Route::get('blog/detail', [PagesController::class, 'blog_detail'])->name('page-blog-detail');
    Route::get('blog/edit', [PagesController::class, 'blog_edit'])->name('page-blog-edit');

    // Miscellaneous Pages With Page Prefix
    Route::get('coming-soon', [MiscellaneousController::class, 'coming_soon'])->name('misc-coming-soon');
    Route::get('not-authorized', [MiscellaneousController::class, 'not_authorized'])->name('misc-not-authorized');
    Route::get('maintenance', [MiscellaneousController::class, 'maintenance'])->name('misc-maintenance');
});
/* Route Pages */
Route::get('/error', [MiscellaneousController::class, 'error'])->name('error');

/* Route Authentication Pages */
Route::group(['prefix' => 'auth'], function () {
    Route::get('login-v1', [AuthenticationController::class, 'login_v1'])->name('auth-login-v1');
    Route::get('login-v2', [AuthenticationController::class, 'login_v2'])->name('auth-login-v2');
    Route::get('register-v1', [AuthenticationController::class, 'register_v1'])->name('auth-register-v1');
    Route::get('register-v2', [AuthenticationController::class, 'register_v2'])->name('auth-register-v2');
    Route::get('forgot-password-v1', [AuthenticationController::class, 'forgot_password_v1'])->name('auth-forgot-password-v1');
    Route::get('forgot-password-v2', [AuthenticationController::class, 'forgot_password_v2'])->name('auth-forgot-password-v2');
    Route::get('reset-password-v1', [AuthenticationController::class, 'reset_password_v1'])->name('auth-reset-password-v1');
    Route::get('reset-password-v2', [AuthenticationController::class, 'reset_password_v2'])->name('auth-reset-password-v2');
    Route::get('lock-screen', [AuthenticationController::class, 'lock_screen'])->name('auth-lock_screen');
});
/* Route Authentication Pages */





/* Route Charts */
Route::group(['prefix' => 'chart'], function () {
    Route::get('apex', [ChartsController::class, 'apex'])->name('chart-apex');
    Route::get('chartjs', [ChartsController::class, 'chartjs'])->name('chart-chartjs');
    Route::get('echarts', [ChartsController::class, 'echarts'])->name('chart-echarts');
});
/* Route Charts */

// map leaflet
Route::get('/maps/leaflet', [ChartsController::class, 'maps_leaflet'])->name('map-leaflet');

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);


//Ruta de enlace de referidos
Route::get('r/{referralCode}', [ReferralController::class, 'link'])->name('referral.link');

//Ruta referidos administrador red
Route::get('rAdminRed/{referral_admin_red_code}', [ReferralController::class, 'linkAdminRed'])->name('referral.Admin.Red.link');

Route::get('/cookie', function () {
    return Cookie::get('referral');
});

Route::get('/referidos', [ReferralController::class, 'referidos'])->name('referidos.index');
