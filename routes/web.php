<?php

// use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\AuthPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubApplicationController;
use App\Http\Controllers\ApplicationMotherController;
use App\Http\Controllers\PropertyCardController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\LegalSearchController;
use App\Http\Controllers\ResidentialController;
use App\Http\Controllers\eRegistryController;
use App\Http\Controllers\DeedsController;
use App\Http\Controllers\ConveyanceController;
use App\Http\Controllers\SaveMainAppController;
use App\Http\Controllers\FileIndexingController;
use App\Http\Controllers\FileScanningController;
use App\Http\Controllers\ScannerController;
use App\Http\Controllers\PageTypingController;

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

require __DIR__ . '/auth.php';

Route::get('/', [HomeController::class, 'index'])->middleware(
    [

        'XSS',
    ]
);
Route::get('home', [HomeController::class, 'index'])->name('home')->middleware(
    [

        'XSS',
    ]
);
Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware(
    [

        'XSS',
    ]
);

//-------------------------------User-------------------------------------------

Route::resource('users', UserController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);


//-------------------------------Subscription-------------------------------------------



Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ],
    function () {

        Route::resource('subscriptions', SubscriptionController::class);
        Route::get('coupons/history', [CouponController::class, 'history'])->name('coupons.history');
        Route::delete('coupons/history/{id}/destroy', [CouponController::class, 'historyDestroy'])->name('coupons.history.destroy');
        Route::get('coupons/apply', [CouponController::class, 'apply'])->name('coupons.apply');
        Route::resource('coupons', CouponController::class);
        Route::get('subscription/transaction', [SubscriptionController::class, 'transaction'])->name('subscription.transaction');
    Route::post('subscription/{id}/{user_id}/manual-assign-package', [PaymentController::class, 'subscriptionManualAssignPackage'])->name('subscription.manual_assign_package');

    }
);

//-------------------------------Subscription Payment-------------------------------------------

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ],
    function () {

        Route::post('subscription/{id}/stripe/payment', [SubscriptionController::class, 'stripePayment'])->name('subscription.stripe.payment');
    }
);
//-------------------------------Settings-------------------------------------------
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ],
    function () {
        Route::get('settings', [SettingController::class,'index'])->name('setting.index');

        Route::post('settings/account', [SettingController::class,'accountData'])->name('setting.account');
        Route::delete('settings/account/delete', [SettingController::class,'accountDelete'])->name('setting.account.delete');
        Route::post('settings/password', [SettingController::class,'passwordData'])->name('setting.password');
        Route::post('settings/general', [SettingController::class,'generalData'])->name('setting.general');
        Route::post('settings/smtp', [SettingController::class,'smtpData'])->name('setting.smtp');
        Route::get('settings/smtp-test', [SettingController::class, 'smtpTest'])->name('setting.smtp.test');
        Route::post('settings/smtp-test', [SettingController::class, 'smtpTestMailSend'])->name('setting.smtp.testing');
        Route::post('settings/payment', [SettingController::class,'paymentData'])->name('setting.payment');
        Route::post('settings/site-seo', [SettingController::class,'siteSEOData'])->name('setting.site.seo');
        Route::post('settings/google-recaptcha', [SettingController::class,'googleRecaptchaData'])->name('setting.google.recaptcha');
        Route::post('settings/company', [SettingController::class,'companyData'])->name('setting.company');
        Route::post('settings/2fa', [SettingController::class, 'twofaEnable'])->name('setting.twofa.enable');

        Route::get('footer-setting', [SettingController::class, 'footerSetting'])->name('footerSetting');
        Route::post('settings/footer', [SettingController::class,'footerData'])->name('setting.footer');

        Route::get('language/{lang}', [SettingController::class,'lanquageChange'])->name('language.change');
        Route::post('theme/settings', [SettingController::class,'themeSettings'])->name('theme.settings');
    }
);

Route::group(
    [
        'middleware' => [
            'auth',
        ],
    ],
    function () {
        Route::post('settings/payment', [SettingController::class, 'paymentData'])->name('setting.payment');
    }
);


//-------------------------------Role & Permissions-------------------------------------------
Route::resource('permission', PermissionController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('role', RoleController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);




//-------------------------------Note-------------------------------------------
Route::resource('note', NoticeBoardController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Contact-------------------------------------------
Route::resource('contact', ContactController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);



//-------------------------------logged History-------------------------------------------

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ],
    function () {

        Route::get('logged/history', [UserController::class, 'loggedHistory'])->name('logged.history');
        Route::get('logged/{id}/history/show', [UserController::class, 'loggedHistoryShow'])->name('logged.history.show');
        Route::delete('logged/{id}/history', [UserController::class, 'loggedHistoryDestroy'])->name('logged.history.destroy');
    }
);



//-------------------------------Document-------------------------------------------

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ],
    function () {
        Route::get('document/history', [DocumentController::class, 'history'])->name('document.history');
        Route::resource('document', DocumentController::class);
        Route::get('my-document', [DocumentController::class, 'myDocument'])->name('document.my-document');
        Route::get('document/{id}/comment', [DocumentController::class, 'comment'])->name('document.comment');
        Route::post('document/{id}/comment', [DocumentController::class, 'commentData'])->name('document.comment');
        Route::get('document/{id}/reminder', [DocumentController::class, 'reminder'])->name('document.reminder');
        Route::get('document/{id}/add-reminder', [DocumentController::class, 'addReminder'])->name('document.add.reminder');
        Route::get('document/{id}/version-history', [DocumentController::class, 'versionHistory'])->name('document.version.history');
        Route::post('document/{id}/version-history', [DocumentController::class, 'newVersion'])->name('document.new.version');
        Route::get('document/{id}/share', [DocumentController::class, 'shareDocument'])->name('document.share');
        Route::post('document/{id}/share', [DocumentController::class, 'shareDocumentData'])->name('document.share');
        Route::get('document/{id}/add-share', [DocumentController::class, 'addshareDocumentData'])->name('document.add.share');
        Route::delete('document/{id}/share/destroy', [DocumentController::class, 'shareDocumentDelete'])->name('document.share.destroy');
        Route::get('document/{id}/send-email', [DocumentController::class, 'sendEmail'])->name('document.send.email');
        Route::post('document/{id}/send-email', [DocumentController::class, 'sendEmailData'])->name('document.send.email');
        Route::get('logged/history', [DocumentController::class, 'loggedHistory'])->name('logged.history');
        Route::get('logged/{id}/history/show', [DocumentController::class, 'loggedHistoryShow'])->name('logged.history.show');
        Route::delete('logged/{id}/history', [DocumentController::class, 'loggedHistoryDestroy'])->name('logged.history.destroy');
    }
);

//-------------------------------Reminder-------------------------------------------

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ],
    function () {
        Route::resource('reminder', ReminderController::class);
        Route::get('my-reminder', [ReminderController::class, 'myReminder'])->name('my-reminder');
    }
);
//-------------------------------Category, Sub Category & Tag-------------------------------------------

Route::get('category/{id}/sub-category', [CategoryController::class, 'getSubcategory'])->name('category.sub-category');
Route::resource('category', CategoryController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('sub-category', SubCategoryController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('tag', TagController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);


//-------------------------------Plan Payment-------------------------------------------

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ],
    function () {

        Route::post('subscription/{id}/bank-transfer', [PaymentController::class, 'subscriptionBankTransfer'])->name('subscription.bank.transfer');
        Route::get('subscription/{id}/bank-transfer/action/{status}', [PaymentController::class, 'subscriptionBankTransferAction'])->name('subscription.bank.transfer.action');
        Route::post('subscription/{id}/paypal', [PaymentController::class, 'subscriptionPaypal'])->name('subscription.paypal');
        Route::get('subscription/{id}/paypal/{status}', [PaymentController::class, 'subscriptionPaypalStatus'])->name('subscription.paypal.status');
        Route::get('subscription/flutterwave/{sid}/{tx_ref}', [PaymentController::class, 'subscriptionFlutterwave'])->name('subscription.flutterwave');
    }
);

//-------------------------------Notification-------------------------------------------
Route::resource('notification', NotificationController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('email-verification/{token}', [VerifyEmailController::class, 'verifyEmail'])->name('email-verification')->middleware(
    [
        'XSS',

    ]
);

//-------------------------------FAQ-------------------------------------------
Route::resource('FAQ', FAQController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Home Page-------------------------------------------
Route::resource('homepage', HomePageController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);
//-------------------------------FAQ-------------------------------------------
Route::resource('pages', PageController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------FAQ-------------------------------------------
Route::resource('authPage', AuthPageController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('page/{slug}', [PageController::class, 'page'])->name('page');
//-------------------------------FAQ-------------------------------------------

use App\Http\Controllers\InstrumentController;

Route::get('/instruments', [InstrumentController::class, 'index'])->name('instruments.index');
Route::get('/instruments/powerOfAttorney', [InstrumentController::class, 'powerOfAttorney'])->name('instruments.powerOfAttorney');
Route::get('/instruments/DeedOfMortgage', [InstrumentController::class, 'DeedOfMortgage'])->name('instruments.DeedOfMortgage');

Route::get('/instruments/Coroi', [InstrumentController::class, 'Coroi'])->name('instruments.Coroi');



Route::post('/instruments', [InstrumentController::class, 'store'])->name('instruments.store');
Route::get('/instruments/{id}/edit', [InstrumentController::class, 'edit']);
Route::post('/instruments/{id}', [InstrumentController::class, 'update'])->name('instruments.update');
Route::delete('/instruments/{id}', [InstrumentController::class, 'destroy']);

// Application Mother routes
Route::get('/sectionaltitling', [ApplicationMotherController::class, 'index'])->name('sectionaltitling.index');


Route::get('/sectionaltitling/landuse', [ApplicationMotherController::class, 'landuse'])->name('sectionaltitling.landuse'); 

Route::get('/sectionaltitling/create', [ApplicationMotherController::class, 'create'])->name('sectionaltitling.create');

Route::get('/sectionaltitling/sub_application', [ApplicationMotherController::class, 'subApplication'])->name('sectionaltitling.sub_application');

Route:: get('/sectionaltitling/generate_bill/{id?}', [ApplicationMotherController::class, 'GenerateBill'])->name('sectionaltitling.generate_bill');
 
Route::get('/sectionaltitling/AcceptLetter', [ApplicationMotherController::class, 'AcceptLetter'])
    ->name('sectionaltitling.AcceptLetter');

Route::get('/sectionaltitling/sub_applications', [ApplicationMotherController::class, 'Subapplications'])->name('sectionaltitling.sub_applications');
Route::get('/sectionaltitling/sub_application', [ApplicationMotherController::class, 'Subapplication'])->name('sectionaltitling.sub_application');

// Add this new route for storing sub-applications
Route::post('/sectionaltitling/storesub', [ApplicationMotherController::class, 'storeSub'])->name('sectionaltitling.storesub');

Route::post('/sectionaltitling', [ApplicationMotherController::class, 'store'])->name('sectionaltitling.store');
Route::get('/sectionaltitling/{id}/edit', [ApplicationMotherController::class, 'edit']);


Route::post('sectionaltitling/approve-sub', [ApplicationMotherController::class, 'approveSubApplication'])
    ->name('sectionaltitling.approveSubApplication');

Route::post('sectionaltitling/decline-sub', [ApplicationMotherController::class, 'declineSubApplication'])
    ->name('sectionaltitling.declineSubApplication');

Route::post('sectionaltitling/decision-sub', [ApplicationMotherController::class, 'decisionSubApplication'])
    ->name('sectionaltitling.decisionSubApplication');

Route::post('sectionaltitling/decision-mother', [ApplicationMotherController::class, 'decisionMotherApplication'])
    ->name('sectionaltitling.decisionMotherApplication');

// Sectional Titling routes
Route::post('/sectional-titling/planning-recommendation', [App\Http\Controllers\ApplicationMotherController::class, 'planningRecommendation'])->name('sectionaltitling.planningRecommendation');
Route::post('/sectional-titling/department-approval', [App\Http\Controllers\ApplicationMotherController::class, 'departmentApproval'])->name('sectionaltitling.departmentApproval');

Route::get('sectionaltitling/getFinancialData', [App\Http\Controllers\ApplicationMotherController::class, 'getFinancialData'])->name('sectionaltitling.getFinancialData');

// Add these routes in the appropriate section of your web.php file
Route::get('sectionaltitling/get-billing-data/{id}', [App\Http\Controllers\ApplicationMotherController::class, 'getBillingData'])->name('sectionaltitling.getBillingData');

Route::get('sectionaltitling/get-billing-data2/{id}', [App\Http\Controllers\ApplicationMotherController::class, 'getBillingData2'])->name('sectionaltitling.getBillingData2');
Route::post('sectionaltitling/save-billing-data', [App\Http\Controllers\ApplicationMotherController::class, 'saveBillingData'])->name('sectionaltitling.saveBillingData');

Route::get('sectionaltitling/viewrecorddetail',  [App\Http\Controllers\ApplicationMotherController::class, 'Veiwrecords'])->name('sectionaltitling.viewrecorddetail');


// Add this route in the appropriate section
Route::post('/sectionaltitling/save-eregistry', [eRegistryController::class, 'saveERegistry'])->name('sectionaltitling.saveERegistry');

Route::get('/propertycard', [PropertyCardController::class, 'index'])->name('propertycard.index');
Route::get('/propertycard/create', [PropertyCardController::class, 'create'])->name('propertycard.create');
Route::get('/propertycard/capture', [PropertyCardController::class, 'capture'])->name('propertycard.capture');
Route::post('/propertycard', [PropertyCardController::class, 'store'])->name('propertycard.store');
Route::get('/propertycard/data', [PropertyCardController::class, 'getData'])->name('propertycard.data');
Route::post('/propertycard/search', [PropertyCardController::class, 'search'])->name('propertycard.search');
Route::post('/propertycard/save-record', [PropertyCardController::class, 'savePropertyRecord'])->name('propertycard.saveRecord');
Route::post('/propertycard/navigate', [PropertyCardController::class, 'navigateRecord'])->name('propertycard.navigate');

// Add this fallback route for propertycard data
Route::get('/propertycard/data-fallback', function() {
    $sampleData = [
        [
            'id' => 1,
            'mlsfNo' => 'MLSF-001',
            'kangisFileNo' => 'KF-001',
            'currentAllottee' => 'Sample Allottee',
            'landUse' => 'Residential',
            'districtName' => 'Sample District',
        ],
        [
            'id' => 2,
            'mlsfNo' => 'MLSF-002',
            'kangisFileNo' => 'KF-002',
            'currentAllottee' => 'Another Allottee',
            'landUse' => 'Commercial',
            'districtName' => 'Another District',
        ]
    ];
    
    return response()->json([
        'draw' => 1,
        'recordsTotal' => count($sampleData),
        'recordsFiltered' => count($sampleData),
        'data' => $sampleData
    ]);
})->name('propertycard.data.fallback');

Route::get('/legal_search', [LegalSearchController::class, 'index'])->name('legal_search.index');
Route::get('/legal_search/report', [LegalSearchController::class, 'report'])->name('legal_search.report');
//Route::post('/legal_search', [LegalSearchController::class, 'store'])->name('legal_search.store');
Route::get('/legal_search/legal_search_report', [LegalSearchController::class, 'legal_search_report'])->name('legal_search.legal_search_report');
//sectionaltitling/residential
Route::get('sectionaltitling/residential', [ResidentialController::class, 'index'])->name('sectionaltitling.residential.index');
Route::get('sectionaltitling/residential/create', [ResidentialController::class, 'create'])->name('sectionaltitling.residential.create');
Route::get('sectionaltitling/residential/sub_application', [ResidentialController::class, 'subApplication'])->name('sectionaltitling.residential.sub_application');
Route::get('sectionaltitling/residential/sub_applications', [ResidentialController::class, 'subApplication'])->name('sectionaltitling.residential.sub_applications');
Route::post('sectionaltitling/residential', [ResidentialController::class, 'storeResMotherApp'])->name('sectionaltitling.residential.store');

Route::post('/deeds/insert', [DeedsController::class, 'insert'])->name('deeds.insert');
Route::get('/deeds/getdeedsdublicate', [DeedsController::class, 'getDeedsDublicate'])->name('deeds.getDeedsDublicate');

Route::post('/conveyance/update', [ConveyanceController::class, 'updateConveyance'])->name('conveyance.update');

Route::get('/sectionaltitling/generate-bill/{id?}', [SubApplicationController::class, 'GenerateBill'])->name('sectionaltitling.generate_bill');
Route::get('/sectionaltitling/generate-bill', [SubApplicationController::class, 'GenerateBill'])->name('sectionaltitling.generate_bill_no_id');

Route::get('/subapplications/{id}', [SubApplicationController::class, 'getSubApplication']);


Route::get('sectionaltitling/viewrecorddetail_sub/{id?}',  [SubApplicationController::class, 'viewrecorddetail_sub'])->name('sectionaltitling.viewrecorddetail_sub');

Route::get('/sectionaltitling/get-conveyance-data/{id}', [App\Http\Controllers\ConveyanceController::class, 'getConveyanceData'])->name('conveyance.getData');

// Fix the route definition - we have a duplicate route
Route::post('/sectionaltitling/store-mother-app', [SaveMainAppController::class, 'storeMotherApp'])
    ->name('sectionaltitling.storeMotherApp');

// Remove or comment out the duplicate route
// Route::post('/sectionaltitling', [SaveMainAppController::class, 'storeMotherApp'])->name('sectionaltitling.storeMotherApp');

// Add a fallback route for debugging
Route::fallback(function () {
    return response('Route not found. Please check the URL.', 404);
});

Route:: get('/sectionaltitling/generate_bill_sub/{id?}', [ApplicationMotherController::class, 'GenerateBill2'])->name('sectionaltitling.generate_bill_sub');
 

Route::get('/propertycard/record-details', [App\Http\Controllers\PropertyCardController::class, 'getRecordDetails'])->name('propertycard.getRecordDetails');


// FileIndexing routes

Route::get('/fileindex/index', [App\Http\Controllers\FileIndexingController::class, 'index'])->name('fileindex.index');

Route::get('/fileindex/create', [App\Http\Controllers\FileIndexingController::class, 'create'])->name('fileindex.create');

Route::impersonate();


Route::resource('fileindex', 'App\Http\Controllers\FileIndexingController');
Route::post('fileindex/save-cofo', 'App\Http\Controllers\FileIndexingController@saveCofO')->name('fileindex.save-cofo');
 
Route::post('fileindex/save-transaction', [FileIndexingController::class, 'savePropertyTransaction'])->name('fileindex.save-transaction');
 


// File Scanning

Route::get('/filescanning/index', [FileScanningController::class, 'index'])->name('filescanning.index');
Route::get('/filescanning/create', [FileScanningController::class, 'create'])->name('filescanning.create');

Route::get('/scanners', [ScannerController::class, 'getScanners'])->name('scanners.list');
Route::post('/scan', [ScannerController::class, 'scan'])->name('scanners.scan');
Route::post('/webcam-capture', [ScannerController::class, 'captureFromWebcam'])->name('scanners.webcam');

Route::get('/pagetyping/index', [PageTypingController::class, 'index'])->name('pagetyping.index');
Route::get('/pagetyping/create', [PageTypingController::class, 'create'])->name('pagetyping.create');
Route::post('/pagetyping/store', [PageTypingController::class, 'store'])->name('pagetyping.store');

Route::get('/sectionaltitling', [\App\Http\Controllers\SectionalTitlingController::class, 'index'])->name('sectionaltitling.index');
Route::get('/sectionaltitling/primary', [\App\Http\Controllers\SectionalTitlingController::class, 'Primary'])->name('sectionaltitling.primary');
Route::get('/sectionaltitling/secondary', [\App\Http\Controllers\SectionalTitlingController::class, 'Secondary'])->name('sectionaltitling.secondary');
Route::get('/sectionaltitling/units', [\App\Http\Controllers\SectionalTitlingController::class, 'Units'])->name('sectionaltitling.units');
Route::get('/map', [\App\Http\Controllers\SectionalTitlingController::class, 'Map'])->name('map.index');

 
// Payment filtering route
Route::get('/programmes/payments/filter', [App\Http\Controllers\ProgrammesController::class, 'filterPayments'])->name('programmes.payments.filter');