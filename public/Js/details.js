document.addEventListener('DOMContentLoaded', function() {
    var dateTirageElement = document.getElementById('dateTirage');
    var currentDate = new Date();
    var formattedDate = currentDate.toLocaleDateString('fr-FR'); // Format de date français

    dateTirageElement.textContent += formattedDate;
});


function imprimerPage() {
    // Déclencher la fenêtre d'impression
    window.print();
}