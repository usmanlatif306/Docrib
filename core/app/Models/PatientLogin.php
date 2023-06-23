<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientLogin extends Model
{
    use HasFactory, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['patient_id', 'patient_ip', 'location', 'browser', 'os', 'longitude', 'latitude', 'city', 'country', 'country_code'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
