
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


		<div class="quiz__inner">
		
		</div>

		<div class="questions">

			
		
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

		let container = document.querySelector('.quiz__inner'),
			btnNext = document.querySelector('.btn__next'),
			xhp = new XMLHttpRequest(),
			numIdx = [],
			randNum = 1,
			pageNum = 1,
			maxPage = <?php echo $query->max_num_pages; ?>,
			score = 0,
			url = 'http://localhost/clean/wp-json/wp/v2/quiz?per_page=1';

			

			// function xCalls(data) {
			// 	console.log(data[0]);
			// }


			// xhp.open('GET', 'http://localhost/clean/wp-json/wp/v2/quiz/' + randNum, true );
			// xhp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");   				

			// xhp.responseType = 'json';
			// xhp.onreadystatechange = function() {
			// 	if (xhp.readyState === 4 && xhp.status == 200) {
			// 		xCalls(xhp.response);      
			// 	} 
			// }      
			// xhp.send(null);  
			

			btnNext.addEventListener('click', (e)=> {
				e.preventDefault();		

				if (pageNum <= maxPage) {		

					fetch(url + '&page=' + pageNum)
					.then(res => res.json())	
					.then(data => {

						let quizzes = data,
							ans = JSON.parse(quizzes[0]._correct_answer.answer);

						ans.forEach(obj => {

							document.querySelector('.questions').innerHTML += `
							<div class="form__group">
								<label for="" class="">
									<input type="radio" name="choice" value="${ obj }"> ${ obj }
								</label>
							</div>
							`;
						});

						quizzes.map((quiz, idx) => {
							container.innerHTML = quiz._correct_answer._correct_answer;		
								
							numIdx.push(quiz.id);	
						});
						

					}).catch((error) => {
						console.log(error);
					});


					pageNum++;
					document.querySelector('.questions').innerHTML = "";
				} else { alert("mana")}
			});
		
	</script>