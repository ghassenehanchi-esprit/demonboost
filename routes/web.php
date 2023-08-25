<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RankBoostController;
use App\Http\Controllers\WinBoostController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlacementBoostController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\SmurfAccountController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\ReportController;




use App\Http\Middleware\CheckAccountOwnership;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/')->with('success', 'Your email has been verified.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('email/verification-notification', function (\Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'A verification link has been sent to your email address.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/captcha/refresh', [CaptchaController::class, 'refresh'])->name('captcha.refresh');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users',[UserController::class, 'index'] )->name('users.admin');
    Route::get('/rankboosts', [RankBoostController::class, 'index'])->name('rank.boosts');
    Route::get('/winboosts', [WinBoostController::class, 'index'])->name('win.boosts');
    Route::get('/placementboosts',[PlacementBoostController::class, 'index'])->name('placement.boosts');
    Route::get('/rankboostorders', [RankBoostController::class, 'orders'])->name('rankboostorders.orders');
    Route::get('/rankboostorders/filter',[RankBoostController::class, 'filter'])->name('rankboostorders.filter');
    Route::get('/winboostorders/filter',[WinBoostController::class, 'filter'])->name('winboostorders.filter');

    Route::post('/rankboostorders/update-status', [RankBoostController::class, 'updateRankStatus'])->name('rankboostorders.updateStatus');
    Route::post('/winboostorders/update-status', [WinBoostController::class, 'updateWinStatus'])->name('winboostorders.updateStatus');
    Route::get('/winboostorders', [WinBoostController::class, 'orders'])->name('winboostorders.orders');
    Route::post('/placementboostorders/update-status', [PlacementBoostController::class, 'updatePlacementStatus'])->name('placementboostorders.updateStatus');
    Route::post('/verifications/update-status',[VerificationController::class, 'updateVerificationStatus'] )->name('verifications.update');

    Route::get('/placementboostorders', [PlacementBoostController::class, 'orders'])->name('placementboostorders.orders');
    Route::get('/placementboostorders/filter',[PlacementBoostController::class, 'filter'])->name('placementboostorders.filter');

    Route::post('/rankboost/update-price', [RankBoostController::class, 'updatePrice'])->name('update.rankboost.price');
    Route::post('/placementboost/update-price', [PlacementBoostController::class, 'updatePrice'])->name('update.placementboost.price');
    Route::post('/winboost/update-price', [WinBoostController::class, 'updatePrice'])->name('update.winboost.price');

    Route::post('/users/{user}/ban', [UserController::class, 'ban'])->name('admin.users.ban');
    Route::post('/users/{user}/unban', [UserController::class, 'unban'])->name('admin.users.unban');

    Route::get('/verifications',  [VerificationController::class, 'showVerifications'])->name('admin.verifications');
    Route::post('/verifications/accept', [VerificationController::class, 'acceptVerification'])->name('verifications.accept');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/refund-order/{orderId}', [PaymentController::class, 'refundOrder'])->name('refund-order');

    //smurf Accounts
    Route::GET('/smurf-accounts', [SmurfAccountController::class, 'show'])->name('smurf-accounts.show');
    Route::GET('/smurf-accounts-orders', [SmurfAccountController::class, 'showOrders'])->name('smurf-accounts.showorders');
    Route::post('/smurf-accounts/store', [SmurfAccountController::class, 'store'])->name('smurf-accounts.store');
    Route::GET('/smurf-accounts/create', [SmurfAccountController::class, 'create'])->name('smurf-accounts.create');
    Route::delete('/smurf-accounts/{id}', [SmurfAccountController::class, 'destroy'])->name('smurf-accounts.destroy');

});
Route::get('/add-account', [AccountController::class, 'create'])->name('add.account');
Route::get('/account-shop', [AccountController::class, 'showAllAccounts'])->name('accountshop');
Route::get('/accounts/{id}',  [AccountController::class, 'showAccountDetails'])->name('account.details');

Route::post('/save-account', [AccountController::class, 'save'])->name('save.account');

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/rank-boost-order', [RankBoostController::class, 'createRankBoostOrder'])->name('rank.boost.order') ->middleware('auth');
    Route::get('/rank-boost-order/{id}', [RankBoostController::class, 'showRankBoostOrder'])->name('rank-boost-order.show')->middleware('rank.boost.order');
    Route::match(['GET', 'POST'],'/rank-boost-order/update-payment-status/{id}', [PaymentController::class,'updateRankBoostPaymentStatus'])->name('update.Rankpaymentstatus')->middleware('auth');
    
    Route::get('/rank-boost-order/details/{id}', [PaymentController::class, 'paymentSuccess'])->name('process.payment') ->middleware('auth');
    Route::get('/rankboostpayment/{id}', [PaymentController::class, 'showPayment'])->name('rankboostpayment') ;
    Route::put('/rank-boost-order/update/{id}', [RankBoostController::class, 'update'])->name('rank-boost-order.update') ->middleware('verify.boost.order.details');
    Route::get('/rankboostpaypalpayment/{id}', [PaymentController::class, 'showRankPaypalPayment'])->name('rankboostpaypalpayment') ;


    Route::post('/placement-boost-order', [PlacementBoostController::class, 'createPlacementBoostOrder'])->name('placement.boost.order') ->middleware('auth');
Route::get('/placement-boost-order/{id}', [PlacementBoostController::class, 'showPlacementBoostOrder'])->name('placement-boost-order.show')->middleware('placement.boost.order');
Route::match(['GET', 'POST'],'/placement-boost-order/update-payment-status/{id}', [PaymentController::class,'updatePlacementBoostPaymentStatus'])->name('update.Placementpaymentstatus')->middleware('auth');

Route::get('/paymentboostpayment/{id}', [PaymentController::class, 'showPlacementPayment'])->name('placementboostpayment')->middleware('auth');
Route::get('/placement-boost-order/details/{id}', [PaymentController::class, 'paymentPlacementSuccess'])->name('process.placementpayment')->middleware('verify.placementboost.order.details');
Route::put('/placement-boost-order/update/{id}', [PlacementBoostController::class, 'update'])->name('placement-boost-order.update');
Route::get('/placementboostpaypalpayment/{id}', [PaymentController::class, 'showPlacementPaypalPayment'])->name('placementboostpaypalpayment') ;

Route::post('/win-boost-order', [WinBoostController::class, 'createWinBoostOrder'])->name('win.boost.order') ->middleware('auth');
Route::get('/win-boost-order/{id}', [WinBoostController::class, 'showWinBoostOrder'])->name('win-boost-order.show')->middleware('win.boost.order');
Route::put('/win-boost-order/update/{id}', [WinBoostController::class, 'update'])->name('win-boost-order.update');
Route::match(['GET', 'POST'],'/win-boost-order/update-payment-status/{id}', [PaymentController::class,'updateWinBoostPaymentStatus'])->name('update.paymentstatus')->middleware('auth');
Route::get('/winboostpayment/{id}', [PaymentController::class, 'showWinPayment'])->name('winboostpayment') ->middleware('auth');
Route::get('/winboostpaypalpayment/{id}', [PaymentController::class, 'showWinPaypalPayment'])->name('winboostpaypalpayment') ->middleware('auth');
Route::get('/win-boost-order/details/{id}', [PaymentController::class, 'paymentWinSuccess'])->name('process.winpayment')->middleware('verify.winboost.order.details');
Route::get('/accountpayment/{id}', [PaymentController::class, 'showAccountPayment'])->name('accountpayment') ->middleware('auth');
Route::get('/accountpaypalpayment/{id}', [PaymentController::class, 'showAccountPaypalPayment'])->name('accountpaypalpayment') ->middleware('auth');
Route::get('/account-payment/{id}', [AccountController::class, 'showAccountPayment'])->name('account-payment.show');
Route::get('/payment/account/success/{id}', [PaymentController::class, 'paymentAccountSuccess'] )
    ->name('payment.account.success');
    Route::get('/account-token/{id}', [PaymentController::class, 'showForm'])->name('account-form.show')->middleware('verify.account.order');
    Route::put('/account-order/success/{id}', [AccountController::class, 'verifyTokenAndShowCredentials'])
    ->name('account-order.success');
    Route::post('account/submitDiscordUsername/{accountId}', [AccountController::class, 'submitDiscordUsername'])->name('account.submitDiscordUsername');
    Route::get('account', [AccountController::class, 'index'])->name('account.index');
    Route::delete('account/{id}', [AccountController::class, 'delete'])->name('account.delete');

Route::post('/smurf-account-order', [SmurfAccountController::class, 'createSmurfOrder'])->name('smurf-order.create') ->middleware('auth');
Route::get('/smurf-account-order/{id}', [SmurfAccountController::class, 'showSmurfAccountOrder'])->name('smurf-account-order.show')->middleware('verify.smurf.account.order');
Route::get('/smurf-account-payment-paypal/{id}', [PaymentController::class, 'showSmurfPaypalPayment'])->name('smurfPaypalpayment') ->middleware('auth');
Route::get('/smurf-account-payment/{id}', [PaymentController::class, 'showSmurfPayment'])->name('smurfpayment') ->middleware('auth')->middleware('verify.smurf.account.order');
Route::match(['GET', 'POST'],'/smurf-account-order/update-payment-status/{id}', [PaymentController::class,'updateSmurfPaymentStatus'])->name('update.Smurfpaymentstatus')->middleware('auth');
Route::put('/smurf-order/success/{id}', [SmurfAccountController::class, 'getAccountCredentials'])
    ->name('smurf-order.success');
Route::get('/smurf-order/account/{id}', [SmurfAccountController::class, 'showForm'])->name('smurfOrder.Account');

Route::get('withdraw', [EarningController::class, 'withdrawForm'])->name('earning.withdrawForm');
Route::post('withdraw', [EarningController::class, 'withdraw'])->name('earning.withdraw');
Route::get('/earning/return-url/{earnings}', [EarningController::class, 'returnURL'])->name('earning.returnURL');
Route::get('/orders', [ProfileController::class, 'showOrders'])->name('orders');
Route::POST('/report/order/{orderId}', [ReportController::class, 'report'])->name('report.order');

});
Route::get('/my-profile', [ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile/{id}/edit', [ProfileController::class, 'update'])->name('profile.updateBio');
Route::post('/profile/update-avatar', 'ProfileController@updateAvatar')->name('profile.updateAvatar');
Route::view('/account/{id}/settings', 'settings')
    ->name('settings')
    ->middleware(['auth', CheckAccountOwnership::class]);
Route::put('/account/update', [UserController::class,'updateAccount'])->name('account.update');
Route::put('/security/update', [UserController::class,'updateSecurity'])->name('security.update');
//rank boost
Route::get('/rank-boost', [RankBoostController::class,'RankBoostShow'])->name('rankboost');

//placement boost
Route::get('/placement-boost', [PlacementBoostController::class,'PlacementBoostShow'])->name('placementboost');

//win boost
Route::get('/win-boost', [WinBoostController::class,'WinBoostShow'])->name('winboost');


//smurf accounts
Route::GET('/smurf-shop', [SmurfAccountController::class, 'showShop'])->name('smurf-accounts.showShop');


//prices
Route::post('/calculate-price',[PriceController::class, 'calculate'] );
Route::post('/calculate-price-placement',[PriceController::class, 'calculateplacement'] );
Route::post('/calculate-price-win',[PriceController::class, 'calculatewin'] );


Route::get('/verification', [VerificationController::class, 'showVerificationForm'])->name('verification.form');
Route::post('/send-verification-notification', [VerificationController::class, 'sendVerificationNotification'])
    ->name('send-verification-notification');