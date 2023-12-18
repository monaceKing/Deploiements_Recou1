<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portefeuille extends Model
{
    use HasFactory;

    //laison avec le model User
    public function users(){
        return $this->belongsToMany(User::class, 'portefeuille_user', 'portefeuille_id', 'user_id');
    }
}
