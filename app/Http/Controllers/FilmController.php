<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddFilmRequest;
use App\Jobs\AddFilm;
use App\Models\Film;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  JsonResponse|Responsable

     */
    public function index()
    {
        return $this->paginate(Film::select(['id', 'name'])->paginate(8));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddFilmRequest $request)
    {
        AddFilm::dispatch($request->imdb);

        return $this->success(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        return $this->success($film);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function similar($id)
    {

    }

    public function getPromo()
    {

    }

    public function setPromo()
    {

    }
}
