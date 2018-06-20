<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class User extends Authenticatable
{

    use SoftDeletes;

    use Notifiable;

    protected $fillable = [
        'pseudo', 'nom', 'prenom','email','ville','codePostal','sexe','canton','adresse','telephone','telephone_2','photo','motDePasse',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Définition des règles de validation pour un nouveau User
    public static $rules = [
        'pseudo' => 'required|string',
        'nom' => 'required|alpha',
        'password' => 'required|string',
        'prenom' => 'required|alpha',
        'email' => 'nullable|email',
        'sexe' => 'required|in:"femme","homme","autre"',
        'ville' => 'required|string',
        'codePostal' => 'required|numeric|digits:4',
        'adresse' => 'required|string',
        'canton' => 'required|string',
        'telephone' => 'required|numeric|digits:10',
        'telephone_2' => 'nullable|numeric|digits:10',
        'photo' => 'required|string',
    ];

    public static function getValidation(Array $inputs)
    {

        $validator = Validator::make($inputs, static::$rules);

        //test en plus des rules
        $validator->after(function ($validator) use($inputs) {

            if(!isset($inputs['update'])){
                $existe = User::where('pseudo',$inputs['pseudo'])->first();

                if(!empty($existe)){
                    $validator->getMessageBag()->add('user', 'user existe déjà');
                }
            }

        });
        return $validator;
    }

    public static function saveOne(Array $values){

        $user = new self();

        $user->pseudo = $values['pseudo'];
        $user->password = $values['password'];
        $user->nom = $values['nom'];
        $user->prenom = $values['prenom'];
        $user->sexe = $values['sexe'];
        $user->email = $values['email'];
        $user->ville = $values['ville'];
        $user->canton = $values['canton'];
        $user->codePostal = $values['codePostal'];
        $user->adresse = $values['adresse'];
        $user->telephone = $values['telephone'];
        $user->telephone_2 = $values['telephone_2'];
        $user->photo = $values['photo'];

        $user->save();

        return $user;
}

    public function groupes(){
        return $this->belongsToMany('App\Groupe','groupe_user');
    }

    public function junior(){
        return $this->hasOne('App\Junior');
    }

    public function employe(){
        return $this->hasOne('App\Employe');
    }

    public function senior(){
        return $this->hasOne('App\Senior');
    }

    public function errors()
    {
        return $this->errors;
    }

}
