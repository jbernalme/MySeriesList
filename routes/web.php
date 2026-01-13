<?php

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\MyListController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TvListController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieListController;

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



Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google.auth');

Route::get('/google-auth/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();
    $user = User::updateOrCreate([
        'google_id' => $googleUser->id,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'username' => explode('@', $googleUser->email)[0] . '@' . substr($googleUser->id, -5),
        'google_token' => $googleUser->token,
        'google_refresh_token' => $googleUser->refreshToken,
    ]);
    Auth::login($user);
    return redirect('/');
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Series
// Route::resource('series', SerieController::class);
Route::get('/series', [SerieController::class, 'index'])->name('series.index');
Route::get('/series/{id}/{slug?}', [SerieController::class, 'show'])->name('serie.show');
Route::get('/filter/series/genres', [SerieController::class, 'genresFilter'])->name('series.genres');
Route::get('/filter/series/search', [SerieController::class, 'searchFilter'])->name('series.search');

// Peliculas
// Route::resource('series', SerieController::class);
Route::get('/peliculas', [MovieController::class, 'index'])->name('movies.index');
Route::get('/peliculas/{id}/{slug?}', [MovieController::class, 'show'])->name('movie.show');
Route::get('/filter/peliculas/genres', [MovieController::class, 'genresFilter'])->name('movies.genres');
Route::get('/filter/peliculas/search', [MovieController::class, 'searchFilter'])->name('movies.search');

//TvList
Route::post('/tvlist', [TvListController::class, 'store'])->name('tvlist.store');
Route::put('/tvlist/{tvList}', [TvListController::class, 'update'])->name('tvlist.update');
Route::delete('/tvlist/{list}', [TvListController::class, 'destroy'])->name('tvlist.destroy');

//MovieList
Route::post('/movielist', [MovieListController::class, 'store'])->name('movielist.store');
Route::put('/movielist/{movielist}', [MovieListController::class, 'update'])->name('movielist.update');
Route::delete('/movielist/{list}', [MovieListController::class, 'destroy'])->name('movielist.destroy');

//Review
Route::get('/review/{apiId}', [ReviewController::class, 'allReviews'])->name('reviews.all');
Route::post('/review/{model}', [ReviewController::class, 'store'])->name('review.store');
Route::put('/review/{review}', [ReviewController::class, 'update'])->name('review.update');


// Mis Listas
Route::get('/list/{username}', [MyListController::class, 'showtest'])->middleware(['auth'])->name('mylist.show');


require __DIR__ . '/auth.php';
