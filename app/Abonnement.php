<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Abonnement extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nom',
        'prix',
        'description'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $errors;

    // Définition des règles de validation pour une nouvelle demande
    public static $rules = [
        'nom' => 'required|string',
        'prix' => 'required|regex:/^\d*(\.\d{1,2})?$/',
        'description' => 'required|string'
    ];

    public static function getValidation(Array $inputs)
    {
        $validator = Validator::make($inputs, static::$rules);
        //test en plus des rules
        $validator->after(function ($validator) use($inputs) {

            if(!isset($inputs['update'])){
                $existe = Abonnement::where('prix',$inputs['prix'])
                    ->where('description',$inputs['description'])
                    ->where('nom',$inputs['nom'])
                    ->first();

                if(!empty($existe)){
                    $validator->getMessageBag()->add('abonnement', 'abonnement existe deja');
                }
            }

        });
        return $validator;
    }

    public static function saveOne(array $values)
    {
        $abonnement = new self();

        $abonnement->nom = $values['nom'];
        $abonnement->prix = $values['prix'];
        $abonnement->description = $values['description'];

        $abonnement->save();

        return $abonnement;
    }

    public function seniors(){
        return $this->hasMany('App\Senior');
    }

    public function errors()
    {
        return $this->errors;
    }
}