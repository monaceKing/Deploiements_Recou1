<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mieux</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('Css/monStyle.css')}}">
{{-- DataTable --}}
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.jqueryui.min.css">

</head>
<body>
<div class="container" >
    <nav style="display: grid; grid-template-columns: auto auto;" class="nav">
    </nav>
</div>

<div class="container">
    <ul class="nav justify-content-center p-2 fs-5" style="background-color: #f6f7f7">
        <li class="nav-item">
          {{-- totalDebit --}}
          <span id="totalDebit1" class="fw-bolder text-primary nav-link" style="display: inline-block;"></span>
        </li>
        <li class="nav-item">
          {{-- totalCredit --}}
          <span id="totalCredit" class="fw-bolder text-success nav-link" style="display: inline-block;"></span>
        </li>
      </ul>
</div>
<div class="container text-center">
    <div class="py-2">
      <p id="balanceStatus" class="fw-bolder fs-5"></p>
    </div>
  </div>
  
<div class="container text-center">
    <div class="py-5">

        <!-- Ajoutez deux boutons pour le filtrage -->
        <table  class="table table-sm" id="myTable">
            <thead class="table-light">
                <p id="totalDebit" class="justify-content-center fw-bolder"></p>
                <tr>
                    <th>CO_No</th>
                    <th>CO_Nom</th>
                    <th>CT_Num</th>
                    <th>EC_Intitule</th>
                    <th>Débit</th>
                    <th class="hidden"></th>
                    <th>Crédit</th>
                    <th class="hidden"></th>
                    <th>Delais</th>
                    {{-- <th>EC_sens</th>
                    <th>Ec_Montant</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
    
            <tbody>
                
                @foreach ($data as $donnee)
                
                @php
                    $amount = $donnee->Ec_Montant;
                    $format = number_format($amount,0, ' ', ' ');
                @endphp

                <tr>
                    <td>{{ $donnee->CO_Nom }}</td>
                    <td>{{ $donnee->CO_No }}</td>
                    <td>{{$donnee->CT_Num}}</td>
                    <td>{{$donnee->EC_Intitule}}</td>
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
                        if ($donnee->EC_sens <= 0) {
                                echo $donnee->Ec_Montant;
                           } else {
                            echo 0;
                           }
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
                        {{-- calcul Crédit --}}
                        @php
                        if ($donnee->EC_sens > 0) {
                            echo $donnee->Ec_Montant;
                       } else {
                        echo 0;
                       }
                    @endphp
                    </td>
                    <td>
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
                    {{-- <td>{{$donnee->EC_sens}}</td> 
                    <td>{{number_format($donnee->Ec_Montant,0, ' ', ' ')}}</td>              --}}
                    <td>
                        <a href="/details/{{$donnee->CT_Num}}" class="btn btn-primary" target="_blank">Détails</a>
                    </td>
                </tr>
                    @endforeach
        </tbody>
        </table>
</div>
     {{--Bootstrap--}}
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     {{-- DataTable --}}
 <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
 <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.13.6/js/dataTables.jqueryui.min.js"></script>
 
 {{--Appel script personnalisé--}}
 <script src="{{asset('Js/faux.js')}}"></script>
</body>
</html>