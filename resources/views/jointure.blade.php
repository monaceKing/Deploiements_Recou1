<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <h1>Recouvrement</h1>
<div class="container py-4">
    <input type="text" id="search" placeholder="Rechercher par CO_No">
    <p id="total-montant"></p>

    <table class="table table-striped" id="table-body">
        <tr>
            <th>CO_Nom</th>
            <th>Co_No</th>
            <th>Ct_num</th>
            <th>Ec_intitule</th>
            <th>EC_sens</th>
            <th>Débit</th>
            <th>Crédit</th>
            <th>Ec_Montant</th>
            <th>Ec_Echéance</th>
            <th>N° Delais</th>
        </tr>
        @foreach($data as $row)
        
            <tr>
                <td>{{ $row->CO_Nom }}</td>
                <td>{{ $row->CO_No }}</td>
                <td>{{ $row->CT_Num }}</td>
                <td>{{ $row->EC_Intitule }}</td>
                <td>{{ $row->EC_sens }}</td>
                <td>
                    @php
                        if ($row->EC_sens <= 0) {
                                echo $row->Ec_Montant;
                           } else {
                            echo 0;
                           }
                    @endphp
                </td>
                <td>
                    @php
                        if ($row->EC_sens > 0) {
                            echo $row->Ec_Montant;
                       } else {
                        echo 0;
                       }
                    @endphp
                </td>
                <td>{{ $row->Ec_Montant }}</td>
                <td>{{(new DateTime($row->EC_Echeance))->format('d/m/Y')}}</td>
                <td>
                    @php
                        $date1 = new DateTime($row->EC_Echeance); //date d'echéance

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
            </tr>
        @endforeach
    </table>
    <div id="error-message" style="color: red; display: none;">Aucun résultat trouvé.</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

 {{--Appel script personnalisé--}}
 <script src="{{asset('Js/fusion.js')}}"></script>
</body>
</html>