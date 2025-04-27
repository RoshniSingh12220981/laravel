<!-- resources/views/admin/feedback-list.blade.php -->
@extends('layouts.app')

@section('title', 'Manage Feedback')
@section('header', 'Manage Feedback')

@section('content')
    <div class="mb-6">
        <form action="{{ route('admin.feedback.index') }}" method="GET" class="flex flex-wrap gap-4">
            <div>
                <select name="status" class="border rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                </select>
            </div>
            <div>
                <select name="issue_type" class="border rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="">All Issue Types</option>
                    <option value="power_outage" {{ request('issue_type') == 'power_outage' ? 'selected' : '' }}>Power Outage</option>
                    <option value="voltage_fluctuation" {{ request('issue_type') == 'voltage_fluctuation' ? 'selected' : '' }}>Voltage Fluctuation</option>
                    <option value="damaged_infrastructure" {{ request('issue_type') == 'damaged_infrastructure' ? 'selected' : '' }}>Damaged Infrastructure</option>
                    <option value="billing_issue" {{ request('issue_type') == 'billing_issue' ? 'selected' : '' }}>Billing Issue</option>
                    <option value="other" {{ request('issue_type') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div>
                <select name="severity" class="border rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="">All Severities</option>
                    <option value="low" {{ request('severity') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ request('severity') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ request('severity') == 'high' ? 'selected' : '' }}>High</option>
                    <option value="critical" {{ request('severity') == 'critical' ? 'selected' : '' }}>Critical</option>
                </select>
            </div>
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title or location" 
                    class="border rounded px-3 py-2 w-full md:w-64">
            </div>
            <div>
                <button type="submit" class="btn">Filter</button>
                @if(request('status') || request('issue_type') || request('severity') || request('search'))
                    <a href="{{ route('admin.feedback.index') }}" class="btn btn-secondary ml-2">Clear</a>
                @endif
            </div>
        </form>
    </div>

    @if($feedbacks->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left">Title</th>
                        <th class="py-3 px-4 text-left">User</th>
                        <th class="py-3 px-4 text-left">Location</th>
                        <th class="py-3 px-4 text-left">Issue Type</th>
                        <th class="py-3 px-4 text-left">Severity</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-left">Date</th>
                        <th class="py-3 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($feedbacks as $feedback)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $feedback->title }}</td>
                            <td class="py-3 px-4">{{ $feedback->user->name }}</td>
                            <td class="py-3 px-4">{{ Str::limit($feedback->location, 30) }}</td>
                            <td class="py-3 px-4">{{ ucfirst(str_replace('_', ' ', $feedback->issue_type)) }}</td>
                            <td class="py-3 px-4">
                                <span class="
                                    @if($feedback->severity == 'low') bg-green-100 text-green-800 
                                    @elseif($feedback->severity == 'medium') bg-blue-100 text-blue-800
                                    @elseif($feedback->severity == 'high') bg-orange-100 text-orange-800
                                    @elseif($feedback->severity == 'critical') bg-red-100 text-red-800
                                    @endif
                                    px-2 py-1 rounded-full text-xs
                                ">
                                    {{ ucfirst($feedback->severity) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="
                                    @if($feedback->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($feedback->status == 'in_progress') bg-blue-100 text-blue-800
                                    @elseif($feedback->status == 'resolved') bg-green-100 text-green-800
                                    @endif
                                    px-2 py-1 rounded-full text-xs
                                ">
                                    {{ ucfirst(str_replace('_', ' ', $feedback->status)) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">{{ $feedback->created_at->format('M d, Y') }}</td>
                            <td class="py-3 px-4">
                                <a href="{{ route('admin.feedback.show', $feedback->id) }}" class="text-blue-600 hover:underline">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $feedbacks->links() }}
        </div>
    @else
        <div class="text-center py-8">
            <p class="text-gray-500">No feedback found matching your criteria.</p>
        </div>
    @endif
@endsection