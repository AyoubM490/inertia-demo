<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return inertia('Home');
});

Route::get('/users', function () {
    return inertia('Users/Index', [
        'users' => User::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn($user) => [
            'id' => $user->id,
            'name' => $user->name
        ]),
        'filters' => request()
    ]);
});

Route::get('/users/create', function () {
    return Inertia::render('Users/Create');
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

Route::post('/logout', function () {
    dd(request('foo'));
});
