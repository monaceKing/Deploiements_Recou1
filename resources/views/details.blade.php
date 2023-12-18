@extends('layouts.app')

@section('content')
<div class="py-5" id="moa">
    {{-- <ul class="nav justify-content-center p-3 bg-light">
        <li class="nav-item">
            <button id="btnFiltrerNonVide" class="btn btn-secondary m-2">Solde Lettré</button> 
        </li>
        <li class="nav-item">
            <button id="btnFiltrerVide" class="btn btn-primary m-2">Solde non Lettré</button>
        </li>
        <li class="nav-item">
            <button id="btnEffacerFiltre" class="btn btn-warning m-2">Effacer le filtre</button>
        </li>
      </ul> --}}
    <div class="row justify-content">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __("Tableau de détails") }}</div>
                <div class="card-body">
                    {{-- <input type="text" id="search" placeholder="Rechercher par CO_No"> --}}
        <table class="table table-striped" id="myTable">
            <tr>
                <th>Ligne</th>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>N° facture</th>
                <th>Libellé</th>
                <th>Echeance</th>
                <th>Rétard</th>
                <th>Débit</th>
                <th>Crédit</th>
            </tr>
            @php
            $currentCTNum = null;
            $totalDebit = 0;
            $totalCredit = 0;
            @endphp
            @foreach ($data as $donnee)
                    
            @php
                $amount = $donnee->Ec_Montant;
                $format = number_format($amount,0, ' ', ' ');
            @endphp

            <tr>
                <td>{{ $donnee->CO_Nom }}</td>
                <td>{{ $donnee->CT_Intitule }}</td>
                <td>{{ $donnee->CT_Telephone }}</td>
                <td>justeamour@gmail.com</td>
                <td>{{$donnee->EC_RefPiece}}</td>
                <td>{{$donnee->EC_Intitule}}</td>
                <td>{{(new DateTime($donnee->EC_Echeance))->format('d/m/Y')}}</td>
                <td style="color:rgb(4, 255, 0)">
                    @php
                        $date1 = new DateTime($donnee->EC_Echeance); //date d'echéance

                        $date2 = new DateTime(); //Date d'aujourd'hui

                        $intervalle = $date2->diff($date1);

                        $nj = $intervalle->format('%a');

                        
                        if ($date1 > $date2) {
                            echo (-$nj);
                        }else{
                            echo ($nj);
                        }
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
            </tr>
                @endforeach
        </table>
        <div id="error-message" style="color: red; display: none;">Aucun résultat trouvé.</div>
                </div>
            </div>
        </div>
    </div>
    {{-- Affichage des totaux dans des balises <span> --}}
    <div class="total-container">
        <?php
            // Calcul du solde
            $solde = $totalDebit - $totalCredit;    
        ?>
        <span class="total-debit">Total Débit : {{ number_format($totalDebit, 0, ' ', ' ') }}</span>
        <span class="total-credit">Total Crédit : {{ number_format($totalCredit, 0, ' ', ' ') }}</span>
        <span class="solde">Solde : {{ number_format($solde, 0, ' ', ' ') }}</span>
    </div>
</div>
<div>
    <script src="{{asset('Js/king.js')}}"></script>
</div>
@endsection
