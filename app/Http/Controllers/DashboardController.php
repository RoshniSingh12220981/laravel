<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the appropriate dashboard based on user role.
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Display the user dashboard.
     */
    public function userDashboard()
    {
        $user = auth()->user();
        
        // Get feedback statistics for the user
        $totalFeedback = Feedback::where('user_id', $user->id)->count();
        $pendingFeedback = Feedback::where('user_id', $user->id)->where('status', 'pending')->count();
        $inProgressFeedback = Feedback::where('user_id', $user->id)->where('status', 'in_progress')->count();
        $resolvedFeedback = Feedback::where('user_id', $user->id)->where('status', 'resolved')->count();
        
        // Get recent feedback
        $recentFeedback = Feedback::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('user.dashboard', compact(
            'totalFeedback',
            'pendingFeedback',
            'inProgressFeedback',
            'resolvedFeedback',
            'recentFeedback'
        ));
    }

    /**
     * Display the admin dashboard.
     */
    public function adminDashboard()
    {
        // Get feedback statistics
        $totalFeedback = Feedback::count();
        $pendingFeedback = Feedback::where('status', 'pending')->count();
        $inProgressFeedback = Feedback::where('status', 'in_progress')->count();
        $resolvedFeedback = Feedback::where('status', 'resolved')->count();
        
        // Get recent feedback
        $recentFeedback = Feedback::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Calculate issue type percentages
        $issueTypePercentages = [];
        $issueTypeCounts = Feedback::select('issue_type', DB::raw('count(*) as count'))
            ->groupBy('issue_type')
            ->pluck('count', 'issue_type')
            ->toArray();
            
        if ($totalFeedback > 0) {
            foreach ($issueTypeCounts as $type => $count) {
                $issueTypePercentages[$type] = round(($count / $totalFeedback) * 100);
            }
        }
        
        return view('admin.dashboard', compact(
            'totalFeedback',
            'pendingFeedback',
            'inProgressFeedback',
            'resolvedFeedback',
            'recentFeedback',
            'issueTypePercentages'
        ));
    }
}