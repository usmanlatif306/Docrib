<?php

namespace App\Http\Controllers\Patient\Auth;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Patient;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use App\Services\TenantService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = 'patient';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('patient.guest');
    }


    public function showRegisterForm()
    {
        $pageTitle = "Patient Register";
        return view('patient.auth.register', compact('pageTitle'));
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        $notify[] = ['success', 'Your are successfully sign up. Please login to your account.'];
        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath())->withNotify($notify);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:191'],
            'username' => ['required', 'string', 'max:10', 'unique:patients,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:patients'],
            'mobile' => ['required', 'string', 'max:191'],
            'address' => ['required', 'string', 'max:191'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Patient
     */
    protected function create(array $data)
    {
        return Patient::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
