<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Employe extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
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
    ];

    public static function getValidation(Array $inputs)
    {
        $validator = Validator::make($inputs, static::$rules);
        //test en plus des rules
        $validator->after(function ($validator) use($inputs) {

            if(!isset($inputs['update'])){
                $existe = Employe::where('user_id',$inputs['user_id'])->first();

                if(!empty($existe)){
                    $validator->getMessageBag()->add('employe', 'employe existe deja');
                }
            }

        });
        return $validator;
    }

    public static function saveOne(array $values)
    {
        $employe = new self();

        $employe->user_id = $values['user_id'];

        $employe->save();

        return $employe;
    }

    public function demandes(){
        return $this->hasMany('App\Demande');
    }

    public function interventions(){
        return $this->hasMany('App\Intervention');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function errors()
    {
        return $this->errors;
    }
}
