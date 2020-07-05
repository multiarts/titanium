<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function filter(Request $request, User $users)
    {
       $users = User::where('active', 'on');

        if ($request->has('name')) {
            $users->where('name', '>', $request->name);
        }

        if ($request->has('email')) {
            $users->where('email', $request->email);
        }

        if ($request->has('has_published_post')) {
            $users->where(function ($query) use ($request) {
                $query->whereHas('posts', function ($query) use ($request) {
                    $query->where('is_published', $request->has_published_post);
                });
            });
        }

        return $users->get();

    }
}
