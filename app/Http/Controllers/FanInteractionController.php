<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ArtistQaSession;
use App\Models\QaQuestion;
use App\Models\ExclusivePreview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FanInteractionController extends Controller
{
    public function qaSessions(Request $request)
    {
        $query = ArtistQaSession::with('artist')
            ->where('is_active', true)
            ->where('status', '!=', 'cancelled');

        if ($request->filled('artist_id')) {
            $query->where('artist_id', $request->artist_id);
        }

        $sessions = $query->latest('scheduled_at')->paginate(20);

        return view('fan-interaction.qa-sessions', compact('sessions'));
    }

    public function viewQaSession($sessionId)
    {
        $session = ArtistQaSession::with(['artist', 'questions.user'])
            ->where('is_active', true)
            ->findOrFail($sessionId);

        // Check access
        $hasAccess = $this->checkAccess($session->access_type);

        if (!$hasAccess) {
            abort(403, 'You do not have access to this Q&A session.');
        }

        return view('fan-interaction.view-qa-session', compact('session'));
    }

    public function askQuestion(Request $request, $sessionId)
    {
        $session = ArtistQaSession::findOrFail($sessionId);

        $hasAccess = $this->checkAccess($session->access_type);

        if (!$hasAccess) {
            return back()->with('error', 'You do not have access to ask questions in this session.');
        }

        $validated = $request->validate([
            'question' => 'required|string|max:1000',
        ]);

        QaQuestion::create([
            'qa_session_id' => $sessionId,
            'user_id' => Auth::id(),
            'question' => $validated['question'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Question submitted successfully!');
    }

    public function upvoteQuestion($questionId)
    {
        $question = QaQuestion::findOrFail($questionId);
        $question->increment('upvotes');

        return response()->json(['success' => true, 'upvotes' => $question->upvotes]);
    }

    public function previews(Request $request)
    {
        $query = ExclusivePreview::with('artist')
            ->where('is_active', true)
            ->where(function($q) {
                $q->whereNull('expiry_date')
                  ->orWhere('expiry_date', '>=', now());
            });

        if ($request->filled('artist_id')) {
            $query->where('artist_id', $request->artist_id);
        }

        $previews = $query->latest('release_date')->paginate(20);

        return view('fan-interaction.previews', compact('previews'));
    }

    private function checkAccess($accessType)
    {
        $user = Auth::user();

        switch ($accessType) {
            case 'public':
                return true;
            case 'all_subscribers':
                return $user->usersubscription_id !== null;
            case 'premium_only':
                // Check if user has premium subscription
                return $user->usersubscription_id !== null;
            case 'super_listeners_only':
                // Check if user is a super listener
                return false; // Implement super listener check
            default:
                return false;
        }
    }
}
