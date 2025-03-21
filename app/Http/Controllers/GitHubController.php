<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Laravel\Socialite\Facades\Socialite;

class GitHubController extends Controller
{
    public function index()
    {
        return Socialite::driver('github')
            ->scopes(['repo', 'admin:org'])
            ->redirect();
    }

    public function store()
    {
        $githubUser = Socialite::driver('github')->user();

        Setting::set('github_token', $githubUser->token, auth()->user()->currentTeam->id);

        return redirect()
            ->route('teams.show', auth()->user()->currentTeam->id)
            ->with('success', 'GitHub connected!');
    }
}
