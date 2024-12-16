<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        $guard = $request->route()->action["middleware"][1] ?? 'web';
        $guard = explode(':', $guard)[1] ?? null;

        switch ($guard) {
            case 'admin':
                return route('admin.login');
            default:
                return route('login');
        }
    }
}
