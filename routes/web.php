<?php

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InfografisController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PanController;
use App\Http\Controllers\MsiController;
use App\Http\Controllers\NtmController;
use App\Http\Controllers\NoonpositionController;
use App\Http\Controllers\DistressController;
use App\Http\Controllers\ShipsactivityController;
use App\Http\Controllers\SecuriteController;
use App\Http\Controllers\ContraventionController;
use App\Http\Controllers\TmasController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
// use Illuminate\View\View;


Route::get('/', [UserController::class, 'login'])->name('login.insaf');

// SIDEBAR MENU DYNAMIC
View::composer('layouts.parts.sidebar', function($view) {
    $response = Http::post('localhost:3000/api/menus/insaf/read/76', [
        'modulid' => 3
    ]);
    $decode = (array)json_decode($response);
    // dd($decode['data']);
    $list_menu = $decode['data'];
    $view->with('dynamic_menu', $list_menu);
    
    $response2 = Http::post('localhost:3000/api/submenus/insaf/read', [
        'menuid' => 28,
        'rows' => 100
    ]);
    $decode2 = (array)json_decode($response2);
    // dd($decode[1][0]);
    $list_sub_menu = (array)$decode2[1][0];
    // dd($list_sub_menu['rows']);
    $view->with('dynamic_sub_menu', $list_sub_menu['rows']);
});

// AUTHENTICATION
Route::prefix('auth/')->group(function() {
    Route::get('login/', [UserController::class, 'login'])->name('login.insaf');
    Route::post('login/process', [UserController::class, 'process_login'])->name('processlogin.insaf');
    
    Route::get('registration/', [UserController::class, 'registration'])->name('registration.insaf');
    Route::post('registration/process', [UserController::class, 'process_registration'])->name('processregistration.insaf');
    
    Route::get('reset_password/', [UserController::class, 'reset_password'])->name('reset_password.insaf');

    Route::get('logout/', [UserController::class, 'logout'])->name('logout.insaf');
});

// Route Download File/image/dokumen insaf
Route::get('download/file/{filename}', function($filename) {
    $response = Http::post('http://127.0.0.1:3000/api/insaf/downloadfile/'.$filename);
    return $response->json();
})->name('download.file');

// GET DATA SHIPS by MMSI FOR MODALS
Route::get('ships/get_ship/{mmsi}', function($mmsi) {
    $response = Http::get('http://127.0.0.1:3000/api/kapal/masdex/read/'.$mmsi);
    return $response->json();
})->name('ship.get');

//  GET DATA SECURITE DETAIL FOR INIT TABLE

Route::get('securite/get_detail/{id}', function($id) {
    $response = Http::get('http://127.0.0.1:3000/api/securite/insaf/read_detail/'.$id);
    return $response->json();
})->name('securite.get');

// SAVE SECURITE DETAIL BY ID
Route::post('securite/save_detail/{id}',function($id){
    return $response->json('hello');
})->name('securite_detail.post');

// DELETE DATA SECURITE DETAIL ON TABLE
Route::get('securite/delete_detail/{id}', function($id) {
    $response = Http::delete('http://127.0.0.1:3000/api/securitedetail/insaf/delete/'.$id);
    return $response->json();
})->name('securite.delete');

// GET BMKG DATA
Route::get('/bmkg/api/get_current_wather', function() {
    $response = Http::get('http://127.0.0.1:3000/api/weather/bmkg');
    $data = $response->json();
    return $data['data'][1];
})->name('get_bmkg_weather');

// ADMINISTRATOR
Route::prefix('admin/')->middleware('access_insaf')->group(function() {

    Route::prefix('dashboard')->group(function() {
        Route::get('/', [DashboardController::class, 'public'])->name('dashboard.insaf');
    });

    Route::prefix('home')->group(function() {
        Route::get('/', [HomeController::class, 'index'])->name('home.insaf');
    });

    Route::prefix('user')->group(function() {
        Route::get('/', [UserController::class, 'get_users_by_modul_id'])->name('users.insaf');
        Route::get('/{i}',[UserController::class,'get_users_by_page'])->name('users_pagination.insaf');
        Route::get('/create', [UserController::class, 'create'])->name('users_create.insaf');
        Route::get('/store', [UserController::class, 'store'])->name('users_store.insaf');
        Route::get('/detail', [UserController::class, 'show'])->name('user_detail.insaf');
    });

    // done
    Route::prefix('msi')->group(function() {
        Route::get('/', [MsiController::class, 'index'])->name('msi.insaf');
        Route::get('/create', [MsiController::class, 'create'])->name('msi_create.insaf');
        Route::post('/store', [MsiController::class, 'store'])->name('msi_store.insaf');
        Route::get('/edit/{id}', [MsiController::class, 'edit'])->name('msi_edit.insaf');
        Route::post('/update', [MsiController::class, 'update'])->name('msi_update.insaf');
        Route::get('/detail/{id}', [MsiController::class, 'show'])->name('msi_detail.insaf');
        Route::post('/delete', [MsiController::class, 'delete'])->name('msi_delete.insaf');
        Route::get('/delete_detail_msi_mmsi/{msi_detail_id}', [MsiController::class, 'delete_detail_msi_mmsi'])->name('msi_delete_detail_mmsi.insaf');
        Route::post('/range_date', [MsiController::class, 'range_date'])->name('msi_range_date.insaf');
    });

    // done
    Route::prefix('pan')->group(function() {
        Route::get('/', [PanController::class, 'index'])->name('pan.insaf');
        Route::get('/create', [PanController::class, 'create'])->name('pan_create.insaf');
        Route::post('/store', [PanController::class, 'store'])->name('pan_store.insaf');
		Route::get('/edit/{id}', [PanController::class, 'edit'])->name('pan_edit.insaf');
        Route::post('/update/{id}', [PanController::class, 'update'])->name('pan_update.insaf');
        Route::get('/detail/{id}', [PanController::class, 'show'])->name('pan_detail.insaf');
        Route::get('/delete/{id}', [PanController::class, 'destroy'])->name('pan_delete.insaf');
    });

    // on progress ================================ 90%
    Route::prefix('securite')->group(function() {
        Route::get('/', [SecuriteController::class, 'index'])->name('securite.insaf');
        Route::get('/create', [SecuriteController::class, 'create'])->name('securite_create.insaf');
        Route::get('/store', [SecuriteController::class, 'store'])->name('securite_store.insaf');
        Route::get('/detail/{id}', [SecuriteController::class, 'show'])->name('securite_detail.insaf');
        Route::get('/edit/{id}', [SecuriteController::class, 'edit'])->name('securite_edit.insaf');
        Route::post('/update', [SecuriteController::class, 'update'])->name('securite_update.insaf');
        Route::post('/create_detail', [SecuriteController::class, 'store_detail'])->name('securite_create_detail.insaf');
        Route::post('/delete', [SecuriteController::class, 'delete'])->name('securite_delete.insaf');
        Route::put('/update_detail', [SecuriteController::class, 'update_detail'])->name('securite_update_detail.insaf');
        Route::post('/range_date', [SecuriteController::class, 'range_date'])->name('securite_range_date.insaf');
    });
    
    // done
    Route::prefix('ntm')->group(function() {
        Route::get('/', [NtmController::class, 'index'])->name('ntm.insaf');
        Route::get('/dokumen_ntm/{dokumen}', [NtmController::class, 'get_dokumen'])->name('dokumen_ntm.insaf');
        Route::get('/range_date', [NtmController::class, 'range_date'])->name('ntm_range_date.insaf');
        Route::get('/detail/{id}', [NtmController::class, 'show'])->name('ntm_detail.insaf');
        Route::get('/create', [NtmController::class, 'create'])->name('ntm_create.insaf');
        Route::post('/store', [NtmController::class, 'store'])->name('ntm_store.insaf');
        Route::get('/edit/{id}', [NtmController::class, 'edit'])->name('ntm_edit.insaf');
        Route::post('/update', [NtmController::class, 'update'])->name('ntm_update.insaf');
        Route::delete('/delete', [NtmController::class, 'delete'])->name('ntm_delete.insaf');
        Route::get('/delete_detail_ntm_mmsi/{ntm_id}/{ntm_detail_id}', [NtmController::class, 'delete_detail_ntm_mmsi'])->name('ntm_delete_detail_mmsi.insaf');
    });
    
    // on progress ================================ 80%
    Route::prefix('distress')->group(function() {
        Route::get('/', [DistressController::class, 'index'])->name('distress.insaf');
        Route::get('/create', [DistressController::class, 'create'])->name('distress_create.insaf');
        Route::post('/store', [DistressController::class, 'store'])->name('distress_store.insaf');
        Route::get('/edit/{id}', [DistressController::class, 'edit'])->name('distress_edit.insaf');
        Route::post('/update/{id}', [DistressController::class, 'update'])->name('distress_update.insaf');
        Route::get('/delete/{id}', [DistressController::class, 'destroy'])->name('distress_delete.insaf');
        Route::get('/detail/{id}', [DistressController::class, 'show'])->name('distress_show.insaf');
        Route::get('/chat_room', [DistressController::class, 'chat_room'])->name('distress_chat_room.insaf');
    });

    // done
    Route::prefix('noon_position')->group(function() {
        Route::get('/', [NoonpositionController::class, 'index'])->name('noon_position.insaf');
        Route::get('/get_kapal/{mmsi}', [NoonpositionController::class, 'get_kapal'])->name('noon_position_get_kapal.insaf');
        Route::get('/create', [NoonpositionController::class, 'create'])->name('noon_position_create.insaf');
        Route::post('/range_date', [NoonpositionController::class, 'range_date'])->name('noon_position_range_date.insaf');
        Route::post('/store', [NoonpositionController::class, 'store'])->name('noon_position_store.insaf');
        Route::get('/detail/{id}', [NoonpositionController::class, 'show'])->name('noon_position_detail.insaf');
        Route::get('/edit/{id}', [NoonpositionController::class, 'edit'])->name('noon_position_edit.insaf');
        Route::post('/update', [NoonpositionController::class, 'update'])->name('noon_position_update.insaf');
        Route::post('/delete', [NoonpositionController::class, 'delete'])->name('noon_position_delete.insaf');
    });
   
    // hold !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    Route::prefix('tmas')->group(function() {
        Route::get('/', [TmasController::class, 'index'])->name('tmas.insaf');
    });

    // done 
    Route::prefix('contravention')->group(function() {
        Route::get('/', [ContraventionController::class, 'index'])->name('contravention.insaf');
        Route::get('/create', [ContraventionController::class, 'create'])->name('contravention_create.insaf');
        Route::post('/store', [ContraventionController::class, 'store'])->name('contravention_store.insaf');
        Route::get('/detail/{id}', [ContraventionController::class, 'show'])->name('contravention_detail.insaf');
        Route::post('/range_date', [ContraventionController::class, 'range_date'])->name('contravention_range_date.insaf');
        Route::get('/edit/{id}', [ContraventionController::class, 'edit'])->name('contravention_edit.insaf');
        Route::post('/update', [ContraventionController::class, 'update'])->name('contravention_update.insaf');
        Route::post('/delete', [ContraventionController::class, 'delete'])->name('contravention_delete.insaf');
    });
    
    // on progress ================================ 20%
    Route::prefix('infografis')->group(function() {
        Route::get('/', [InfografisController::class, 'index'])->name('infografis.insaf');
    });

    // on progress ================================ 20%
    Route::prefix('ship/')->group(function() {

        Route::prefix('departure')->group(function() {
            Route::get('/', [ShipsactivityController::class, 'departure'])->name('ship_departure.insaf');
            Route::get('/create', [ShipsactivityController::class, 'departure_create'])->name('ship_departure_create.insaf');
            Route::post('/store', [ShipsactivityController::class, 'departure_store'])->name('ship_departure_store.insaf');
            Route::get('/detail/{id}', [ShipsactivityController::class, 'departure_detail'])->name('ship_departure_detail.insaf');
        });

        // on progress ================================ 80%
        Route::prefix('arrival')->group(function() {
            Route::get('/', [ShipsactivityController::class, 'arrival'])->name('ship_arrival.insaf');
            Route::post('/cek_total_tagihan', [ShipsactivityController::class, 'cek_total_tagihan'])->name('ship_arrival_cek_tagihan.insaf');
            Route::post('/range_date', [ShipsactivityController::class, 'arrival_date_range'])->name('ship_arrival_range_date.insaf');
            Route::get('/detail', [ShipsactivityController::class, 'arrival_detail'])->name('ship_arrival_detail.insaf');
            Route::get('/create_srop', [ShipsactivityController::class, 'arrival_srop_create'])->name('ship_arrival_srop_create.insaf');
            Route::get('/create_vts', [ShipsactivityController::class, 'arrival_vts_create'])->name('ship_arrival_vts_create.insaf');
            Route::post('/store/arrival', [ShipsactivityController::class, 'arrival_store'])->name('ship_arrival_store.insaf');
            // Route::post('/store/vts', [ShipsactivityController::class, 'vts_store'])->name('ship_arrival_vts_store.insaf');
            Route::get('/edit_vts/{id}', [ShipsactivityController::class, 'arrival_vts_edit'])->name('ship_arrival_vts_edit.insaf');
            Route::get('/edit_srop/{id}', [ShipsactivityController::class, 'arrival_srop_edit'])->name('ship_arrival_srop_edit.insaf');
            Route::post('/update', [ShipsactivityController::class, 'arrival_update'])->name('ship_arrival_update.insaf');
            Route::post('/delete', [ShipsactivityController::class, 'arrival_delete'])->name('ship_arrival_delete.insaf');
        });

        Route::prefix('on_port')->group(function() {
            Route::get('/', [ShipsactivityController::class, 'on_port'])->name('ship_on_port.insaf');
            Route::get('/create', [ShipsactivityController::class, 'on_port_create'])->name('ship_on_port_create.insaf');
            Route::post('/store', [ShipsactivityController::class, 'on_port_store'])->name('ship_on_port_store.insaf');
			Route::get('/detail/{id}', [ShipsactivityController::class, 'on_port_detail'])->name('ship_on_port_detail.insaf');
        });

    });
});

// errors
Route::get('error/404', [ErrorController::class, 'error_404'])->name('error.404');
Route::get('error/500', [ErrorController::class, 'error_500'])->name('error.500');
Route::get('error/503', [ErrorController::class, 'error_503'])->name('error.503');
