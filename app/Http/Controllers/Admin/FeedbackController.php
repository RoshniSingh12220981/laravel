<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the feedback.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Feedback::where('user_id', $user->id);
        
        // Apply filters if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('issue_type')) {
            $query->where('issue_type', $request->issue_type);
        }
        
        // Get paginated results
        $feedbacks = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();
        
        return view('user.feedback-history', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new feedback.
     */
    public function create()
    {
        return view('user.submit-feedback');
    }

    /**
     * Store a newly created feedback in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'issue_type' => 'required|string|in:power_outage,voltage_fluctuation,damaged_infrastructure,billing_issue,other',
            'description' => 'required|string',
            'severity' => 'required|string|in:low,medium,high,critical',
        ]);
        
        // Create the feedback
        $feedback = new Feedback();
        $feedback->user_id = auth()->id();
        $feedback->title = $validated['title'];
        $feedback->location = $validated['location'];
        $feedback->issue_type = $validated['issue_type'];
        $feedback->description = $validated['description'];
        $feedback->severity = $validated['severity'];
        $feedback->status = 'pending'; // Default status
        $feedback->save();
        
        return redirect()->route('user.feedback.index')
            ->with('success', 'Your feedback has been submitted successfully.');
    }

    /**
     * Display the specified feedback.
     */
    public function show(Feedback $feedback)
    {
        // Check if the feedback belongs to the authenticated user
        if ($feedback->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('user.feedback-show', compact('feedback'));
    }
}