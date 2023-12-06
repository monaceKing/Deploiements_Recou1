@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __("Tableau d'affichage") }}</div>
                <div class="card-body">
                    {{-- <input type="text" id="search" placeholder="Rechercher par CO_No"> --}}
        <p id="total-montant" class="fw-bold py-1"></p>
        <table class="table table-striped" id="table-body">
            <tr>
                <th>Ligne</th>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Solde</th>
                <th>Action</th>
            </tr>
            @php $currentIntitule = null; @endphp
            @php
            $totalDebit = 0;
            $totalCredit = 0;
            @endphp
            @foreach($data as $row)
                @if($currentIntitule != $row->CT_Intitule)
                    <tr>
                        <td class="hidden">
                            {{-- Calcul débit --}}
                            @php
                               $debitValue = ($row->EC_sens <= 0) ? $row->Ec_Montant : 0;
                               $totalDebit += $debitValue;
                            @endphp
        
                        </td>
                        <td class="hidden">
                            {{-- Calcul crédit --}}
                                @php
                                    $creditValue = ($row->EC_sens > 0) ? $row->Ec_Montant : 0;
                                    $totalCredit += $creditValue;
                                @endphp
                        </td>
                        <td>{{ $row->CO_Nom }}</td>
                        <td>{{ $row->CT_Intitule }}</td>
                        <td>{{ $row->CT_Telephone }}</td>
                        <td>justeamour@gmail.com</td>
                        <?php
                        // Calcul du solde
                        $solde = $totalDebit - $totalCredit;    
                        ?>
                        <td class="solde">{{ number_format($solde, 0, ' ', ' ') }}</td>
                        <td>
                            <a href="/details/{{$row->CT_Num}}" class="btn btn-primary" target="_blank">Voir les factures</a>
                        </td>
                    </tr>
                        @php $currentIntitule = $row->CT_Intitule; @endphp
                    @endif
                    @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
