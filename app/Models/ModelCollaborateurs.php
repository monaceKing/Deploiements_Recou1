<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ModelCollaborateurs extends Model
{
    use HasFactory, Searchable;
    protected $connection = 'external_db';
    protected $table = 'F_COLLABORATEUR';
}
