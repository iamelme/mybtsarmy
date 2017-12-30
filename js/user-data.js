
			let userSubmitButton = document.getElementById( 'user-submit-btn' ),
					importants = document.querySelectorAll('.important'),
					formLabels = document.querySelectorAll('.form__label'),
					modal = document.querySelector('.modal'),
					messageBody = document.querySelector('.message__body'),
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

			function removeClass(target, targetClass){
				target.forEach(el =>{
					el.classList.remove(targetClass);
				});
			}

			function resetAll() {

				let formControls = document.querySelectorAll('.form__control');

				removeClass(importants, 'error');
				removeClass(formLabels, 'active');

				formControls.forEach((formControl) => {
					formControl.value = "";
				});

				modal.classList.add('show');
				messageBody.innerHTML = `					
					<p>Thank you! Your submission has been sent</p>
				`;

				grecaptcha.reset();
				document.getElementById( 'user-post' ).reset();				

				setTimeout(() => {			
						modal.classList.remove('show');			
			      message.innerHTML = "";   
			    }, 4800);
			}

			function recaptchaCallback() {
			    userSubmitButton.removeAttribute('disabled');
			};

