(function() {
    function countDown() {
        let enchereDate = document.getElementById('enchereDateFin').innerText;
        let goalDate = new Date(enchereDate).getTime();
        let now = new Date().getTime();
        //console.log(goalDate);
        const gap = goalDate - now
        // console.log(gap);

        let seconde = 1000;
        let minute = seconde * 60;
        let heure = minute * 60;
        let jour = heure * 24;

        // calcul de la date restante
        let textDay = Math.floor(gap / jour);
        let textHour = Math.floor((gap%jour) / heure);
        let textMinute = Math.floor((gap%heure) / minute);
        let textSeconde = Math.floor((gap%minute) / seconde);
        //console.log(textDay, textHour, textMinute, textSeconde);

        document.getElementById('day').innerHTML = textDay;
        document.getElementById('hour').innerHTML = textHour;
        document.getElementById('minute').innerHTML = textMinute;
        document.getElementById('second').innerHTML = textSeconde;

        
    }

    setInterval(countDown, 1000);

    /* if (textDay == 0 && textHour == 0 && textMinute == 0 && textSeconde == 0) {
        document.getElementById('placerMise').innerHTML = "L'enchère est expirée";
        document.getElementById('placerMise').disabled = true;
    } */
})()

