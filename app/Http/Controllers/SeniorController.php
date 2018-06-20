<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Senior;
use Validator;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Groupe;

class SeniorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Senior::with('user')->get());
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
            'seniorInputSex',
            'seniorInputFirstName',
            'seniorInputName',
            'seniorInputPseudo',
            'seniorInputPassword',
            'seniorInputEmail',
            'seniorInputAddress',
            'seniorInputFloor',
            'seniorInputCity',
            'seniorInputState',
            'seniorInputNPA'
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $valuesUser['sexe'] = $request->seniorInputSex;
        $valuesUser['prenom'] = $request->seniorInputFirstName;
        $valuesUser['nom'] = $request->seniorInputName;
        $valuesUser['pseudo'] = $request->seniorInputPseudo;
        $valuesUser['password'] = bcrypt($request->seniorInputPassword);
        $valuesUser['email'] = $request->seniorInputEmail;

        $valuesUser['telephone'] = "0211540000";
        $valuesUser['telephone_2'] = "0211540408";
        $valuesUser['photo'] = "http://photo";

//        $valuesUser['telephone'] = $request->seniorInputPhoneNumber;
//        $valuesUser['telephone_2'] = $request->seniorInputPhoneNumber_2;
//        $valuesUser['photo'] = $request->seniorInputPhoto;
        $valuesUser['adresse'] = $request->seniorInputAddress;
        $valuesUser['ville'] = $request->seniorInputCity;
        $valuesUser['canton'] = $request->seniorInputState;
        $valuesUser['codePostal'] = $request->seniorInputNPA;
        $valuesUser['groupe'] = 2;

        $valuesSenior['etage'] = $request->seniorInputFloor;
        $valuesSenior['abonnement_id'] = null;

        DB::beginTransaction();
        try {

            $validate = User::getValidation($valuesUser);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $newUser = User::saveOne($valuesUser);

            $groupe = Groupe::find($valuesUser['groupe']);
            $newUser->groupes()->save($groupe);

            $valuesSenior['user_id'] = $newUser->id;

            $validate = Senior::getValidation($valuesSenior);

            if ($validate->fails()) {
                return $validate->errors();
            }

            $newSenior = Senior::saveOne($valuesSenior);

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
        return response()->json(Senior::with('user')->where('id',$id)->get());
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
            'seniorInputSex',
            'seniorInputFirstName',
            'seniorInputName',
            'seniorInputPseudo',
            'seniorInputPassword',
            'seniorInputEmail',
            'seniorInputAddress',
            'seniorInputPhoneNumber',
            'seniorInputPhoneNumber_2',
            'seniorInputPhoto',
            'seniorInputFloor',
            'seniorInputCity',
            'seniorInputState',
            'seniorInputNPA',
            'seniorAbonnementID'
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $senior = Senior::find($id);

        if(empty($senior)){
            return response()->json(['error' => 'senior introuvable']);
        }

        $valuesUser['sexe'] = $request->seniorInputSex;
        $valuesUser['prenom'] = $request->seniorInputFirstName;
        $valuesUser['nom'] = $request->seniorInputName;
        $valuesUser['pseudo'] = $request->seniorInputPseudo;
        $valuesUser['password'] = bcrypt($request->seniorInputPassword);
        $valuesUser['email'] = $request->seniorInputEmail;
        $valuesUser['telephone'] = $request->seniorInputPhoneNumber;
        $valuesUser['telephone_2'] = $request->seniorInputPhoneNumber_2;
        $valuesUser['photo'] = $request->seniorInputPhoto;
        $valuesUser['adresse'] = $request->seniorInputAddress;
        $valuesUser['ville'] = $request->seniorInputCity;
        $valuesUser['canton'] = $request->seniorInputState;
        $valuesUser['codePostal'] = $request->seniorInputNPA;

        $valuesSenior['etage'] = $request->seniorInputFloor;
        $valuesSenior['abonnement_id'] = $request->seniorAbonnementID;

        DB::beginTransaction();
        try {


            $valuesUser['update'] = true;
            $validate = User::getValidation($valuesUser);
            if ($validate->fails()) {
                return $validate->errors();
            }

            unset($valuesUser['update']);

            $user = User::where('id',$senior->user_id);

            $user->update($valuesUser);

            $valuesSenior['update'] = true;
            $validate = Senior::getValidation($valuesSenior);

            if ($validate->fails()) {
                return $validate->errors();
            }


            unset($valuesSenior['update']);
            $senior->update($valuesSenior);

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
        $user = User::find($id);
        $user->delete();

        $senior = Senior::where('user_id',$user->id)->first();
        $senior->delete();

        return $senior;
    }
}