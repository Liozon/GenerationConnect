<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Competence;
use App\Disponibilite;
use Validator;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Junior extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'adresse_2',
        'lienCV',
        'dureeEngagement',
        'estValide',
        'banque',
        'numeroCompteBancaire'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $errors;

    // Définition des règles de validation pour un nouveau junior
    public static $rules = [
        'user_id' => 'exists:users,id|sometimes|required',
        'adresse_2' => 'nullable|string',
        'lienCV' => 'required|string',
        'dureeEngagement' => 'required|numeric',
        'estValide' => 'required|boolean',
        'banque' => 'nullable|string',
        'numeroCompteBancaire' => 'nullable|string',
        'aProposDeMoi' => 'nullable|string'

    ];

    public static function getValidation(Array $inputs)
    {


        $validator = Validator::make($inputs, static::$rules);

        //test en plus des rules
        $validator->after(function ($validator) use($inputs) {

            if(!isset($inputs['update'])){
                $existe = Junior::where('user_id',$inputs['user_id'])->first();

                if(!empty($existe)){
                    $validator->getMessageBag()->add('junior', 'junior existe deja');
                }
            }

        });
        return $validator;
    }

    public static function saveOne(array $values)
    {
        $junior = new self();

        $junior->user_id = $values['user_id'];
        $junior->adresse_2 = $values['adresse_2'];
        $junior->lienCV = $values['lienCV'];
        $junior->dureeEngagement = $values['dureeEngagement'];
        $junior->estValide = $values['estValide'];
        $junior->banque = $values['banque'];
        $junior->numeroCompteBancaire = $values['numeroCompteBancaire'];

        $junior->save();

        return $junior;
    }

    public function competences(){
        return $this->belongsToMany('App\Competence', 'competence_junior')->withTimestamps()->withPivot('niveau');
    }

    public function regions(){
        return $this->belongsToMany('App\Region','junior_region');
    }

    public function disponibilites(){
        return $this->hasMany('App\Disponibilite');
    }

    public function demandes(){
        return $this->hasMany('App\Demande');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function errors()
    {
        return $this->errors;
    }
}
