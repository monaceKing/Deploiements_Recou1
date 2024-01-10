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



document.addEventListener('DOMContentLoaded', function() {
    const presentAlertButton = document.getElementById('present-alert');

    presentAlertButton.addEventListener('click', function() {
        const name = prompt('Message du client...');
});
});