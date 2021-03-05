<?php

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
    return view('welcome');
});

use App\User;
use App\Profile;

Route::get('/create_user', function() {
    $user = User::create([
        'name' => 'guest',
        'email' => 'guest@gmail.com',
        'password' => bcrypt(12345)
    ]);

    return $user;
});

Route::get('/create_profile', function() {
    $profile = Profile::create([
        'user_id' => 1,
        'phone' => '08921231413',
        'address' => 'Jl. Lama, No. 4' 
    ]);

    return $profile;
});

Route::get('/create_user_profile', function() {
    $user = User::find(2);

    $profile = new Profile([
        'phone' => '0892123124151',
        'address' => 'Jl. Lama, No. 6'
    ]);

    $user->profile()->save($profile);

    return $user;
});

Route::get('/read_user', function () {
    $user = User::find(1);

    $data = [
        'name' => $user->name,
        'phone' => $user->profile->phone,
        'address' => $user->profile->address
    ];

    return $data;
});

Route::get('/read_profile', function () {
    $profile = Profile::where('phone', '0892123124151')->first();

    $data = [
        'name' => $profile->user->name,
        'email' => $profile->user->email,
        'phone' => $profile->phone,
        'address' => $profile->address
    ];

    return $data;
});

Route::get('/update_profile', function () {
    $user = User::find(2);

    $user->profile()->update([
        'phone' => '0895325237',
        'address' => 'Jl. Inovasi, No. 23'
    ]);

    return $user;
});