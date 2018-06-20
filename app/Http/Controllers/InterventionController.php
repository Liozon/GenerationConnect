<?php

namespace App\Http\Controllers;

use App\Disponibilite;
use Illuminate\Http\Request;
use App\Demande;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Intervention;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interventions = Intervention::all();
        return response()->json($interventions);
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
            'interventionDemandeID',
            'interventionEmployeID',
            'interventionDateDebutPrevue',
            'interventionDateFinPrevue',
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $valuesIntervention['demande_id'] = $request->interventionDemandeID;
        $valuesIntervention['employe_id'] = $request->interventionEmployeID;
        $valuesIntervention['dateDebutPrevue'] = $request->interventionDateDebutPrevue;
        $valuesIntervention['dateFinPrevue'] = $request->interventionDateFinPrevue;

        DB::beginTransaction();
        try {
            $demandeOK = Demande::find($request->interventionDemandeID);
            $disponibilitesOK = Disponibilite::where('');
            date($demandeOK->date);
            date($valuesIntervention['dateDebutPrevue']);
            date($valuesIntervention['dateFinPrevue']);
            if (($demandeOK->statut != "validé")
                || ($demandeOK->date < $valuesIntervention['dateDebutPrevue'])
                || ($demandeOK->date > $valuesIntervention['dateFinPrevue'])
                || ($demandeOK->date > $disponibilitesOK)) {
                return response()->json(['error' => 'intervention pas valide pour cette demande']);
            }
            $validate = Intervention::getValidation($valuesIntervention);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $newIntervention = Intervention::saveOne($valuesIntervention);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $newIntervention;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Intervention::find($id));
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
            'interventionDemandeID',
            'interventionEmployeID',
            'interventionDateDebutPrevue',
            'interventionDateFinPrevue',
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }


        $intervention = Intervention::find($id);

        if(empty($intervention)){
            return response()->json(['error' => 'intervention introuvable']);
        }

        $valuesIntervention['demande_id'] = $request->interventionDemandeID;
        $valuesIntervention['employe_id'] = $request->interventionEmployeID;
        $valuesIntervention['dateDebutPrevue'] = $request->interventionDateDebutPrevue;
        $valuesIntervention['dateFinPrevue'] = $request->interventionDateFinPrevue;

        DB::beginTransaction();
        try {

            $valuesIntervention['update'] = 1;

            $demandeOK = Demande::find($request->interventionDemandeID);
            $disponibilitesOK = Disponibilite::where('');
            date($demandeOK->date);
            date($valuesIntervention['dateDebutPrevue']);
            date($valuesIntervention['dateFinPrevue']);
            if (($demandeOK->statut != "validé")
                || ($demandeOK->date < $valuesIntervention['dateDebutPrevue'])
                || ($demandeOK->date > $valuesIntervention['dateFinPrevue'])
                || ($demandeOK->date > $disponibilitesOK)) {
                return response()->json(['error' => 'intervention pas valide pour cette demande']);
            }
            $validate = Intervention::getValidation($valuesIntervention);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $intervention->update($valuesIntervention);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $intervention;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $intervention = Intervention::find($id);
        $intervention->delete();

        return $intervention;
    }
}
