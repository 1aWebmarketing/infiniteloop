<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        $admin = auth()->user();
        $admin->github_token = $githubUser->token;
        $admin->save();

        return redirect('/admin')->with('success', 'GitHub connected!');
    }
}
