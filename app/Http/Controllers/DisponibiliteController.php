<?php

namespace App\Http\Controllers;

use App\Disponibilite;
use App\Recurrence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisponibiliteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disponibilites = Disponibilite::all();
        return response()->json($disponibilites);
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
            'disponibiliteJuniorID',
            'disponibiliteHeureDebut',
            'disponibiliteHeureFin',
            'disponibiliteDate',
            'disponibiliteJourDeLaSemaine',
            'disponibiliteRecurrenceDateDebut',
            'disponibiliteRecurrenceDateFin',
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $valuesDisponibilite['junior_id'] = $request->disponibiliteJuniorID;
        $valuesDisponibilite['heureDebut'] = $request->disponibiliteHeureDebut;
        $valuesDisponibilite['heureFin'] = $request->disponibiliteHeureFin;
        $valuesDisponibilite['date'] = $request->disponibiliteDate;
        $valuesDisponibilite['jourDeLaSemaine'] = $request->disponibiliteJourDeLaSemaine;


        if(empty($valuesDisponibilite['date'])){
            $valuesRecurrence['dateDebut'] = $request->disponibiliteRecurrenceDateDebut;
            $valuesRecurrence['dateFin'] = $request->disponibiliteRecurrenceDateFin;
            $newRecurrence = Recurrence::saveOne($valuesRecurrence);

        }
        elseif(empty($valuesDisponibilite['date']) && empty($valuesDisponibilite['jourDeLaSemaine']))
        {
            $valuesRecurrence['frequence'] = "quotidien";
            $newRecurrence = Recurrence::saveOne($valuesRecurrence);

        }

        DB::beginTransaction();
        try {

            $validate = Disponibilite::getValidation($valuesDisponibilite);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $newDisponibilite = Disponibilite::saveOne($valuesDisponibilite);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $newDisponibilite;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Disponibilite::find($id));
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
            'disponibiliteInputJuniorID',
            'disponibiliteInputHeureDebut',
            'disponibiliteInputHeureFin',
            'disponibiliteInputDate',
            'disponibiliteInputJourDeLaSemaine'
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $disponibilite = Disponibilite::find($id);

        if(empty($disponibilite)){
            return response()->json(['error' => 'disponibilite introuvable']);
        }

        if(empty($valuesDisponibilite['date'])){
            $valuesRecurrence['dateDebut'] = $request->disponibiliteRecurrenceDateDebut;
            $valuesRecurrence['dateFin'] = $request->disponibiliteRecurrenceDateFin;

            $recurrence = Recurrence::find($valuesDisponibilite['recurrence_id']);

        }
        elseif(empty($valuesDisponibilite['date']) && empty($valuesDisponibilite['jourDeLaSemaine']))
        {
            $valuesRecurrence['frequence'] = "quotidien";

        }

        $recurrence->update($valuesRecurrence);

        $valuesDisponibilite['junior_id'] = $request->disponibiliteInputJuniorID;
        $valuesDisponibilite['heureDebut'] = $request->disponibiliteInputHeureDebut;
        $valuesDisponibilite['heureFin'] = $request->disponibiliteInputHeureFin;
        $valuesDisponibilite['date'] = $request->disponibiliteInputDate;
        $valuesDisponibilite['jourDeLaSemaine'] = $request->disponibiliteInputJourDeLaSemaine;

        DB::beginTransaction();
        try {

            $valuesDisponibilite['update'] = true;

            $validate = Disponibilite::getValidation($valuesDisponibilite);
            if ($validate->fails()) {
                return $validate->errors();
            }

            unset($valuesDisponibilite['update']);

            $disponibilite->update($valuesDisponibilite);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $disponibilite;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disponibilite = Disponibilite::find($id);
        $disponibilite->delete();

        return $disponibilite;
    }
}