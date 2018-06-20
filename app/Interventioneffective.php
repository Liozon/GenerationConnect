<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interventioneffective extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'intervention_id',
        'date',
        'heureDebut',
        'heureFin',
    ];

    // Définition des règles de validation pour une nouvelle intervention effective
    public static $rules = [
        'intervention_id' => 'exists:interventions,id|sometimes|required',
        'date' => 'required|date',
        'heureDebut' => 'required|date_format:"H:i:s"|before:heureFin',
        'heureFin' => 'required|date_format:"H:i:s"|after:heureDebut',
    ];

    public static function getValidation(Array $inputs)
    {
        $validator = Validator::make($inputs, static::$rules);
        //test en plus des rules
        $validator->after(function ($validator) use($inputs) {

            if(!isset($inputs['update'])){
                $existe = InterventionEffective::where('intervention_id',$inputs['intervention_id'])
                    ->where('date',$inputs['date'])
                    ->where('heureDebut',$inputs['heureDebut'])
                    ->where('heureFin',$inputs['heureFin'])
                    ->first();

                if(!empty($existe)){
                    $validator->getMessageBag()->add('interventionEffective', 'intervention effective existe deja');
                }
            }

        });
        return $validator;
    }

    public static function saveOne(array $values)
    {
        $interventionEffective = new self();

        $interventionEffective->intervention_id = $values['intervention_id'];
        $interventionEffective->date = $values['date'];
        $interventionEffective->heureDebut = $values['heureDebut'];
        $interventionEffective->heureFin = $values['heureFin'];

        $interventionEffective->save();

        return $interventionEffective;
    }

    public function intervention(){
        return $this->belongsTo('App\Intervention');
    }

    public function rapport(){
        return $this->hasOne('App\Rapport');
    }

    public function errors()
    {
        return $this->errors;
    }
}
