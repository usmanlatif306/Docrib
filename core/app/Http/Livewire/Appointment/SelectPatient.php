<?php

namespace App\Http\Livewire\Appointment;

use App\Models\Patient;
use Livewire\Component;

class SelectPatient extends Component
{
    public $patients, $patient_id, $name, $email, $mobile;

    public function mount()
    {
        $this->patients = Patient::select(['id', 'first_name', 'last_name', 'email', 'mobile'])->active()->get();
    }
    public function render()
    {
        return view('livewire.appointment.select-patient');
    }

    public function updatedPatientId()
    {
        $patient = Patient::find($this->patient_id);
        $this->name = $patient->name;
        $this->email = $patient->email;
        $this->mobile = $patient->mobile;
    }
}
