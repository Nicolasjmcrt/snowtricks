
// Attends que le DOM soit chargé
$(document).ready(function(event) {

	// Lance l'effet parallax
	// var p = new Parallax('.parallax').init()

	$('.scrollable').click(function(event) {
		// Vitesse de déplacement en millisecondes
		var speed = 300;

		// récupère l'attribut href du lien clické
		var page = $(this).attr('href');

		$("html, body").animate({ scrollTop: $(page).offset().top }, speed);

		return fnct;
	});


});
