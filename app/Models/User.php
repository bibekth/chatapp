<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function messageTo()
    {
        return $this->hasMany(Message::class, 'to');
    }
    public function messageFrom()
    {
        return $this->hasMany(Message::class, 'from');
    }
    public function friendTo()
    {
        return $this->hasMany(Friend::class, 'to', 'id')->where('to', Auth::id())
            ->where('status', 0);
    }
    public function friendFrom()
    {
        return $this->hasMany(Friend::class, 'from', 'id')->where('from', Auth::id())
            ->where('status', 0);
    }

    public function friends()
    {
        $authId = Auth::id();

        $friends = DB::table('users as u')
            ->join('friends as f', function ($join) {
                $join->on('f.to', '=', 'u.id')
                    ->orOn('f.from', '=', 'u.id');
            })
            ->where('f.status', 1)
            ->where(function ($query) use ($authId) {
                $query->where('f.to', $authId)
                    ->orWhere('f.from', $authId);
            })
            ->where('u.id', '!=', $authId)
            ->select('u.*')
            ->orderBy('f.created_at', 'desc')
            ->get();
        return $friends;
    }

    public function friendRequests()
    {
        $requests = Friend::where('status', 0)->where('to', Auth::id())
        ->orderBy('created_at', 'desc')->pluck('from');
        return User::with('friendFrom')->whereIn('id', $requests)->get();
    }

    public function addFriends()
    {
        $authId = Auth::id();

        $friends = DB::table('users as u')
            ->join('friends as f', function ($join) {
                $join->on('f.to', '=', 'u.id')
                    ->orOn('f.from', '=', 'u.id');
            })
            ->where('f.status', 1)
            ->where(function ($query) use ($authId) {
                $query->where('f.to', $authId)
                    ->orWhere('f.from', $authId);
            })
            ->where('u.id', '!=', $authId)
            ->select('u.id')->pluck('u.id')
            ->flatten()
            ->unique()
            ->toArray();
        $requestedFrom = DB::table('users as u')->join('friends as f', function ($join) {
            $join->on('f.from', '=', 'u.id');
        })->where('f.status', 0)->where('f.to', $authId)
            ->where('u.id', '!=', $authId)
            ->select('u.id')->pluck('u.id')
            ->flatten()
            ->unique()
            ->toArray();
        $friendsOrRequestedFrom  = array_merge($friends, $requestedFrom);
        $addFriends = User::whereNotIn('id',$friendsOrRequestedFrom)->where('id','!=',$authId)->orderBy('created_at','desc')->get();
        return $addFriends;
    }

    public function cancelRequest()
    {
        $authId = Auth::id();
        return $this->hasOne(Friend::class,'to')->where('from',$authId)->where('status',0)
        ->orderBy('created_at', 'desc');
    }
}
