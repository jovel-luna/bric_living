<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AcquisitionController;
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
    return view('home');
})->middleware('auth.redirect');



// Auth::routes(['register' => false]);
Route::group(['middleware' => ['web']], function() {

    // Login Routes...
        Route::get('login', ['as' => 'login', 'uses' => 'App\Http\Controllers\Auth\LoginController@showLoginForm']);
        Route::post('login', ['as' => 'login.post', 'uses' => 'App\Http\Controllers\Auth\LoginController@login']);
        Route::post('logout', ['as' => 'logout', 'uses' => 'App\Http\Controllers\Auth\LoginController@logout']);
    
    // Registration Routes...
        Route::get('register', ['as' => 'register', 'uses' => 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm']);
        Route::post('register', ['as' => 'register.post', 'uses' => 'App\Http\Controllers\Auth\RegisterController@register']);
    
    // Password Reset Routes...
        Route::get('password/reset', ['as' => 'password.request', 'uses' => 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm']);
        Route::post('password/email', ['as' => 'password.email', 'uses' => 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail']);
        Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm']);
        Route::post('password/reset', ['as' => 'password.update', 'uses' => 'App\Http\Controllers\Auth\ResetPasswordController@reset']);
});

Route::group(['middleware' => ['auth']], function() {
    Route::resource('property', PropertyController::class);
    Route::resource('entity', EntityController::class);
    Route::resource('admin', AdminController::class);
    Route::resource('acquisition', AcquisitionController::class);
    Route::resource('operation', App\Http\Controllers\OperationController::class);
    Route::resource('development', App\Http\Controllers\DevelopmentController::class);
    Route::resource('letting', App\Http\Controllers\LettingController::class);
    Route::resource('finance', App\Http\Controllers\FinanceController::class);
    Route::resource('setting', App\Http\Controllers\SettingController::class);
    Route::resource('report', App\Http\Controllers\ReportController::class);
    Route::resource('tenant', App\Http\Controllers\TenantController::class);
    // Route::resource('document', App\Http\Controllers\FileController::class);
    Route::resource('letting-status', 'App\Http\Controllers\LettingStatusController');

    Route::resource('location', App\Http\Controllers\LocationController::class);
    

    Route::get('/settings/getUserAccounts', [App\Http\Controllers\SettingController::class, 'getSettingsUsers'])->name('get.user-accounts');
    Route::post('/settings/updateProfileImage/{id}', [App\Http\Controllers\SettingController::class, 'updateUserProfileImage'])->name('update.user-profile-image');
    Route::post('/settings/updateUserInfo/{id}', [App\Http\Controllers\SettingController::class, 'updateUserInfo'])->name('update.user-info');
    Route::post('/settings/updateUserPassword/{id}', [App\Http\Controllers\SettingController::class, 'updateUserPassword'])->name('update.user-password');
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::get('/sample-sheet-format-download/{type}', [App\Http\Controllers\ImportController::class, 'getSheetFormat'])->name('download.sheet-format');
    Route::get('import-data', [App\Http\Controllers\ImportController::class, 'viewImport'])->name('view.import');
    Route::post('upload-data', [App\Http\Controllers\ImportController::class, 'uploadData'])->name('upload.import');
    
    // Route::get('/entities', [App\Http\Controllers\EntityController::class, 'index'])->name('entity');
    Route::get('/download-entity-format', [App\Http\Controllers\EntityController::class, 'getEntitySampleFormat'])->name('entity.download');
    Route::get('import-entities', [App\Http\Controllers\EntityController::class, 'importEntities'])->name('entity.import');
    Route::post('upload-entities', [App\Http\Controllers\EntityController::class, 'uploadEntities'])->name('entity.upload');
    
    Route::post('entity/fetch/{id}', [App\Http\Controllers\EntityController::class, 'getEntityById'])->name('get.entity');
    Route::post('entity/updateEntity/{id}', [App\Http\Controllers\EntityController::class, 'updateEntity'])->name('get.update-entity');
    
    Route::post('acquisition/fetch/{id}', [App\Http\Controllers\AcquisitionController::class, 'getAcquisitionById'])->name('get.acquisition');
    Route::post('acquisition/getAcquisitionFieldData', [App\Http\Controllers\AcquisitionController::class, 'getAcquisitionFieldData'])->name('get.acquisition-field-data');
    Route::post('acquisition/updateAcquisition/{id}', [App\Http\Controllers\AcquisitionController::class, 'updateAcquisition'])->name('get.update-acquisition');
    Route::get('acquisition/getPlanning/{id}', [App\Http\Controllers\AcquisitionController::class, 'getPlanning'])->name('get.planning');
    Route::post('acquisition/savePlanning/{id}', [App\Http\Controllers\AcquisitionController::class, 'savePlanning'])->name('store.planning');
    Route::get('acquisition/removePlanning/{id}', [App\Http\Controllers\AcquisitionController::class, 'removePlanning'])->name('remove.planning');
    Route::get('acquisition/getSpecificPlanning/{id}', [App\Http\Controllers\AcquisitionController::class, 'getSpecificPlanning'])->name('remove.single-planning');
    Route::post('acquisition/updatePlanning/{id}', [App\Http\Controllers\AcquisitionController::class, 'updatePlanning'])->name('update.planning');
    
    Route::get('property/details/{id}', [App\Http\Controllers\PropertyController::class, 'propertyDetailsShow'])->name('get.property-details');
    Route::post('property/isExisting', ['as' => 'property.isExisting', 'uses' => 'App\Http\Controllers\PropertyController@isExisting']);
    
    Route::get('operations/budget/{id}', [App\Http\Controllers\OperationController::class, 'createBudget'])->name('get.create-budget');
    Route::get('operations/expenditure/{id}', [App\Http\Controllers\OperationController::class, 'createExpenditure'])->name('get.create-expenditure');
    
    Route::post('operations/budget/{id}', [App\Http\Controllers\OperationController::class, 'storeBudget'])->name('store.budget');
    Route::post('operations/expenditure/{id}', [App\Http\Controllers\OperationController::class, 'storeExpenditure'])->name('store.expenditure');
    
    Route::post('operations/budget/{id}/edit', [App\Http\Controllers\OperationController::class, 'editBudget'])->name('edit.budget');
    Route::post('operations/expenditure/{id}/edit', [App\Http\Controllers\OperationController::class, 'editExpenditure'])->name('edit.expenditure');
    
    Route::post('development/updateHsDevelopment/{id}', [App\Http\Controllers\DevelopmentController::class, 'updateHsDevelopment'])->name('update.hs-development');
    
    Route::post('letting/bulkUpdate', [App\Http\Controllers\LettingController::class, 'bulkUpdateLettings'])->name('lettings.bulk-update');
    Route::post('letting/bulkArchive', [App\Http\Controllers\LettingController::class, 'bulkArchiveLettings'])->name('lettings.bulk-archive');
    Route::post('letting/update', [App\Http\Controllers\LettingController::class, 'updateLettings'])->name('lettings.update');

    Route::get('/document/remove-file/{id}', [App\Http\Controllers\FileController::class, 'removeDocument'])->name('remove.file-documents');
    Route::post('/upload/{id?}/{type?}', [App\Http\Controllers\FileController::class, 'upload'])->name('upload');
    Route::get('/document/{id?}/{type?}', [App\Http\Controllers\FileController::class, 'getDocument'])->name('get.file-documents');
    
    // Activity Log
    Route::get('/getActivityLogs', [App\Http\Controllers\ActivityLogController::class, 'getAllActivity'])->name('get.activity');
    
    // System Settings
    Route::post('/updateSystemLogo', [App\Http\Controllers\SystemSettingController::class, 'updateSystemLogo'])->name('update.system-logo');
    
    // Notes
    Route::post('notes/add-notes', [App\Http\Controllers\NoteController::class, 'createNotes'])->name('create.notes');
    Route::get('notes/view-notes', [App\Http\Controllers\NoteController::class, 'getNotes'])->name('get.notes');
    Route::get('notes/delete/{id}', [App\Http\Controllers\NoteController::class, 'removeNotes'])->name('remove.notes');
    Route::post('notes/update/{id}', [App\Http\Controllers\NoteController::class, 'updateNotes'])->name('update.notes');
    Route::get('notes/get-single-notes/{id}', [App\Http\Controllers\NoteController::class, 'getSingleNotes'])->name('get.single-notes');

    // Logs
    Route::post('logs/add-logs', [App\Http\Controllers\LogController::class, 'createLogs'])->name('create.logs');
    Route::get('logs/view-logs', [App\Http\Controllers\LogController::class, 'getLogs'])->name('get.logs');
    Route::get('logs/delete/{id}', [App\Http\Controllers\LogController::class, 'removeLogs'])->name('remove.logs');
    Route::post('logs/update/{id}', [App\Http\Controllers\LogController::class, 'updateLogs'])->name('update.logs');
    Route::get('logs/get-single-logs/{id}', [App\Http\Controllers\LogController::class, 'getSingleLogs'])->name('get.single-logs');

    // Tenant

    Route::post('tenant/update/{id}', [App\Http\Controllers\TenantController::class, 'update'])->name('update.tenant');
    Route::post('notes/add-tenant-notes', [App\Http\Controllers\TenantNoteController::class, 'createTenantNotes'])->name('create.tenant-notes');
    Route::get('notes/view-tenant-notes', [App\Http\Controllers\TenantNoteController::class, 'getTenantNotes'])->name('get.tenant-notes');
    Route::get('notes/delete-tenant-notes/{id}', [App\Http\Controllers\TenantNoteController::class, 'removeTenantNotes'])->name('remove.tenant-notes');
    Route::post('notes/update-tenant-notes/{id}', [App\Http\Controllers\TenantNoteController::class, 'updateTenantNotes'])->name('update.tenant-notes');
    Route::get('notes/get-single-tenant-notes/{id}', [App\Http\Controllers\TenantNoteController::class, 'getSingleTenantNotes'])->name('get.single-tenant-notes');

    // Links

    Route::post('links/add-link', [App\Http\Controllers\LinkController::class, 'storeLink'])->name('store.links');
    Route::post('links/remove-link', [App\Http\Controllers\LinkController::class, 'removeLink'])->name('remove.links');

    // Property photo, video, floorplan
    Route::post('/upload/property-photo/{id?}/{type?}', [App\Http\Controllers\FileController::class, 'uploadPropertyPhoto'])->name('upload.property-photo');
    Route::post('/upload/property-video/{id?}/{type?}', [App\Http\Controllers\FileController::class, 'uploadPropertyVideo'])->name('upload.property-video');
    Route::post('/upload/property-floorplan/{id?}/{type?}', [App\Http\Controllers\FileController::class, 'uploadPropertyFloorplan'])->name('upload.property-floorplan');
    Route::get('download/{id?}/{type?}/{filename?}', [App\Http\Controllers\FileController::class, 'download'])->name('download.file');
    Route::post('gallery/remove/{id}', [App\Http\Controllers\FileController::class, 'remove'])->name('remove.gallery-file');

    // Contract info
    Route::get('lettings/history', [App\Http\Controllers\LettingController::class, 'lettingsHistory'])->name('lettings.history');
    Route::post('lettings/unarchive', [App\Http\Controllers\LettingController::class, 'unarchive'])->name('unarchive.lettings');

    
    Route::get('external', [App\Http\Controllers\PropertyController::class, 'viewExternal'])->name('get.property-external');
    // Route::get('upload/entities', [App\Http\Controllers\EntityController::class, 'upload'])->name('entity.upload');
});
