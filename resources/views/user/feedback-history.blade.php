<!-- resources/views/user/feedback-history.blade.php -->
@extends('layouts.app')

@section('title', 'Feedback History')
@section('header', 'My Feedback History')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <form action="{{ route('user.feedback.index') }}" method="GET" class="flex space-x-4">
                <div>
                    <select name="status" class="border rounded px-3 py-1" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                    </select>
                </div>
                <div>
                    <select name="issue_type" class="border rounded px-3 py-1" onchange="this.form.submit()">
                        <option value="">All Issue Types</option>
                        <option value="power_outage" {{ request('issue_type') == 'power_outage' ? 'selected' : '' }}>Power Outage</option>
                        <option value="voltage_fluctuation" {{ request('issue_type') == 'voltage_fluctuation' ? 'selected' : '' }}>Voltage Fluctuation</option>
                        <option value="damaged_infrastructure" {{ request('issue_type') == 'damaged_infrastructure' ? 'selected' : '' }}>Damaged Infrastructure</option>
                        <option value="billing_issue" {{ request('issue_type') == 'billing_issue' ? 'selected' : '' }}>Billing Issue</option>
                        <option value="other" {{ request('issue_type') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
            </form>
        </div>
        <a href="{{ route('user.feedback.create') }}" class="btn">Submit New Feedback</a>
    </div>

    @if($feedbacks->count() > 0)
        <div class="space-y-6">
            @foreach($feedbacks as $feedback)
                <div class="border rounded-lg overflow-hidden">
                    <div class="p-4 bg-gray-50 border-b flex justify-between items-center">
                        <h3 class="font-medium">{{ $feedback->title }}</h3>
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
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-sm text-gray-500">Location</p>
                                <p>{{ $feedback->location }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Issue Type</p>
                                <p>{{ ucfirst(str_replace('_', ' ', $feedback->issue_type)) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Submitted On</p>
                                <p>{{ $feedback->created_at->format('M d, Y \a\t h:i A') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Severity</p>
                                <p>{{ ucfirst($feedback->severity) }}</p>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 mb-1">Description</p>
                            <p>{{ $feedback->description }}</p>
                        </div>
                        
                        @if($feedback->admin_response)
                            <div class="mt-4 bg-blue-50 p-4 rounded">
                                <p class="text-sm text-gray-500 mb-1">Admin Response</p>
                                <p>{{ $feedback->admin_response }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $feedbacks->links() }}
        </div>
    @else
        <div class="text-center py-8">
            <p class="text-gray-500 mb-4">You haven't submitted any feedback yet.</p>
            <a href="{{ route('user.feedback.create') }}" class="btn">Submit Your First Feedback</a>
        </div>
    @endif
@endsection