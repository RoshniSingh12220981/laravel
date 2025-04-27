<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('header', 'Admin Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-blue-50 p-4 rounded-lg shadow text-center">
            <div class="text-3xl font-bold text-blue-700">{{ $totalFeedback }}</div>
            <div class="text-gray-600">Total Feedback</div>
        </div>
        <div class="bg-yellow-50 p-4 rounded-lg shadow text-center">
            <div class="text-3xl font-bold text-yellow-700">{{ $pendingFeedback }}</div>
            <div class="text-gray-600">Pending</div>
        </div>
        <div class="bg-indigo-50 p-4 rounded-lg shadow text-center">
            <div class="text-3xl font-bold text-indigo-700">{{ $inProgressFeedback }}</div>
            <div class="text-gray-600">In Progress</div>
        </div>
        <div class="bg-green-50 p-4 rounded-lg shadow text-center">
            <div class="text-3xl font-bold text-green-700">{{ $resolvedFeedback }}</div>
            <div class="text-gray-600">Resolved</div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="font-semibold text-lg mb-4">Recent Feedback</h3>
            
            @if($recentFeedback->count() > 0)
                <div class="space-y-3">
                    @foreach($recentFeedback as $feedback)
                        <a href="{{ route('admin.feedback.show', $feedback->id) }}" class="block border rounded p-3 hover:bg-gray-50">
                            <div class="flex justify-between">
                                <span class="font-medium">{{ $feedback->title }}</span>
                                <span class="
                                    @if($feedback->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($feedback->status == 'in_progress') bg-blue-100 text-blue-800
                                    @elseif($feedback->status == 'resolved') bg-green-100 text-green-800
                                    @endif
                                    px-2 rounded text-xs
                                ">
                                    {{ ucfirst(str_replace('_', ' ', $feedback->status)) }}
                                </span>
                            </div>
                            <div class="text-gray-500 text-sm mt-1">{{ $feedback->user->name }} - {{ $feedback->created_at->format('M d, Y') }}</div>
                        </a>
                    @endforeach
                </div>
                <div class="mt-4 text-right">
                    <a href="{{ route('admin.feedback.index') }}" class="text-blue-600 hover:underline">View all</a>
                </div>
            @else
                <p class="text-gray-500">No feedback submissions yet.</p>
            @endif
        </div>
        
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="font-semibold text-lg mb-4">Issue Types Breakdown</h3>
            
            <div class="space-y-3">
                <div class="flex items-center">
                    <div class="w-32">Power Outage</div>
                    <div class="flex-1 bg-gray-200 rounded-full h-4">
                        <div class="bg-red-500 h-4 rounded-full" style="width: {{ $issueTypePercentages['power_outage'] ?? 0 }}%"></div>
                    </div>
                    <div class="w-16 text-right">{{ $issueTypePercentages['power_outage'] ?? 0 }}%</div>
                </div>
                
                <div class="flex items-center">
                    <div class="w-32">Voltage Fluctuation</div>
                    <div class="flex-1 bg-gray-200 rounded-full h-4">
                        <div class="bg-orange-500 h-4 rounded-full" style="width: {{ $issueTypePercentages['voltage_fluctuation'] ?? 0 }}%"></div>
                    </div>
                    <div class="w-16 text-right">{{ $issueTypePercentages['voltage_fluctuation'] ?? 0 }}%</div>
                </div>
                
                <div class="flex items-center">
                    <div class="w-32">Damaged Infrastructure</div>
                    <div class="flex-1 bg-gray-200 rounded-full h-4">
                        <div class="bg-blue-500 h-4 rounded-full" style="width: {{ $issueTypePercentages['damaged_infrastructure'] ?? 0 }}%"></div>
                    </div>
                    <div class="w-16 text-right">{{ $issueTypePercentages['damaged_infrastructure'] ?? 0 }}%</div>
                </div>
                
                <div class="flex items-center">
                    <div class="w-32">Billing Issue</div>
                    <div class="flex-1 bg-gray-200 rounded-full h-4">
                        <div class="bg-purple-500 h-4 rounded-full" style="width: {{ $issueTypePercentages['billing_issue'] ?? 0 }}%"></div>
                    </div>
                    <div class="w-16 text-right">{{ $issueTypePercentages['billing_issue'] ?? 0 }}%</div>
                </div>
                
                <div class="flex items-center">
                    <div class="w-32">Other</div>
                    <div class="flex-1 bg-gray-200 rounded-full h-4">
                        <div class="bg-gray-500 h-4 rounded-full" style="width: {{ $issueTypePercentages['other'] ?? 0 }}%"></div>
                    </div>
                    <div class="w-16 text-right">{{ $issueTypePercentages['other'] ?? 0 }}%</div>
                </div>
            </div>
            
            <div class="mt-6 text-right">
                <a href="{{ route('admin.statistics') }}" class="text-blue-600 hover:underline">View detailed statistics</a>
            </div>
        </div>
    </div>
@endsection