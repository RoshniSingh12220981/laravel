<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    /**
     * Display the statistics dashboard.
     */
    public function index()
    {
        // Status statistics
        $totalFeedback = Feedback::count();
        $statusCounts = Feedback::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
            
        $statusPercentages = [];
        if ($totalFeedback > 0) {
            foreach ($statusCounts as $status => $count) {
                $statusPercentages[$status] = round(($count / $totalFeedback) * 100);
            }
        }
        
        // Severity statistics
        $severityCounts = Feedback::select('severity', DB::raw('count(*) as count'))
            ->groupBy('severity')
            ->pluck('count', 'severity')
            ->toArray();
            
        $severityPercentages = [];
        if ($totalFeedback > 0) {
            foreach ($severityCounts as $severity => $count) {
                $severityPercentages[$severity] = round(($count / $totalFeedback) * 100);
            }
        }
        
        // Issue type statistics
        $issueTypeCounts = Feedback::select('issue_type', DB::raw('count(*) as count'))
            ->groupBy('issue_type')
            ->pluck('count', 'issue_type')
            ->toArray();
            
        $issueTypePercentages = [];
        if ($totalFeedback > 0) {
            foreach ($issueTypeCounts as $type => $count) {
                $issueTypePercentages[$type] = round(($count / $totalFeedback) * 100);
            }
        }
        
        // Monthly trends (last 6 months)
        $monthlyData = [];
        $monthlyLabels = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthlyLabels[] = $date->format('M Y');
            
            $count = Feedback::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
                
            $monthlyData[] = $count;
        }
        
        // Response time analytics
        $issueTypes = [
            'power_outage' => 'Power Outage',
            'voltage_fluctuation' => 'Voltage Fluctuation',
            'damaged_infrastructure' => 'Damaged Infrastructure',
            'billing_issue' => 'Billing Issue',
            'other' => 'Other'
        ];
        
        $avgResponseTimes = [];
        $avgResolutionTimes = [];
        $resolvedCounts = [];
        
        foreach ($issueTypes as $type => $label) {
            // Calculate average time to first response (admin_response not null)
            $responseTimeQuery = Feedback::where('issue_type', $type)
                ->whereNotNull('admin_response')
                ->select(DB::raw('AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) as avg_time'))
                ->first();
                
            $avgResponseTimes[$type] = $responseTimeQuery->avg_time ? 
                round($responseTimeQuery->avg_time) . ' hours' : 'N/A';
            
            // Calculate average time to resolution
            $resolutionTimeQuery = Feedback::where('issue_type', $type)
                ->where('status', 'resolved')
                ->select(DB::raw('AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) as avg_time'))
                ->first();
                
            $avgResolutionTimes[$type] = $resolutionTimeQuery->avg_time ? 
                round($resolutionTimeQuery->avg_time) . ' hours' : 'N/A';
                
            // Count resolved issues by type
            $resolvedCounts[$type] = Feedback::where('issue_type', $type)
                ->where('status', 'resolved')
                ->count();
        }
        
        return view('admin.statistics', compact(
            'statusCounts',
            'statusPercentages',
            'severityCounts',
            'severityPercentages',
            'issueTypeCounts',
            'issueTypePercentages',
            'monthlyLabels',
            'monthlyData',
            'issueTypes',
            'avgResponseTimes',
            'avgResolutionTimes',
            'resolvedCounts'
        ));
    }
}