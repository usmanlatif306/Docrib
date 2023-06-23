<?php

namespace App\Http\Controllers\Patient\Auth;

use App\Models\Doctor;
use App\Models\DoctorPasswordReset;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientPasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;


class ResetPasswordController extends Controller
{
    /*
        |--------------------------------------------------------------------------
        | Password Reset Controller
        |--------------------------------------------------------------------------
        |
        | This controller is responsible for handling password reset requests
        | and uses a simple trait to include this behavior. You're free to
        | explore this trait and override any methods you wish to tweak.
        |
        */

    use ResetsPasswords;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/patient/dashboard';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('patient.guest');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Http\Response
     */
    public function showResetForm(Request $request, $token)
    {
        $pageTitle  = "Account Recovery";
        $resetToken = PatientPasswordReset::where('token', $token)->where('status', 0)->first();

        if (!$resetToken) {
            $notify[] = ['error', 'Verification code mismatch'];
            return to_route('patient.password.reset')->withNotify($notify);
        }
        $email = $resetToken->email;
        return view('patient.auth.passwords.reset', compact('pageTitle', 'email', 'token'));
    }


    public function reset(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:4',
        ]);

        $reset = PatientPasswordReset::where('token', $request->token)->orderBy('created_at', 'desc')->first();
        $user  = Patient::where('email', $reset->email)->first();
        if ($reset->status == 1) {
            $notify[] = ['error', 'Invalid code'];
            return to_route('patient.login')->withNotify($notify);
        }

        $user->password = bcrypt($request->password);
        $user->save();
        $reset->status = 1;
        $reset->save();

        $userIpInfo = getIpInfo();
        $userBrowser = osBrowser();

        notify($user, 'PASS_RESET_DONE', [
            'operating_system' => $userBrowser['os_platform'],
            'browser'          => $userBrowser['browser'],
            'ip'               => $userIpInfo['ip'],
            'time'             => $userIpInfo['time']
        ], ['email'], false);

        $notify[] = ['success', 'Password changed'];
        return to_route('patient.login')->withNotify($notify);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('patients');
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return auth()->guard('patient');
    }
}
