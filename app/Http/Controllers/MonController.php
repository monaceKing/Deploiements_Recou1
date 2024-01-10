<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\MonModel;
use App\Models\ModelCompteT;
use App\Models\ModelCollaborateurs;
use App\Models\Portefeuille;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Recouvrement;
use PDF;

class MonController extends Controller
{
    public function montrer(Request $request){
        $dataBase = MonModel::select(
            'JM_Date', 
            'JO_Num',
             'CT_Num',
              'EC_RefPiece',
               'EC_Intitule',
                'CG_Num',
                 'EC_Echeance',
                  'EC_Sens',
                   'EC_Montant',
                    'EC_Lettrage')
            ->get();
            return view('juste',compact('dataBase'));


}


    public function faux(Request $request){
        $data = ModelCompteT ::join('F_ECRITUREC', 'F_COMPTET.CT_Num', '=', 'F_ECRITUREC.CT_Num')
        ->join('F_COLLABORATEUR', 'F_COMPTET.CO_No', '=', 'F_COLLABORATEUR.CO_No')
        ->select('F_COMPTET.CO_No','F_COLLABORATEUR.CO_Nom', 'F_ECRITUREC.CT_Num', 'F_ECRITUREC.EC_Intitule', 'F_ECRITUREC.EC_sens', 'F_ECRITUREC.Ec_Montant', 'F_ECRITUREC.EC_Echeance')
        ->where('F_ECRITUREC.CT_Num', 'like', 'CL%')
        ->orderBy('F_ECRITUREC.CT_Num')
        ->whereYear('EC_Echeance','2023')
        ->get();

        return view('faux',compact('data'));
    }

    
    

    public function details($CT_Num){
        $data = DB::table('F_ECRITUREC')
        ->join('F_COMPTET', 'F_ECRITUREC.CT_Num', '=', 'F_COMPTET.CT_Num')
        ->join('F_COLLABORATEUR', 'F_COMPTET.CO_No', '=', 'F_COLLABORATEUR.CO_No')
        ->join('portefeuilles', 'F_COLLABORATEUR.CO_Nom', '=', 'portefeuilles.name')
        ->join('portefeuille_user', 'portefeuilles.id', '=', 'portefeuille_user.portefeuille_id')
        ->join('users', 'portefeuille_user.user_id', '=', 'users.id')
        ->select(
            'F_COMPTET.CO_No',
            'F_COMPTET.CT_Intitule',
            'F_COMPTET.CT_Telephone',
            'F_COMPTET.CT_EMail',
            'F_COLLABORATEUR.CO_Nom',
            'F_ECRITUREC.CT_Num',
            'F_ECRITUREC.EC_Intitule',
            'F_ECRITUREC.EC_sens',
            'F_ECRITUREC.Ec_Montant',
            'F_ECRITUREC.EC_Echeance',
            'F_ECRITUREC.EC_RefPiece',
            'F_ECRITUREC.EC_Lettre',
        )
        ->where('F_ECRITUREC.CT_Num', '=', $CT_Num)
        ->where('F_ECRITUREC.EC_Lettre','=', 0)
        ->where('F_ECRITUREC.CT_Num', 'like', 'CL%')
        // ->whereYear('EC_Echeance','2023')
        ->get();
        return view('details', compact('data'));
    }



    
    public function fusion()
    {
        $data = ModelCompteT ::join('F_ECRITUREC', 'F_COMPTET.CT_Num', '=', 'F_ECRITUREC.CT_Num')
        ->join('F_COLLABORATEUR', 'F_COMPTET.CO_No', '=', 'F_COLLABORATEUR.CO_No')
        ->select('F_COMPTET.CO_No','F_COLLABORATEUR.CO_Nom', 'F_ECRITUREC.CT_Num', 'F_ECRITUREC.EC_Intitule', 'F_ECRITUREC.EC_sens', 'F_ECRITUREC.Ec_Montant', 'F_ECRITUREC.EC_Echeance')
        ->where('F_ECRITUREC.CT_Num', 'like', 'CL%')
        ->orderBy('F_ECRITUREC.CT_Num')
        ->whereYear('EC_Echeance','2023')
        ->get();
       
        return view('jointure',compact('data'));
    }


    public function peuplerPortefeuilleAvecCO_No()
    {
        // Récupérez les données de la colonne "CO_No" depuis la table "F_CompteT" avec la condition whereYear
        $donneesCO_No = ModelCollaborateurs::select('CO_Nom')->pluck('CO_Nom');
    
        // Parcourez les données et créez des enregistrements dans la table "portefeuille" uniquement s'ils n'existent pas déjà
        foreach ($donneesCO_No as $coNo) {
            if (!Portefeuille::where('name', $coNo)->exists()) {
                $portefeuille = new Portefeuille();
                $portefeuille->name = $coNo;
                $portefeuille->save();
            }
        }
    
        return "Mise à jour de la colonne name de la table Portefeuille.";
    }

    public function enregistrerLigne(Request $request){
        $id_agent = $request->input('id_agent');
        $idClient = $request->input('idClient');
        $ligne = $request->input('ligne');
        $email = $request->input('email');
        $num_facture = $request->input('num_facture');
        $libelle = $request->input('libelle');
        $telephone = $request->input('telephone');
        $credit = $request->input('credit');
        $debit = $request->input('debit');


        // Vérifier si un enregistrement avec le même 'libelle' existe déjà
        $existingRecord = DB::table('recouvrements')
        ->where('libelle', $libelle)
        ->first();

        if ($existingRecord) {
            // Gérer le cas où un enregistrement avec le même 'libelle' existe déjà
            return redirect()->back()->with('message', 'Un enregistrement avec le même libellé existe déjà.');
        }


        DB::table('recouvrements')->insert([
            'ligne' => $ligne,
            'idClient' => $idClient,
            'libelle' => $libelle,
            'email' => $email,
            'telephone' => $telephone,
            'num_facture' => $num_facture,
            'credit' => $credit,
            'debit' => $debit,
            'id_agent' => $id_agent,
        ]);

        return redirect()->back()->with('message', 'Enregistrement inséré avec succès.');
    }



    public function enregistrer_commentaire(Request $request){
        $id_agent = $request->input('id_agent');
        $idClient = $request->input('idClient');
        $ligne = $request->input('ligne');
        $email = $request->input('email');
        $num_facture = $request->input('num_facture');
        $libelle = $request->input('libelle');
        $telephone = $request->input('telephone');
        $message = $request->input('message');
        $credit = $request->input('credit');
        $debit = $request->input('debit');




        DB::table('commentaires')->insert([
            'ligne' => $ligne,
            'idClient' => $idClient,
            'libelle' => $libelle,
            'email' => $email,
            'telephone' => $telephone,
            'num_facture' => $num_facture,
            'credit' => $credit,
            'debit' => $debit,
            'message' => $message,
            'id_agent' => $id_agent,
        ]);

        return redirect()->back()->with('message', 'Message ajouter.');
    }

    public function client_recouvre($id){
        $data = Recouvrement::all()->where("id_agent", "=", $id);
        return view('les_recouvres', compact('data'));
    }

    public function client_rappel($id){
        $data = Commentaire::all()->where("id_agent", "=", $id);
        return view('rappels', compact('data'));
    }

}

