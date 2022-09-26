(function(){
    let error = false;
    let messageErr;
    let valeur;
    let regExp;

    formNv.submitNv.addEventListener('click', (e) => {
        //console.log('hhh');
        error = false;
        validerNom();
        validerPays();
        validerCourriel();
        validerPassword();
        validerPassword2();
        if (error) e.preventDefault();
    })

    formNv.addEventListener('change', (e) => {
        let elChamp = e.target.id;
        if (elChamp === 'nomNv') validerNom();
        if (elChamp === 'paysNv') validerPays();
        if (elChamp === 'courrielNv') validerCourriel();
        if (elChamp === 'mdpNv') validerPassword();
        if (elChamp === 'mdpNv2') validerPassword2();
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
})()