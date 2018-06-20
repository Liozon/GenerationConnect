<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nom',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $errors;

    // Définition des règles de validation pour un nouvelle region
    public static $rules = [
        'nom' => 'required|string'
    ];

    public static function getValidation(Array $inputs)
    {
        $validator = Validator::make($inputs, static::$rules);
        //test en plus des rules
        $validator->after(function ($validator) use($inputs) {

            if(!isset($inputs['update'])){
                $existe = Region::where('nom',$inputs['nom'])
                    ->first();

                if(!empty($existe)){
                    $validator->getMessageBag()->add('region', 'region existe deja');
                }
            }
        });
        return $validator;
    }

    public static function saveOne(array $values)
    {
        $region = new self();

        $region->nom = $values['nom'];

        $region->save();

        return $region;
    }

    public function juniors(){
        return $this->belongsToMany('App\Junior','junior_region');
    }

    public function errors()
    {
        return $this->errors;
    }
}