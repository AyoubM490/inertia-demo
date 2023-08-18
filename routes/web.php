<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return inertia('Home');
    });

    Route::get('/users', function () {
//        return UserResource::collection(User::all());


        return inertia('Users/Index', [
            'users' => UserResource::collection(User::query()
                ->when(request('search'), function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->paginate(10)
                ->withQueryString()),
            'filters' => request(),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class)
            ]
        ]);
    });

    Route::get('/users/create', function () {
        return Inertia::render('Users/Create');
    })->middleware('can:create,App\Models\User');

    Route::get('users/{id}/edit', function ($id) {
        $user = User::find($id);
        return Inertia::render('Users/Show', [
            'user' => UserResource::make($user)
        ]);
    });

    Route::post('/users', function () {
        $attributes = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => 'required',
        ]);

        User::create($attributes);

        // redirect
        return redirect('/users');
    });

    Route::get('/settings', function () {
        return inertia('Settings');
    });


});
