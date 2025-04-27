<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of all feedback.
     */
    public function index(Request $request)
    {
        $query = Feedback::with('user');
        
        // Apply filters if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('issue_type')) {
            $query->where('issue_type', $request->issue_type);
        }
        
        if ($request->filled('severity')) {
            $query->where('severity', $request->severity);
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }
        
        // Get paginated results
        $feedbacks = $query->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();
        
        return view('admin.feedback-list', compact('feedbacks'));
    }

    /**
     * Display the specified feedback.
     */
    public function show(Feedback $feedback)
    {
        return view('admin.feedback-show', compact('feedback'));
    }

    /**
     * Update the specified feedback.
     */
    public function update(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,in_progress,resolved',
            'admin_response' => 'nullable|string',
        ]);
        
        // Update the feedback
        $feedback->status = $validated['status'];
        $feedback->admin_response = $validated['admin_response'];
        $feedback->save();
        
        return redirect()->route('admin.feedback.show', $feedback->id)
            ->with('success', 'Feedback updated successfully.');
    }
}