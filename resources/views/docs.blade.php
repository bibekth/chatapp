@extends('layouts.app')

@section('content')
<style>
    .chatapp-docs-container {
        height: 85vh;
    }

    .docs-left-section>ul>li {
        list-style: none;
    }

    .docs-left-section>ul>li>a {
        text-decoration: none;
        color: inherit;
    }
</style>
<div class="container chatapp-docs-container">
    <div class="row">
        <div class="docs-left-section col-3">
            <ul>
                <li><a href="#overview">Overview</a></li>
                <li><a href="#setup">Setup</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#usage">Usage</a></li>
                <li><a href="#faqs">FAQs</a></li>
            </ul>
        </div>
        <div class="chatapp-docs-section docs-right-section col-9">
            <div class="title-section">
                <h1>Documentation for ChatApp</h1>
                <span>A real-time chat application</span>
            </div>
            <div class="overview-section" id="overview">
                <h3>1. Overview</h3>
                The Real-Time Chat Application, <a href="https://chatapp.techenfield.com">ChatApp</a>, is a <a
                    href="https://laravel.com/">Laravel</a>-based web app that allows users to communicate in real
                time. It uses <a href="https://github.com/laravel/ui">Laravel/ui</a> with <a
                    href="https://getbootstrap.com/">Bootstrap</a> for authentication and user interface, and <a
                    href="https://pusher.com/">Pusher</a> for real-time messaging. A user need unique username to login
                and
                be friend with other to chat. The lifespan of the chats
                are 24 hours or we can say one day only.
            </div>
            <div class="setup-section" id="setup">
                <h3>2. Setup</h3>
                <h4>Technology used</h4>
                <ul>
                    <li><a href="https://laravel.com/">Laravel</a></li>
                    <li><a href="https://pusher.com">Pusher</a></li>

                </ul>
            </div>
            <div class="features-section" id="features">
                <h3>3. Features</h3>
                <ul>
                    <li><strong>Real-Time Messaging</strong>: Users can send and receive messages in real time. </li>
                    <li><strong></strong></li>
                    <li><strong></strong></li>
                </ul>
            </div>
            <div class="usage-section" id="usage">
                <h3>4. Usage</h3>
            </div>
            <div class="faqs-section" id="faqs">
                <h3>5. FAQs</h3>
            </div>
        </div>
    </div>
</div>
@endsection
