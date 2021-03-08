	//Schrattenholz\CallToActions
		if($('#calltoactions').length>0){
			$('.calltoaction').each(function(){
				$(this).fadeTo(200,1);
			});
			$(window).on('scroll',function(){
				//console.log("s"+$(window).scrollTop());
				if($(window).scrollTop()>0){
					$('.calltoaction').each(function(){
						$(this).stop().fadeTo(200,0);
					});
				}else{
					$('.calltoaction').each(function(){
						$(this).stop().fadeTo(200,1);
					}); 
				}
			}); 
			
		}
	//End Schrattenholz\CallToActions