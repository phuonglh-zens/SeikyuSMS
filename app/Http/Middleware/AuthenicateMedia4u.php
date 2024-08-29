<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserInfo;
use App\Models\User;

class AuthenicateMedia4u
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        $tokenTemplate = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvZGV2LWlrdW4ubXl6ZW5zLm5ldFwvYXBpXC9kZXZlbG9wbWVudFwvbG9naW4iLCJpYXQiOjE3MjA0OTQyMjYsIm5iZiI6MTcyMDQ5NDIyNiwianRpIjoiNUZmTDBtRUhHREtod21sSSIsInN1YiI6MTExMywicHJ2IjoiNDBhOTdmY2EyZDQyNGU3NzhhMDdhMGEyZjEyZGM1MTdhODVjYmRjMSJ9.quln9DNRvUajlS7lgltv389UNnpv1wGK87iGios2rFA";

        if($token !== $tokenTemplate) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        return $next($request);
    }
}
