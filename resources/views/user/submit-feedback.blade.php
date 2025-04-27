<!-- resources/views/user/submit-feedback.blade.php -->
@extends('layouts.app')

@section('title', 'Submit Feedback')
@section('header', 'Submit Feedback')

@section('content')
    <div class="max-w-2xl mx-auto">
        <form action="{{ route('user.feedback.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Issue Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500"
                    placeholder="Brief title describing the issue">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <input type="text" name="location" id="location" value="{{ old('location') }}" 
                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500"
                    placeholder="Address or location where the issue occurred">
                @error('location')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="issue_type" class="block text-sm font-medium text-gray-700 mb-1">Issue Type</label>
                <select name="issue_type" id="issue_type" 
                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500">
                    <option value="">Select Issue Type</option>
                    <option value="power_outage" {{ old('issue_type') == 'power_outage' ? 'selected' : '' }}>Power Outage</option>
                    <option value="voltage_fluctuation" {{ old('issue_type') == 'voltage_fluctuation' ? 'selected' : '' }}>Voltage Fluctuation</option>
                    <option value="damaged_infrastructure" {{ old('issue_type') == 'damaged_infrastructure' ? 'selected' : '' }}>Damaged Infrastructure</option>
                    <option value="billing_issue" {{ old('issue_type') == 'billing_issue' ? 'selected' : '' }}>Billing Issue</option>
                    <option value="other" {{ old('issue_type') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('issue_type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="5" 
                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500"
                    placeholder="Please provide a detailed description of the issue">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="severity" class="block text-sm font-medium text-gray-700 mb-1">Severity</label>
                <div class="flex space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="severity" value="low" {{ old('severity') == 'low' ? 'checked' : '' }}
                            class="text-blue-600 focus:ring focus:ring-blue-200">
                        <span class="ml-2">Low</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="severity" value="medium" {{ old('severity') == 'medium' ? 'checked' : '' }}
                            class="text-blue-600 focus:ring focus:ring-blue-200">
                        <span class="ml-2">Medium</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="severity" value="high" {{ old('severity') == 'high' ? 'checked' : '' }}
                            class="text-blue-600 focus:ring focus:ring-blue-200">
                        <span class="ml-2">High</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="severity" value="critical" {{ old('severity') == 'critical' ? 'checked' : '' }}
                            class="text-blue-600 focus:ring focus:ring-blue-200">
                        <span class="ml-2">Critical</span>
                    </label>
                </div>
                @error('severity')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn">Submit Feedback</button>
            </div>
        </form>
    </div>
@endsection