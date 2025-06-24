@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow border-0">
        <div class="card-body text-center">
            <h2 class="text-success fw-bold">🙋‍♂️ User Dashboard</h2>
            <p class="mt-3">Welcome, {{ Auth::user()->name }}!</p>
            <p class="text-muted">Here you can explore and submit published forms.</p>

            <a href="{{ route('user.forms') }}" class="btn btn-primary mt-3">
                📋 View Available Forms
            </a>
        </div>
    </div>
</div>
@endsection
