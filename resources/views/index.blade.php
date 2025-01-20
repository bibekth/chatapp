@extends('layouts.app')

@section('content')
<div class="container-fluid mt-5 p-5">
    <div class="row">
        <div class="col-md-2 add-friend-container pb-5">
            <h5>Add Users</h5>
            <input type="text" id="search-box-add-friend" class="form-control mb-3" placeholder="Enter username"
                name="username" autofocus>
            <p class="text-danger" style="margin-top:-16px; margin-left: 8px; display: none;"
                id="user_not_found-add-friend">User
                not found.</p>
            <ul id="user-list-add-friend" class="list-group"></ul>
            <div class="same-height">
                @foreach ($addFriends as $addfriend)
                <div class="d-flex justify-content-between pt-1 pb-2">
                    <div class="">{{ $addfriend->username }}</div>
                    @if(!empty($addfriend->cancelRequest))
                    <form action="/add-friend?event=cancel&to={{ $addfriend->id }}" method="POST">
                        @csrf @method('POST')
                        <div class="add-friend"><button class="btn btn-sm btn-outline-primary">Cancel Request</button>
                        </div>
                    </form>
                    @else
                    <form action="/add-friend?event=add&to={{ $addfriend->id }}" method="POST">
                        @csrf @method('POST')
                        <div class="add-friend"><button class="btn btn-sm btn-outline-primary">Add Friend</button></div>
                    </form>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-2 request-container pb-5">
            <h5>Requests</h5>
            <input type="text" id="search-box-requests" class="form-control mb-3" placeholder="Enter username"
                name="username" autofocus>
            <p class="text-danger" style="margin-top:-16px; margin-left: 8px; display: none;"
                id="user_not_found-requests">User
                not found.</p>
            <ul id="user-list-requests" class="list-group"></ul>
            <div class="same-height">
                @foreach ($friendRequests as $friendRequest)
                <div class="d-flex justify-content-between pt-1 pb-1">
                    <div class="">{{ $friendRequest->username }}</div>
                    <form action="/add-friend?event=accept&from={{ $friendRequest->id }}" method="POST">
                        @csrf @method('POST')
                        <div class="add-friend"><button class="btn btn-sm btn-outline-primary">Accept</button></div>
                    </form>
                    <form action="/add-friend?event=decline&from={{ $friendRequest->id }}" method="POST">
                        @csrf @method('POST')
                        <div class="add-friend"><button class="btn btn-sm btn-outline-danger">Decline</button></div>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-2 my-friend-container pb-5">
            <h5>My Friends</h5>
            <input type="text" id="search-box-my-friend" class="form-control mb-3" placeholder="Enter username"
                name="username" autofocus>
            <p class="text-danger" style="margin-top:-16px; margin-left: 8px; display: none;"
                id="user_not_found-my-friend">User
                not found.</p>
            <ul id="user-list-my-friend" class="list-group"></ul>
            <div class="same-height">
                @foreach ($myFriends as $myfriend)
                <div class="d-flex justify-content-between pt-1 pb-2 my-friend" id="friend-{{ $myfriend->id }}"
                    data-user={{ $myfriend->id }} data-name="{{ $myfriend->username }}">
                    <div class="">{{ $myfriend->username }}</div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-6 chat-container pb-5">
            <h5 id="chat-title">Chat</h5>
            <div id="chat-box" class=""></div>
            <div class="row">
                <div class="col-lg-10 col-md-9 col-sm-10 col-xs-10 col-8">
                    <input type="text" name="message" data-user="" id="chat-input" class="form-control"
                        placeholder="Type a message...">
                </div>
                <div class="col-lg-2 col-md-3 col-sm-2 col-xs-2 col-4">
                    <button class="btn btn-primary form-control col-2" data-user="" id="send-message">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
