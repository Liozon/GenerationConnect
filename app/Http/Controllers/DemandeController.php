<?php

namespace App\Http\Controllers;

use App\Demande;
use App\Disponibilite;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Demande::with('senior.user','competences','employe.user','junior.user')->get());
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
            'demandeJuniorID',
            'demandeSeniorID',
            'demandeEmployeID',
            'demandeDescription',
            'demandeDate',
            'demandeHeure',
            'demandeDuree',
            'demandeTitre',
            'demandeCompetenceID'
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $valuesDemande['junior_id'] = $request->demandeJuniorID;
        $valuesDemande['senior_id'] = $request->demandeSeniorID;
        $valuesDemande['employe_id'] = $request->demandeEmployeID;
        $valuesDemande['description'] = $request->demandeDescription;
        $valuesDemande['titre'] = $request->demandeTitre;
        $valuesDemande['date'] = $request->demandeDate;
        $valuesDemande['heure'] = $request->demandeHeure;
        $valuesDemande['duree'] = $request->demandeDuree;
        $valuesDemande['statut'] = "envoyé";
        $competenceID = $request->demandeCompetenceID;

        DB::beginTransaction();
        try {

            $validate = Demande::getValidation($valuesDemande);
            if ($validate->fails()) {
                return $validate->errors();
            }


            $newDemande = Demande::saveOne($valuesDemande);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $newDemande;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Demande::with('senior.user','competences','employe.user','junior.user')->where('id',$id)->get());
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
            'junior_id',
            'senior_id',
            'employe_id',
            'description',
            'date',
            '',
            'demandeDuree',
            'demandeTitre',
            'demandeCompetenceID',
            'demandeStatut'
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }


        $demande = Demande::find($id);

        if(empty($demande)){
            return response()->json(['error' => 'demande introuvable']);
        }

        $valuesDemande['junior_id'] = $request->demandeJuniorID;
        $valuesDemande['senior_id'] = $request->demandeSeniorID;
        $valuesDemande['employe_id'] = $request->demandeEmployeID;
        $valuesDemande['description'] = $request->demandeDescription;
        $valuesDemande['titre'] = $request->demandeTitre;
        $valuesDemande['date'] = $request->demandeDate;
        $valuesDemande['heure'] = $request->demandeHeure;
        $valuesDemande['duree'] = $request->demandeDuree;
        $valuesDemande['statut'] = $request->demandeStatut;

        $disponibilitesATester = Disponibilite::where('junior_id',$valuesDemande['junior_id'])->get();

        // foreach($disponibilitesATester as $disponibilite){
        //     return response()->json(date('l',$disponibilite->date));
        // }

        if(!$disponibilitesATester){
            return response()->json(['error' => 'le junior est pas dispo pour cette date']);
        }

        DB::beginTransaction();
        try {

            $valuesDemande['update'] = 1;


            $validate = Demande::getValidation($valuesDemande);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $demande->update($valuesDemande);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $demande;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $demande = Demande::find($id);
        $demande->delete();

        return $demande;
    }
}