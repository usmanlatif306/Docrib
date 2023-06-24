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
use Illuminate\Validation\Rule;

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
            'first_name' => ['required', 'string', 'max:191'],
            'last_name' => ['required', 'string', 'max:191'],
            'username' => ['required', 'string', 'max:10', 'unique:patients,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:patients'],
            'mobile' => ['required', 'string', 'max:191'],
            'address' => ['required', 'string', 'max:191'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'gender' => ['required', 'string', Rule::in(['male', 'female', 'transgender', 'other'])],
            'post_office' => ['required', 'string', 'max:191'],
            'city' => ['required', 'string', 'max:191'],
            'nationality' => ['required', 'string', 'max:191'],
            'social_security_code' => ['required', 'string', 'max:191'],
            'language' => ['required', 'string', 'max:191'],
            'lease_payments' => ['required', 'string', 'max:191'],
            'how_find_us' => ['required', 'string', 'max:191'],
        ], [
            'mobile.required' => 'Phone number is required',
            'mobile.string' => 'Phone number must be string',
            'mobile.max' => 'Phone number must not be greater than 191 characters',
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
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
            'gender' => $data['gender'],
            'post_office' => $data['post_office'],
            'city' => $data['city'],
            'nationality' => $data['nationality'],
            'social_security_code' => $data['social_security_code'],
            'language' => $data['language'],
            'lease_payments' => $data['lease_payments'],
            'how_find_us' => $data['how_find_us'],
        ]);
    }
}
