<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all();
        return response()->json($regions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Récupération des inputs pertinents
        if (!$request->has([
            'regionNom',
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }
        $valuesRegion['nom'] = $request->regionNom;

        DB::beginTransaction();
        try {
            $validate = Region::getValidation($valuesRegion);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $newRegion = Region::saveOne($valuesRegion);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $newRegion;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Region::find($id));
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
        // Récupération des inputs pertinents
        if (!$request->has([
            'regionNom',
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $region = Region::find($id);

        $valuesRegion['nom'] = $request->regionNom;

        DB::beginTransaction();
        try {

            $valuesRegion['update'] = 1;
            $validate = Region::getValidation($valuesRegion);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $region->update($valuesRegion);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $region;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::find($id);
        $region->delete();

        return $region;
    }
}
