@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __("Tableau d'affichage") }}</div>
                <div class="card-body">
                    <input type="text" id="search" placeholder="Rechercher par CO_No">
        <p id="total-montant" class="fw-bold py-1"></p>
        <table class="table table-striped" id="table-body">
            <tr>
                <th>Ligne</th>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Factures</th>
                <th>Action</th>
            </tr>
            @php $currentIntitule = null; @endphp
            @foreach($data as $row)
                @if($currentIntitule != $row->CT_Intitule)
                    <tr>
                        <td>{{ $row->CO_Nom }}</td>
                        <td>{{ $row->CT_Intitule }}</td>
                        <td>{{ $row->CT_Telephone }}</td>
                        <td>{{ $row->CT_EMail }}</td>
                        <td>
                            @foreach($data->where('CT_Intitule', $row->CT_Intitule) as $facture)
                                {{ $facture->EC_RefPiece }},
                            @endforeach
                        </td>
                        <td>
                            <a href="/details/{{$row->CT_Num}}" class="btn btn-primary" target="_blank">Voir les factures</a>
                        </td>
                    </tr>
                    @php $currentIntitule = $row->CT_Intitule; @endphp
                @endif
            @endforeach
        </table>
        
        
        <div id="error-message" style="color: red; display: none;">Aucun résultat trouvé.</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
