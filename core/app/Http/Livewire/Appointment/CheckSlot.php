<?php

namespace App\Http\Livewire\Appointment;

use App\Models\Appointment;
use Carbon\Carbon;
use Livewire\Component;

class CheckSlot extends Component
{
    // public $date = "2023-06-23", $starting = "09:00 am", $ending = "02:00 pm", $chair = "Chair 1", $procedures, $procedure, $doctor;
    public $date, $starting, $ending, $chair, $procedures, $procedure, $doctor, $doctor_start_time, $doctor_end_time;

    protected $listeners = ['startTimeSelected', 'endTimeSelected'];

    public function mount()
    {
        $this->doctor_start_time = Carbon::parse($this->doctor->start_time);
        $this->doctor_end_time = Carbon::parse($this->doctor->end_time);
        $this->procedures = Appointment::procedures();
    }

    public function render()
    {
        return view('livewire.appointment.check-slot');
    }

    public function updatedDate()
    {
        $this->checkSlot();
    }

    public function updatedChair()
    {
        $this->checkSlot();
    }

    public function startTimeSelected($time)
    {
        $this->starting = $time;
        $this->checkSlot();
    }

    public function endTimeSelected($time)
    {
        $this->ending = $time;
        $this->checkSlot();
    }

    public function checkSlot()
    {
        // make sure starting and ending time never less or greater than doctor time
        $starting = Carbon::parse($this->starting);
        $ending = Carbon::parse($this->ending);

        if ($starting->lt($this->doctor_start_time)) {
            session()->flash('error', __('Start time should not be less than  ' . $this->doctor_start_time->format('h:i a')));
            $this->dispatchBrowserEvent('slotCheck', ['result' => false]);
            return;
        }

        if ($ending->gt($this->doctor_end_time)) {
            session()->flash('error', __('End time should not be greater than  ' . $this->doctor_end_time->format('h:i a')));
            $this->dispatchBrowserEvent('slotCheck', ['result' => false]);
            return;
        }

        // make sure start date is always greater than ending
        if ($this->starting && $this->ending) {
            if ($starting->gte($ending)) {
                session()->flash('error', __('End Time should always greater than Start Time'));
                $this->dispatchBrowserEvent('slotCheck', ['result' => false]);
                return;
            }
        }


        // make sure slot is free
        if ($this->date && $this->starting && $this->ending && $this->chair) {
            $appointments = Appointment::query()
                ->newAppointment()
                ->where('booking_date', $this->date)
                ->where('chair', $this->chair)
                ->get();

            // $foundFlag = false;
            if ($appointments->count() > 0) {
                $beginDate = Carbon::create(date('Y-m-d') . ' ' . $this->starting);
                $endDate = Carbon::create(date('Y-m-d') . ' ' . $this->ending);
                foreach ($appointments as $appointment) {
                    $beginDateForCurrenAppointment = \Carbon\Carbon::create(date('Y-m-d') . ' ' . $appointment->starting);
                    $endDateForCurrenAppointment = \Carbon\Carbon::create(date('Y-m-d') . ' ' . $appointment->ending);

                    // check either some part of time existed between appointments
                    if ($beginDateForCurrenAppointment->between($beginDate, $endDate, false) || $endDateForCurrenAppointment->between($beginDate, $endDate, false) || $beginDate->between($beginDateForCurrenAppointment, $endDateForCurrenAppointment, false) || $endDate->between($beginDateForCurrenAppointment, $endDateForCurrenAppointment, false)) {
                        session()->flash('error', __('The slot ' . carbon($appointment->starting)->format('h:i a') . ' - ' . carbon($appointment->ending)->format('h:i a') . ' for ' . $appointment->chair . ' on ' . $appointment->booking_date . ' is already booked for ' . $appointment->doctor?->name . ' for ' . $appointment->procedure . '.'));
                        $this->dispatchBrowserEvent('slotCheck', ['result' => false]);
                        break;
                    } else {
                        // check either slot of same time existed
                        $appoint = $appointment->whereTime('starting', '<=', $starting->toTimeString())->whereTime('ending', '>=', $ending->toTimeString())->first();

                        if ($appoint) {
                            session()->flash('error', __('The slot ' . carbon($appoint->starting)->format('h:i a') . ' - ' . carbon($appoint->ending)->format('h:i a') . ' for ' . $appoint->chair . ' on ' . $appoint->booking_date . ' is already booked for ' . $appoint->doctor?->name . ' for ' . $appoint->procedure . '.'));
                            $this->dispatchBrowserEvent('slotCheck', ['result' => false]);
                            break;
                        } else {
                            $this->dispatchBrowserEvent('slotCheck', ['result' => true]);
                        }
                    }
                }
            } else {
                $this->dispatchBrowserEvent('slotCheck', ['result' => true]);
            }
        } else {
            $this->dispatchBrowserEvent('slotCheck', ['result' => false]);
        }
    }
}
