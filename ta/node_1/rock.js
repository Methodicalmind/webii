function handlePlay(req, res) {
   var playerWeapon = req.query.weapon; 
    var cpuWeapon = getRandomWeapon();
    var winner = getWinner(playerWeapon, cpuWeapon);
    var data = {
        won: winner,
        pw: playerWeapon,
        cw: cpuWeapon
    }
    res.render("pages/winner", data);
});

function getRandomWeapon() {
    return "Rock";
}

function getWinner(pw, cw) {
    return "Computer";
}

module.exports = {}