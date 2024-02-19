<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentHeaderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function() {
    Route::get('/', [UserController::class, 'login'])->name('guest.login');
    Route::post('/', [UserController::class, 'handleLogin'])->name('guest.handleLogin');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/logout', [UserController::class, 'handleLogout'])->name('guest.handleLogout');

    Route::prefix('admin')->middleware(['admin'])->group(function () {
        Route::get('/payment-list', [PaymentController::class, 'paymentList'])->name('admin.paymentList');
        Route::get('/student-list', [UserController::class, 'studentList'])->name('admin.studentList');
        Route::get('/admin-list', [UserController::class, 'adminList'])->name('admin.adminList');

        Route::get('/insert-payment', [PaymentController::class, 'insertPayment'])->name('admin.insertPayment');
        Route::post('/insert-payment', [PaymentController::class, 'handleInsertPayment'])->name('admin.handleInsertPayment');

        Route::get('/insert-student', [UserController::class, 'insertStudent'])->name('admin.insertStudent');
        Route::post('/insert-student', [UserController::class, 'handleInsertStudent'])->name('admin.handleInsertStudent');

        Route::get('/insert-admin', [UserController::class, 'insertAdmin'])->name('admin.insertAdmin');
        Route::post('/insert-admin', [UserController::class, 'handleInsertAdmin'])->name('admin.handleInsertAdmin');

        Route::get('/update-payment/{id}', [PaymentController::class, 'updatePayment'])->name('admin.updatePayment');
        Route::post('/update-payment/{id}', [PaymentController::class, 'handleUpdatePayment'])->name('admin.handleUpdatePayment');

        Route::get('/mapping-student/{payment_id}', [PaymentController::class, 'mappingStudent'])->name('admin.mappingStudent');
        Route::get('/handle-mapping-student/{user_id}/{payment_id}' ,[PaymentHeaderController::class,'handleMappingStudent'])->name('admin.handleMappingStudent');
        Route::get('/handle-remove-mapping-student/{user_id}/{payment_id}' ,[PaymentHeaderController::class,'handleRemoveMappingStudent'])->name('admin.handleRemoveMappingStudent');

        Route::get('/delete-payment/{id}', [PaymentController::class, 'handleDeletePayment'])->name('admin.handleDeletePayment');
    });

    Route::prefix('student')->middleware(['student'])->group(function () {
        Route::get('/student-payment', [PaymentController::class, 'studentPayment'])->name('student.studentPayment');
        Route::get('/handle-student-payment/{payment_id}', [PaymentController::class, 'handleStudentPayment'])->name('student.handleStudentPayment');

    });

});
