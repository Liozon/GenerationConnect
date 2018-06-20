<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    // Définition des règles de validation pour un nouvelle ressource
    public static $rules = [
        'nom' => 'required|string'
    ];

    public static function getValidation(Array $inputs)
    {
        $validator = Validator::make($inputs, self::$rules);

        //test en plus des rules
        $validator->after(function ($validator) use($inputs) {
            $ressources = Ressource::all();
            foreach ($ressources as $ressource) {
                if($ressource->nom = $inputs['nom']){
                    $validator->errors()->add('exists', 'cette ressource existe déjà.');
                }
            }
        });
        return $validator;
    }

    public function groupes(){
        return $this->belongsToMany('App\Groupe', 'roles')->withTimestamps()->withPivot('crud');
    }

    public function errors()
    {
        return $this->errors;
    }
}
