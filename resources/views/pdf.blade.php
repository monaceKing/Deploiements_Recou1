<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('Css/monStyle.css')}}">
</head>

<style>
    body, html {
  margin: 0;
  padding: 0;
  margin-bottom: 0;
}

.hidden {
  display: none;
}

.total-container {
  font-size: 18px; /* Taille de police */
  margin-top: 10px; /* Espacement vers le haut */
}

.total-debit,
.total-credit,
.solde {
  margin-right: 20px; /* Espacement horizontal entre les totaux */
  font-weight: bold;
}

#moa{
  margin: 10px;
}
</style>

<body>
    <h1>ça commence à venir...</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Ligne</th>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>N° facture</th>
                <th>Libellé</th>
                <th>Echeance</th>

            </tr>
        </thead>

        @php
            $currentCTNum = null;
            $totalDebit = 0;
            $totalCredit = 0;
        @endphp

        @foreach ($users as $donnee)

        <tbody>
            <tr>
                <td>{{ $donnee->CO_Nom }}</td>
                <td>{{ $donnee->CT_Intitule }}</td>
                <td>{{ $donnee->CT_Telephone }}</td>
                <td>justeamour@gmail.com</td>
                <td>{{$donnee->EC_RefPiece}}</td>
                <td>{{$donnee->EC_Intitule}}</td>
                <td>{{(new DateTime($donnee->EC_Echeance))->format('d/m/Y')}}</td>
            </tr>
        </tbody>

        @endforeach
    </table>
</body>
</html>