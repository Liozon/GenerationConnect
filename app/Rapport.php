<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\InterventionEffective;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rapport extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'interventionEffective_id',
        'classement',
        'commentaireTitre',
        'commentaireDescription',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $errors;
    
    // D�finition des r�gles de validation pour un nouveau rapport
    public static $rules = [
        'user_id' => 'exists:users,id|sometimes|required',
        'interventionEffective_id' => 'exists:interventioneffectives,id|sometimes|required',
        'classement' => 'nullable',
        'commentaireTitre' => 'nullable',
        'commentaireDescription' => 'nullable'
    ];

    public static function getValidation(Array $inputs)
    {
        
        $validator = Validator::make($inputs, static::$rules);
        //test en plus des rules
        $validator->after(function ($validator) use($inputs) {

            if(!isset($inputs['update'])){
                $existe = Rapport::where('user_id',$inputs['user_id'])
                ->where('interventionEffective_id',$inputs['interventionEffective_id'])
                ->first();

                if(!empty($existe)){
                    $validator->getMessageBag()->add('rapport', 'rapport existe deja');
                }
            }

        });
        return $validator;
    }

    public static function saveOne(array $values)
    {
        $rapport = new self();

        $rapport->user_id = $values['user_id'];
        $rapport['interventionEffective_id'] = $values['interventionEffective_id'];
        $rapport['classement'] = $values['classement'];
        $rapport['commentaireTitre'] = $values['commentaireTitre'];
        $rapport['commentaireDescription'] = $values['commentaireDescription'];

        $rapport->save();

        return $rapport;
    }

    public function interventioneffective(){
        return $this->belongsTo('App\Interventioneffective');
    }

    public function errors()
    {
        return $this->errors;
    }
}