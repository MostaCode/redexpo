<?php

namespace App\Models;

use App\Models\User;
use App\Models\Agent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo', 'about', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function agents() {
        return $this->hasMany(Agent::class);
    }
}
