<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const CREATE="C";
    const READ="R";
    const UPDATE="U";
    const DELETE="D";
}
