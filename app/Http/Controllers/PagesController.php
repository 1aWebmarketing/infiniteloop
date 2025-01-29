<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function changelog()
    {
        $changelog = getAppChangelog();

        return view('pages/changelog', compact('changelog'));
    }
}
