<?php

namespace App\Http\Controllers;

use App\Competence;
use App\Competencejunior;
use App\Disponibilite;
use Illuminate\Http\Request;
use App\Junior;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder;
use Validator;
use App\User;
use App\Groupe;

class JuniorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Junior::with('user','competences','disponibilites')->get());
    }

    public function juniorsdispos($id)
    {
        $demande = Demande::find($id);
        //$demande
        return response()->json($id);
        //Junior::with('user','competences','disponibilites')->where('')->get()
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
            'juniorInputSex',
            'juniorInputName',
            'juniorInputFirstName',
            'juniorInputPseudo',
            'juniorInputPassword',
            'juniorInputEmail',
            'juniorInputAddress',
            'juniorInputCity',
            'juniorInputState',
            'juniorInputNPA'
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $valuesUser['sexe'] = $request->juniorInputSex;
        $valuesUser['nom'] = $request->juniorInputName;
        $valuesUser['prenom'] = $request->juniorInputFirstName;
        $valuesUser['pseudo'] = $request->juniorInputPseudo;
        $valuesUser['password'] = bcrypt($request->juniorInputPassword);
        $valuesUser['adresse'] = $request->juniorInputAddress;
        $valuesUser['ville'] = $request->juniorInputCity;
        $valuesUser['email'] = $request->juniorInputEmail;
        $valuesUser['canton'] = $request->juniorInputState;
        $valuesUser['codePostal'] = $request->juniorInputNPA;

        $valuesUser['telephone'] = "0875555555";
        $valuesUser['telephone_2'] = "0875555777";
        $valuesUser['photo'] = "httpwapda";
        $valuesUser['groupe'] = 1;

//        $valuesUser['telephone'] = $request->juniorInputPhoneNumber;
//        $valuesUser['telephone_2'] = $request->juniorInputPhoneNumber_2;
//        $valuesUser['photo'] = $request->juniorInputPhoto;

        $valuesJunior['lienCV'] = "http://example.com/CV";
        $valuesJunior['dureeEngagement'] = 12;
        $valuesJunior['estValide'] = false;
        $valuesJunior['adresse_2'] = "";
        $valuesJunior['banque'] = "";
        $valuesJunior['numeroCompteBancaire'] = "";
        $valuesJunior['aProposDeMoi'] = "";

//        $valuesJunior['lienCV'] = $request->juniorInputLienCV;
//        $valuesJunior['adresse_2'] = $request->juniorInputAdresse;
//        $valuesJunior['dureeEngagement'] = $request->juniorInputDureeEngagement;
//        $valuesJunior['banque'] = $request->juniorInputBanque;
//        $valuesJunior['numeroCompteBancaire'] = $request->juniorInputNumeroCompteBancaire;

        $valuesCompetence['competence_id'] = 1;
        $valuesCompetence['niveau'] = 1;

        $valuesDisponibilite['heureDebut'] = "12:00:00";
        $valuesDisponibilite['heureFin'] = "13:00:00";
        $valuesDisponibilite['jourDeLaSemaine'] = "mardi";
        $valuesDisponibilite['date'] = "2018-02-02";


//        $valuesCompetence['competence_id'] = $request->juniorInputCompetenceID;
//        $valuesCompetence['niveau'] = $request->juniorInputCompetenceNiveau;
//
//        $valuesDisponibilite['heureDebut'] = $request->juniorInputDisponibiliteHeureDebut;
//        $valuesDisponibilite['heureFin'] = $request->juniorInputDisponibiliteHeureFin;
//        $valuesDisponibilite['jourDeLaSemaine'] = $request->juniorInputDisponibiliteJourDeLaSemaine;
//        $valuesDisponibilite['date'] = $request->juniorInputDisponibiliteDate;

        DB::beginTransaction();
        try {

            $validate = User::getValidation($valuesUser);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $newUser = User::saveOne($valuesUser);

            $groupe = Groupe::find($valuesUser['groupe']);
            $newUser->groupes()->save($groupe);

            $valuesJunior['user_id'] = $newUser->id;

            $validate = Junior::getValidation($valuesJunior);

            if ($validate->fails()) {
                return $validate->errors();
            }

            $newJunior = Junior::saveOne($valuesJunior);

            ////////////////////////////////////////////////
            /// COMPETENCES//////////////////////////////
            /////////////////////////////////////////////

            $valuesCompetence['junior_id'] = $newJunior->id;

            $validate = Competencejunior::getValidation($valuesCompetence);
            if ($validate->fails()) {
                return $validate->errors();
            }
            $newCompetence = Competence::find($valuesCompetence['competence_id']);
            $newJunior->competences()->save($newCompetence,['niveau' => $valuesCompetence['niveau']]);

            ////////////////////////////////////////////////
            /// DISPONIBILITES//////////////////////////////
            /////////////////////////////////////////////

            $valuesDisponibilite['junior_id'] = $newJunior->id;
            $valuesDisponibilite['id'] = null;

            $validate = Disponibilite::getValidation($valuesDisponibilite);
            if ($validate->fails()) {
                return $validate->errors();
            }

            Disponibilite::saveOne($valuesDisponibilite);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return response()->json('correct');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Junior::with('user','competence')->where('id',$id)->get());
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
            'sexe',
            'prenom',
            'nom',
            'pseudo',
            'password',
            'email',
            'adresse',
            'ville',
            'canton',
            'codePostal',
            'telephone',
            'telephone_2',
            'photo',
            'lienCV',
            'adresse_2',
            'numeroCompteBancaire',
            'banque',
            'estValide',
            'dureeEngagement',
            'aProposDeMoi',
            "user_id"
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $junior = Junior::find($id);

        if(empty($junior)){
            return response()->json(['error' => 'junior introuvable']);
        }

        $valuesUser['sexe'] = $request->sexe;
        $valuesUser['nom'] = $request->nom;
        $valuesUser['prenom'] = $request->prenom;
        $valuesUser['pseudo'] = $request->pseudo;
        $valuesUser['password'] = bcrypt($request->password);
        $valuesUser['adresse'] = $request->adresse;
        $valuesUser['ville'] = $request->ville;
        $valuesUser['email'] = $request->email;
        $valuesUser['canton'] = $request->canton;
        $valuesUser['codePostal'] = $request->codePostal;
        $valuesUser['telephone'] = $request->telephone;
        $valuesUser['telephone_2'] = $request->telephone_2;
        $valuesUser['photo'] = $request->photo;

        $valuesJunior['lienCV'] = $request->lienCV;
        $valuesJunior['dureeEngagement'] = $request->dureeEngagement;
        $valuesJunior['estValide'] = $request->estValide;
        $valuesJunior['adresse_2'] = $request->adresse_2;
        $valuesJunior['banque'] = $request->banque;
        $valuesJunior['numeroCompteBancaire'] = $request->numeroCompteBancaire;
        $valuesJunior['aProposDeMoi'] = $request->aProposDeMoi;
        $valuesJunior['user_id'] = $request->user_id;

        DB::beginTransaction();
        try {

            $valuesUser['update'] = true;

            $validate = User::getValidation($valuesUser);


            if ($validate->fails()) {
                return $validate->errors();
            }

            unset($valuesUser['update']);

            $user = User::where('id',$junior->user_id);

            $user->update($valuesUser);

            $valuesJunior['update'] = true;

            $validate = Junior::getValidation($valuesJunior);


            if ($validate->fails()) {

                return $validate->errors();
            }


            unset($valuesJunior['update']);

            $junior->update($valuesJunior);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return response()->json('correct');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $junior = Junior::find($id);

        $user = User::where('id',$junior->user_id)->first();
        $user->delete();

        $junior->delete();

        return $junior;
    }
}