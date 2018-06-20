<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interventioneffective;
use App\Intervention;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Validator;

class InterventioneffectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interventionsEffectives = Interventioneffective::all();
        return response()->json($interventionsEffectives);
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
            'interventionEffectiveInterventionID',
            'interventionEffectiveDate',
            'interventionEffectiveHeureDebut',
            'interventionEffectiveHeureFin',
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $valuesInterventionEffective['id'] = null;
        $valuesInterventionEffective['intervention_id'] = $request->interventionEffectiveInterventionID;
        $valuesInterventionEffective['date'] = $request->interventionEffectiveDate;
        $valuesInterventionEffective['heureDebut'] = $request->interventionEffectiveHeureDebut;
        $valuesInterventionEffective['heureFin'] = $request->interventionEffectiveHeureFin;

        DB::beginTransaction();
        try {
            $interventionOK = Intervention::find($request->interventionEffectiveInterventionID);
            date($interventionOK->dateDebutPrevue);
            date($interventionOK->dateFinPrevue);
            date($valuesInterventionEffective['date']);
            if (
                ($valuesInterventionEffective['date'] < $interventionOK->dateDebutPrevue)
                || ($valuesInterventionEffective['date'] > $interventionOK->dateFinPrevue)
                ) {
                return response()->json(['error' => 'date intervention effective must be between dateDébutPrevue and dateFinPrevue in intervention']);
            }

            $validate = Interventioneffective::getValidation($valuesInterventionEffective);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $newInterventionEffective = Interventioneffective::saveOne($valuesInterventionEffective);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $newInterventionEffective;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Interventioneffective::find($id));
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
            'interventionEffectiveInterventionID',
            'interventionEffectiveDate',
            'interventionEffectiveHeureDebut',
            'interventionEffectiveHeureFin',
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $interventionEffective = Interventioneffective::find($id);

        $valuesInterventionEffective['id'] = null;
        $valuesInterventionEffective['intervention_id'] = $request->interventionEffectiveInterventionID;
        $valuesInterventionEffective['date'] = $request->interventionEffectiveDate;
        $valuesInterventionEffective['heureDebut'] = $request->interventionEffectiveHeureDebut;
        $valuesInterventionEffective['heureFin'] = $request->interventionEffectiveHeureFin;

        DB::beginTransaction();
        try {
            $interventionOK = Intervention::find($request->interventionEffectiveInterventionID);
            date($interventionOK->dateDebutPrevue);
            date($interventionOK->dateFinPrevue);
            date($valuesInterventionEffective['date']);
            if (
                ($valuesInterventionEffective['date'] < $interventionOK->dateDebutPrevue)
                || ($valuesInterventionEffective['date'] > $interventionOK->dateFinPrevue)
                ) {
                return response()->json(['error' => 'date intervention effective must be between dateDébutPrevue and dateFinPrevue in intervention']);
            }
            
            $valuesInterventionEffective['update'] = 1;
            $validate = Interventioneffective::getValidation($valuesInterventionEffective);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $interventionEffective->update($valuesInterventionEffective);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $interventionEffective;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $interventionEffective = Interventioneffective::find($id);
        $interventionEffective->delete();

        return $interventionEffective;
    }
}