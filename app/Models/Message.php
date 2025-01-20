<?php

namespace App\Models;

use App\Observers\MessageObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([MessageObserver::class])]
class Message extends Model
{
    protected $fillable = ['to', 'from', 'message'];
    public function messageTo()
    {
        return $this->belongsTo(User::class, 'to');
    }
    public function messageFrom()
    {
        return $this->belongsTo(User::class, 'from');
    }
}
