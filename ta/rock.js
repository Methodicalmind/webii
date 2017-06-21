/**
 * Returns a random integer between min (inclusive) and max (inclusive)
 * Using Math.round() will give you a non-uniform distribution!
 */
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function getCpuChoice() {
	var num = getRandomInt(0, 2);

	var result;

	if (num == 0) {
		result = "rock";
	} else if (num == 1) {
		result = "paper";
	} else if (num == 2) {
		result = "scissors";
	}

	return result;
}

function getWinner(player, cpu) {
	var winner;

	if (player == cpu) {
		winner = "draw";
	} else if ((player == "rock" && cpu == "scissors")
		|| (player == "scissors" && cpu == "paper")
		|| (player == "paper" && cpu == "rock")) {
		winner = "player";
	} else {
		winner = "cpu";
	}

	return winner;
}

function handleGame(request, response) {
	var playerChoice = request.query.player_choice;
	console.log("Player Choice: " + playerChoice);

	var cpuChoice = getCpuChoice();
	console.log("CPU Choice: " + cpuChoice);

	var winner = getWinner(playerChoice, cpuChoice);
	console.log("Winner: " + winner);

	var params = {playerChoice: playerChoice, cpuChoice: cpuChoice, winner: winner};

	response.render("pages/results", params);
}

function play(playerChoice, callback) {
	var cpuChoice = getCpuChoice();
	console.log("CPU Choice: " + cpuChoice);

	var winner = getWinner(playerChoice, cpuChoice);
	console.log("Winner: " + winner);

	var results = {playerChoice: playerChoice, cpuChoice: cpuChoice, winner: winner};

	callback(null, results);
}

module.exports = {play: play};

