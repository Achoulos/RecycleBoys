var score = 0;
var started = false;
var timeout;

$(document).ready(function() {
	registerEventHandlers();
})
	// Randomly generates a question to solve.
	// Avoids displaying duplicate questions through the additional
	// object boolean "answered".
	function selectQuestion(e) {
		if (!started) {
			var duration = 30000;
	         $("#can").animate({top:140}, duration);  
			  function timer(){
			        alert("Time's up!");
		      }
      		 timeout =  setTimeout(timer, duration);
      		 started = true;
		}
		var random = Math.floor(Math.random() * 100 % 5);
		if (questions[random].answered) {
			for (var i = 0; i < questions.length; i++) {
				random = (random + 1) % questions.length;
				if (!questions[random].answered) {
					var value = questions[random].question;
					document.getElementById("question").value = value;
					questions[random].answered = true;
					$('#answer1').remove();
					$('#answer2').remove();
					$('#answer3').remove();
					$('#answer4').remove();

					$('#a1').append("<span id='answer1'>" + questions[random].a + "</span>");
					$('#b1').append("<span id='answer2'>" + questions[random].b + "</span>");
					$('#c1').append("<span id='answer3'>" + questions[random].c + "</span>");
					$('#d1').append("<span id='answer4'>" + questions[random].d + "</span>");
					return;
				}
			}	
			alert("All questions have been shown!");
			$('#can').stop();
			clearTimeout(timeout);
			return;
		}
		var value = questions[random].question;
		document.getElementById("question").value = value;
		questions[random].answered = true;
		$('#answer1').remove();
		$('#answer2').remove();
		$('#answer3').remove();
		$('#answer4').remove();

		$('#a1').append("<span id='answer1'>" + questions[random].a + "</span>");
		$('#b1').append("<span id='answer2'>" + questions[random].b + "</span>");
		$('#c1').append("<span id='answer3'>" + questions[random].c + "</span>");
		$('#d1').append("<span id='answer4'>" + questions[random].d + "</span>");
	}

	function stopTimer(e) {
		$('#can').stop();
		clearTimeout(timeout);
		alert("You have ended the quiz! Thank you for playing.");
	}

	// Checks correctness of answer. 
	function checkAnswer(e) {
		var answer = $("input[name=answer]:checked").val();
		var question = $("#question").val();

		for (var i = 0; i < question.length; i++) {
			if (questions[i].question === question) {
				if (answer === questions[i].answer) {
					score ++;
					$("#score").remove();
					$("#keeper").append("<h1 id='score'>" + score + "</h1>");
					selectQuestion();
				} else {
					alert("Incorrect, try again!");
				}
			}
		}
	}

	function registerEventHandlers() {
		document.getElementById("questionSubmit").addEventListener('click',selectQuestion, false);
		document.getElementById("answerSubmit").addEventListener('click',checkAnswer, false);
		document.getElementById("stopQuiz").addEventListener('click', stopTimer, false);
	}
// TODO(alex and eric): Add legit questions. 
var questions = 
		[
			{ question: "Each American uses _____ pounds of paper each year.", 
			  a: "70", 
			  b: "680", 
			  c: "420",
			  d: "1200",
			  answer: "B",
			  answered: false },
			{ question: "What are the three R's?", 
			  a: "Reduce replenish, recycle", 
			  b: "Reduce, reuse, recycle", 
			  c: "Recycle, recycle, recycle",
			  d: "Recycle, reuse, repeat",
			  answer: "B",
			  answered: false },
			  { question: "One drip per second of a leaky faucet can waste up to ____ gallons of water per year.", 
			  a: "30", 
			  b: "80", 
			  c: "540",
			  d: "300",
			  answer: "C",
			  answered: false },
			  { question: "Recycling all of your home’s waste newsprint, cardboard, glass, and metal can reduce carbon dioxide emissions by _____.", 
			  a: "850 pounds a year", 
			  b: "70 pounds a year", 
			  c: "20 pounds a year",
			  d: "200 pounds a year",
			  answer: "A",
			  answered: false },
			  { question: "How many aluminum cans do we use each year?", 
			  a: "Zero", 
			  b: "800 million", 
			  c: "8",
			  d: "80 billion",
			  answer: "D",
			  answered: false },
		]