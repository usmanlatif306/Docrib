<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientPasswordReset extends Model
{
    use HasFactory;

    // protected $table = "patient_password_resets";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [''];

    public $timestamps = false;
}
