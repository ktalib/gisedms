<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrimaryFormController;
use App\Http\Controllers\MotherApplicationController;
use App\Http\Controllers\SubApplicationModalController;
use App\Http\Controllers\ActionsController;
use App\Http\Controllers\ProgrammesController;
use App\Http\Controllers\CustomerCareController;


// Place this route OUTSIDE the middleware group if you want it public
Route::get('/mother-applications/{id}', [MotherApplicationController::class, 'show']);
Route::post('/mother-applications', [MotherApplicationController::class, 'store'])->name('mother-applications.store');
Route::post('/mother-applications/storeDeeds', [MotherApplicationController::class, 'storeDeeds'])->name('mother-applications.storeDeeds');
Route::post('/planning-recommendation/update', [MotherApplicationController::class, 'updatePlanningRecommendation'])->name('planning-recommendation.update');
Route::post('/director-approval/update', [MotherApplicationController::class, 'updateDirectorApproval'])->name('director-approval.update');


Route::prefix('sub-application')->group(function () {
    Route::get('/{id}', [SubApplicationModalController::class, 'showSubApplication']);
    Route::post('/survey', [SubApplicationModalController::class, 'storeSurvey'])->name('sub-application.survey.store');
    Route::post('/deeds', [SubApplicationModalController::class, 'storeSubApplicationDeeds'])->name('sub-application.deeds.store');
    Route::post('/planning-recommendation', [SubApplicationModalController::class, 'updateSubPlanningRecommendation'])->name('sub-application.planning-recommendation.update');
    Route::post('/director-approval', [SubApplicationModalController::class, 'updateSubDirectorApproval'])->name('sub-application.director-approval.update');
    Route::get('/conveyance/{applicationId}', [SubApplicationModalController::class, 'getSubConveyance'])->name('sub-application.conveyance.get');
    Route::post('/conveyance', [SubApplicationModalController::class, 'updateSubConveyance'])->name('sub-application.conveyance.update');
    Route::post('/buyers-list', [SubApplicationModalController::class, 'renderSubBuyersList'])->name('sub-application.buyers-list.render');
});



// Example route for the apps.php file
Route::middleware(['auth'])->group(function () {
    Route::get('/primaryform', [PrimaryFormController::class, 'index'])->name('primaryform.index');
    Route::post('/primaryform', [PrimaryFormController::class, 'store'])->name('primaryform.store');
    Route::get('/conveyance/{id}', [MotherApplicationController::class, 'getConveyance'])->name('conveyance.get');
    Route::post('/conveyance/update', [MotherApplicationController::class, 'updateConveyance'])->name('conveyance.update');
    Route::post('/render-buyers-list', [MotherApplicationController::class, 'renderBuyersList'])->name('render-buyers-list');
});

Route::prefix('actions')->group(function () {
    Route::get('/other-departments/{id}', [ActionsController::class, 'OtherDepartments'])->name('actions.other-departments');
    Route::get('/bill/{id}', [ActionsController::class, 'Bill'])->name('actions.bill');
    Route::get('/payments/{id}', [ActionsController::class, 'Payment'])->name('actions.payments');
    Route::get('/recommendation/{id}', [ActionsController::class, 'Recommendation'])->name('actions.recommendation');
    Route::get('/final-conveyance/{id}', [ActionsController::class, 'FinalConveyance'])->name('actions.final-conveyance');
    Route::post('/{application}/update-architectural-design', [ActionsController::class, 'updateArchitecturalDesign'])->name('actions.update-architectural-design');
    Route::get('/director-approval/{id}', [ActionsController::class, 'DirectorApproval'])->name('actions.director-approval');
});

Route::prefix('programmes')->group(function () {
    Route::get('/field-data', [ProgrammesController::class, 'FieldData'])->name('programmes.field-data');
    Route::get('/payments', [ProgrammesController::class, 'Payments'])->name('programmes.payments');
    Route::get('/approvals/other-departments', [ProgrammesController::class, 'Others'])->name('programmes.approvals.other-departments');
    Route::get('/approvals/deeds', [ProgrammesController::class, 'Deeds'])->name('programmes.approvals.deeds');
     Route::get('/approvals/lands', [ProgrammesController::class, 'Lands'])->name('programmes.approvals.lands');
      Route::get('/approvals/planning_recomm', [ProgrammesController::class, 'PlanningRecomm'])->name('programmes.approvals.planning_recomm');
    Route::get('/approvals/director', [ProgrammesController::class, 'Director_approval'])->name('programmes.approvals.director');
    Route::get('/report', [ProgrammesController::class, 'ST_Report'])->name('programmes.report');
    Route::get('/certificates', [ProgrammesController::class, 'CertificateOfOccupancy'])->name('programmes.certificates');
    Route::get('/entity/{applicationId?}', [ProgrammesController::class, 'Entity'])->name('programmes.entity');
});


Route::prefix('customer_care')->group(function () {
    Route::get('/', [CustomerCareController::class, 'index'])->name('customer-care.index');
    Route::get('/customer/{id}', [CustomerCareController::class, 'getCustomer'])->name('customer-care.get-customer');
    Route::post('/send-sms', [CustomerCareController::class, 'sendSms'])->name('customer-care.send-sms');
    Route::post('/make-call', [CustomerCareController::class, 'makeCall'])->name('customer-care.make-call');
    Route::post('/send-bulk-sms', [CustomerCareController::class, 'sendBulkSms'])->name('customer-care.send-bulk-sms');
    Route::post('/send-email', [CustomerCareController::class, 'sendEmail'])->name('customer-care.send-email');
    Route::post('/send-bulk-email', [CustomerCareController::class, 'sendBulkEmail'])->name('customer-care.send-bulk-email');
    Route::post('/send-whatsapp', [CustomerCareController::class, 'sendWhatsApp'])->name('customer-care.send-whatsapp');
    Route::post('/send-bulk-whatsapp', [CustomerCareController::class, 'sendBulkWhatsApp'])->name('customer-care.send-bulk-whatsapp');
    Route::get('/view-application/{id}', [CustomerCareController::class, 'viewApplication'])->name('customer-care.view-application');
    Route::get('/open-file/{id}', [CustomerCareController::class, 'openFile'])->name('customer-care.open-file');
});