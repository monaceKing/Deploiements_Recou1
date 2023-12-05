// Enregistrez une méthode API `sum` avec DataTables
DataTable.Api.register('column().data().sum()', function () {
    return this.reduce(function (a, b) {
        let x = parseFloat(a) || 0;
        let y = parseFloat(b) || 0;
        return x + y;
    });
});





// Calcul debit
function calculateTotalDebitWithSearch() {
  const table = $('#myTable').DataTable();  
  let totalDebit = 0;
  
  // Parcourez les données filtrées pour calculer le total des débits
  table.rows({ search: 'applied' }).every(function (rowIdx, tableLoop, rowLoop) {
      const debitValue = parseFloat(this.cell(rowIdx, 5).data()) || 0; // Colonne 6 est "Débit"
      totalDebit += debitValue;
  });
  
  return totalDebit;
}

// Événement pour déclencher le calcul du total des débits lors de la recherche
$('#myTable').on('search.dt', function () {
  const totalDebitWithSearch = calculateTotalDebitWithSearch();
  const formattedTotalDebitWithSearch = totalDebitWithSearch.toLocaleString('fr-FR');
  
  // Mettez à jour la balise <p> avec le résultat du calcul
  $('#totalDebit1').text("Total des débits : " + formattedTotalDebitWithSearch);
});






$(document).ready(function () {
  const table = $('#myTable').DataTable();
  
  // Événement pour filtrer quand EC_Lettrage est vide
  $('#btnFiltrerVide').click(function () {
      table.column(12).search('^$', true, false).draw(); // Colonne 12 est "EC_Lettrage"
  });
  
  // Événement pour filtrer quand EC_Lettrage n'est pas vide
  $('#btnFiltrerNonVide').click(function () {
      table.column(12).search('.+', true, false).draw(); // Colonne 12 est "EC_Lettrage"
  });
});








//Calcul credit
function calculateTotalCreditWithSearch() {
  const table = $('#myTable').DataTable();
  const searchValue = table.search(); // Obtenez la valeur de recherche

  let totalCredit = 0;

  // Parcourez les données filtrées pour calculer le total du crédit
  table.rows({ search: 'applied' }).every(function (rowIdx, tableLoop, rowLoop) {
    const creditValue = parseFloat(this.cell(rowIdx, 7).data()) || 0; // Colonne 8 est "Crédit"
    totalCredit += creditValue;
  });

  return totalCredit;
}

$('#myTable').on('search.dt', function () {
  const totalCreditWithSearch = calculateTotalCreditWithSearch();
  const formattedTotalCreditWithSearch = totalCreditWithSearch.toLocaleString('fr-FR');

  // Mettez à jour la balise <p> avec le résultat du calcul du crédit
  $('#totalCredit').text("  Total des crédits : " + formattedTotalCreditWithSearch);
});







$(document).ready(function () {
  const table = $('#myTable').DataTable();

  // Événement pour effacer le filtre et réafficher le tableau à l'état initial
  $('#btnEffacerFiltre').click(function () {
    // Effacez le filtre sur la colonne "EC_Lettrage" (colonne 12)
    table.column(12).search('').draw();

    // Réinitialisez la recherche dans DataTables
    table.search('').draw();

    // Réinitialisez le bouton de recherche (si nécessaire)
    // Vous pouvez également ajouter du code pour réinitialiser d'autres éléments de filtrage ici

    // Réaffichez le tableau à son état initial
    table.page(0).draw('page');
  });
});
