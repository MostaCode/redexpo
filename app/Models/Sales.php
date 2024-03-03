<?php

namespace App\Models;

use App\Models\User;
use App\Models\Agent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sales extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone', 'user_id', 'agent_id'];

    public function agent() {
        return $this->belongsTo(Agent::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
