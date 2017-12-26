		




			let userSubmitButton = document.getElementById( 'user-submit-btn' ),
				importants = document.querySelectorAll('.important'),
				message = document.querySelector('.message');


			let adminAjaxRequest = function( formData, action ) {
				
				let xhp = new XMLHttpRequest();


				xhp.open('POST', my_ajax_object.ajax_url + '?action='+ action );
				xhp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   				

				xhp.onreadystatechange = function() {
			      if (xhp.readyState == 4) {
			        if (xhp.status == 201) {
			          alert("ok");
			        } else {
			          console.log(xhp.responseText);
			        }
			      }
			    }

			    var serialize = function(obj) {
				  var str = [];
				  for(var p in obj)
				    if (obj.hasOwnProperty(p)) {
				      str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
				    }
				  return str.join("&");
				}

			    xhp.send(serialize(formData));
			};


			userSubmitButton.addEventListener( 'click', function(event) {
				event.preventDefault();

				var formData = {
					'name' : document.getElementById( 'user-name').value,
					'email' : document.getElementById( 'user-email').value,
					'link' : document.getElementById( 'user-link').value,
					'message' : document.getElementById( 'user-message').value,
					'captcha' : document.getElementById( 'g-recaptcha-response').value,
					'security' : my_ajax_object.nonce
				};


				importants.forEach((important) =>{

					if(important.value) {
						important.classList.remove('error');
					} else {						
						important.classList.add('error');
					}

					if(formData.name && formData.email && formData.link && formData.message ) {
						adminAjaxRequest(formData, 'process_user_generated_post');
						resetAll();					
						
						userSubmitButton.disabled = true;
					}			

				});
				
				
			} );


			function resetAll() {

				let formControls = document.querySelectorAll('.form__control');

				importants.forEach((important) => {
					important.classList.remove('error');	
				});


				formControls.forEach((formControl) => {
					formControl.value = "";
				});

				message.innerHTML = "Thank you! Your message has been sent";

				grecaptcha.reset();
				document.getElementById( 'user-post' ).reset();

				setTimeout(() => {
			      message.innerHTML = "";   
			    }, 3800);
			}

			function recaptchaCallback() {
			    userSubmitButton.removeAttribute('disabled');
			};

