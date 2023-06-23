<?php

namespace App\Http\Controllers\Patient;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AssistantDoctorTrack;
use App\Models\Deposit;
use App\Models\DoctorLogin;
use App\Models\Education;
use App\Models\Experience;
use App\Models\PatientLogin;
use App\Models\SocialIcon;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function dashboard()
    {
        $pageTitle   = 'Dashboard';
        $patient      = auth()->guard('patient')->user();
        $appointment = Appointment::where('email', $patient->id)->where('try', Status::YES)->where('is_delete', Status::NO);

        $new  = clone $appointment;
        $done = clone $appointment;
        // $widget['total_online_earn']      = Deposit::where('doctor_id', $patient->id)->where('status', Status::PAYMENT_SUCCESS)->sum('amount');
        // $widget['total_cash_earn']        = $patient->balance - $widget['total_online_earn'];
        $widget['total_new_appointment']  = $new->where('is_complete', Status::APPOINTMENT_INCOMPLETE)->count();
        $widget['total_done_appointment'] = $done->where('is_complete', Status::APPOINTMENT_COMPLETE)->count();

        $assistantsDoctor  = AssistantDoctorTrack::where('doctor_id', auth()->guard('patient')->id())->with('assistant')->whereHas('assistant', function ($q) {
            $q->active();
        })->paginate(getPaginate());
        $loginLogs      = PatientLogin::where('patient_id',  $patient->id)->orderByDesc('id')->with('patient')->take(10)->get();
        return view('patient.dashboard', compact('pageTitle', 'widget', 'patient', 'assistantsDoctor', 'loginLogs'));
    }

    public function profile()
    {
        $pageTitle = 'Profile';
        $patient    = auth()->guard('patient')->user();
        return view('patient.info.profile', compact('pageTitle', 'patient'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])]
        ]);
        $patient = auth()->guard('patient')->user();

        if ($request->hasFile('image')) {
            try {
                $patient->image = fileUploader($request->image, getFilePath('doctorProfile'), getFileSize('doctorProfile'), $patient->image);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $patient->save();
        $notify[] = ['success', 'Your profile has been updated.'];
        return back()->withNotify($notify);
    }

    public function password()
    {
        $pageTitle = 'Password Setting';
        $patient = auth()->guard('patient')->user();
        return view('patient.password', compact('pageTitle', 'patient'));
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = auth()->guard('patient')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notify[] = ['error', 'Password do not match !!'];
            return back()->withNotify($notify);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $notify[] = ['success', 'Password changed successfully.'];
        return to_route('patient.password')->withNotify($notify);
    }
}
