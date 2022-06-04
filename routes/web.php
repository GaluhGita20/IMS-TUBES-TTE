<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\PesertaTrainingController;




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

Route::get('docusign', [DocusignController::class, 'index'])->name('docusign');
Route::get('connect-docusign', [DocusignController::class, 'connectDocusign'])->name('connect.docusign');
Route::get('docusign/callback', [DocusignController::class, 'callback'])->name('docusign.callback');
Route::get('sign-document', [DocusignController::class, 'signDocument'])->name('docusign.sign');
Auth::routes();

Route::middleware(['guest:web'])->group(function(){
    Route::view('/','user.home')->name('welcome');
    Route::get('login',[AuthUserController::class,'login'])->name('login');
    Route::get('register',[AuthUserController::class,'register'])->name('register');
    route::post('registers_proses',[AuthUserController::class,'proses_register'])->name('register_proses');
    Route::post('logins_proses',[AuthUserController::class,'proses_login'])->name('login_proses');

    
    
});

Route::middleware(['auth:web'])->group(function(){
    Route::get('home', [DashboardController::class, 'index'])->name('home');
    Route::post('/logout',[AuthUserController::class,'logout'])->name('logout');

    //main proses\
    Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
    Route::get('list-training',[DashboardController::class,'training'])->name('training');
    Route::get('list-certificate',[DashboardController::class,'certificate'])->name('certificate');

});


Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(['guest:admin'])->group(function(){
        Route::get('login',[AuthAdminController::class,'login'])->name('login');
        route::post('logins_proses',[AuthAdminController::class,'proses_login'])->name('login_proses');
    });
    Route::middleware(['auth:admin'])->group(function(){
        Route::get('home', [DashboardAdminController::class, 'index'])->name('home');


        // training
        Route::get('training', [ActivityController::class, 'index'])->name('training.index');
        route::get('training/add',[ActivityController::class,'add'])->name('training.create');
        route::post('training/store',[ActivityController::class,'store'])->name('training.store');
        route::get('training/detail-{id}',[ActivityController::class,'detail'])->name('training.detail');
        route::get('training/edit-{id}',[ActivityController::class,'edit'])->name('training.edit');
        route::post('training/update-{id}',[ActivityController::class,'update'])->name('training.update');
        route::post('training/add-peserta-{id}',[ActivityController::class,'peserta_add'])->name('training.peserta_add');
        route::post('training/delete-peserta-{id}',[ActivityController::class,'peserta_delete'])->name('training.peserta_delete');
        route::post('training-delete-{id}',[ActivityController::class,'destroy'])->name('training.destroy');
        route::post('training/finish-{id}',[ActivityController::class,'training_finish'])->name('training.isFinish');




        //document
        Route::get('documents', [DocumentController::class, 'index'])->name('document.index');
        Route::get('documents/create', [DocumentController::class, 'create'])->name('document.create');
        Route::get('documents/detail-{id}', [DocumentController::class, 'detail'])->name('document.detail');
        Route::get('documents/edit-{id}', [DocumentController::class, 'edit'])->name('document.edit');
        route::post('documents/upload',[DocumentController::class,'store'])->name('document.upload');
        route::post('documents/signer-add-{id}',[DocumentController::class,'signer_add'])->name('signer.add');
        route::post('documents/signer-delete-{id}',[DocumentController::class,'signer_delete'])->name('signer.delete');
        route::post('documents/sending-{id}',[DocumentController::class,'document_sending'])->name('document.sending');
        route::post('documents/integrasi-{id}',[DocumentController::class,'document_integrasi'])->name('document.integrasi');
        route::get('documents/download-final-{id}',[DocumentController::class,'document_download_final'])->name('document.download_final');
        route::post('documents/delete-{id}',[DocumentController::class,'destroy'])->name('document.destroy');



        // peserta
        Route::get('documents/peserta={id_user}&training={id_training}', [PesertaTrainingController::class, 'index'])->name('peserta.index');
        route::post('certificate/add-{id}',[PesertaTrainingController::class,'create'])->name('certificate.add');
        route::post('certificate/sending-{id}',[PesertaTrainingController::class,'sending'])->name('certificate.sending');
        
    });
});


// 
// Route::get('test', [DashboardController::class, 'test'])->name('test');