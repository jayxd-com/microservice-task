<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $permission)
    {
        $user = $request->user();  // Using request user might be more flexible for tests or different guards

        // Check if user exists, has a role, the role has permissions, and the permission is in the permissions array
        if ($user && optional($user->role)->permissions && in_array($permission, $user->role->permissions)) {
            return $next($request);
        }
        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
