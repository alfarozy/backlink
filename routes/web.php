<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthMemberController;
use App\Http\Controllers\BacklinkController;
use App\Http\Controllers\BacklinkPremiumController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardMemberController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ManageMemberController;
use App\Http\Controllers\PackagePremiumMemberController;
use App\Http\Controllers\PremiumPackageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->group(function () {

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource("backlink", BacklinkController::class)->except('show', 'create');
        Route::resource("member", ManageMemberController::class)->except('destroy', 'create', 'edit', 'store');
        Route::resource("paket-member-premium", PackagePremiumMemberController::class)->except('destroy');
        Route::resource("data-backlink-premium", BacklinkPremiumController::class)->except('destroy', 'create');

        Route::resource("premium-package", PremiumPackageController::class)->except('show');
    });


    Route::get('login', [AuthController::class, 'index'])->name('admmin.login');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login');

    Route::get('logout', function () {
        Auth()->logout();
        request()->session()->invalidate();
        request()->session()->flush();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('admin.logout');
});



Route::middleware('auth:member')->group(function () {
    Route::get('/', [DashboardMemberController::class, 'index'])->name('dashboard.member.index');
    Route::get('/backlinks', [DashboardMemberController::class, 'listBacklink'])->name('dashboard.member.listbacklink');
    Route::get('/backlinks-premium', [DashboardMemberController::class, 'backlinkPremium'])->name('dashboard.member.backlink.premium');
    Route::get('/backlinks-saya/create/{id}', [DashboardMemberController::class, 'memberBacklinkCreate'])->name('dashboard.member.backlink.create');
    Route::post('/backlinks-saya/store/{id}', [DashboardMemberController::class, 'memberBacklinkStore'])->name('dashboard.member.backlink.store');
    Route::get('/backlinks-saya/{id}', [DashboardMemberController::class, 'memberBacklinkShow'])->name('dashboard.member.backlink.show');
});

Route::get('register', [AuthMemberController::class, 'registerView'])->name('register');
Route::post('register', [AuthMemberController::class, 'register'])->name('register');
Route::get('login', [AuthMemberController::class, 'loginView'])->name('login');
Route::post('login', [AuthMemberController::class, 'login'])->name('login');
Route::get('forgot-password', [ForgotPasswordController::class, 'index'])->name('forgotpassword');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendEmail'])->name('forgetpassword.send');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'editPassword'])->name('edit.password');
Route::put('reset-password', [ForgotPasswordController::class, 'updatePassword'])->name('update.password');
Route::get('activity-member/{token}', [ForgotPasswordController::class, 'activatedMember'])->name('activedMember');

Route::get('logout', function () {
    Auth('member')->logout();
    request()->session()->invalidate();
    request()->session()->flush();;
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');
