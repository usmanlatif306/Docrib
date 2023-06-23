<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use HasFactory, Searchable, GlobalStatus;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'username', 'email', 'mobile', 'address', 'password', 'email_verified_at', 'featured', 'status', 'image'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class)->where('status', '!=', Status::PAYMENT_INITIATE);
    }

    // SCOPES
    public function scopeActive($query)
    {
        return $query->where('status', Status::ACTIVE);
    }
    public function scopeInactive($query)
    {
        return $query->where('status', Status::INACTIVE);
    }

    public function statusBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->status == Status::ACTIVE) {
                $html = '<span class="badge badge--success">' . trans("Active") . '</span>';
            } elseif ($this->status == Status::INACTIVE) {
                $html = '<span class="badge badge--danger">' . trans("Inactive") . '</span>';
            }
            return $html;
        });
    }

    public function featureBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->featured == Status::YES) {
                $html = '<span class="badge badge--success">' . trans("Featured") . '</span>';
            } elseif ($this->featured == Status::NO) {
                $html = '<span class="badge badge--warning">' . trans("Non Featured") . '</span>';
            }
            return $html;
        });
    }
}
