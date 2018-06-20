<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Competencejunior extends Model
{
    protected $table = "competence_junior";

    // Définition des règles de validation pour une nouvelle competence
    public static $rules = [
        'competence_id' => 'exists:competences,id|sometimes|required',
        'junior_id' => 'exists:juniors,id|sometimes|required',
        'niveau' => 'required|numeric'
    ];

    public static function getValidation(Array $inputs)
    {
        $validator = Validator::make($inputs, static::$rules);
        //test en plus des rules
        $validator->after(function ($validator) use($inputs) {

            $existe = Competencejunior::where('junior_id',$inputs['junior_id'])
                ->where('competence_id',$inputs['competence_id'])
                ->where('niveau',$inputs['niveau'])
                ->first();

            if(!empty($existe)){
                $validator->getMessageBag()->add('liaison', 'cette liaison existe deja');
            }
        });
        return $validator;
    }

    public function errors()
    {
        return $this->errors;
    }

}
