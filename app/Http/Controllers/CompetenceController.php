<?php

namespace App\Http\Controllers;

use App\Competence;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competences = Competence::all();
        return response()->json($competences);
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
            'competenceNom',
            'competenceCategorie',
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $valuesCompetence['nom'] = $request->competenceNom;
        $valuesCompetence['categorie'] = $request->competenceCategorie;

        DB::beginTransaction();
        try {
             $validate = Competence::getValidation($valuesCompetence);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $newCompetence = Competence::saveOne($valuesCompetence);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $newCompetence;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Competence::find($id));
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
            'competenceNom',
            'competenceCategorie',
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $competence = Competence::find($id);

        $valuesCompetence['nom'] = $request->competenceNom;
        $valuesCompetence['categorie'] = $request->competenceCategorie;

        DB::beginTransaction();
        try {

            $valuesCompetence['update'] = 1;
            $validate = Competence::getValidation($valuesCompetence);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $competence->update($valuesCompetence);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $competence;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $competence = Competence::find($id);
        $competence->delete();

        return $competence;
    }
}
