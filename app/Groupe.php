<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    // Définition des règles de validation pour un nouveau groupe
    public static $rules = [
        'nom' => 'required|string'
    ];

    public static function getValidation(Array $inputs)
    {
        $validator = Validator::make($inputs, self::$rules);

        //test en plus des rules
        $validator->after(function ($validator) use($inputs) {
            $groupes = Groupe::all();
            foreach ($groupes as $groupe) {
                if($groupe->nom = $inputs['nom']){
                    $validator->errors()->add('exists', 'ce groupe existe déjà.');
                }
            }
        });
        return $validator;
    }

    public function ressources(){
        return $this->belongsToMany('App\Ressource', 'roles')->withTimestamps()->withPivot('crud');
    }

    public function users(){
        return $this->belongsToMany('App\User','groupe_user');
    }

    public function errors()
    {
        return $this->errors;
    }
}
