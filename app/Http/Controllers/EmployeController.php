<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Employe;
use App\Groupe;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Employe::with('user')->get());
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
            'employeInputSex',
            'employeInputFirstName',
            'employeInputName',
            'employeInputPseudo',
            'employeInputPassword',
            'employeInputEmail',
            'employeInputAddress',
            'employeInputPhoneNumber',
            'employeInputPhoneNumber_2',
            'employeInputPhoto',
            'employeInputCity',
            'employeInputState',
            'employeInputNPA'
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }
        $valuesUser['sexe'] = $request->employeInputSex;
        $valuesUser['prenom'] = $request->employeInputFirstName;
        $valuesUser['nom'] = $request->employeInputName;
        $valuesUser['pseudo'] = $request->employeInputPseudo;
        $valuesUser['password'] = bcrypt($request->employeInputPassword);
        $valuesUser['email'] = $request->employeInputEmail;
        $valuesUser['telephone'] = $request->employeInputPhoneNumber;
        $valuesUser['telephone_2'] = $request->employeInputPhoneNumber_2;
        $valuesUser['photo'] = $request->employeInputPhoto;
        $valuesUser['adresse'] = $request->employeInputAddress;
        $valuesUser['ville'] = $request->employeInputCity;
        $valuesUser['canton'] = $request->employeInputState;
        $valuesUser['codePostal'] = $request->employeInputNPA;
        $valuesUser['groupe'] = 3;

        DB::beginTransaction();
        try {

            $validate = User::getValidation($valuesUser);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $newUser = User::saveOne($valuesUser);

            $groupe = Groupe::find($valuesUser['groupe']);
            $newUser->groupes()->save($groupe);

            $valuesEmploye['user_id'] = $newUser->id;

            $validate = Employe::getValidation($valuesEmploye);

            if ($validate->fails()) {
                return $validate->errors();
            }

            $newEmploye = Employe::saveOne($valuesEmploye);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $newUser;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Employe::with('user')->where('id',$id)->get());
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
            'employeInputSex',
            'employeInputFirstName',
            'employeInputName',
            'employeInputPseudo',
            'employeInputPassword',
            'employeInputEmail',
            'employeInputAddress',
            'employeInputPhoneNumber',
            'employeInputPhoneNumber_2',
            'employeInputPhoto',
            'employeInputCity',
            'employeInputState',
            'employeInputNPA',
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $user = User::find($id);

        if(empty($user)){
            return response()->json(['error' => 'user introuvable']);
        }

        $valuesUser['sexe'] = $request->employeInputSex;
        $valuesUser['prenom'] = $request->employeInputFirstName;
        $valuesUser['nom'] = $request->employeInputName;
        $valuesUser['pseudo'] = $request->employeInputPseudo;
        $valuesUser['password'] = bcrypt($request->employeInputPassword);
        $valuesUser['email'] = $request->employeInputEmail;
        $valuesUser['telephone'] = $request->employeInputPhoneNumber;
        $valuesUser['telephone_2'] = $request->employeInputPhoneNumber_2;
        $valuesUser['photo'] = $request->employeInputPhoto;
        $valuesUser['adresse'] = $request->employeInputAddress;
        $valuesUser['ville'] = $request->employeInputCity;
        $valuesUser['canton'] = $request->employeInputState;
        $valuesUser['codePostal'] = $request->employeInputNPA;
        $valuesUser['groupe'] = 3;

        DB::beginTransaction();
        try {

            $valuesUser['update'] = 1;

            $validate = User::getValidation($valuesUser);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $user->update($valuesUser);

            $valuesEmploye['user_id'] = $user->id;

            $employe = Employe::where('user_id',$user->id)->first();

            $valuesEmploye['update'] = 1;
            $validate = Employe::getValidation($valuesEmploye);

            if ($validate->fails()) {
                return $validate->errors();
            }
            $employe->update($valuesEmploye);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $user;
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

        $employe = Employe::where('user_id',$user->id)->first();
        $employe->delete();
        return $employe;
    }
}
