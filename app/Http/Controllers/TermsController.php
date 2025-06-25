<?php

namespace App\Http\Controllers;

use App\Http\Requests\TermsAcceptRequest;

class TermsController extends Controller
{
    public function index()
    {
        return view('terms');
    }

    public function store(TermsAcceptRequest $request)
    {
        auth()->user()->update([
            'terms_accepted_at' => now(),
        ]);

        return redirect()->route('dashboard');
    }
}
