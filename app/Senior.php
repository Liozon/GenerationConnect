<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Senior extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'abonnement_id',
        'etage'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $errors;

    // Définition des règles de validation pour un nouveau senior
    public static $rules = [
        'user_id' => 'exists:users,id|sometimes|required',
        'abonnement_id' => 'exists:abonnements,id|nullable',
        'etage' => 'nullable|integer'
    ];

    public static function getValidation(Array $inputs)
    {
        $validator = Validator::make($inputs, static::$rules);
        //test en plus des rules
        $validator->after(function ($validator) use($inputs) {

            if(!isset($inputs['update'])){
                $existe = Senior::where('user_id',$inputs['user_id'])->first();

                if(!empty($existe)){
                    $validator->getMessageBag()->add('senior', 'senior existe deja');
                }
            }

        });
        return $validator;
    }

    public static function saveOne(array $values)
    {
        $senior = new self();

        $senior->user_id = $values['user_id'];
        $senior->abonnement_id = $values['abonnement_id'];
        $senior->etage = $values['etage'];

        $senior->save();

        return $senior;
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function demandes(){
        return $this->hasMany('App\Demande');
    }

    public function abonnement(){
        return $this->belongsTo('App\Abonnement');
    }

    public function errors()
    {
        return $this->errors;
    }
}