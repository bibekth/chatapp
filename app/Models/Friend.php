<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = ['to','from','status'];
    public function friendTo(){
        return $this->belongsTo(User::class,'to');
    }
    public function friendFrom(){
        return $this->belongsTo(User::class,'from');
    }
}
