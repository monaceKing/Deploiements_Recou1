$(document).ready(function () {
  const table = $('#myTable').DataTable({
    searching: true, // Activer la recherche
    columnDefs: [
      { targets: [0], searchable: true }, // Définir la colonne 0 (CO_No) comme recherche activée
      { targets: [1, 2, 3, 4, 5, 6, 7, 8], searchable: false }, // Désactiver la recherche pour les autres colonnes
    ],
  });

  // Fonction pour calculer le total des débits
  function calculateTotalDebitWithSearch() {
    let totalDebit = 0;
    table.rows({ search: 'applied' }).every(function (rowIdx) {
      const debitValue = parseFloat(this.cell(rowIdx, 5).data()) || 0;
      totalDebit += debitValue;
    });
    return totalDebit;
  }

  // Événement pour mettre à jour le total des débits lors de la recherche
  $('#myTable').on('search.dt', function () {
    const totalDebitWithSearch = calculateTotalDebitWithSearch();
    const formattedTotalDebitWithSearch = totalDebitWithSearch.toLocaleString('fr-FR');
    $('#totalDebit1').text("Total des débits : " + formattedTotalDebitWithSearch);
  });

  // Fonction pour calculer le total des crédits
  function calculateTotalCreditWithSearch() {
    let totalCredit = 0;
    table.rows({ search: 'applied' }).every(function (rowIdx) {
      const creditValue = parseFloat(this.cell(rowIdx, 7).data()) || 0;
      totalCredit += creditValue;
    });
    return totalCredit;
  }

  // Événement pour mettre à jour le total des crédits lors de la recherche
  $('#myTable').on('search.dt', function () {
    const totalCreditWithSearch = calculateTotalCreditWithSearch();
    const formattedTotalCreditWithSearch = totalCreditWithSearch.toLocaleString('fr-FR');
    $('#totalCredit').text("Total des crédits : " + formattedTotalCreditWithSearch);
  });

  // Fonction pour calculer la différence entre débit et crédit
  function calculateBalance() {
    const totalDebit = calculateTotalDebitWithSearch();
    const totalCredit = calculateTotalCreditWithSearch();
    const balance = totalDebit - totalCredit;
    return balance;
  }

  // Fonction pour afficher le solde créditeur ou débiteur
  function displayBalanceStatus() {
    const balance = calculateBalance();
    const balanceElement = $('#balanceStatus');

    if (balance > 0) {
      balanceElement.text("Le Solde est Créditeur de : " + balance.toLocaleString('fr-FR'));
      balanceElement.removeClass('text-danger').addClass('text-success');
    } else if (balance < 0) {
      balanceElement.text("Le Solde est Débiteur de : " + (-balance).toLocaleString('fr-FR'));
      balanceElement.removeClass('text-success').addClass('text-success');
    } else {
      balanceElement.text("Solde à Zéro");
      balanceElement.removeClass('text-success text-danger');
    }
  }

  // Événement pour recalculer le solde lorsque la recherche change
  $('#myTable').on('search.dt', function () {
    displayBalanceStatus();
  });

  // Initialisation du solde
  displayBalanceStatus();
});
