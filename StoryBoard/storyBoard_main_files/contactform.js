  $(document).ready(function() {		
  $('#buttonsend').click( function() {
	
		var name    = $('#name').val();
		var subject = $('#subject').val();
		var email   = $('#email').val();
		var message = $('#message').val();
		
		$('.loading').fadeIn('fast');
		
		if (name != "" && subject != "" && email != "" && message != "")
			{

				$.ajax(
					{
						url: './sendemail.php',
						type: 'POST',
						data: "name=" + name + "&subject=" + subject + "&email=" + email + "&message=" + message,
						success: function(result) 
						{
							$('.loading').fadeOut('fast');
							if(result == "email_error") {
								$('#email').css({"background":"#FFFCFC","border":"1px solid #ffadad"}).next('.require').text(' !');
							} else {
								$('#name, #subject, #email, #message').val("","Name","Subject","Email","Message");
								$('<div class="uk-alert uk-alert-success uk-text-center uk-margin-medium-bottom" data-uk-alert><p>Your message has been sent successfully. Thank you!</p></div>').insertBefore('#contact-form');
								$('.uk-alert').fadeOut(5000, function(){ $(this).remove(); });
							}
						}
					}
				);
				return false;
				
			} 
		else 
			{
				$('.loading').fadeOut('fast');
				if( name == "","Name") $('#name').css({"background":"#FFFCFC","border":"1px solid #ffadad"});
				if(subject == "","Subject") $('#subject').css({"background":"#FFFCFC","border":"1px solid #ffadad"});
				if(email == "","Email" ) $('#email').css({"background":"#FFFCFC","border":"1px solid #ffadad"});
				if(message == "","Message") $('#message').css({"background":"#FFFCFC","border":"1px solid #ffadad"});
				return false;
			}
	});
	
		$('#name, #subject, #email,#message').focus(function(){
			$(this).css({"border":"none","background":"#fafafa","border":"1px solid #ccc"});
		});
      	
		});