$(document).ready(function(){
  $('.carousel').slick({
  	  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  });
});





(function($){

	$('.step_tissu_haut').hide();
	$('.step_finition_haut').hide();

	$('.step_modele_bas').hide();
	$('.step_tissu_bas').hide();
	$('.step_finition_bas').hide();

	$('.step_accessoire').hide();


   $('#commande_modeleHaut input').change(function(event){

		var modeleHaut_id = $(this).val();
   
		$('.step_tissu_haut').show();
		$('#commande_tissuHaut #' + modeleHaut_id).show().siblings().hide();

	
     

   		$('#commande_tissuHaut input').change(function(event){

			$('.step_finition_haut').show();

			$('#commande_finitionHaut #' + modeleHaut_id).show().siblings().hide();


            $('#commande_finitionHaut input').change(function(event){

				$('.step_modele_bas').show();

				$('#commande_modeleBas input').change(function(event){

					var modeleBas_id = $(this).val();

					$('.step_tissu_bas').show();
		            $('#commande_tissuBas #' + modeleBas_id).show().siblings().hide();


		            $('#commande_tissuBas input').change(function(event){

                        $('.step_finition_bas').show();
                        $('#commande_finitionBas #' + modeleBas_id).show().siblings().hide();

                        $('#commande_finitionBas input').change(function(event){

                            $('.step_accessoire').show();

                        });

                     
                     });

                });



            });



 		});

	








 	});



	

	








})(jQuery); 









/*



$('#commande_finitionHaut').css('color' ,'blue')



$('#commande_modeleBas').css('color','green')

$('.commande_tissuBas').css('color','purple')

$('.commande_finitionBas').css('color','chocolat')

$('#commande_accessoire').css('color','orange')
*/












