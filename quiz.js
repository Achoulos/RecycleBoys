var score = 0;

$(document).ready(function() {
	registerEventHandlers();
})
	// Randomly generates a country to solve.
	// Avoids displaying duplicate countries through the additional
	// object boolean "answered".
	function selectCountry(e) {
	// 	var random = Math.floor(Math.random() * 100 % 11);
	// 	if (countries[random].answered) {
	// 		for (var i = 0; i < countries.length; i++) {
	// 			random = (random + 1) % countries.length;
	// 			if (!countries[random].answered) {
	// 				var value = countries[random].country;
	// 				value = value.charAt(0).toUpperCase() + value.slice(1);
	// 				document.getElementById("country").value = value;
	// 				countries[random].answered = true;
	// 				return;
	// 			}
	// 		}	
	// 		alert("All contries have been shown!");
	// 		return;
	// 	}
	// 	var value = countries[random].country;
	// 	value = value.charAt(0).toUpperCase() + value.slice(1);
	// 	document.getElementById("country").value = value;

	// 	countries[random].answered = true;
	}

	// Checks validity of answer regardless of letter case and if
	// the user has actually filled out the form. 
	function checkAnswer(e) {
		// var answer = document.getElementById("capitol").value;
		// if (answer === "") {
		// 	alert("Please enter an answer.");
		// 	return;
		// }
		// answer = answer.toLowerCase();
		// var country = document.getElementById("country").value;
		// if (country === "") {
		// 	alert("Please generate a valid country.");
		// 	return;
		// }
		// country = country.toLowerCase();
		// for (var i = 0; i < countries.length; i++) {
		// 	if (countries[i].country === country) {
		// 		if (answer === countries[i].capitol) {
		// 			score ++;
		// 			alert("Correct answer! Score: " + score);
		// 			document.getElementById("capitol").value = "";
		// 			selectCountry();
		// 		} else {
		// 			alert("Incorrect, try again! Score: " + score);
		// 		}
		// 	}
		// }

		alert($("input[name=answer]:checked").val());
		$('#a1').append("<span id='answer1'>Hello</span>");
		$('#b1').append("<span id='answer2'>Hello</span>");
		$('#c1').append("<span id='answer3'>Hello</span>");
		$('#d1').append("<span id='answer4'>Hello</span>");
		$('#answer1').remove();
		$('#a1').append("woop");

	}
	function registerEventHandlers() {
		document.getElementById("countrySubmit").addEventListener('click',selectCountry, false);
		document.getElementById("capitolSubmit").addEventListener('click',checkAnswer, false);
	}

var countries = 
		[
			{country: "argentina", capitol: "buenos aires", answered: false },
			{country: "australia", capitol: "canberra", answered: false },
			{country: "netherlands", capitol: "amsterdam", answered: false },
			{country: "austria", capitol: "vienna", answered: false},
			{country: "japan", capitol: "tokyo", answered: false},
			{country: "greece", capitol: "athens", answered: false},
			{country: "iceland", capitol: "reykjavik", answered: false},
			{country: "india", capitol: "new delhi", answered: false},
			{country: "indonesia", capitol: "jakarta", answered: false},
			{country: "armenia", capitol: "yerevan", answered: false},
			{country: "belgium", capitol: "brussels", answered: false}
		]