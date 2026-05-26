function ouvrirModale(id, nom, prenom, date, heure) { 

            
            document.getElementById('input-id').value     = id;
            document.getElementById('input-nom').value    = nom;
            document.getElementById('input-prenom').value = prenom;
            document.getElementById('input-date').value   = date;
            document.getElementById('input-heure').value  = heure;

            
            document.getElementById('modale').style.display  = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function fermerModale() {
            
            document.getElementById('modale').style.display  = 'none';
            document.getElementById('overlay').style.display = 'none';
        }