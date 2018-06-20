<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competence extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nom',
        'categorie'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $errors;

    // Définition des règles de validation pour une nouvelle competence
    public static $rules = [
        'nom' => 'required|string',
        'categorie' => 'required|string'
    ];

    public static function getValidation(Array $inputs)
    {
        $validator = Validator::make($inputs, static::$rules);
        //test en plus des rules
        $validator->after(function ($validator) use($inputs) {

            if(!isset($inputs['update'])){
                $existe = Competence::where('nom',$inputs['nom'])
                    ->where('categorie',$inputs['categorie'])
                    ->first();
                if(!empty($existe)){
                    $validator->getMessageBag()->add('competence', 'competence existe deja');
                }
            }
        });
        return $validator;
    }

    public static function saveOne(array $values)
    {
        $competence = new self();

        $competence->nom = $values['nom'];
        $competence->categorie = $values['categorie'];

        $competence->save();

        return $competence;
    }

    public function juniors(){
        return $this->belongsToMany('App\Junior', 'competence_junior')->withTimestamps()->withPivot('niveau');
    }

    public function demandes(){
        return $this->belongsToMany('App\Demande','competence_demande');
    }

    public function errors()
    {
        return $this->errors;
    }

}