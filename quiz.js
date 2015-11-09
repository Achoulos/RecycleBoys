var score = 0;

$(document).ready(function() {
	registerEventHandlers();
})
	// Randomly generates a question to solve.
	// Avoids displaying duplicate questions through the additional
	// object boolean "answered".
	function selectQuestion(e) {
		// TODO(eric) : ADD START-TIMER LOGIC HERE.
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
	}
// TODO(alex and eric): Add legit questions. 
var questions = 
		[
			{ question: "asdf", 
			  a: "buenos aires", 
			  b: "dasfdas", 
			  c: "dasfdasfas",
			  d: "dasfewaddd",
			  answer: "A",
			  answered: false },
			{ question: "ddd", 
			  a: "eawsdes", 
			  b: "asda", 
			  c: "ff",
			  d: "e",
			  answer: "B",
			  answered: false },
			  { question: "lfjlewak", 
			  a: "geasdfaew", 
			  b: "dasfaweeewwwww", 
			  c: "mcmccmccca",
			  d: "eqqqw21",
			  answer: "C",
			  answered: false },
			  { question: "39p18247", 
			  a: " aires", 
			  b: "daccccva", 
			  c: "3341",
			  d: "aweoawlaw",
			  answer: "A",
			  answered: false },
			  { question: "cccnccccc", 
			  a: "dasfeawfw e111", 
			  b: "213", 
			  c: "555",
			  d: "das444fewaddd",
			  answer: "D",
			  answered: false },
		]