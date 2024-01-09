@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{asset('Css/details.css')}}">

<div id="moa">

    <div class="header">
        <div class="header-left">
            <p>Nom de la société: IGF</p>
            <p>Période: Janvier 2023</p>
        </div>
        <div class="header-right">
            <p>Extrait de compte compte tiers</p>
            <p>Tenue de compte: XOF</p>
            <p id="dateTirage">Date de tirage: </p>
        </div>
    </div>
    <div class="card">
        <div class="card-body rounded">
            <div class="row justify-content-center rounded">
                <div class="col-md-10">
                    @if(count($data) > 0)
                    <table class="table table-secondary table-responsive rounded table-ct">
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Intitulé</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $data[0]->CT_Num }}</td>
                                <td>{{ $data[0]->CT_Intitule }}</td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                </div>
            </div>
        </div>
        {{-- <div class="card-header">{{ __("Tableau de détails") }}</div> --}}
        <div class="card-body">
            <table class="table table-bordered border-primary" id="myTable">
                <thead>
                    <tr>
                        <th>Ligne</th>
                        {{-- <th>Nom</th> --}}
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>N° facture</th>
                        <th>Libellé</th>
                        <th>Echeance</th>
                        <th>Rétard</th>
                        <th class="col-2">Débit</th>
                        <th class="col-2">Crédit</th>
                        <th>Commentaire</th>
                        <th class="col-2">Check-box</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $currentCTNum = null;
                        $totalDebit = 0;
                        $totalCredit = 0;
                    @endphp
                    @foreach ($data as $donnee)
                        @php
                            $amount = $donnee->Ec_Montant;
                            $format = number_format($amount, 0, ' ', ' ');
                        @endphp
                        <tr>
                            <td>{{ $donnee->CO_Nom }}</td>
                            {{-- <td>{{ $donnee->CT_Intitule }}</td> --}}
                            <td>{{ $donnee->CT_Telephone }}</td>
                            <td>justeamour@gmail.com</td>
                            <td>{{ $donnee->EC_RefPiece }}</td>
                            <td>{{ $donnee->EC_Intitule }}</td>
                            <td>{{ (new DateTime($donnee->EC_Echeance))->format('d/m/Y') }}</td>
                            <td class="retard" style="color: #ff0000">
                                @php
                                    $date1 = new DateTime($donnee->EC_Echeance);
                                    $date2 = new DateTime();
                                    $intervalle = $date2->diff($date1);
                                    $nj = $intervalle->format('%a');
                                    //Si le débit = 0 ne pas afficher les jours de retard
                                    echo ($nj > 100) ? '' : $nj;
                                @endphp
                            </td>
                            <td>
                                {{-- Débit --}}
                                @php
                                    if ($donnee->EC_sens <= 0) {
                                        echo $format;
                                    } else {
                                        echo 0;
                                    }
                                @endphp
                            </td>
                            <td class="hidden">
                                {{-- Calcul débit --}}
                                @php
                                    $debitValue = ($donnee->EC_sens <= 0) ? $donnee->Ec_Montant : 0;
                                    $totalDebit += $debitValue;
                                @endphp
                            </td>
                            <td>
                                {{-- Crédit --}}
                                @php
                                    if ($donnee->EC_sens > 0) {
                                        echo $format;
                                    } else {
                                        echo 0;
                                    }
                                @endphp
                            </td>
                            <td class="hidden">
                                {{-- Calcul crédit --}}
                                @php
                                    $creditValue = ($donnee->EC_sens > 0) ? $donnee->Ec_Montant : 0;
                                    $totalCredit += $creditValue;
                                @endphp
                            </td>
                            <td>
                                <textarea name="" id="" cols="15" rows="1"></textarea>
                            </td>
                            <td>
                                <input type="checkbox" name="" id="">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <button class="btn btn-success imprimer-bouton mb-3" onclick="imprimerPage()">Imprimer</button>
                </tfoot>
            </table>
            <div class="mb-3 justify-content-center">
                <?php
                    // Calcul du solde
                    $solde = $totalDebit - $totalCredit;    
                ?>
                <span class="total-debit">Total Débit : {{ number_format($totalDebit, 0, ' ', ' ') }}</span>
                <span class="total-credit">Total Crédit : {{ number_format($totalCredit, 0, ' ', ' ') }}</span>
                <span class="solde">Solde : {{ number_format($solde, 0, ' ', ' ') }}</span>
            </div>
        </div>
    </div>
</div>
 <script src="{{asset('Js/details.js')}}"></script>
@endsection
