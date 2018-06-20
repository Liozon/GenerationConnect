<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intervention extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'demande_id',
        'employe_id',
        'dateDebutPrevue',
        'dateFinPrevue',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $errors;

    // Définition des règles de validation pour une nouvelle intervention
    public static $rules = [
        'demande_id' => 'exists:demandes,id|sometimes|required',
        'employe_id' => 'exists:employes,id|sometimes|required',
        'dateDebutPrevue' => 'required|date|before_or_equal:dateFinPrevue',
        'dateFinPrevue' => 'required|date|after_or_equal:dateDebutPrevue',
    ];

    public static function getValidation(Array $inputs)
    {
        $validator = Validator::make($inputs, static::$rules);
        //test en plus des rules
        $validator->after(function ($validator) use($inputs) {

            if(!isset($inputs['update'])){
                $existe = Intervention::where('demande_id',$inputs['demande_id'])
                    ->where('employe_id',$inputs['employe_id'])
                    ->where('dateDebutPrevue',$inputs['dateDebutPrevue'])
                    ->where('dateFinPrevue',$inputs['dateDebutPrevue'])
                    ->first();

                if(!empty($existe)){
                    $validator->getMessageBag()->add('intervention', 'intervention existe deja');
                }
            }

        });
        return $validator;
    }

    public static function saveOne(array $values)
    {
        $intervention = new self();

        $intervention->demande_id = $values['demande_id'];
        $intervention->employe_id = $values['employe_id'];
        $intervention->dateDebutPrevue = $values['dateDebutPrevue'];
        $intervention->dateFinPrevue = $values['dateFinPrevue'];

        $intervention->save();

        return $intervention;
    }

    public function interventionsEffectives(){
        return $this->hasMany('App\InterventionEffective');
    }

    public function employe(){
        return $this->belongsTo('App\Employe');
    }

    public function disponibilites(){
        return $this->belongsToMany('App\Disponibilite', 'dispo_intervention');
    }

    public function demande(){
        return $this->belongsTo('App\Demande');
    }

    public function errors()
    {
        return $this->errors;
    }
}