<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Auth')->group(function () {

    Route::controller('RegisterController')->group(function () {
        Route::get('/register', 'showRegisterForm')->name('register');
        Route::post('/register', 'register')->name('register');
    });

    Route::controller('LoginController')->group(function () {
        Route::get('/', 'showLoginForm')->name('login');
        Route::post('/', 'login')->name('login');
        Route::get('logout', 'logout')->name('logout');
    });

    //  Password Reset
    Route::controller('ForgotPasswordController')->group(function () {
        Route::get('password/reset', 'showLinkRequestForm')->name('password.reset');
        Route::post('password/reset', 'sendResetCodeEmail');
        Route::get('password/code-verify', 'codeVerify')->name('password.code.verify');
        Route::post('password/verify-code', 'verifyCode')->name('password.verify.code');
    });

    Route::controller('ResetPasswordController')->group(function () {
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset.form');
        Route::post('password/reset/change', 'reset')->name('password.change');
    });
});

Route::middleware('patient')->group(function () {
    Route::controller('PatientController')->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('password', 'password')->name('password');
        Route::post('password', 'passwordUpdate')->name('password.update');


        //Notification
        Route::get('notifications', 'notifications')->name('notifications');
        Route::get('notification/read/{id}', 'notificationRead')->name('notification.read');
        Route::get('notifications/read-all', 'readAll')->name('notifications.readAll');

        //Report Bugs
        Route::get('request-report', 'requestReport')->name('request.report');
        Route::post('request-report', 'reportSubmit');

        Route::get('download-attachments/{file_hash}', 'downloadAttachment')->name('download.attachment');
    });

    Route::controller('PatientController')->prefix('information')->name('info.')->group(function () {
        Route::get('profile', 'profile')->name('profile');
        Route::post('profile', 'profileUpdate')->name('profile.update');
    });

    //Appointments
    Route::controller('AppointmentController')->prefix('appointment')->name('appointment.')->group(function () {
        Route::get('booking', 'details')->name('booking');
        Route::get('booking/availability/date', 'availability')->name('available.date');
        Route::post('store/{id}', 'store')->name('store');

        //Appointment
        Route::get('new', 'new')->name('new');
        Route::post('dealing/{id}', 'done')->name('dealing');

        Route::get('service/done', 'doneService')->name('done');

        Route::post('remove/{id}', 'remove')->name('remove');
        Route::get('trashed', 'serviceTrashed')->name('trashed');
    });
});
