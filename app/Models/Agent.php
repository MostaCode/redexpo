<?php

namespace App\Models;

use App\Models\User;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo', 'phone', 'company_id', 'user_id'];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function clients() {
        return $this->hasMany(Client::class);
    }
    public function sales() {
        return $this->hasMany(Sales::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
