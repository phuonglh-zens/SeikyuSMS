<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserInfo;
use App\Models\User;

class AuthenticateByUuid
{
    public function handle(Request $request, Closure $next)
    {
        $uuid = $request->header('uuid');

        if (!$uuid) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }
        

        $user = UserInfo::where('uuid', $uuid)->first();

        if (!$user) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        Auth::login($user);

        return $next($request);
    }
}
