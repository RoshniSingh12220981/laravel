<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
    <script>
        // Redirect based on user role
        window.onload = function() {
            @if(auth()->user()->is_admin)
                window.location.href = "{{ route('admin.dashboard') }}";
            @else
                window.location.href = "{{ route('user.dashboard') }}";
            @endif
        }
    </script>
    
    <div class="text-center py-8">
        <p>Redirecting to your dashboard...</p>
    </div>
@endsection