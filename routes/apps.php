<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrimaryFormController;
use App\Http\Controllers\PrimaryActionsController;
use App\Http\Controllers\SubApplicationModalController;
use App\Http\Controllers\ActionsController;
use App\Http\Controllers\ProgrammesController;
use App\Http\Controllers\CustomerCareController;
use App\Http\Controllers\SecondaryFormController;
use App\Http\Controllers\SubActionsController;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\RofoController;
use App\Http\Controllers\CofoController;
use App\Http\Controllers\FinalBillController;



// Place this route OUTSIDE the middleware group if you want it public
Route::get('/primary-applications/{id}', [PrimaryActionsController::class, 'show']);
Route::post('/primary-applications', [PrimaryActionsController::class, 'store'])->name('primary-applications.store');
Route::get('/survey/{applicationId}', [PrimaryActionsController::class, 'getSurvey'])->name('survey.get');
Route::post('/survey/update', [PrimaryActionsController::class, 'updateSurvey'])->name('survey.update');
Route::post('/primary-applications/storeDeeds', [PrimaryActionsController::class, 'storeDeeds'])->name('primary-applications.storeDeeds');
Route::post('/planning-recommendation/update', [PrimaryActionsController::class, 'updatePlanningRecommendation'])->name('planning-recommendation.update');
Route::post('/director-approval/update', [PrimaryActionsController::class, 'updateDirectorApproval'])->name('director-approval.update');
Route::get('/conveyance/{id}', [PrimaryActionsController::class, 'getConveyance'])->name('conveyance.get');
Route::post('/conveyance/update', [PrimaryActionsController::class, 'updateConveyance'])->name('conveyance.update');
Route::post('/conveyance/add-buyer', [PrimaryActionsController::class, 'addBuyer'])->name('conveyance.add-buyer');
Route::post('/conveyance/delete-buyer', [PrimaryActionsController::class, 'deleteBuyer'])->name('conveyance.delete-buyer');
Route::post('/render-buyers-list', [PrimaryActionsController::class, 'renderBuyersList'])->name('render-buyers-list');

// Example route for the apps.php file
  Route::middleware(['auth'])->group(function () {
    Route::get('/primaryform', [PrimaryFormController::class, 'index'])->name('primaryform.index');
    Route::post('/primaryform', [PrimaryFormController::class, 'store'])->name('primaryform.store');
});


  Route::middleware(['auth'])->group(function () {
    Route::post('/secondaryform', [SecondaryFormController::class, 'save'])->name('secondaryform.save');
});


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




Route::prefix('actions')->group(function () {
    Route::get('/other-departments/{id}', [ActionsController::class, 'OtherDepartments'])->name('actions.other-departments');
    Route::get('/bill/{id}', [ActionsController::class, 'Bill'])->name('actions.bill');
    Route::get('/payments/{id}', [ActionsController::class, 'Payment'])->name('actions.payments');
    Route::get('/recommendation/{id}', [ActionsController::class, 'Recommendation'])->name('actions.recommendation');
    Route::get('/final-conveyance/{id}', [ActionsController::class, 'FinalConveyance'])->name('actions.final-conveyance');
    Route::post('/{application}/update-architectural-design', [ActionsController::class, 'updateArchitecturalDesign'])->name('actions.update-architectural-design');
    Route::get('/director-approval/{id}', [ActionsController::class, 'DirectorApproval'])->name('actions.director-approval');
});

Route::prefix('sub-actions')->group(function () {
    Route::get('/other-departments/{id}', [SubActionsController::class, 'OtherDepartments'])->name('sub-actions.other-departments');
    Route::get('/bill/{id}', [SubActionsController::class, 'Bill'])->name('sub-actions.bill');
    Route::get('/payments/{id}', [SubActionsController::class, 'Payment'])->name('sub-actions.payments');
    Route::get('/recommendation/{id}', [SubActionsController::class, 'Recommendation'])->name('sub-actions.recommendation');
    Route::get('/final-conveyance/{id}', [SubActionsController::class, 'FinalConveyance'])->name('sub-actions.final-conveyance');
    Route::post('/{application}/update-architectural-design', [SubActionsController::class, 'updateArchitecturalDesign'])->name('sub-actions.update-architectural-design');
    Route::get('/director-approval/{id}', [SubActionsController::class, 'DirectorApproval'])->name('sub-actions.director-approval');
    
    // New AJAX endpoints
    Route::post('/planning-recommendation/update', [SubActionsController::class, 'updatePlanningRecommendation'])->name('sub-actions.update-planning-recommendation');
    Route::post('/director-approval/update', [SubActionsController::class, 'updateDirectorApproval'])->name('sub-actions.update-director-approval');
    Route::post('/survey/store', [SubActionsController::class, 'storeSurvey'])->name('sub-actions.store-survey');
    Route::post('/deeds/store', [SubActionsController::class, 'storeDeeds'])->name('sub-actions.store-deeds');
    Route::get('/related/{primaryId}', [SubActionsController::class, 'getRelatedSubApplications'])->name('sub-actions.get-related');
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
    Route::get('/certificates', [CofoController::class, 'CertificateOfOccupancy'])->name('programmes.certificates');
    Route::get('/generate_cofo/{id}', [CofoController::class, 'generateCofO'])->name('programmes.generate_cofo');
    Route::post('/save_cofo', [CofoController::class, 'saveCofO'])->name('programmes.save_cofo');
    Route::get('/entity/{applicationId?}', [ProgrammesController::class, 'Entity'])->name('programmes.entity');

    Route::get('/memo', [MemoController::class, 'Memo'])->name('programmes.memo'); 
    Route::get('/view_memo/{id}', [MemoController::class, 'viewMemo'])->name('programmes.view_memo');
    Route::get('/view_memo_primary/{id}', [MemoController::class, 'viewMemoPrimary'])->name('programmes.view_memo_primary');
    
    // New routes for memo generation
    Route::get('/generate_memo/{id}', [MemoController::class, 'generateMemo'])->name('programmes.generate_memo');
    Route::post('/save_memo', [MemoController::class, 'saveMemo'])->name('programmes.save_memo');

    Route::get('/rofo', [RofoController::class, 'RofO'])->name('programmes.rofo');
    Route::get('/generate_rofo/{id}', [RofoController::class, 'generateRofO'])->name('programmes.generate_rofo');
    Route::post('/save_rofo', [RofoController::class, 'saveRofO'])->name('programmes.save_rofo');
    Route::get('/view_rofo/{id}', [RofoController::class, 'viewRofO'])->name('programmes.view_rofo');
     

    
    Route::get('/view_cofo/{id}', [CofoController::class, 'ViewCofO'])->name('programmes.view_cofo');
});

// Final Bill Routes
Route::prefix('final-bill')->group(function () {
    Route::get('/generate/{id}', [FinalBillController::class, 'generateBill'])->name('final-bill.generate');
    Route::post('/save', [FinalBillController::class, 'saveBill'])->name('final-bill.save');
    Route::get('/print/{id}', [FinalBillController::class, 'printBill'])->name('final-bill.print');
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