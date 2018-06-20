<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disponibilite extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'junior_id',
        'heureDebut',
        'heureFin',
        'date',
        'jourDeLaSemaine'
    ];


    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $errors;

    // Définition des règles de validation pour une nouvelle demande
    public static $rules = [
        'junior_id' => 'exists:juniors,id|sometimes|required',
        'heureDebut' => 'required|date_format:"H:i:s"|before:heureFin',
        'heureFin' => 'required|date_format:"H:i:s"|after:heureDebut',
        'date' => 'nullable|date',
        'jourDeLaSemaine' => 'nullable|in:"lundi","mardi","mercredi","jeudi","vendredi","samedi","dimanche"'
    ];

    public static function getValidation(Array $inputs)
    {
        $validator = Validator::make($inputs, static::$rules);
        //test en plus des rules
        $validator->after(function ($validator) use($inputs) {

            if(!isset($inputs['update'])){
                $existe = Disponibilite::where('junior_id',$inputs['junior_id'])
                    ->where('date',$inputs['date'])
                    ->where('jourDeLaSemaine',$inputs['jourDeLaSemaine'])
                    ->where('heureDebut',$inputs['heureDebut'])
                    ->where('heureFin',$inputs['heureFin'])
                    ->first();

                if(!empty($existe)){
                    $validator->getMessageBag()->add('disponibilite', 'disponibilite existe deja');
                }
            }
        });
        return $validator;
    }

    public static function saveOne(array $values)
    {
        $disponibilite = new self();

        $disponibilite->junior_id = $values['junior_id'];
        $disponibilite->heureDebut = $values['heureDebut'];
        $disponibilite->heureFin = $values['heureFin'];
        $disponibilite->date = $values['date'];
        $disponibilite->jourDeLaSemaine = $values['jourDeLaSemaine'];

        $disponibilite->save();

        return $disponibilite;
    }

    public function junior(){
        return $this->belongsTo('App\Junior');
    }

    public function recurrence(){
        return $this->belongsTo('App\Recurrence');
    }

    public function interventions(){
        return $this->belongsToMany('App\Intervention','dispo_intervention');
    }

    public function demandes(){
        return $this->belongsToMany('App\Demande','demande_disponibilite');
    }

    public function errors()
    {
        return $this->errors;
    }
}
