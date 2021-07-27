<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Clearance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->isAdmin()) {
            return $next($request);
        }

        /**
         * Managing User Routes
         */

        if ($request->is('admin/users'))
        {
            if ($request->isMethod('GET')  && auth()->user()->hasPermissionTo('See All Users')) {
                return $next($request);
            } elseif ($request->isMethod('POST')  && auth()->user()->hasPermissionTo('Save User')) {
                return $next($request);
            } else {
                abort('401');
            }
        }

        if ($request->is('admin/users/create'))
        {
            if ($request->isMethod('GET')  && auth()->user()->hasPermissionTo('Create User')) {
                return $next($request);
            } else {
                abort('401');
            }
        }

        if ($request->is('admin/users/*/edit')) {
            if ($request->isMethod('GET')  && auth()->user()->hasPermissionTo('Edit User')) {
                return $next($request);
            } else {
                abort('401');
            }
        }

        if ($request->is('admin/users/*')) {
            if ($request->isMethod('DELETE')  && auth()->user()->hasPermissionTo('Delete User')) {
                return $next($request);
            } elseif ($request->isMethod('PATCH')  && auth()->user()->hasPermissionTo('Update User')) {
                return $next($request);
            } elseif ($request->isMethod('GET')  && auth()->user()->hasPermissionTo('See User')) {
                return $next($request);
            } else {
                abort('401');
            }
        }

        /**
         * Manage Roles
         */

        if ($request->is('admin/roles'))
        {
            if ($request->isMethod('GET')  && auth()->user()->hasPermissionTo('See All Roles')) {
                return $next($request);
            } elseif ($request->isMethod('POST')  && auth()->user()->hasPermissionTo('Save Role')) {
                return $next($request);
            } else {
                abort('401');
            }
        }

        if ($request->is('admin/roles/create'))
        {
            if ($request->isMethod('GET')  && auth()->user()->hasPermissionTo('Create Role')) {
                return $next($request);
            } else {
                abort('401');
            }
        }

        if ($request->is('admin/roles/*/edit')) {
            if ($request->isMethod('GET')  && auth()->user()->hasPermissionTo('Edit Role')) {
                return $next($request);
            } else {
                abort('401');
            }
        }

        if ($request->is('admin/roles/*')) {
            if ($request->isMethod('DELETE')  && auth()->user()->hasPermissionTo('Delete Role')) {
                return $next($request);
            } elseif ($request->isMethod('PATCH')  && auth()->user()->hasPermissionTo('Update Role')) {
                return $next($request);
            } elseif ($request->isMethod('GET')  && auth()->user()->hasPermissionTo('See Role')) {
                return $next($request);
            } else {
                abort('401');
            }
        }

        /**
         * Manage Permission Routes
         */

        if ($request->is('admin/permissions'))
        {
            if ($request->isMethod('GET')  && auth()->user()->hasPermissionTo('See All Permissions')) {
                return $next($request);
            } elseif ($request->isMethod('POST')  && auth()->user()->hasPermissionTo('Save Permission')) {
                return $next($request);
            } else {
                abort('401');
            }
        }

        if ($request->is('admin/permissions/create'))
        {
            if ($request->isMethod('GET')  && auth()->user()->hasPermissionTo('Create Permission')) {
                return $next($request);
            } else {
                abort('401');
            }
        }

        if ($request->is('admin/permissions/*/edit')) {
            if ($request->isMethod('GET')  && auth()->user()->hasPermissionTo('Edit Permission')) {
                return $next($request);
            } else {
                abort('401');
            }
        }

        if ($request->is('admin/permissions/*')) {
            if ($request->isMethod('DELETE')  && auth()->user()->hasPermissionTo('Delete Permission')) {
                return $next($request);
            } elseif ($request->isMethod('PATCH')  && auth()->user()->hasPermissionTo('Update Permission')) {
                return $next($request);
            } elseif ($request->isMethod('GET')  && auth()->user()->hasPermissionTo('See Permission')) {
                return $next($request);
            } else {
                abort('401');
            }
        }

        return $next($request);
    }
}

// [
//     ['name' => 'See All Roles', 'guard_name' => 'web'],
//     ['name' => 'Create Role', 'guard_name' => 'web'],
//     ['name' => 'Edit Role', 'guard_name' => 'web'],
//     ['name' => 'Delete Role', 'guard_name' => 'web'],
//     ['name' => 'Save Role', 'guard_name' => 'web'],
//     ['name' => 'Update Role', 'guard_name' => 'web'],
//     ['name' => 'See Role', 'guard_name' => 'web'],
//     ['name' => 'See All Permissions', 'guard_name' => 'web'],
//     ['name' => 'Create Permission', 'guard_name' => 'web'],
//     ['name' => 'Edit Permission', 'guard_name' => 'web'],
//     ['name' => 'Delete Permission', 'guard_name' => 'web'],
//     ['name' => 'Save Permission', 'guard_name' => 'web'],
//     ['name' => 'Update Permission', 'guard_name' => 'web'],
//     ['name' => 'See Permission', 'guard_name' => 'web'],
// ]
