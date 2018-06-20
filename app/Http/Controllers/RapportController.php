<?php

namespace App\Http\Controllers;

use App\Rapport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RapportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rapports = Rapport::all();
        return response()->json($rapports);
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
            'rapportUserID',
            'rapportInterventionEffectiveID',
            'rapportClassement',
            'rapportCommentaireTitre',
            'rapportDescription',
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }
        $valuesRapport['user_id'] = $request->rapportUserID;
        $valuesRapport['interventionEffective_id'] = $request->rapportInterventionEffectiveID;
        $valuesRapport['classement'] = $request->rapportClassement;
        $valuesRapport['commentaireTitre'] = $request->rapportCommentaireTitre;
        $valuesRapport['commentaireDescription'] = $request->rapportDescription;

        DB::beginTransaction();
        try {
            $validate = Rapport::getValidation($valuesRapport);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $newRapport = Rapport::saveOne($valuesRapport);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $newRapport;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Rapport::find($id));
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
            'rapportUserID',
            'rapportInterventionEffectiveID',
            'rapportClassement',
            'rapportCommentaireTitre',
            'rapportDescription',
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $rapport = Rapport::find($id);

        $valuesRapport['user_id'] = $request->rapportUserID;
        $valuesRapport['interventionEffective_id'] = $request->rapportInterventionEffectiveID;
        $valuesRapport['classement'] = $request->rapportClassement;
        $valuesRapport['commentaireTitre'] = $request->rapportCommentaireTitre;
        $valuesRapport['commentaireDescription'] = $request->rapportDescription;

        DB::beginTransaction();
        try {

            $valuesRapport['update'] = 1;
            $validate = Rapport::getValidation($valuesRapport);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $rapport->update($valuesRapport);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $rapport;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rapport = Rapport::find($id);
        $rapport->delete();

        return $rapport;
    }
}
