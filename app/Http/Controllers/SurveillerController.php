<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Surveiller;
use Illuminate\Http\Request;
use App\Http\Requests\SurveilleRequest;

class SurveillerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveiller = Surveiller::with("personneVulnerable","personneAffilee")->get();
        return response()->json([
            "success" => true,
            "message" => "Liste des perssones vulnerable et leurs proches",
            "data" => $surveiller
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SurveilleRequest $request)
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Respons
     */
    public function show(Request $request, $id)
    {
        $input=$request->all();
        $surveiller = Surveiller::create($input);
        return response()->json([
            "success" => true,
            "message" => "Donné moyenne  Creer avec succès.",
            "data" => $surveiller
            ]);
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
