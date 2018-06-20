<?php

namespace App\Http\Controllers;

use App\Abonnement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AbonnementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abonnements = Abonnement::all();
        return response()->json($abonnements);
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
            'abonnementNom',
            'abonnementPrix',
            'abonnementDescription'
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $valuesAbonnement['nom'] = $request->abonnementNom;
        $valuesAbonnement['prix'] = $request->abonnementPrix;
        $valuesAbonnement['description'] = $request->abonnementDescription;

        DB::beginTransaction();
        try {

            $validate = Abonnement::getValidation($valuesAbonnement);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $newAbonnement = Abonnement::saveOne($valuesAbonnement);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $newAbonnement;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Abonnement::find($id));
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
            'abonnementNom',
            'abonnementPrix',
            'abonnementDescription'
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $abonnement = Abonnement::find($id);

        if(empty($abonnement)){
            return response()->json(['error' => 'abonnement introuvable']);
        }

        $valuesAbonnement['nom'] = $request->abonnementNom;
        $valuesAbonnement['prix'] = $request->abonnementPrix;
        $valuesAbonnement['description'] = $request->abonnementDescription;

        DB::beginTransaction();
        try {

            $valuesAbonnement['update'] = 1;

            $validate = Abonnement::getValidation($valuesAbonnement);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $abonnement->update($valuesAbonnement);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $abonnement;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $abonnement = Abonnement::find($id);
        $abonnement->delete();

        return $abonnement;
    }
}
