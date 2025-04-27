<!-- resources/views/admin/statistics.blade.php -->
@extends('layouts.app')

@section('title', 'Feedback Statistics')
@section('header', 'Feedback Statistics and Analytics')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg mb-4">Status Breakdown</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between mb-1">
                        <span>Pending</span>
                        <span>{{ $statusCounts['pending'] ?? 0 }} ({{ $statusPercentages['pending'] ?? 0 }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-yellow-500 h-4 rounded-full" style="width: {{ $statusPercentages['pending'] ?? 0 }}%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between mb-1">
                        <span>In Progress</span>
                        <span>{{ $statusCounts['in_progress'] ?? 0 }} ({{ $statusPercentages['in_progress'] ?? 0 }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-blue-500 h-4 rounded-full" style="width: {{ $statusPercentages['in_progress'] ?? 0 }}%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between mb-1">
                        <span>Resolved</span>
                        <span>{{ $statusCounts['resolved'] ?? 0 }} ({{ $statusPercentages['resolved'] ?? 0 }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-green-500 h-4 rounded-full" style="width: {{ $statusPercentages['resolved'] ?? 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg mb-4">Severity Distribution</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between mb-1">
                        <span>Low</span>
                        <span>{{ $severityCounts['low'] ?? 0 }} ({{ $severityPercentages['low'] ?? 0 }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-green-500 h-4 rounded-full" style="width: {{ $severityPercentages['low'] ?? 0 }}%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between mb-1">
                        <span>Medium</span>
                        <span>{{ $severityCounts['medium'] ?? 0 }} ({{ $severityPercentages['medium'] ?? 0 }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-blue-500 h-4 rounded-full" style="width: {{ $severityPercentages['medium'] ?? 0 }}%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between mb-1">
                        <span>High</span>
                        <span>{{ $severityCounts['high'] ?? 0 }} ({{ $severityPercentages['high'] ?? 0 }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-orange-500 h-4 rounded-full" style="width: {{ $severityPercentages['high'] ?? 0 }}%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between mb-1">
                        <span>Critical</span>
                        <span>{{ $severityCounts['critical'] ?? 0 }} ({{ $severityPercentages['critical'] ?? 0 }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-red-500 h-4 rounded-full" style="width: {{ $severityPercentages['critical'] ?? 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg mb-4">Issue Types</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between mb-1">
                        <span>Power Outage</span>
                        <span>{{ $issueTypeCounts['power_outage'] ?? 0 }} ({{ $issueTypePercentages['power_outage'] ?? 0 }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-red-500 h-4 rounded-full" style="width: {{ $issueTypePercentages['power_outage'] ?? 0 }}%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between mb-1">
                        <span>Voltage Fluctuation</span>
                        <span>{{ $issueTypeCounts['voltage_fluctuation'] ?? 0 }} ({{ $issueTypePercentages['voltage_fluctuation'] ?? 0 }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-orange-500 h-4 rounded-full" style="width: {{ $issueTypePercentages['voltage_fluctuation'] ?? 0 }}%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between mb-1">
                        <span>Damaged Infrastructure</span>
                        <span>{{ $issueTypeCounts['damaged_infrastructure'] ?? 0 }} ({{ $issueTypePercentages['damaged_infrastructure'] ?? 0 }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-blue-500 h-4 rounded-full" style="width: {{ $issueTypePercentages['damaged_infrastructure'] ?? 0 }}%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between mb-1">
                        <span>Billing Issue</span>
                        <span>{{ $issueTypeCounts['billing_issue'] ?? 0 }} ({{ $issueTypePercentages['billing_issue'] ?? 0 }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-purple-500 h-4 rounded-full" style="width: {{ $issueTypePercentages['billing_issue'] ?? 0 }}%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between mb-1">
                        <span>Other</span>
                        <span>{{ $issueTypeCounts['other'] ?? 0 }} ({{ $issueTypePercentages['other'] ?? 0 }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-gray-500 h-4 rounded-full" style="width: {{ $issueTypePercentages['other'] ?? 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg mb-4">Monthly Trends</h3>
            <div class="h-64">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 gap-8 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg mb-4">Response Time Analytics</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 text-left">Issue Type</th>
                            <th class="py-3 px-4 text-right">Avg. Response Time</th>
                            <th class="py-3 px-4 text-right">Avg. Resolution Time</th>
                            <th class="py-3 px-4 text-right">Total Resolved</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($issueTypes as $type => $label)
                            <tr>
                                <td class="py-3 px-4">{{ ucfirst(str_replace('_', ' ', $type)) }}</td>
                                <td class="py-3 px-4 text-right">{{ $avgResponseTimes[$type] ?? 'N/A' }}</td>
                                <td class="py-3 px-4 text-right">{{ $avgResolutionTimes[$type] ?? 'N/A' }}</td>
                                <td class="py-3 px-4 text-right">{{ $resolvedCounts[$type] ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Monthly trends chart
        const ctx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($monthlyLabels),
                datasets: [
                    {
                        label: 'Feedback Submissions',
                        data: @json($monthlyData),
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.1,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    });
</script>
@endpush