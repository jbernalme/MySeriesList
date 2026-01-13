<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\TvList;
use App\Models\MovieList;
use Illuminate\Http\Request;
use App\Models\WatchingState;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class MyListController extends Controller
{
    public function show($username)
    {
        try {

            $user_id = User::where('username', $username)->firstOrFail()->id;
            

            $stateWatchingList = WatchingState::all(['id', 'name', 'color']);

            $tv = TvList::where('user_id', $user_id)
                ->select(['id', 'name', 'api_id', 'poster', 'watching_state_id', 'score_id', 'season', 'episode'])
                ->selectRaw('"TvShow" as type');

            $lists = MovieList::where('user_id', $user_id)
                ->select(['id', 'name', 'api_id', 'poster', 'watching_state_id', 'score_id'])
                ->selectRaw('Null as season, NULL as episode, "Movie" as type')
                ->union($tv)
                // ->orderBy($this->sortField, $this->sortDirection)
                ->get();

        } catch (ModelNotFoundException $e) {
            return Inertia::render('Error', ['status' => 404]);
        }

        $data = collect(['lists' => $lists])->merge(['stateWatchingList' => $stateWatchingList]);

        // Log::debug($data);
        return Inertia::render('MyList/Index', ['data' => $data]);
    }

    public function showtest($username)
{
    try {
        $user = User::where('username', $username)->firstOrFail();
        $user_id = $user->id;

        $stateWatchingList = WatchingState::all(['id', 'name', 'color']);

        $tv = TvList::where('user_id', $user_id)
            ->select(['id', 'name', 'api_id', 'poster', 'watching_state_id', 'score_id', 'season', 'episode'])
            ->selectRaw("'TvShow' as type");

        $lists = MovieList::where('user_id', $user_id)
            ->select(['id', 'name', 'api_id', 'poster', 'watching_state_id', 'score_id'])
            ->selectRaw("NULL as season, NULL as episode, 'Movie' as type")
            ->union($tv)
            ->get();

    } catch (ModelNotFoundException $e) {
        return Inertia::render('Error', ['status' => 404]);
    }

    $data = collect(['lists' => $lists])->merge(['stateWatchingList' => $stateWatchingList]);

    return Inertia::render('MyList/Index', ['data' => $data]);
}
}
