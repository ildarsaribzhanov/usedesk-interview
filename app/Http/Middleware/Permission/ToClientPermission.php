<?php

namespace App\Http\Middleware\Permission;

use App\Models\User;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;

/**
 * Class ToClientPermission
 *
 * @package App\Http\Middleware\Permission
 */
class ToClientPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     * @throws AuthorizationException
     */
    public function handle($request, Closure $next)
    {
        $client_id = $request->route('client_id', null);

        if (is_null($client_id)) {
            $client_id = $request->route('id', null);
        }

        if (!$client_id) {
            return $next($request);
        }

        $currentUser = $request->user();

        /** @var User $currentUser */
        if (!$currentUser->hasClientAccess($client_id)) {
            throw new AuthorizationException('Указанный клиент не доступен');
        }

        return $next($request);
    }
}
