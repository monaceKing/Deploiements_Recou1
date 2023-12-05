<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recupération</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('Css/monStyle.css')}}">
{{-- DataTable --}}
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.jqueryui.min.css">

 {{-- <!-- Inclure jQuery localement -->
 <script src="Js/jquery.min.js"></script>
   <!-- Inclure les fichiers CSS et JS de DataTables localement -->
   <link rel="stylesheet" href="Css/jquery.dataTables.min.css">
   <script src="Js/jquery.dataTables.min.js"></script> --}}

</head>
<body>
<div class="container">
    <ul class="nav justify-content-center p-3 bg-light">
        <li class="nav-item">
            <button id="btnFiltrerNonVide" class="btn btn-secondary m-2">Solde Lettré</button> 
        </li>
        <li class="nav-item">
            <button id="btnFiltrerVide" class="btn btn-primary m-2">Solde non Lettré</button>
        </li>
        <li class="nav-item">
            <button id="btnEffacerFiltre" class="btn btn-warning m-2">Effacer le filtre</button>
        </li>
      </ul>
</div>
<div class="text-center">
    <div class="py-5">
       <div style="display: grid; grid-template-columns: auto auto;">
       {{-- totalDebit --}}
        <span id="totalDebit1" class="fw-bolder text-primary" style="display: inline-block;"></span>
       {{-- totalCredit --}}
        <span id="totalCredit" class="fw-bolder text-success" style="display: inline-block;"></span>
        </div>
        <!-- Ajoutez deux boutons pour le filtrage -->
        <table class="table table-dark table-hover py-5 mx-auto" id="myTable">
            <thead class="table-light">
                <p id="totalDebit" class="justify-content-center fw-bolder"></p>
                <tr>
                    <th>#</th>
                    <th>JM_Date</th>
                    <th>JO_Num</th>
                    <th>CT_Num</th>
                    <th>EC_RefPiece</th>
                    <th>EC_Intitule</th>
                    <th>CG_Num</th>
                    <th>EC_Echeance</th>
                    <th>N°?</th>
                    <th>Débit</th>
                    <th class="hidden">King</th>
                    <th>Crédit</th>
                    <th>EC_Lettrage</th>
                </tr>
            </thead>
    
            <tbody>
                
                @php
                    $ide = 1;
                @endphp
                @foreach ($dataBase as $donnee)
                
                @php
                    $amount = $donnee->EC_Montant;
                    $format = number_format($amount,0, '.', '.');
                @endphp

                <tr>
                    <td>{{$ide}}</td>
                    <td>{{(new DateTime($donnee->JM_Date))->format('d/m/Y')}}</td>
                    <td>{{$donnee->JO_Num}}</td>
                    <td>{{$donnee->CT_Num}}</td>
                    <td>{{$donnee->EC_RefPiece}}</td>
                    <td>{{$donnee->EC_Intitule}}</td>
                    <td>{{$donnee->CG_Num}}</td>
                    <td>{{(new DateTime($donnee->EC_Echeance))->format('d/m/Y')}}</td>
                    <td style="color:chartreuse">
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
                           if ($donnee->EC_Sens <= 0) {
                                echo $donnee->EC_Montant;
                           } else {
                            echo 0;
                           }
                        @endphp
                    </td>
                    <td class="hidden">
                        {{-- Calcul débit --}}
                        @php
                           if ($donnee->EC_Sens <= 0) {
                                echo $donnee->EC_Montant;
                           } else {
                            echo 0;
                           }
                        @endphp

                    </td>

                    <td>
                        {{-- Crédit --}}
                        @php
                           if ($donnee->EC_Sens > 0) {
                                echo $donnee->EC_Montant;
                           } else {
                            echo 0;
                           }
                        @endphp
                    </td>
                    <td>{{$donnee->EC_Lettrage}}</td> 
                </tr>
                    @php
                    $ide +=1;
                    @endphp
                    @endforeach
        </tbody>
        </table> 
    </div> 
    </div>
</div>
    {{--Bootstrap--}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    {{-- DataTable --}}
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.jqueryui.min.js"></script>

{{--Appel script personnalisé--}}
<script src="{{asset('Js/monScript.js')}}"></script>
</body>
</html>