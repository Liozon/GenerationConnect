<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Demande extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'junior_id',
        'senior_id',
        'employe_id',
        'description',
        'date',
        'titre',
        'statut'
    ];

    protected $hidden = [
        'created_at',
        'deleted_at'
    ];

    protected $errors;

    // Définition des règles de validation pour une nouvelle demande
    public static $rules = [
        'junior_id' => 'exists:juniors,id|nullable',
        'senior_id' => 'exists:seniors,id|sometimes|required',
        'employe_id' => 'exists:employes,id|nullable',
        'description' => 'required|string',
        'date' => 'required|date',
        'heure' => 'required|date_format:"H:i:s"',
        'duree' => 'required|date_format:"H:i:s"',
        'titre' => 'required|string',
        'statut' => 'required|in:"envoyé","reçu","accepté","validé","refusé","annulé"'
    ];

    public static function getValidation(Array $inputs)
    {
        $validator = Validator::make($inputs, static::$rules);
        //test en plus des rules
        $validator->after(function ($validator) use($inputs) {

            if(!isset($inputs['update'])){
                $existe = Demande::where('employe_id',$inputs['employe_id'])
                    ->where('senior_id',$inputs['senior_id'])
                    ->where('junior_id',$inputs['junior_id'])
                    ->where('description',$inputs['description'])
                    ->where('date',$inputs['date'])
                    ->where('heure',$inputs['heure'])
                    ->where('duree',$inputs['duree'])
                    ->where('titre',$inputs['titre'])
                    ->first();

                if(!empty($existe)){
                    $validator->getMessageBag()->add('demande', 'demande existe deja');
                }
            }

        });
        return $validator;
    }

    public static function saveOne(array $values)
    {
        $demande = new self();

        $demande->junior_id = $values['junior_id'];
        $demande->senior_id = $values['senior_id'];
        $demande->employe_id = $values['employe_id'];
        $demande->description = $values['description'];
        $demande->titre = $values['titre'];
        $demande->date = $values['date'];
        $demande->heure = $values['heure'];
        $demande->duree = $values['duree'];
        $demande->statut = $values['statut'];

        $demande->save();

        return $demande;
    }

    public function competences(){
        return $this->belongsToMany('App\Competence', 'competence_demande');
    }

    public function junior(){
        return $this->belongsTo('App\Junior');
    }

    public function senior(){
        return $this->belongsTo('App\Senior');
    }

    public function employe(){
        return $this->belongsTo('App\Employe');
    }

    public function disponibilites(){
        return $this->belongsToMany('App\Disponibilite','demande_disponibilite');
    }

    public function intervention(){
        return $this->hasOne('App\Intervention');
    }

    public function errors()
    {
        return $this->errors;
    }
}
