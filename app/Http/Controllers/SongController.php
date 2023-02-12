<?php

namespace App\Http\Controllers;

use App\Http\Resources\SongCollection;
use App\Http\Resources\SongResource;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songs = Song::all();
        return new SongCollection($songs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => 'required|string|max:255',
            "album" => 'required|string',
            "genre_id"=>'required',
            "musician_id"=>'required'
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        $song = Song::create([
            'name' => $request->name,
            'album'=>$request->album,
            'created_at'=>now(),
            'updated_at'=>now(),
            'genre_id'=>$request->genre_id,
            'musician_id'=>$request->musician_id
            
           
        ]);
        $song->save();


        return response()->json(['Song is created successfully.', $song]);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $song = Song::find($id);
        return new SongResource($song);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => 'bail|required|string|max:255',
            "album" => 'bail|required|string',
            "genre_id"=>'bail|required',
            "musician_id"=>'required'
        ]);

        if ($validator->fails())
             return response()->json($validator->errors());
        $song=Song::find($id);
        //update it
        $song->update($request->all());
        //return it
        return $song;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $s = Song::find($id);
        if($s){
            $s->delete();
            return response()->json(["Song is deleted.", $s]);
        }
        else{
            return response()->json(['Error!!!']);
        }
    }

    public function search($name)
    {
        return Song::where('name', 'like', '%'.$name.'%')->get();
    }
}
