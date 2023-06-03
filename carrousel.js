$(document).ready(function(){//Nous n'avons pas recommenter cette partie car elle est déjà très claire.
    var $carrousel = $('#carrousel'), // on cible le bloc du carrousel
    $img = $('#carrousel img'), // on cible les images contenues dans le carrousel
    indexImg = $img.length - 1, // on définit l'index du dernier élément
    i = 0, // on initialise un compteur
    $currentImg = $img.eq(i); // enfin, on cible l'image courante, qui possède l'index i (0 pour l'instant)
    $img.css('display', 'none'); // on cache les images
    $currentImg.css('display', 'block'); // on affiche seulement l'image courante
    //$carrousel.append('<div class="controls"> <span class="prev"><img src="boutonsr.jpg" alt="suivant" height="50" width="50"/></span><span class="next"><img src="boutons.jpg" alt="suivant" height="50" width="50"/></span> </div>'); 
   
    /*$('.next').click(function(){ //Lorsque l'on clique sur l'image permmettant de passer à la photo suivante
        i++; // on incrémente le compteur
        if( i < indexImg ){
        $img.css('display', 'none'); //on masque l'image que l'on passe
        $currentImg = $img.eq(i); //on sélectionne l'image suivante
        $currentImg.css('display', 'block'); //on affiche l'image sélectionné
        }
        else{
        i = 0;//si i= indexImg, on passe à la première image
        }
    });
       
    $('.prev').click(function(){ //Lorsque l'on clique sur l'image permettant de revenir à la photo précédente
        i--; // on décrémente le compteur
        if( i > 0 ){
        $img.css('display', 'none');//on masque l'image que l'on a à l'écran
        $currentImg = $img.eq(i);//on sélectionne l'image précédente
        $currentImg.css('display', 'block');//on affiche l'image selectionnée
        }
        else{
        i = indexImg;//Si i=0, on revient à la dernière image
        }
    });*/

    function slideImg(){
        setTimeout(function(){ 
        if (i < indexImg){//Fonctionne tant que le compteur n'est pas arrivé à la dernière image
        i++; // on l'incrémente
        }
        else{ //Revient à la première image lorsque l'on atteint la dernière image
        i = 0;
        }
        $img.css('display', 'none');
        $currentImg = $img.eq(i);
        $currentImg.css('display', 'block');
        slideImg(); //On relance la fonction à chaque itération
        }, 7000); //on définit l'intervalle entre chaque exécution à 7000ms, ce qui donne 7s
    };
       slideImg(); //On lance la fonction une première fois, elle fonctionnera de manière automatique ensuite
}); 