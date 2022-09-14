window.addEventListener('load', function() {
let imageDiv = document.querySelector('.images');
let image = document.querySelector('.imgPrincipale');
let hamburger = document.getElementById('hamburger');
let navUL = document.getElementById('menuUL');


hamburger.addEventListener('click', function(){
    navUL.classList.toggle('afficher');
})


imageDiv.addEventListener('mousemove', function(e) {
    e.preventDefault();
    let x = e.clientX - e.target.offsetLeft;
    let y = e.clientY - e.target.offsetTop;

    
    image.style.transformOrigin = `${x}px ${y}px`;
    image.style.transform = `scale(1.8)`;
    image.style.transition = 'transform 3s';
    image.setAttribute('title', '');
});

imageDiv.addEventListener('mouseleave', function(e) {
    image.style.transform = `scale(1)`;
    image.style.transition = 'transform 1s';
});



});

