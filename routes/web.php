<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarrierController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\FileUploadController;

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
Route::get('/', [PageController::class, 'toLandingPage'])->name('frontend.home');

Route::group(['middleware' => ['guest']], function() {
    /**
     * Frontend Pages Routes
     */
    Route::controller(PageController::class)->group(function () {
        // Route::get('/', 'toLandingPage')->name('frontend.home');
        Route::get('/services', 'toServicesPage')->name('frontend.service');
        Route::get('/about', 'toAboutPage')->name('frontend.about');
        Route::get('/contact', 'toContactPage')->name('frontend.contact');
        Route::get('/privacy', 'toPrivacyPage')->name('frontend.privacy');
        Route::get('/login', 'toLoginPage')->name('login.show');
        Route::get('/login/customer', 'toLoginCustomerPage')->name('login.customer');
        Route::get('/login/carrier', 'toLoginCarrierPage')->name('login.carrier');
        Route::get('/login/driver', 'toLoginDriverPage')->name('login.driver');
    });

    /**
     * Quote Request Routes
     */
    Route::controller(QuoteController::class)->group(function () {
        Route::get('/quote/request', 'quoteCreate')->name('quote.request');
        Route::get('/quote/getInfo', 'quoteGetInfo');
    });

    /**
     * Contact Message Routes
     */
    Route::controller(MessageController::class)->group(function () {
        Route::get('/contact/message', 'contactMessage')->name('contact.message');
    });

    /**
     * Authentication Routes
     */
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login', 'login')->name('login.perform');
        Route::post('/login/customer', 'loginCustomer')->name('login.customer.perform');
        Route::post('/login/carrier', 'loginCarrier')->name('login.carrier.perform');
        Route::post('/login/driver', 'loginDriver')->name('login.driver.perform');
    });

    /**
     * Verify Customer Route
     */
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer/verify/{token}', 'customerVerify')->name('customer.verify');
    });
});

Route::group(['middleware' => ['user']], function() {
    /**
     * APIs
     */
    Route::controller(UserController::class)->group(function () {
        // API
        Route::get('/users/{id}', 'getUser');

        // Redirector
        Route::post('/user/save', 'userSave')->name('user.save');
        Route::get('/user/delete', 'userDelete')->name('user.delete');

        // Password
        Route::post('/user/password', 'passUser')->name('user.password');
    });

    // Route::controller(CarrierController::class)->group(function () {
    //     Route::get('/carriers/all', 'getCarriers');
    //     Route::get('/carriers/{id}', 'getCarrier');
    //     Route::post('/carriers/save', 'carrierSave');
    //     Route::get('/carrier/delete/{id}', 'carrierDelete');
    // });

    /**
     * Customer Quote Routes
     */
    Route::controller(QuoteController::class)->group(function () {
        //Route::get('/quotes/requested/all', 'quoteGetRequestedAll');            // Get All Requested Quotes
        // Route::get('/quotes/checked/all', 'quoteGetCheckedAll');
        // Route::get('/quotes/rejected/all', 'quoteGetRejectedAll');
        // Route::get('/quotes/approved/all', 'quoteGetApprovedAll');
        // Route::get('/quotes/confirmed/all', 'quoteGetConfirmedAll');
        // Route::get('/quotes/completed/all', 'quoteGetCompletedAll');
        // Route::get('/quotes/submitted/all', 'quoteGetSubmittedAll');
        // Route::get('/quotes/published/all', 'quoteGetPublishedAll');
        // Route::get('/quotes/ongoing/all', 'quoteGetOnGoingAll');
        // Route::get('/quotes/completed/all', 'quoteGetCompletedAll');

        Route::post('/quote/approved/create', 'quoteApprovedCreate')->name('manager.quote.approve');            // Status 1 => 2, Quote Approve
        Route::post('/quote/approved/recreate', 'quoteApprovedRecreate')->name('manager.quote.reapprove');      // Status 4 => 2, Quote Re-create

        // Route::get('/quotes/requested/{id}', 'quoteGetRequested');
        // Route::get('/quotes/approved/{id}', 'quoteGetApproved');
        // Route::post('/quote/comp/create', 'quoteCompCreate');
        // Route::post('/quote/comp/check', 'quoteCompCheck');

        // Route::get('/quotes/submitted/carrier', 'quoteGetSubmittedCarrier');
        // Route::get('/quotes/published/carrier', 'quoteGetPublishedCarrier');
        // Route::get('/quotes/completed/carrier', 'quoteGetCompletedCarrier');

        Route::get('/quote/get/review/{id}', 'quoteGetReview');
    });

    /**
     * Administrator Routes
     */
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return redirect('/admin/users');
        });

        Route::controller(AdminController::class)->group(function () {
            Route::get('/users', 'toAdminUsers')->name('admin.users');
        });
    })->middleware('admin');

    /**
     * Get Map Track Points
     */
    Route::controller(TrackController::class)->group(function () {
        Route::get('/getpoints/{id}', 'getTrack')->name('api.getpoints');
    });

    /**
     * File Upload
     */
    Route::controller(FileUploadController::class)->group(function () {
        Route::post('/uploads/process', 'process')->name('uploads.process');
        Route::delete('/uploads/revert', 'revert')->name('uploads.revert');
    });

    /**
     * PDF Publish
     */
    Route::controller(CarrierController::class)->group(function () {
        Route::get('/rateconf/publish/{id}', 'confPublish')->name('carrier.rateconf.publish');
        Route::get('/rateconf/view/{id}', 'confView')->name('carrier.rateconf.view');
    });


    /**
     * Logout Routes
     */
    Route::controller(AuthController::class)->group(function () {
        Route::get('/logout', 'logout')->name('logout.perform');
    });
});

Route::group(['middleware' => ['manager']], function() {
    /**
     * Manager Routes
     */
    Route::prefix('manager')->group(function () {
        Route::get('/', function () {
            return redirect('/manager/dashboard');
        });

        Route::controller(ManagerController::class)->group(function () {
            // Dashboard
            Route::get('/dashboard', 'toManagerDashboard')->name('manager.dashboard');
            Route::get('/dashboard/get_monthly_data', 'getManagerMonthlyData');
            Route::get('/dashboard/get_yearly_data', 'getManagerYearlyData');
            // Route::get('/dashboard', 'toManagerDashboard')->name('manager.dashboard');

            // Task Quotes
            Route::get('/quotes/requested', 'toManagerRequestedQuotes')->name('manager.quotes.requested');          // Status: 1, Requested
            Route::get('/quotes/checked', 'toManagerCheckedQuotes')->name('manager.quotes.checked');                // Status: 2, Checked
            Route::get('/quotes/approved', 'toManagerApprovedQuotes')->name('manager.quotes.approved');             // Status: 3, Approved
            Route::get('/quotes/rejected', 'toManagerRejectedQuotes')->name('manager.quotes.rejected');             // Status: 4, Rejected
            Route::get('/quotes/confirmed', 'toManagerConfirmedQuotes')->name('manager.quotes.confirmed');          // Status: 5, Confirmed
            Route::get('/quotes/submitted', 'toManagerSubmittedQuotes')->name('manager.quotes.submitted');          // Status: 6, Submitted
            Route::get('/quotes/published', 'toManagerPublishedQuotes')->name('manager.quotes.published');          // Status: 7, Published
            Route::get('/quotes/ongoing', 'toManagerOnGoingQuotes')->name('manager.quotes.ongoing');                // Status: 8-11, On going
            Route::get('/quotes/completed', 'toManagerCompletedQuotes')->name('manager.quotes.completed');          // Status: 12, Completed

            Route::post('/quote/update', 'quoteUpdate')->name('manager.quote.update');                              // Quote Update

            Route::get('/quote/details/{id}', 'toManagerQuoteDetails')->name('manager.quote.details');              // To Quote Details Page
            Route::get('/quote/details/{id}/edit', 'toManagerQuoteDetailsEdit')->name('manager.quote.edit');        // To Quote Details Page
            Route::get('/carrier/get/by_mc_number', 'getCarrierMC')->name('manager.carrier.mc');                    // Quote details with MC Carrier
            Route::get('/carrier/get/by_dot_number', 'getCarrierDOT')->name('manager.carrier.dot');                 // Quote details with DOT Carrier

            Route::post('/quotes/confirm', 'quoteCompSubmit')->name('manager.quote.confirm');                       // Confirm Quote: Status 3 => 5
            Route::get('/quotes/confirm/{id}', 'quoteCompConfirm')->name('manager.carrier.confirm');            // Confirm Quote: Status 3 => 5
            // Route::post('/quotes/confirm', 'toManagerConfirmQuote')->name('manager.quote.confirm');                  // Confirm Quote: Status 3 => 5
            //Route::get('/quotes/confirm/cancel/{id}', 'toManagerConfirmCancelQuote')->name('manager.quote.confirm.cancel');  // Confirm Quote Cancel: Status 5 => 3
            Route::post('/quote/comp/submit', 'quoteCompSubmit')->name('manager.quote.submit');                     // Submit Quote: Status 5 => 6

            // Display All Quotes
            Route::get('/quotes/all', 'toManagerQuotesAll')->name('manager.all.quotes');

            // Carriers
            Route::get('/carriers/all', 'toManagerCarrier')->name('manager.carriers.all');

            // Completed
            Route::get('/invoices', 'toManagerInvoices')->name('manager.quote.invoices');
            Route::get('/invoice/customer/{id}', 'toManagerInvoiceCustomer')->name('manager.invoice.customer');
            Route::get('/invoice/carrier/{id}', 'toManagerInvoiceCarrier')->name('manager.invoice.carrier');
        });
    });
});

Route::group(['middleware' => ['customer']], function() {
    /**
     * Customer Routes
     */
    Route::prefix('customer')->group(function () {
        Route::controller(CustomerController::class)->group(function () {
            Route::get('/welcome', 'customerWelcome')->name('customer.welcome');
            // Route::get('/quote/check/{id}', 'customerQuoteCheck')->name('customer.quotecheck');
            Route::post('/quote/approve', 'quoteApprove')->name('customer.quote.approve');
            Route::post('/quote/reject', 'quoteReject')->name('customer.quote.reject');
            Route::post('/quote/delete', 'quoteDelete')->name('customer.quote.delete');
            Route::post('/quote/review', 'quoteReview')->name('customer.quote.review');
            // Route::get('/status/{id}', 'customerQuoteStatus')->name('customer.quote.status');
            Route::get('/stripe', 'customerStripe')->name('customer.stripe');

            Route::get('/invoice/publish', 'invoicePublish')->name('customer.invoice.publish');
            Route::get('/invoice/view', 'invoiceView')->name('customer.invoice.view');
        });

        /**
         * Stripe Payment
         */
        Route::controller(StripeController::class)->group(function(){
            Route::post('/stripe', 'stripePost')->name('customer.stripe.pay');
        });

        /**
         * Paypal Payment
         */
        Route::controller(PaypalController::class)->group(function(){
            // Route::get('/paypal', [PaypalController::class, 'form'])->name('paypal.home');
            Route::post('/checkout/payment/{order}/paypal', 'checkout')->name('checkout.payment.paypal');
            Route::get('/paypal/checkout/{order}/completed', 'completed')->name('paypal.checkout.completed');
            Route::get('/paypal/checkout/{order}/cancelled', 'cancelled')->name('paypal.checkout.cancelled');
            Route::post('/webhook/paypal/{order?}/{env?}', 'webhook')->name('webhook.paypal.ipn');
        });
    });
});


Route::group(['middleware' => ['carrier']], function() {
    /**
     * Carrier Routes
     */
    Route::prefix('carrier')->group(function () {
        Route::get('/', function () {
            return redirect('/carrier/welcome');
        });
        Route::controller(CarrierController::class)->group(function () {
            Route::get('/welcome', 'toCarrierWelcome')->name('carrier.welcome');
            Route::get('/step/2', 'toCarrierStep2')->name('carrier.step.2');
            Route::get('/step/3', 'toCarrierStep3')->name('carrier.step.3');
            Route::post('/step/4', 'toCarrierStep4')->name('carrier.step.4');
            Route::post('/step/5', 'toCarrierStep5')->name('carrier.step.5');
            Route::get('/step/back/{state}', 'toCarrierStepBack')->name('carrier.step.back');



            Route::post('/quote/reject', 'toCarrierQuoteReject')->name('carrier.quote.reject');




            Route::get('/quotes', 'toCarrierQuotes')->name('carrier.quotes');
            Route::get('/quotes/published', 'toCarrierPublishedQuotes')->name('carrier.quotes.published');
            Route::get('/quotes/completed', 'toCarrierCompletedQuotes')->name('carrier.quotes.completed');
            Route::get('/quotes/details/{id}', 'toCarrierQuoteDetails')->name('carrier.quote.details');
            Route::post('/quote/publish', 'quotePublish')->name('carrier.quote.publish');

        });
    });
});


Route::group(['middleware' => ['driver']], function() {
    /**
     * Driver Routes
     */
    Route::prefix('driver')->group(function () {
        Route::get('/', function () {
            return redirect('/driver/welcome');
        });
        Route::controller(DriverController::class)->group(function () {
            Route::get('/welcome', 'toDriverWelcome')->name('driver.welcome');
            Route::get('/status/active', 'driverActive')->name('driver.status.active');
            Route::get('/status/goto8', 'driverStatus8')->name('driver.status.8');
            Route::get('/status/goto9', 'driverStatus9')->name('driver.status.9');
            Route::get('/status/goto10', 'driverStatus10')->name('driver.status.10');
            Route::get('/status/goto11', 'driverStatus11')->name('driver.status.11');
            Route::post('/status/goto12', 'driverStatus12')->name('driver.status.12');
            Route::get('/status/back', 'driverStatusBack')->name('driver.status.back');


            Route::post('/upload/bol', 'uploadBol')->name('driver.upload.bol');
            Route::get('/status/set/{id}/{status}', 'statusSet')->name('driver.status.set');

            // Location API
            Route::post('/api/location/send', 'sendLocation')->name('api.driver.location');
        });
    });
});
