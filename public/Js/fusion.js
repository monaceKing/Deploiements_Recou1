        const searchInput = document.getElementById('search');
        const tableBody = document.getElementById('table-body');
        const rows = tableBody.getElementsByTagName('tr');
        const totalMontant = document.getElementById('total-montant');
    
        searchInput.addEventListener('input', () => {
            const searchTerm = searchInput.value.toLowerCase();
            let resultFound = false;
            let sumMontant = 0;
    
            for (const row of rows) {
                const coNo = row.cells[0].textContent.toLowerCase();
                if (coNo.includes(searchTerm)) {
                    row.style.display = '';
                    resultFound = true;
    
                    // Ajouter le montant à la somme
                    const montant = parseFloat(row.cells[7].textContent);
                    if (!isNaN(montant)) {
                        sumMontant += montant;
                    }
                } else {
                    row.style.display = 'none';
                }
            }
    
            if (!resultFound) {
                totalMontant.textContent = ''; // Effacer le total s'il n'y a pas de résultats
            } else {
                totalMontant.textContent = `Total Montant : ${sumMontant.toFixed(2)}`; // Afficher le total
            }
        });