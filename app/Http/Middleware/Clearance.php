<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
        $routes = Route::getRoutes();

        $grants = array(
            // User Management Routes
            array('url' => 'users', 'method' => 'GET', 'permission' => 'See All Users'),
            array('url' => 'users/create', 'method' => 'GET', 'permission' => 'Create User'),
            // array('url' => 'users', 'method' => 'POST', 'permission' => 'Add User'),
            array('url' => 'users/*', 'method' => 'GET', 'permission' => 'See User'),
            array('url' => 'users/*/edit', 'method' => 'GET', 'permission' => 'Edit User'),
            // array('url' => 'users/*', 'method' => 'PATCH', 'permission' => 'Update User'),
            array('url' => 'users/*', 'method' => 'DELETE', 'permission' => 'Delete User'),

            // Role Management Routes
            array('url' => 'roles', 'method' => 'GET', 'permission' => 'See All Roles'),
            array('url' => 'roles/create', 'method' => 'GET', 'permission' => 'Create Role'),
            array('url' => 'roles/*', 'method' => 'GET', 'permission' => 'See Role'),
            array('url' => 'roles/*/edit', 'method' => 'GET', 'permission' => 'Edit Role'),
            array('url' => 'roles/*', 'method' => 'DELETE', 'permission' => 'Delete Role'),

            // Permission Management Routes
            array('url' => 'permissions', 'method' => 'GET', 'permission' => 'See All Permissions'),
            array('url' => 'permissions/create', 'method' => 'GET', 'permission' => 'Create Permission'),
            array('url' => 'permissions/*', 'method' => 'GET', 'permission' => 'See Permission'),
            array('url' => 'permissions/*/edit', 'method' => 'GET', 'permission' => 'Edit Permission'),
            array('url' => 'permissions/*', 'method' => 'DELETE', 'permission' => 'Delete Permission'),

            // Category Routes
            array('url' => 'categories', 'method' => 'GET', 'permission' => 'See All Categories'),
            array('url' => 'categories/create', 'method' => 'GET', 'permission' => 'Create Category'),
            array('url' => 'categories/*', 'method' => 'GET', 'permission' => 'See Category'),
            array('url' => 'categories/*/edit', 'method' => 'GET', 'permission' => 'Edit Category'),
            array('url' => 'categories/*', 'method' => 'DELETE', 'permission' => 'Delete Category'),

            // Category Routes
            array('url' => 'gallery', 'method' => 'GET', 'permission' => 'See All Galleries'),
            array('url' => 'gallery/create', 'method' => 'GET', 'permission' => 'Create Gallery'),
            array('url' => 'gallery/*', 'method' => 'GET', 'permission' => 'See Gallery'),
            array('url' => 'gallery/*/edit', 'method' => 'GET', 'permission' => 'Edit Gallery'),
            array('url' => 'gallery/*', 'method' => 'DELETE', 'permission' => 'Delete Gallery'),

            // Excel Routes
            array('url' => 'excel', 'method' => 'GET', 'permission' => 'See Excel Operations'),

            // Ajax Routes
            array('url' => 'ajax', 'method' => 'GET', 'permission' => 'See Ajax Operations'),

        );

        // Super Admin
        if (auth()->user()->isAdmin()) {
            return $next($request);
        }

        foreach ($grants as $key => $grant) {

            if ($request->is($grant['url']))
            {
                if ($request->isMethod($grant['method'])  && auth()->user()->hasPermissionTo($grant['permission'])) {
                    return $next($request);
                } else {
                    abort('401');
                }
            }
        }

        return $next($request);
    }
}
