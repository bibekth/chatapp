<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Friend;
use App\Models\Message;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $authUser = Auth::user();
        $data['currentUser'] = User::where('id',$authUser->id)->first(['id','username']);
        $data['url'] = config('app.url');
        $data['pusher_config'] = config('broadcasting.connections.pusher');
        if($request->ajax()){
            return response()->json($data, 200);
        }
        $data['addFriends'] = $authUser->addFriends();
        $data['myFriends'] = $authUser->friends();
        $data['friendRequests'] = $authUser->friendRequests();
        return view('index', $data);
    }

    // Search users
    public function findUser(Request $request)
    {
        $authUser = Auth::user();
        $username = $request->username;
        if ($request->query('section') == 'add') {
            $friends = DB::select("select distinct u.id from users as u
            join friends as f on (f.'from' = u.id or f.'to' = u.id) where (f.'from' = :authId or f.'to' = :authId) and f.status = 1", ['authId' => $authUser->id]);
            $requestedFrom = Friend::where('status', 0)->where('to', $authUser->id)->get(['from']);
            $merged_data = array_merge($friends, $requestedFrom->toArray());
            $ids = array_column($merged_data, 'id');
            $requestedTo = Friend::where('status', 0)->where('from', $authUser->id)->get(['to']);
            $users = User::whereNotIn('id', $ids)->where('username', 'like', '%' . $username . '%')->get(['id', 'username']);
            foreach ($users as $key => $user) {
                foreach ($requestedTo as $index => $requested) {
                    if ($user->id == $requested->to) {
                        $users[$key]['status'] = 1;
                    } else {
                        $users[$key]['status'] = 0;
                    }
                }
            }
            return response()->json($users, 200);
        } elseif ($request->query('section') == 'request') {
            $requestedFrom = Friend::where('status', 0)->where('to', $authUser->id)->get(['from']);
            $ids = array_column($requestedFrom->toArray(), 'from');
            $users = User::whereIn('id', $ids)->where('username', 'like', '%' . $username . '%')->get(['id', 'username']);
            return response()->json($users, 200);
        } elseif ($request->query('section') == 'my') {
            $friends = DB::select("select distinct u.id from users as u
            join friends as f on (f.'from' = u.id or f.'to' = u.id) where (f.'from' = :authId or f.'to' = :authId) and f.status = 1", ['authId' => $authUser->id]);
            $ids = array_column($friends, 'id');
            $users = User::whereIn('id', $ids)->where('username', 'like', '%' . $username . '%')->where('username', '!=', $authUser->username)
                ->get(['id', 'username']);
            if ($users->isEmpty()) {
                return response()->json('User not found.', 404);
            }
            return response()->json($users, 200);
        }
    }

    /*
    This function is for retrieving message of the authenticated user with the user which s/he clicked.
    */
    public function retrieveMessage($user)
    {
        try {
            $authId = Auth::id();
            $messages = Message::where(function ($query) use ($user, $authId) {
                $query->where('from', $authId)
                    ->where('to', $user);
            })->orWhere(function ($query) use ($user, $authId) {
                $query->where('from', $user)
                    ->where('to', $authId);
            })->get();
            return response()->json(['status' => 'success', 'data' => $messages], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'data' => $e->getMessage()], 500);
        }
    }

    public function storeMessage(Request $request, $user)
    {
        try {
            $authId = Auth::id();
            Message::create([
                'from' => $authId,
                'to' => $user,
                'message' => $request->message
            ]);
            return response()->json(['status' => 'success', 'user' => $user], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'data' => $e->getMessage()], 500);
        }
    }

    public function pusherAuth(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $userData = json_encode([
            'id' => str($user->id),
            'username' => $user->username,
        ]);
        $channel = $request->channel_name;
        $socketId = $request->socket_id;
        $stringToSign = $socketId . ':' . $channel;
        // $stringToSign = $socketId . ':' . $channel . ':' . $userData; // for presence channel
        $secret = config('broadcasting.connections.pusher.secret');
        $hashed = hash_hmac('sha256', $stringToSign, $secret);
        // $hashed = hash_hmac('sha256', $request->socket_id . ':presence-channel-' . $user->id .':{"id":1,"username":"john_doe"}', $secret); // for presence channel
        $appkey = config('broadcasting.connections.pusher.key');
        $data = [
            "auth" => $appkey . ":" . $hashed,
            "user_data" => $userData,
        ];
        return response()->json($data, 200);
    }

    public function docs(){
        return view('docs');
    }
}
