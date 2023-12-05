<?php

namespace App\Http\Controllers;

use App\Models\MonModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FauxController extends Controller
{
    public function time()
{
    $jsonStrings = MonModel::select('EC_Echeance')
        ->whereYear('EC_Echeance', '=', '2022')
        ->get();

    $differences = [];

    if ($jsonStrings->isNotEmpty()) {
        $aujourdHui = Carbon::now()->startOfDay(); // Début de la journée d'aujourd'hui

        foreach ($jsonStrings as $jsonString) {
            $dateString = $jsonString->EC_Echeance;
            $date = Carbon::createFromFormat('Y-m-d H:i:s.u', $dateString);

            if ($date !== false) {
                $difference = $date->diffInDays($aujourdHui);
                $differences[] = $difference;
            }
        }
    }

    return view('Faux', ['differences' => $differences]);
}
}

