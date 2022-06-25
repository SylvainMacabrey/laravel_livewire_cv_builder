<?php

namespace App\Http\Controllers\Profile\Experience;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('profile.experiences.show', [
            'user' => auth()->user()->load('profile.experiences'),
        ]);
    }
}
