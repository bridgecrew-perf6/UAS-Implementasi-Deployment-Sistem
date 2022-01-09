<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
    }

    function getMoviesNP(){ 
        $sel = DB::table('movies')->where('status', '=', '1')->get()->toJson(JSON_PRETTY_PRINT); 
        return response($sel, 200); 
    }

    function getMoviesBrowse(){ 
        $sel = DB::table('movies')->where('status', '=', '0')->get()->toJson(JSON_PRETTY_PRINT); 
        return response($sel, 200); 
    } 
    
    function getMoviesCS(){ 
        $sel = DB::table('movies')->where('status', '=', '2')->get()->toJson(JSON_PRETTY_PRINT); 
        return response($sel, 200);
    }

    function getTiket(){ 
        $sel = DB::table('pemesanan_tiket')->get()->toJson(JSON_PRETTY_PRINT); 
        return response($sel, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
