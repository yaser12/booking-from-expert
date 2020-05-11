<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function start_of_slot()
    {
        return $this->belongsTo(StartOfSlot::class);
    }
    public function expert()
    {
        return $this->belongsTo(User::class,'expert_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
