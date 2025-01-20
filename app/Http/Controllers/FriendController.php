<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Friend $friend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Friend $friend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Friend $friend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Friend $friend)
    {
        //
    }

    public function addFriend(Request $request)
    {
        $authId = Auth::id();
        // try {
        //     DB::beginTransaction();
            if ($request->event == 'add') {
                if(count(Friend::where(['from'=>$authId,'to'=>$request->to])->get()) == 0){
                    Friend::create([
                        'from' => $authId,
                        'to' => $request->to,
                        'status' => 0
                    ]);
                }
            } elseif ($request->event == 'cancel') {
                Friend::where([
                    'from' => $authId,
                    'to' => $request->to,
                    'status' => 0
                ])->delete();
            } elseif ($request->event == 'accept') {
                Friend::where([
                    'to' => $authId,
                    'from' => $request->from,
                    'status' => 0
                ])->update(['status' => 1]);
            } elseif ($request->event == 'decline') {
                Friend::where([
                    'to' => $authId,
                    'from' => $request->from,
                    'status' => 0
                ])->delete();
            }
        //     DB::commit();
            return back();
        // } catch (Exception $e) {
        //     DB::rollBack();
        //     return response()->json($e->getMessage(), 500);
        // }
    }
    public function acceptRequest() {}
}
