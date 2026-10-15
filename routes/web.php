<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManifestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaludoController;
use App\Models\User;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/registro', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/registro', [AuthController::class, 'register'])->name('register.store');
});

Route::get('/saludo', [SaludoController::class, 'saludar']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/panel', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/manifiestos', [ManifestController::class, 'index'])->name('manifests.index');

    Route::get('/empresas', [CompanyController::class, 'index'])->name('companies.index');

    Route::get('/trazabilidad', function () {
        return view('trazabilidad.index');
    })->name('traceability.index');

    Route::get('/facturacion', function () {
        return view('facturacion.index');
    })->name('billing.index');

    Route::get('/configuracion', function () {
        return view('configuracion.index');
    })->name('settings.index');

    Route::put('/configuracion', function (Request $request) {
        $settings = $request->validate([
            'email_notifications' => ['required', 'in:0,1'],
            'sms_alerts' => ['required', 'in:0,1'],
            'monthly_digest' => ['required', 'in:0,1'],
            'login_alerts' => ['required', 'in:0,1'],
        ]);

        $request->session()->put('sira_settings', $settings);

        return redirect()->route('settings.index')->with('status', 'Preferencias guardadas para esta sesión.');
    })->name('settings.update');

    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::match(['patch', 'put'], '/perfil', [ProfileController::class, 'update'])->name('profile.update');
});

if (app()->environment('local')) {
    Route::get('/configuracion/preview', function () {
        $previewUser = new User([
            'name' => 'Carlos Mendoza R.',
            'email' => 'carlos.mendoza@sira.mx',
        ]);
        $previewUser->id = 1048;

        auth()->setUser($previewUser);

        return view('configuracion.index', ['previewOnly' => true]);
    })->name('settings.preview');

    Route::get('/facturacion/preview', function () {
        $previewUser = new User([
            'name' => 'Carlos Mendoza R.',
            'email' => 'carlos.mendoza@sira.mx',
        ]);
        $previewUser->id = 1048;

        auth()->setUser($previewUser);

        return view('facturacion.index');
    })->name('billing.preview');

    Route::get('/trazabilidad/preview', function () {
        $previewUser = new User([
            'name' => 'Carlos Mendoza R.',
            'email' => 'carlos.mendoza@sira.mx',
        ]);
        $previewUser->id = 1048;

        auth()->setUser($previewUser);

        return view('trazabilidad.index');
    })->name('traceability.preview');

    Route::get('/manifiestos/preview', function () {
        $previewUser = new User([
            'name' => 'Carlos Mendoza R.',
            'email' => 'carlos.mendoza@sira.mx',
        ]);
        $previewUser->id = 1048;

        auth()->setUser($previewUser);

        return view('manifiestos.index');
    })->name('manifests.preview');

    Route::get('/panel/preview', function () {
        $previewUser = new User([
            'name' => 'Carlos Mendoza R.',
            'email' => 'carlos.mendoza@sira.mx',
        ]);
        $previewUser->id = 1048;

        auth()->setUser($previewUser);

        return view('panel.index');
    })->name('dashboard.preview');

    Route::get('/perfil/preview', function () {
        $previewUser = new User([
            'name' => 'Carlos Mendoza R.',
            'email' => 'carlos.mendoza@sira.mx',
        ]);
        $previewUser->id = 1048;
        $previewUser->created_at = now()->subMonths(8);

        return view('profile.edit', [
            'profileUser' => $previewUser,
            'previewOnly' => true,
        ]);
    })->name('profile.preview');
}