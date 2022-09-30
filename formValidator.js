(function(){
    let error = false;
    let messageErr;
    let valeur;
    let regExp;

    formNv.submitNv.addEventListener('click', (e) => {
        error = false;
        validerNom();
        validerPays();
        validerCourriel();
        validerPassword();
        validerPassword2();
        validerCourrielCompte();
        validerPrixEnchere();
        validerVille();
        validerPays2();
        validerYear();
        validerDateDebut();
        validerDateFin();
        validerValeurDepart();
        validerDescription();
        if (error) e.preventDefault();
    })

    formNv.addEventListener('change', (e) => {
        let elChamp = e.target.id;
        if (elChamp === 'nomNv') validerNom();
        if (elChamp === 'paysNv') validerPays();
        if (elChamp === 'courrielNv') validerCourriel();
        if (elChamp === 'mdpNv') validerPassword();
        if (elChamp === 'mdpNv2') validerPassword2();
        if (elChamp === 'compteCourriel') validerCourrielCompte();
        if (elChamp === 'nouvelleEnchere') validerPrixEnchere();
        if (elChamp === 'villeNv') validerVille();
        if (elChamp === 'paysNv2') validerPays2();
        if (elChamp === 'yearNv') validerYear();
        if (elChamp === 'dateDebutNv') validerDateDebut();
        if (elChamp === 'dateFinNv') validerDateFin();
        if (elChamp === 'valeurDepartNv') validerValeurDepart();
        if (elChamp === 'descriptionNv') validerDescription();
    })

    formNv.addEventListener('input', (e) => {
        let elChamp = e.target.id;
        if (elChamp === 'descriptionNv') countChar();
    })

    function validerNom() {
        messageErr = "";
        regExp = /[a-zA-Z -]{3,}/i;
        valeur = document.getElementById('nomNv').value;
        if (valeur == '') {
            messageErr = 'Le nom ne doit pas être vide!';
            error = true;
        } else if (valeur !== '') { 
            if (!regExp.test(valeur)) {
                messageErr = 'Le nom devrait avoir au moins 3 caractères!';
                error = true;
            }
        }

        document.getElementById('errNom').innerHTML = messageErr;
    }

    function validerPays() {
        messageErr = "";
        regExp = /[a-zA-Z -]{3,}/i;
        valeur = document.getElementById('paysNv').value;
        if (valeur == '') {
            messageErr = 'Le champ du pays ne doit pas être vide!';
            error = true;
        } else if (valeur !== '') { 
            if (!regExp.test(valeur)) {
                messageErr = 'Le pays devrait avoir au moins 3 caractères!';
                error = true;
            }
        }

        document.getElementById('errPays').innerHTML = messageErr;
    }

    function validerCourriel() {
        messageErr = "";
        regExp = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/i;
        valeur = document.getElementById('courrielNv').value;
        if (valeur == '') {
            messageErr = 'Le courriel ne doit pas être vide!';
            error = true;
        } else if (valeur !== '') { 
            if (!regExp.test(valeur)) {
                messageErr = 'Le courriel n\'est pas valide!';
                error = true;
            }
        }

        document.getElementById('errCourriel').innerHTML = messageErr;
    }

    function validerPassword() {
        messageErr = "";
        regExp = /[a-zA-Z0-9 !@#$%^&*()_+=-`~/|?><,\.\+\*\\]{8,25}/i;
        valeur = document.getElementById('mdpNv').value;
        if (valeur == '') {
            messageErr = 'Le mot de passe ne doit pas être vide!';
            error = true;
        } else if (valeur !== '') { 
            if (!regExp.test(valeur)) {
                messageErr = 'Le mot de passe devrait avoir entre 8 et 25 caractères!';
                error = true;
            }
        }

        document.getElementById('errMdp').innerHTML = messageErr;
    }

    function validerPassword2() {
        messageErr = '';
        valeur = document.getElementById('mdpNv').value;
        let valeur2 = document.getElementById('mdpNv2').value;

        if (valeur !== valeur2) {
            messageErr = 'Les deux mots de passe ne se correspondent pas!';
            error = true;
        }

        document.getElementById('errMdp2').innerHTML = messageErr;
    }



    function validerCourrielCompte() {
        messageErr = "";
        regExp = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/i;
        valeur = document.getElementById('compteCourriel').value;
        if (valeur == '') {
            messageErr = 'Le courriel ne doit pas être vide!';
            error = true;
        } else if (valeur !== '') { 
            if (!regExp.test(valeur)) {
                messageErr = 'Le courriel n\'est pas valide!';
                error = true;
            }
        }

        document.getElementById('errCourriel').innerHTML = messageErr;
    }

    function validerPrixEnchere() {
        messageErr = "";
        valeur = document.getElementById('nouvelleEnchere').value;
        let valeur2 = document.getElementById('ancienneEnchere').value;
        if (valeur2 >= valeur) {
            messageErr = 'Veuillez mettre une valeur supérieure que celle déjà disponible!';
            valeur2 = '';
            error = true;
        } else if (valeur == '') {
            messageErr = 'Ce champ ne doit pas être vide!';
            valeur2 = '';
            error = true;
        }
        
        document.getElementById('errEnchere').innerHTML = messageErr;
    }

    function validerVille() {
        messageErr = "";
        regExp = /[a-zA-Z -]{3,}/i;
        valeur = document.getElementById('villeNv').value;
        if (valeur == '') {
            messageErr = 'Le champ de la ville ne doit pas être vide!';
            error = true;
        } else if (valeur !== '') { 
            if (!regExp.test(valeur)) {
                messageErr = 'La ville devrait avoir au moins 3 caractères!';
                error = true;
            }
        }

        document.getElementById('errVille').innerHTML = messageErr;
    }

    function validerPays2() {
        messageErr = "";
        regExp = /[a-zA-Z -]{3,}/i;
        valeur = document.getElementById('paysNv2').value;
        if (valeur == '') {
            messageErr = 'Le champ du pays ne doit pas être vide!';
            error = true;
        } else if (valeur !== '') { 
            if (!regExp.test(valeur)) {
                messageErr = 'Le pays devrait avoir au moins 3 caractères!';
                error = true;
            }
        }

        document.getElementById('errPays2').innerHTML = messageErr;
    }
    
    function validerYear() {
        messageErr = "";
        regExp = /[0-9]{4}/g;
        valeur = document.getElementById('yearNv').value;
        if (valeur === '') {
            messageErr = 'Ce champ doit être rempli!';
            error = true;
        } else if (valeur !== '') { 
            if (!regExp.test(valeur)) {
                messageErr = 'Il y a des erreurs au niveau de ce champ!';
                error = true;
            }
        }

        document.getElementById('errYear').innerHTML = messageErr;
    }

    
    function validerDateDebut() {
        messageErr = "";
        let auj = new Date().toISOString().slice(0, 10);
        valeur = document.getElementById('dateDebutNv').value;
        let valeur2 = document.getElementById('dateFinNv').value;
        if (valeur === '') {
            messageErr = 'Ce champ doit être rempli!';
            error = true;
        } else if (valeur < auj) {
            messageErr = "Vous devez mettre la date d'aujourd'hui ou une date postérieure";
            error = true;
        } 

        document.getElementById('errDateDebut').innerHTML = messageErr;
    }

    function validerDateFin() {
        messageErr = "";
        valeur = document.getElementById('dateFinNv').value;
        let valeur2 = document.getElementById('dateDebutNv').value;
        if (valeur === '') {
            messageErr = 'Ce champ doit être rempli!';
            error = true;
        } else if (valeur < valeur2) { 
            messageErr = 'La date de fin ne doit pas être avant celle de début!';
            error = true;
        } else if (valeur == valeur2 || valeur > valeur2) { 
            messageErr = 'Veuillez mettre une date à partir du lendemain!';
            error = true;
        }

        document.getElementById('errDateFin').innerHTML = messageErr;
    }

    function validerValeurDepart() {
        messageErr = "";
        regExp = /^[0-9]{1,6}$/;
        valeur = document.getElementById('valeurDepartNv').value;
        if (valeur == "") {
            messageErr = 'Veuillez mettre une valeur!';
            error = true;
        } else if (valeur == 0) {
            messageErr = 'Veuillez mettre une valeur positive!';
            error = true;
        } else if (valeur != '') {
            if (!regExp.test(valeur)) {
                messageErr = 'Veuillez mettre une valeur entre 1 et 1 million!';
                error = true;
            }
        } 
        
        document.getElementById('errValeurDepart').innerHTML = messageErr;
    }



    function validerDescription() {
        messageErr = "";
        regExp = /[a-zA-Z0-9 ]{10,1000}/i;
        valeur = document.getElementById('descriptionNv').value;
        if (valeur == "") {
            messageErr = 'Veuillez insérer du texte!';
            error = true;
        } else if (valeur != '') {
            if (!regExp.test(valeur)) {
                messageErr = 'Veuillez mettre entre 10 et 300 caractères!';
                error = true;
            }
        } 
        
        document.getElementById('errDescription').innerHTML = messageErr;
    }

    function countChar() {
        let textbox = document.getElementById('descriptionNv');
        let compteur = document.getElementById('counter');
        
        textbox.addEventListener('keyup', function(){
            valeur = textbox.value.split('');
            compteur.innerText = valeur.length
        })

        if (valeur == "") 
            compteur.innerText = 0
        
    }

    
    /* function countChar(textbox) {
        textbox = document.getElementById('descriptionNv');
        let chars = textbox.value.match(/(a-zA-Z0-9 !@#%&_}{)\(\$\^\(\\-\*\/\+)+/);
        let letters = chars ? chars.length : 0;
        document.getElementById('counter').innerHTML = letters;
    } */
})()