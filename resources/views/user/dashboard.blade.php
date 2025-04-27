<!-- resources/views/user/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'User Dashboard')
@section('header', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-blue-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Feedback Summary</h3>
            <div class="flex items-center justify-between mb-2">
                <span>Total Submitted:</span>
                <span class="font-bold">{{ $totalFeedback }}</span>
            </div>
            <div class="flex items-center justify-between mb-2">
                <span>Pending:</span>
                <span class="font-bold text-yellow-600">{{ $pendingFeedback }}</span>
            </div>
            <div class="flex items-center justify-between mb-2">
                <span>In Progress:</span>
                <span class="font-bold text-blue-600">{{ $inProgressFeedback }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span>Resolved:</span>
                <span class="font-bold text-green-600">{{ $resolvedFeedback }}</span>
            </div>
        </div>
        
        <div class="bg-green-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
            <div class="space-y-4">
                <a href="{{ route('user.feedback.create') }}" class="btn block text-center">
                    Submit New Feedback
                </a>
                <a href="{{ route('user.feedback.index') }}" class="btn btn-secondary block text-center">
                    View Feedback History
                </a>
            </div>
        </div>
    </div>
    
    <div class="mt-8">
        <h3 class="text-lg font-semibold mb-4">Recent Feedback</h3>
        @if($recentFeedback->count() > 0)
            <div class="space-y-4">
                @foreach($recentFeedback as $feedback)
                    <div class="border rounded-lg p-4 hover:bg-gray-50">
                        <div class="flex justify-between">
                            <h4 class="font-medium">{{ $feedback->title }}</h4>
                            <span class="
                                @if($feedback->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($feedback->status == 'in_progress') bg-blue-100 text-blue-800
                                @elseif($feedback->status == 'resolved') bg-green-100 text-green-800
                                @endif
                                px-2 py-1 rounded text-sm
                            ">
                                {{ ucfirst(str_replace('_', ' ', $feedback->status)) }}
                            </span>
                        </div>
                        <p class="text-gray-600 mt-2">{{ Str::limit($feedback->description, 100) }}</p>
                        <div class="mt-2 text-sm text-gray-500">Submitted: {{ $feedback->created_at->format('M d, Y') }}</div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                <a href="{{ route('user.feedback.index') }}" class="text-blue-600 hover:underline">View all feedback →</a>
            </div>
        @else
            <p class="text-gray-500">You haven't submitted any feedback yet.</p>
        @endif
    </div>
@endsection