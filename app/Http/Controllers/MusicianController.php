<?php

namespace App\Http\Controllers;

use App\Http\Resources\MusicianResource;
use App\Models\Musician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Js;

class MusicianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $musician = Musician::all();
        return MusicianResource::collection($musician);
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
        $validator = Validator::make($request->all(), [
            "name" => 'required|string|max:255',
            "instrument"=>'required|string|max:40|',
            "biography"=>'required|string|max:255|',
            "date_of_birth"=>'required|string|max:15',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        $musician = Musician::create([
            'name' => $request->name,
            'instrument'=> $request->instrument,
            'biography'=> $request->biography,
            'date_of_birth'=>$request->date_of_birth,
        ]);
        $musician->save();
        return response()->json(['Musician is created successfully.', $musician]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Musician  $musician
     * @return \Illuminate\Http\Response
     */
    public function show(Musician $musician)
    {
       return new MusicianResource($musician);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Musician  $musician
     * @return \Illuminate\Http\Response
     */
    public function edit(Musician $musician)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Musician  $musician
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate inputs
        $validator = Validator::make($request->all(), [
            "name" => 'required|string|max:255',
            "instrument"=>'required|string|max:40|',
            "biography"=>'required|text|max:255|',
            "date_of_birth"=>'required|string|max:15',
        ]);

        if ($validator->fails())
     
            return response()->json($validator->errors());

        
        $mus=Musician::find($id);
        //update it
        $mus->update($request->all());
        //return it
        return response()->json([
            "Musician is successfully updated!"
          , $mus]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Musician  $musician
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mus = Musician::find($id);
        
        if($mus){
            $mus->delete();
            return response()->json(["Musician is deleted.", $mus]);
        }
        else{
            return response()->json(['Error!!!']);
        }
    }
}
