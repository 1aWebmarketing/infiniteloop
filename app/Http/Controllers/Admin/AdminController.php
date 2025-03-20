<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function index()
    {
        $response = Http::withToken(auth()->user()->github_token)
            ->get('https://api.github.com/user/repos')->json();

        $repos = [];
        foreach ($response as $repo) {
            if('.github' === $repo['name']) continue;

            $repos[$repo['id']] = array(
                'name' => $repo['name'],
                'owner' => $repo['owner']['login'],
            );
        }

        return view('admin.index', [
            'repos' => $repos,
        ]);
    }
}
