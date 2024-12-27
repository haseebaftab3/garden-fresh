<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function shareLink(Request $request)
    {
        // Get the link from the request
        $link = $request->input('link');

        // Return a success response or perform additional actions like logging
        return back()->with('success', 'Link copied successfully!');
    }
}
