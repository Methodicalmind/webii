var express = require('express');
var app = express();

app.use(express.static(__dirname + '/public'));

app.set('views', __dirname + '/views');
app.set('view engine', 'ejs');

app.set('port', (process.env.PORT || 5000));

app.listen(app.get('port'), function (){
           console.log("server is running on port: " + app.get('port'));
});

var rockGame = require('./rock.js');
//app.get('/', function(req, res){
//});

app.get('/play', rockGame.handle(req, res) {
    
});