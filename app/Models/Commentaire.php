<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use \Illuminate\Database\Eloquent\Concerns\HasTimestamps;
    use HasFactory;
    protected $fillable = [
        "ligne",
        "idClient",
        "libelle",
        "email",
        "telephone",
        "num_facture",
        "credit",
        "debit",
        "message",
        "id_agent"
    ];
}
