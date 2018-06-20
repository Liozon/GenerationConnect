<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\InterventionEffective;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recurrence extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'disponibilite_id',
        'dateDebut',
        'dateFin',
        'frequence',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $errors;
    // Définition des règles de validation pour un nouvelle récurrence
    public static $rules = [
        'disponibilite_id' => 'exists:disponibilites,id|sometimes|required',
        'dateDebut' => 'required|date|before:dateFin',
        'dateFin' => 'required|date|after:dateDebut',
        'frequence' => 'required|in:"quotidien","hebdomadaire","bihebdomadaire","bimensuel","mensuel"'
    ];

    public static function getValidation(Array $inputs)
    {
        $validator = Validator::make($inputs, static::$rules);
        //test en plus des rules
        $validator->after(function ($validator) use($inputs) {

            if(!isset($inputs['update'])){
                $existe = Recurrence::where('disponibilite_id',$inputs['disponibilite_id'])
                    ->where('description',$inputs['description'])
                    ->where('nom',$inputs['nom'])
                    ->first();

                if(!empty($existe)){
                    $validator->getMessageBag()->add('recurrence', 'recurrence existe deja');
                }
            }

        });
    }

    public static function saveOne(array $values)
    {
        $recurrence = new self();

        $recurrence->dateDebut = $values['dateDebut'];
        $recurrence->dateFin = $values['dateFin'];
        $recurrence->frequence = $values['frequence'];

        $recurrence->save();

        return $recurrence;
    }

    public function disponibilites(){
        return $this->hasMany('App\Disponibilite');
    }

    public function errors()
    {
        return $this->errors;
    }
}