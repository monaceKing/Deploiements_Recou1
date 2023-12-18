@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __("Tableau d'affichage") }}</div>
                <div class="card-body">
                    {{-- <input type="text" id="search" placeholder="Rechercher par CO_No"> --}}
                    @if(count($data) > 0)
                    <table class="table table-bordered">
                        <thead class=" text-cente">
                            <tr>
                                <th>Nom</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Ligne</th>
                                <th>Libellé</th>
                                <th>N° Facture</th>
                                <th>Action</th>
                                <th>Solde</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $currentCTNum = null;
                                $totalDebit = 0;
                                $totalCredit = 0;
                                $currentSolde = 0;
                            @endphp
                    
                            @foreach($data as $item)
                                @if($currentCTNum !== $item->CT_Num)
                                    {{-- Fermer la ligne précédente avant d'ouvrir une nouvelle --}}
                                    @if($currentCTNum !== null)
                                        <td>{{ $totalDebit - $totalCredit }}</td>
                                        </tr>
                                    @endif
                    
                                    {{-- Ouvrir une nouvelle ligne --}}
                                    <tr>
                                        <td>{{ $item->CT_Intitule }}</td>
                                        <td>{{ $item->CT_Telephone }}</td>
                                        {{-- <td>{{ $item->CT_EMail }}</td> --}}
                                        <td>justeamour@gmail.com</td>
                                        <td>{{ $item->CO_Nom }}</td>
                                        <td>{{ $item->EC_Intitule }}</td>
                                        <td>{{ $item->EC_RefPiece }}</td>
                    
                                        <td>
                                            <a href="/details/{{$item->CT_Num}}" class="btn btn-primary" target="_blank">voir les factures</a>    
                                        </td>
                    
                                        @php
                                            // Réinitialise les totaux pour la nouvelle facture
                                            $totalDebit = 0;
                                            $totalCredit = 0;
                                            $currentSolde = 0;
                                            $currentCTNum = $item->CT_Num;
                    
                                            // Vérifie le EC_sens pour déterminer le débit ou le crédit
                                            if ($item->EC_sens > 0) {
                                                $totalCredit += $item->Ec_Montant;
                                            } else {
                                                $totalDebit += $item->Ec_Montant;
                                            }
                                            $currentSolde += $item->Ec_Montant;
                                        @endphp
                                @else
                                    @php
                                        // Vérifie le EC_sens pour déterminer le débit ou le crédit
                                        if ($item->EC_sens > 0) {
                                            $totalCredit += $item->Ec_Montant;
                                        } else {
                                            $totalDebit += $item->Ec_Montant;
                                        }
                                        $currentSolde += $item->Ec_Montant;
                                    @endphp
                                @endif
                            @endforeach
                    
                            {{-- Fermer la dernière ligne --}}
                            <td>{{ $totalDebit - $totalCredit }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @else
                    <p>Aucune donnée disponible.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
