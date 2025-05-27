<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDepositController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\EpinsController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\GlobalSettingsController;
use App\Http\Controllers\Auth\ConfirmPasswordController;


// Frontend Section
Route::get('/',[FrontendController::class,'index']);
Route::get('/about-us',[FrontendController::class,'about_page'])->name('about-us');
Route::get('/contact-us',[FrontendController::class,'contact_page'])->name('contact-us');
Route::get('/testimonials',[FrontendController::class,'Testimonials'])->name('testimonials');
Route::post('vpay-webhook', [FrontendController::class, 'vpay_webhook']);
Route::get('vpay-webhook', [FrontendController::class, 'vpay_webhook']);
Auth::routes();

// Login & Register Section
Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::get('/user-logout',[LoginController::class,'Logout'])->name('user.logout');
Route::get('/admin-logout',[LoginController::class,'adminLogout'])->name('admin.logout');
Route::post('/admin',[LoginController::class,'adminLogin'])->name('admin.login');
Route::post('/create-user',[LoginController::class,'create_user'])->name('cretae-user');
// Admin reset password 
Route::get('/reset-admin-password',[LoginController::class,'reset_admin_password'])->name('admin.reset-password');
Route::get('/reset-admin-link',[LoginController::class,'reset_admin_link'])->name('admin.reset-link');
Route::post('/reset-admin-link',[LoginController::class,'send_reset_link'])->name('admin.reset');
Route::post('/update-admin-password',[LoginController::class,'update_pasword'])->name('admin.update-password');

Route::get('/admin/register',[RegisterController::class,'showAdminRegisterForm'])->name('admin.register-view');
Route::get('/register',[RegisterController::class,'showUserRegisterForm'])->name('register');
Route::post('/admin/register',[RegisterController::class,'createAdmin'])->name('admin.register');

// User Section Start 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/hunt-code', [App\Http\Controllers\HomeController::class, 'hunt_code'])->name('hunt.code');
Route::post('/save-code', [App\Http\Controllers\HomeController::class, 'save_code'])->name('save-code');
Route::get('/get-code-ii', [App\Http\Controllers\HomeController::class, 'get_coupon']);
Route::get('/network-data', [App\Http\Controllers\HomeController::class, 'Network_data'])->name('network.buy-data');
Route::post('/mtn-data', [App\Http\Controllers\HomeController::class, 'get_mtn_data'])->name('network.mtn-data');
Route::post('/gol-data', [App\Http\Controllers\HomeController::class, 'get_gol_data'])->name('network.gol-data');
Route::post('/airtel-data', [App\Http\Controllers\HomeController::class, 'get_airtel_data'])->name('network.airtime-data');
Route::post('/nine-data', [App\Http\Controllers\HomeController::class, 'get_9moblie_data'])->name('network.nine-data');
Route::get('/smile-data', [App\Http\Controllers\HomeController::class, 'Smile_data'])->name('network.smile-data');
Route::get('/spectratnet-data', [App\Http\Controllers\HomeController::class, 'Spectratnet_data'])->name('network.spectratnet-data');
Route::get('/network-airtime', [App\Http\Controllers\HomeController::class, 'get_airtime'])->name('network.airtime');
Route::post('/pay-airtime', [App\Http\Controllers\EpinsController::class, 'epins_airtime'])->name('network.pay-airtime');
Route::get('/network-epin', [App\Http\Controllers\HomeController::class, 'get_epin'])->name('network.epin');
Route::get('/tv-subscription', [App\Http\Controllers\HomeController::class, 'get_tv_subscription'])->name('tv.subscription');
Route::get('/ikeja-electric', [App\Http\Controllers\PurchaseController::class, 'electricity_bill'])->name('electricity.bill');
Route::get('/eko-electric', [App\Http\Controllers\PurchaseController::class, 'eko_electric'])->name('eko.electric');
Route::get('/kano-electric', [App\Http\Controllers\PurchaseController::class, 'kano_electric'])->name('kano.electric');
Route::get('/harcourt-electric', [App\Http\Controllers\PurchaseController::class, 'harcourt_electric'])->name('harcourt.electric');
Route::get('/jos-electric', [App\Http\Controllers\PurchaseController::class, 'jos_electric'])->name('jos.electric');
Route::get('/ibadan-electric', [App\Http\Controllers\PurchaseController::class, 'ibadan_electric'])->name('ibadan.electric');
Route::get('/kaduna-electric', [App\Http\Controllers\PurchaseController::class, 'kaduna_electric'])->name('kaduna.electric');
Route::get('/abuja-electric', [App\Http\Controllers\PurchaseController::class, 'abuja_electric'])->name('abuja.electric');
Route::get('/benin-electric', [App\Http\Controllers\PurchaseController::class, 'benin_electric'])->name('benin.electric');
Route::get('/enugu-electric', [App\Http\Controllers\PurchaseController::class, 'enugu_electric'])->name('enugu.electric');
Route::get('/wace-registration', [App\Http\Controllers\PurchaseController::class, 'wace_registration'])->name('wace.registration');
Route::post('/pay-wace-registration', [App\Http\Controllers\PurchaseController::class, 'pay_wace_registration']);
Route::post('/verify-meter', [App\Http\Controllers\PurchaseController::class, 'verify_meter']);
Route::post('/pay-meter', [App\Http\Controllers\PurchaseController::class, 'pay_electric_bill']);
Route::post('/amount-pay', [App\Http\Controllers\EpinsController::class, 'get_total_amount']);
Route::get('/pricing', [App\Http\Controllers\PurchaseController::class, 'pricing'])->name('wavepluse.price');
Route::get('/profile', [App\Http\Controllers\PurchaseController::class, 'profile'])->name('wavepluse.profile');
Route::post('/update_user/{id}', [App\Http\Controllers\PurchaseController::class, 'update_user'])->name('wavepluse.user');
Route::post('/clam-bonus', [App\Http\Controllers\BonusController::class, 'clam_bonus']);
Route::post('/cash_back', [App\Http\Controllers\BonusController::class, 'cash_back']);
Route::get('/reseller-access', [App\Http\Controllers\BonusController::class, 'reseller'])->name('wavepluse.reseller');
Route::post('/upgrade_reseller', [App\Http\Controllers\BonusController::class, 'upgrade_reseller'])->name('wavepluse.up_reseller');
Route::post('/apply_coupon', [App\Http\Controllers\BonusController::class, 'coupon']);
Route::get('/send-message', [App\Http\Controllers\PaymentController::class, 'send_message'])->name('send-notification');
Route::post('/send-notification', [App\Http\Controllers\PaymentController::class, 'send_notification'])->name('send-message');






// Testing URL
Route::get('/testing-api', [App\Http\Controllers\HomeController::class, 'testing'])->name('api.testing');
Route::get('/testepin', [App\Http\Controllers\EpinsController::class, 'epin_airtime'])->name('api.tsepin');
Route::post('/testepin', [App\Http\Controllers\EpinsController::class, 'testepin'])->name('api.testepin');

// PAYMENT SECTION
Route::get('credit-wallet', [App\Http\Controllers\PaymentController::class, 'credit_wallet'])->name('credit.wallet');
Route::get('share-wallet', [App\Http\Controllers\PaymentController::class, 'share_wallet'])->name('share.wallet');
Route::get('test-api', [App\Http\Controllers\PaymentController::class, 'test_api'])->name('test.api');
Route::post('generate-vpay', [App\Http\Controllers\PaymentController::class, 'connect_vpay'])->name('vpay');
Route::post('share-balance', [App\Http\Controllers\PaymentController::class, 'share_balance'])->name('share.balance');
Route::get('transfer-history', [App\Http\Controllers\PaymentController::class, 'transfer_history'])->name('transfer.history');
Route::get('payment-history', [App\Http\Controllers\PaymentController::class, 'payment_history'])->name('credit.history');
Route::get('purchase-history', [App\Http\Controllers\PaymentController::class, 'purchase_history'])->name('purchase.history');
Route::get('view-history/{id}', [App\Http\Controllers\PaymentController::class, 'edit_history'])->name('view.history');
Route::post('waveplus/payment', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('paystack');
Route::post('waveplus/transfer', [App\Http\Controllers\PaymentController::class, 'payByTransfer'])->name('transfer');
Route::get('waveplus/payment/callback', [App\Http\Controllers\PaymentController::class, 'handleGatewayCallback']);
Route::get('waveplus/monnify/callback', [App\Http\Controllers\PaymentController::class, 'handleMonnifyCallback']);
Route::get('waveplus/pay-with-monnify', [App\Http\Controllers\PaymentController::class, 'redirectToMonnifyGateway']);
// connect to service provider
Route::post('/waveplus-data', [App\Http\Controllers\EpinsController::class, 'get_epins_data'])->name('waveplus.data');
Route::post('/waveplus-data-2', [App\Http\Controllers\EpinsController::class, 'get_datahub'])->name('waveplus.data_2');
Route::post('/waveplus-smile-data', [App\Http\Controllers\HomeController::class, 'get_vtpass_smile_data'])->name('waveplus.smile-data');
Route::post('/waveplus-smile-pay', [App\Http\Controllers\HomeController::class, 'get_vtpass_smile_pay'])->name('waveplus.smile-pay');
Route::post('/waveplus-spectranet-pay', [App\Http\Controllers\HomeController::class, 'get_epins_spectranet_pay'])->name('waveplus.spectranet-pay');
Route::post('/waveplus-epin', [App\Http\Controllers\HomeController::class, 'get_network_epin'])->name('waveplus.epin');
Route::post('/waveplus-verify-tv', [App\Http\Controllers\PurchaseController::class, 'verify_star_show'])->name('verify.tv');
Route::post('/waveplus-pay-star-show', [App\Http\Controllers\PurchaseController::class, 'pay_star_show'])->name('pay.star-show');
Route::post('/waveplus-pay-showmax', [App\Http\Controllers\PurchaseController::class, 'showmax'])->name('pay.showmax');
Route::post('/waveplus-tv-subscription', [App\Http\Controllers\HomeController::class, 'get_tvs_subscription'])->name('waveplus.tv-subscription');
Route::post('/waveplus-tv-subscription-pay', [App\Http\Controllers\HomeController::class, 'get_tvs_subscription_pay'])->name('waveplus.tv-subscription-pay');

// Countdown timer
Route::get('updata-bonus', [App\Http\Controllers\GlobalSettingsController::class, 'updata_bonus']);

// User Section End 



Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function(){
    Route::get('/dashboard',[AdminController::class,'Dashboard'])->name('admin.dashboard');

    // Create User Section 
    Route::get('/create-user',[AdminController::class,'Create_user'])->name('admin.create-user');
    Route::post('/save-user',[AdminController::class,'Save_user'])->name('admin.save-user');
    Route::get('/get-all-user',[AdminController::class,'Get_user'])->name('admin.get-user');
    Route::get('/get-all-purchase',[AdminController::class,'get_all_purchase'])->name('admin.get-purchase');
    Route::get('/edit-user/{id}',[AdminController::class,'Edit_user'])->name('admin.edit-user');
    Route::post('/update-user/{id}',[AdminController::class,'update_user'])->name('admin.update-user');
    Route::get('/delete-user/{id}',[AdminController::class,'delete_user'])->name('admin.delete-user');
    Route::post('/active-user',[AdminController::class,'active_user'])->name('admin.active-user');
    Route::get('/add-network',[AdminController::class,'network'])->name('admin.add-network');
    Route::post('/save-network',[AdminController::class,'save_network'])->name('admin.save-network');
    Route::get('/get-network',[AdminController::class,'get_network'])->name('admin.get-network');
    Route::get('/edit-network/{id}',[AdminController::class,'edit_network'])->name('admin.edit-network');
    Route::post('/update-network/{id}',[AdminController::class,'update_network'])->name('admin.update-network');
    Route::get('/delete-network/{id}',[AdminController::class,'delete_network'])->name('admin.delete-network');
    Route::get('/discount-charges',[AdminController::class,'discount_and_charges'])->name('admin.discount-and-charge');
    Route::get('/delete-discount/{id}',[AdminController::class,'delete_discount'])->name('admin.delete-discount');
    Route::get('/get-code',[AdminController::class,'get_coupon']);
    Route::post('/save-discount-charges',[AdminController::class,'save_discount_and_charges'])->name('admin.save-charges');
    Route::post('/fund-wallet/{id}',[AdminController::class,'fund_wallet'])->name('admin.fund-wallet');
    Route::get('/get-transfer',[AdminController::class,'transfer'])->name('admin.transfer');
    Route::post('/approve-transfer',[AdminController::class,'approve_transfer']);
    Route::get('/all-transfer',[AdminController::class,'all_transfer'])->name('admin.all-transfer');
    Route::get('/search-all-transfer',[AdminController::class,'search_all_fund'])->name('admin.search-all-transfer');
    Route::get('/search-transfer',[AdminController::class,'search_fund'])->name('admin.search-transfer');
    Route::get('/search-user',[AdminController::class,'search_user'])->name('admin.search-user');
    Route::get('/payment-history',[AdminDepositController::class,'payment_history'])->name('admin.payment-history');
    Route::post('/revert-payment',[AdminDepositController::class,'revert_payment'])->name('admin.revert-payment');
    Route::get('/search-payment',[AdminDepositController::class,'search_payment'])->name('admin.search-history');
    Route::get('/payment-gateway',[AdminDepositController::class,'payment_gataway'])->name('admin.payment-gateway');
    Route::post('/save-payment-api',[AdminDepositController::class,'payment_api'])->name('admin.payment-api');
    Route::post('/save-soundbox',[AdminDepositController::class,'soundbox'])->name('admin.sound-box');
    Route::get('/api-gateway',[AdminDepositController::class,'api_gataway'])->name('admin.api-gateway');
    Route::get('/api-sound-box',[AdminDepositController::class,'sound_box'])->name('admin.sound-boxer');
    Route::get('/profile',[AdminController::class,'admin_profile'])->name('admin.profile');
    Route::post('/save-profile',[AdminController::class,'update_profile'])->name('admin.save-profile');
    // filter section
    Route::post('/get-transaction',[AdminDepositController::class,'get_transaction']);
    Route::post('/send-message',[AdminDepositController::class,'send_message'])->name('admin.send-message');
    Route::get('/get-notification/{id}',[AdminDepositController::class,'get_notification'])->name('admin.get-notification');
    Route::get('/get-email',[AdminSettingController::class,'get_email_smtp'])->name('admin.get-email-smtp');
    Route::post('/save-email-data',[AdminSettingController::class,'save_email_data'])->name('admin.connect-email');
    Route::post('/test-email',[AdminSettingController::class,'test'])->name('admin.test');
    Route::get('/global-setting',[GlobalSettingsController::class,'index'])->name('admin.global-setting');
    Route::post('/save-global-setting',[GlobalSettingsController::class,'save_global_settings'])->name('admin.save-global-settings');

    Route::post('/get-vtpass-service-id',[App\Http\Controllers\PaymentController::class,'pay_api'])->name('admin.pay_api');


    
    
});

