<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invitation extends Model
{
    use HasFactory;
    protected $fillable = ['phone', 'user_id', 'invitation_number', 'event_id', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function Event() {
        return $this->belongsTo(Event::class);
    }
}
