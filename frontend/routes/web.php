<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

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


Route::get('/', function (Request $request) {
    $genres = Http::get('http://localhost:3333/genre/movie/list')->json()['genres'];

    if ($request->query('query')) {
        $response = Http::get('http://localhost:3333/search/movie/' . $request->query('query'))->json()['results'];
    } else if($request->query('genre')) {
        $response = Http::get('http://localhost:3333/discover/movie/' . $request->query('genre'))->json()['results'];
    } else {
        $response = Http::get('http://localhost:3333/trending')->json()['results'];
    }

    return view('index', [
        'genres' => $genres,
        'trending' => $response
    ]);
});

Route::get('/movie/{id}', function ($id) {
    $movie = Http::get('http://localhost:3333/movie/' . $id)->json();

    return view('movie', ['movie'=> $movie]);
 })->where('id', '[0-9]+');