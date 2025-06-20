{{-- @extends('layouts.app')
@section('title', 'Home')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3 shadow" style="background: linear-gradient(to right, #f9f871, #fceabb);">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-5 fw-bold">Welcome to FormBuilder 🛠️</h1>
                    <p class="fs-5 mt-3">Build, publish, and manage powerful forms with ease. Admins create, users respond — all in one place.</p>
                    <a href="{{ url('/register') }}" class="btn btn-primary btn-lg mt-3">Get Started</a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="https://cdn.pixabay.com/photo/2020/06/21/16/25/form-5321931_960_720.png" alt="Form Illustration" class="img-fluid" style="max-height: 350px;">
                </div>
            </div>
        </div>
    </div>
@endsection --}}















@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3 shadow" style="background: linear-gradient(to right, #f9f871, #fceabb);">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-5 fw-bold">Welcome to FormBuilder 🛠️</h1>
                    <p class="fs-5 mt-3">Build, publish, and manage powerful forms with ease. Admins create, users respond — all in one place.</p>
                    <a href="{{ url('/register') }}" class="btn btn-primary btn-lg mt-3">Get Started</a>
                </div>
                <div class="col-md-6 text-center">
                    <!-- ✅ Lottie Animation Embed -->
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player
                        src="https://lottie.host/d925ab9d-b3b6-4c2e-b3a5-ae830ba46c69/lbWyoK4kB8.lottie"
                        background="transparent"
                        speed="1"
                        style="width: 300px; height: 300px"
                        loop
                        autoplay>
                    </dotlottie-player>
                </div>
            </div>
        </div>
    </div>
@endsection
