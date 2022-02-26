<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontView\FrontViewController;
use App\Http\Controllers\Auth\AccountActivationController; 
use App\Http\Controllers\Auth\AdminAccessCodeController; 
use App\Http\Controllers\PasswordReset\ResetPasswordContoller; 
use App\Http\Controllers\Dashboard\DashboardController; 
use App\Http\Controllers\UsersController\UserHandlerController; 
use App\Http\Controllers\Notification\NotificationController; 
use App\Http\Controllers\Transaction\TransactionController; 
use App\Http\Controllers\Earning\EarningsController; 
use App\Http\Controllers\Withdrawals\MainBalanceWithdrawal; 
use App\Http\Controllers\Referral\ReferralController; 
use App\Http\Controllers\Plan\PlanController; 
use App\Http\Controllers\News\PostNewsController; 
use App\Http\Controllers\Settings\SettingsController; 
use App\Http\Controllers\WalletSettings\SiteWalletsController; 
use App\Http\Controllers\WalletSettings\UserWalletsController; 
use App\Http\Controllers\Reinvest\ReInvestController; 
use App\Http\Controllers\EmergencyWithdraw\EmergencyCashoutController; 
use App\Http\Controllers\TransferBalance\TransferMoneyToUser; 
use App\Http\Controllers\CryptoPurchase\CryptoPurchaseController; 

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

Route::get('/access-code', function () {
    return view('auth.admin_login');
});

Route::get('/', [FrontViewController::class, 'homePage'])->name('/');
Route::get('about', [FrontViewController::class, 'aboutPage'])->name('about');
Route::get('investors', [FrontViewController::class, 'investorPage'])->name('investors');
Route::get('partners', [FrontViewController::class, 'partnerPage'])->name('partners');
Route::get('faq', [FrontViewController::class, 'faqPage'])->name('faq');
Route::get('contact', [FrontViewController::class, 'contactPage'])->name('contact');
Route::get('affiliate', [FrontViewController::class, 'affiliatePage'])->name('affiliate');
Route::get('services', [FrontViewController::class, 'servicesPage'])->name('services');
Route::get('plan', [FrontViewController::class, 'planPage'])->name('plan');
Route::get('terms-of-use', [FrontViewController::class, 'termOfUsePage'])->name('terms-of-use');

// Route::get('testing', [CoinSwapController::class, 'fectCoins'])->name('testing');

Route::post('subscribe', [FrontViewController::class, 'userSubscribe'])->name('subscribe');
Route::post('contact-mail', [FrontViewController::class, 'contactMailHandler'])->name('contact-mail');

Route::middleware('guest')->group(function() {
    //account activation
    Route::get('/account_activation/{userId?}', [AccountActivationController::class, 'accountActivationPage'])->name('account_activation');
    Route::post('/activate_account/{typeOfCode}/{userId?}', [AccountActivationController::class, 'verifyAndActivateAccount'])->name('activate_account');
    Route::get('/send_account_activation_code/{userId?}/{type_of_code}', [AccountActivationController::class, 'sendActivationCode'])->name('send_account_activation_code');

    //reset user password
    Route::post('/send-reset-password-token', [ResetPasswordContoller::class, 'sendUserTokenToMail'])->name('send-reset-password-token');
    Route::get('/verify-password-token/{userId?}', [ResetPasswordContoller::class, 'verifyPasswordToken'])->name('verify-password-token');
    Route::post('/verify-reset-password-token/{userId?}', [ResetPasswordContoller::class, 'verifyUserSentToken'])->name('verify-reset-password-token');
    Route::get('/set-new-password/{userId?}', [ResetPasswordContoller::class, 'setNewPassword'])->name('set-new-password');
    Route::post('/reset-password/{userId?}', [ResetPasswordContoller::class, 'resetPassword'])->name('reset-password');
});

Route::middleware('auth')->group(function() {
    //admin access code handler
    Route::post('grant-access', [AdminAccessCodeController::class, 'grantAmdinAccess'])->name('grant-access');

    // Route for DashboardController
    //gets
    Route::get('dashboard', [DashboardController::class, 'dashboardPage'])->name('dashboard');

    // Route for UserHandlerController
    //gets
    Route::get('profile', [UserHandlerController::class, 'profilePage'])->name('profile');
    Route::get('edit-profile', [UserHandlerController::class, 'editProfilePage'])->name('edit-profile');
    Route::get('users-account', [UserHandlerController::class, 'usersAccountInterface'])->name('users-account');
    Route::get('view-user-profile/{id?}', [UserHandlerController::class, 'viewUserProfile'])->name('view-user-profile');
    Route::get('edit-user-profile/{id?}', [UserHandlerController::class, 'editUserAccountInterface'])->name('edit-user-profile');
    //post
    Route::post('update-profile/{unique_id?}', [UserHandlerController::class, 'updateProfilePage'])->name('update-profile');
    Route::post('update-profile-image/{unique_id?}', [UserHandlerController::class, 'uploadUserProfileImage'])->name('update-profile-image');
    Route::post('update-password/{unique_id?}', [UserHandlerController::class, 'updateUserPassword'])->name('update-password');
    Route::post('block-user-account/{id?}', [UserHandlerController::class, 'blockUserAccount'])->name('block-user-account');
    Route::post('unblock-user-account/{id?}', [UserHandlerController::class, 'unblockUserAccount'])->name('unblock-user-account');
    Route::post('activate-user-account/{id?}', [UserHandlerController::class, 'activateUserAccount'])->name('activate-user-account');
    Route::post('delete-user-account/{id?}', [UserHandlerController::class, 'deleteUserAccount'])->name('delete-user-account');
    Route::post('top-up-account/{id?}', [UserHandlerController::class, 'topUpUserAccount'])->name('top-up-account');

    // Route for NotificationController
    //gets
    Route::get('all-notification', [NotificationController::class, 'notificationInterface'])->name('all-notification');
    Route::get('single-notification/{id?}', [NotificationController::class, 'singleNotificationInterface'])->name('single-notification');

    // Route for TransactionController
    //gets
    Route::get('invest', [TransactionController::class, 'investPageInterface'])->name('invest');
    Route::get('pending-investment-history', [TransactionController::class, 'pendingInvestmentHistoryInterface'])->name('pending-investment-history');
    Route::get('investment-history', [TransactionController::class, 'investmentHistoryInterface'])->name('investment-history');
    Route::get('payment-invoice/{id?}', [TransactionController::class, 'paymentInvoiceInterface'])->name('payment-invoice');
    Route::get('confrim-investment', [TransactionController::class, 'comfirmInvestmentInterface'])->name('confrim-investment');
    Route::get('view-investment-history', [TransactionController::class, 'adminViewInvestmentMade'])->name('view-investment-history');
    Route::get('interest-adder', [TransactionController::class, 'interestAdderInterface'])->name('interest-adder');
    //posts
    Route::post('create-payment-invoice', [TransactionController::class, 'createTransactionPaymentInvoice'])->name('create-payment-invoice');
    Route::post('upload-payment-proof/{id?}', [TransactionController::class, 'uploadPaymentProof'])->name('upload-payment-proof');
    Route::post('confirm-payment/{id?}', [TransactionController::class, 'confirmUserDeposit'])->name('confirm-payment');
    Route::post('unconfirm-payment/{id?}', [TransactionController::class, 'unconfirmUserDeposit'])->name('unconfirm-payment');
    Route::post('delete-payment/{id?}', [TransactionController::class, 'deleteUserDeposit'])->name('delete-payment');
    Route::post('decline-payment/{id?}', [TransactionController::class, 'declineUserDeposit'])->name('decline-payment');
    Route::post('add-interest/{id?}', [TransactionController::class, 'addInterestManually'])->name('add-interest');

    // Route for EarningsController
    //gets
    Route::get('earnings-page', [EarningsController::class, 'earningsPageInterface'])->name('earnings-page');
    Route::get('earnings-history', [EarningsController::class, 'earningsHistoryPage'])->name('earnings-history');
    //posts
    Route::post('process-earning-payout', [EarningsController::class, 'processPayout'])->name('process-earning-payout');
    Route::post('process-earning-reinvest', [EarningsController::class, 'processReinvest'])->name('process-earning-reinvest');
    Route::post('delete-earning-reinvest', [EarningsController::class, 'deleteUserReinvest'])->name('delete-earning-reinvest');
    

    // Route for MainBalanceWithdrawal
    //gets
    Route::get('funds-withdrawal', [MainBalanceWithdrawal::class, 'withdrawalFundInterface'])->name('funds-withdrawal');
    Route::get('withdrawal-history', [MainBalanceWithdrawal::class, 'withdrawalHistoryInterface'])->name('withdrawal-history');
    Route::get('pay-out', [MainBalanceWithdrawal::class, 'payoutInterface'])->name('pay-out');
    Route::get('pay-out-processor/{id?}', [MainBalanceWithdrawal::class, 'payoutProcessor'])->name('pay-out-processor');
    Route::get('payment-history', [MainBalanceWithdrawal::class, 'paymentHistoryInterface'])->name('payment-history');
    //posts
    Route::post('update-wallet-mail/{id?}', [MainBalanceWithdrawal::class, 'sendMailForWalletUpdate'])->name('update-wallet-mail'); 
    Route::post('create-withdrawal-invoice', [MainBalanceWithdrawal::class, 'createWithdrawalInvoice'])->name('create-withdrawal-invoice');
    Route::post('confirm-payout', [MainBalanceWithdrawal::class, 'comfirmPayment'])->name('confirm-payout');

    // Route for ReferralController
    //gets
    Route::get('my-referrals', [ReferralController::class, 'referralInterface'])->name('my-referrals');
    Route::get('withdraw-comission', [ReferralController::class, 'withdrawComission'])->name('withdraw-comission');
    Route::get('ref-comission-payout', [ReferralController::class, 'reComisiionPayoutInterface'])->name('ref-comission-payout');
    Route::get('ref-comission-payout-processor/{id?}', [ReferralController::class, 'comissionPayoutProcessor'])->name('ref-comission-payout-processor');
    Route::get('ref-comission-payment-history', [ReferralController::class, 'comissionPaymentHistoryInterface'])->name('ref-comission-payment-history');
    //posts
    Route::post('create-comission-invoice', [ReferralController::class, 'createComissionWithdrawInvoice'])->name('create-comission-invoice');
    Route::post('comfirm-comission-payout/{id?}', [ReferralController::class, 'comfirmRefComissionPayment'])->name('comfirm-comission-payout');

    // Route for ReferralController
    //gets
    Route::get('create-plan', [PlanController::class, 'createPlanPageInterface'])->name('create-plan');
    Route::get('view-plan', [PlanController::class, 'viewPlansPageInterface'])->name('view-plan');
    Route::get('edit-plan/{unique_id?}', [PlanController::class, 'editPlansPageInterface'])->name('edit-plan');
    //post
    Route::post('add-plan', [PlanController::class, 'addNewPlan'])->name('add-plan');
    Route::post('update-plan/{unique_id?}', [PlanController::class, 'updatePlan'])->name('update-plan');

    // Route for PostNewsController
    //gets
    Route::get('post-news', [PostNewsController::class, 'postNewsInterface'])->name('post-news');
    Route::post('post-news-request', [PostNewsController::class, 'postNews'])->name('post-news-request');

    // Route for SettingsController
    //gets
    Route::get('settings-page', [SettingsController::class, 'settingPageInterface'])->name('settings-page');
    //posts
    Route::post('update-site-settings/{unique_id?}', [SettingsController::class, 'updateSiteAccountSettings'])->name('update-site-settings');
    Route::post('update-advance-settings/{unique_id?}', [SettingsController::class, 'updateAdvanceSiteSettings'])->name('update-advance-settings');
    Route::post('update-site-logo/{unique_id?}', [SettingsController::class, 'updateSiteLogoSettings'])->name('update-site-logo');

    // Route for SiteWalletsController
    //gets
    Route::get('site-wallet-page', [SiteWalletsController::class, 'addSiteWalletInterface'])->name('site-wallet-page');
    Route::get('view-site-wallet-page', [SiteWalletsController::class, 'returnListOfSystemWallet'])->name('view-site-wallet-page');
    Route::get('edit-site-wallet/{unique_id?}', [SiteWalletsController::class, 'returnSingleSystemWallet'])->name('edit-site-wallet');
    //post
    Route::post('add-site-wallet', [SiteWalletsController::class, 'createSystemWallet'])->name('add-site-wallet');
    Route::post('update-site-wallet/{unique_id?}', [SiteWalletsController::class, 'updateSystemWallet'])->name('update-site-wallet');
    Route::post('delete-site-wallet', [SiteWalletsController::class, 'deleteSystemWallet'])->name('delete-site-wallet');

    // Route for UserWalletsController
    //gets
    Route::get('user-wallet-page', [UserWalletsController::class, 'addUserWalletInterface'])->name('user-wallet-page');
    Route::get('view-user-wallet-page', [UserWalletsController::class, 'returnListOfUserWallet'])->name('view-user-wallet-page');
    Route::get('edit-user-wallet/{unique_id?}', [UserWalletsController::class, 'returnSingleUserWallet'])->name('edit-user-wallet');
    //post
    Route::post('add-user-wallet', [UserWalletsController::class, 'addNewUserWallets'])->name('add-user-wallet');
    Route::post('update-user-wallet/{unique_id?}', [UserWalletsController::class, 'updateUserWallet'])->name('update-user-wallet');
    Route::post('delete-user-wallet', [UserWalletsController::class, 'deleteUserWallet'])->name('delete-user-wallet');

    // Route for ReInvestController
    //gets
    Route::get('reinvest', [ReInvestController::class, 'reinvestInvestInterface'])->name('reinvest');
    Route::get('plan_upgrade/{id?}', [ReInvestController::class, 'planUpgradeInterface'])->name('plan_upgrade');
    Route::get('pending_withdrawals', [ReInvestController::class, 'getAllPendingInvestmentWithdrawal'])->name('pending_withdrawals');
    Route::get('confirm_withdrawals', [ReInvestController::class, 'getAllConfirmInvestmentWithdrawal'])->name('confirm_withdrawals');
    Route::get('confirm-upgraded-invest', [ReInvestController::class, 'confirmUpgradedInvestmentInterface'])->name('confirm-upgraded-invest');
    Route::get('upgraded-invest-history', [ReInvestController::class, 'upgradedInvestmentInterface'])->name('upgraded-invest-history');
    //post
    Route::post('upgrade_plan/{id?}', [ReInvestController::class, 'upgradePlanPament'])->name('upgrade_plan');
    Route::post('upgrade-confirm-payout/{id?}', [ReInvestController::class, 'comfirmUpgradePayment'])->name('upgrade-confirm-payout');

    // Route for EmergencyCashoutController
    //gets
    Route::get('investment-cashout', [EmergencyCashoutController::class, 'withdrawInvestInterface'])->name('investment-cashout');
    Route::get('investment_withdraw/{id?}', [EmergencyCashoutController::class, 'investWithdrawInterface'])->name('investment_withdraw');
    Route::get('pending-emergency-withdrawal', [EmergencyCashoutController::class, 'pendingEmergencyWithdrawalHistory'])->name('pending-emergency-withdrawal');
    Route::get('view-emergency-withdrawal', [EmergencyCashoutController::class, 'emergencyWithdrawalHistory'])->name('view-emergency-withdrawal');
    Route::get('admin-confirm-withdrawals', [EmergencyCashoutController::class, 'comfrimUpgradedInvestmentByAdmin'])->name('admin-confirm-withdrawals');
    Route::get('upgrade-pay-out-processor/{id?}', [EmergencyCashoutController::class, 'upgradePayoutProcessor'])->name('upgrade-pay-out-processor');
    Route::get('upgrade-withdraw-history', [EmergencyCashoutController::class, 'comfrimUpgradedInvestmentHistory'])->name('upgrade-withdraw-history');
    //post
    Route::post('withdraw_invest/{id?}', [EmergencyCashoutController::class, 'placeWithdrawalInvest'])->name('withdraw_invest');
    Route::post('delete-emergency-withdraw', [EmergencyCashoutController::class, 'deleteEmergencyWithdrawal'])->name('delete-emergency-withdraw');

    // Route for TransferBalance
    //gets
    Route::get('transfer-funds-page', [TransferMoneyToUser::class, 'transferFundInterface'])->name('transfer-funds-page');
    Route::get('transfer-funds-history', [TransferMoneyToUser::class, 'getTransferHistoryForSender'])->name('transfer-funds-history');
    Route::get('recieve-funds-history', [TransferMoneyToUser::class, 'getTransferHistoryForReciever'])->name('recieve-funds-history');
    //posts
    Route::post('transfer-funds', [TransferMoneyToUser::class, 'transferFundsToUser'])->name('transfer-funds');
    Route::post('delete-funds', [TransferMoneyToUser::class, 'deleteTransferRequest'])->name('delete-funds');

    // Route for CryptoPurchaseController
    //gets
    Route::get('crypto-purchase', [CryptoPurchaseController::class, 'cryptoPurchaseInterface'])->name('crypto-purchase');  
    Route::get('crypto-purchase-history', [CryptoPurchaseController::class, 'cryptoPurchaseHistoryInterface'])->name('crypto-purchase-history');  
    Route::get('process-purchase/{id?}', [CryptoPurchaseController::class, 'processCryptoPurchaseInterface'])->name('process-purchase');  
    Route::get('comfirm-purchase/{id?}', [CryptoPurchaseController::class, 'comfirmCryptoPurchaseInterface'])->name('comfirm-purchase');
    Route::get('admin-comfirm-purchase', [CryptoPurchaseController::class, 'adminComfirmCryptoPurchaseInterface'])->name('admin-comfirm-purchase');  
    Route::get('admin-purchase-history', [CryptoPurchaseController::class, 'adminViewInvestmentMade'])->name('admin-purchase-history');
    Route::get('purchase-payout', [CryptoPurchaseController::class, 'cryptoPurchasePayoutInterface'])->name('purchase-payout'); 
    Route::get('purchase-payout-history', [CryptoPurchaseController::class, 'cryptoPurchasePayoutHistoryInterface'])->name('purchase-payout-history'); 
    //post
    Route::post('process-purchase-request/{id?}', [CryptoPurchaseController::class, 'processPurchase'])->name('process-purchase-request'); 
    Route::post('upload-proof/{id?}', [CryptoPurchaseController::class, 'uploadPaymentProof'])->name('upload-proof'); 
    Route::post('admin-confirm-purchase/{id?}', [CryptoPurchaseController::class, 'confirmUserDeposit'])->name('admin-confirm-purchase');
    Route::post('admin-unconfirm-purchase/{id?}', [CryptoPurchaseController::class, 'unconfirmUserDeposit'])->name('admin-unconfirm-purchase');
    Route::post('decline-purchase', [CryptoPurchaseController::class, 'declineUserDeposit'])->name('decline-purchase');
    Route::post('delete-purchase', [CryptoPurchaseController::class, 'deleteUserDeposit'])->name('delete-purchase');
    Route::post('payout', [CryptoPurchaseController::class, 'payoutToUser'])->name('payout');
    

});

require __DIR__.'/auth.php';
