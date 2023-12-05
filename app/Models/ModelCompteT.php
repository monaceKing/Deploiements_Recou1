<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ModelCompteT extends Model
{
    use HasFactory, Searchable;
    protected $connection = 'external_db';
    protected $table = 'F_COMPTET';

}
