<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Traits\AppointmentManager;

class AppointmentController extends Controller
{
    use AppointmentManager;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->guard('patient')->user();
            return $next($request);
        });
        $this->userType   = 'patient';
        $this->userColumn = 'doctor_id';
    }
}
