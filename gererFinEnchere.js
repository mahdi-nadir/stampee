(function() {
    let timer = {
        D: document.getElementById('day'),
        H: document.getElementById('hour'),
        M: document.getElementById('minute'),
        S: document.getElementById('second')
    }
    

    function countDown() {
        if (timer.D) {
        let enchereDate = document.getElementById('enchereDateFin').innerText;
        let goalDate = new Date(enchereDate).getTime();
        let now = new Date().getTime();
        const gap = goalDate - now

        let seconde = 1000;
        let minute = seconde * 60;
        let heure = minute * 60;
        let jour = heure * 24;

        // calcul de la date restante
        let textDay = Math.floor(gap / jour);
        let textHour = Math.floor((gap%jour) / heure);
        let textMinute = Math.floor((gap%heure) / minute);
        let textSecond = Math.floor((gap%minute) / seconde);
        //console.log(textDay, textHour, textMinute, textSecond);

        timer.D.innerHTML = textDay;
        timer.H.innerHTML = textHour;
        timer.M.innerHTML = textMinute;
        timer.S.innerHTML = textSecond;

        
        if (timer.D.innerHTML <= 0 && timer.H.innerHTML <= 0 && timer.M.innerHTML <= 0 && timer.S.innerHTML <= 0 ) {
            document.querySelector('#tiimer').remove();
            if (document.getElementById('placerMise')) {
                document.getElementById('placerMise').innerHTML = "L'enchère est expirée";
                document.querySelector('.msgGagnant').innerText = "L'enchère a été remportée par ";
                document.querySelector('.versMise').setAttribute('href', 'enchere/tout');                
            }
            if (document.getElementById('placerMise2')) {
                document.getElementById('placerMise2').innerHTML = "L'enchère est expirée";
                document.querySelector('.msgGagnant').innerText = "L'enchère a été remportée par ";
                document.querySelector('.versMise').setAttribute('href', 'enchere/tout');
            }
            if (document.getElementById('placerMise3')) {
                document.getElementById('placerMise3').innerHTML = "L'enchère estt expirée";
                document.querySelector('.msgGagnant').innerText = "L'enchère a été remportée par ";
                document.querySelector('.versMise').setAttribute('href', 'enchere/tout');
            }

        } else {
                document.querySelector('.msgGagnant').innerText = "Jusque là, l'enchère est remportée par ";
                document.querySelector('.msgGagnant').innerText = "Jusque là, l'enchère est remportée par ";
                document.querySelector('.msgGagnant').innerText = "Jusque là, l'enchère est remportée par ";
        }
    }
    }

    setInterval(countDown, 1000);

})()

