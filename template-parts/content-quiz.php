
<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mybtsarmy
 */

?>

	<div class="quiz">

		<div class="numbering">
		</div>
		<h1 class="question t1">
		
		</h1>

		<div class="answers">

			
		
		</div>

		<div class="quiz__score">

		</div>


		<button class="btn btn-purple btn__next">NEXT</button>

		<?php

		$args = [ 
			'posts_per_page'      	=> 1, 
			'post_status' 			=> 'publish',
			'post_type'           	=> 'quiz'
		];
		
		
		$query = new WP_Query( $args );

		

		?>
	
	</div>

	<script>
		'use strict';


		let container = document.querySelector('.question'),
			btnNext = document.querySelector('.btn__next'),

			questionLength = 0,
			numIdx = 0,

			randNum = 1,
			pageNum = 1,
			correctAns = [],
			chooses = [],
			maxPage = <?php echo $query->max_num_pages; ?>,
			score = 0,
			url = 'http://localhost/clean/wp-json/wp/v2/quiz?per_page=3';


			function fetchFun(index) {
				console.log(url + `${ pageNum != 0 && pageNum < 4 ? `&page=${pageNum}` : ''}`);

				fetch(url + `&page=${randNum}`)
				.then(res => res.json())	
				.then(data => {

					let quizzes = data[index],
						ans = JSON.parse(quizzes._quiz_meta.answer),
						question = quizzes.title.rendered;

						questionLength = data.length;


					ans.forEach((obj, idx) => {
						document.querySelector('.answers').innerHTML += `
						<div class="form__group">
							<label for="choice${idx}" class="">
								<input type="radio" id="choice${idx}" name="choices" value="${ obj }"> ${ obj }
							</label>
						</div>
						`;
					});

					document.querySelector('.numbering').innerHTML = `Question ${ index + 1 } of ${ questionLength }`;

					
					container.innerHTML = question;

					correctAns.push(quizzes._quiz_meta._correct_answer[0]);

	

				}).catch((error) => {
					console.log(error);
				});
			}			

			fetchFun(numIdx);

			


			function checkAnswer() {
				let choices = document.getElementsByName('choices');

				for ( var x = 0; x < choices.length; x++) {
					if(choices[x].checked) {
						chooses.push(choices[x].value);


						if(choices[x].value == correctAns[numIdx]) {
							alert('sakto');
							score++;
						}						
					}
				}
			}


			btnNext.addEventListener('click', (e)=> {
				e.preventDefault();	

				checkAnswer();				
				numIdx++;
				console.log(numIdx);

				if(numIdx <= 2) {					
					fetchFun(numIdx);
					document.querySelector('.answers').innerHTML = '';					
				}else {
					alert('end');
					document.querySelector('.quiz__score').innerHTML = `${score} out of ${questionLength}`;
					document.querySelector('.question').innerHTML = '';
					document.querySelector('.answers').innerHTML = '';
					btnNext.innerHTML = 'Submit';
					return false;
				}
				
			});

			
		
	</script>