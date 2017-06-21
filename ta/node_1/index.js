var express = require('express');
var app = express();
app.set('port', (process.env.PORT || 5000));

app.use(express.static(__dirname + '/public'));

// views is directory for all template files
app.set('views', __dirname + '/views');
app.set('view engine', 'ejs');

app.get('/', function(request, response) {
  response.render('pages/index');
});

app.listen(app.get('port'), function() {
  console.log('Node app is running on port', app.get('port'));
});

app.get('/math', function (req, res) {
//    var val1 = req.name("val1");
    var value1 = req.query.val1;
    var value2 = req.query.val2;
    var tot = value1 - value2;
    data = {
        total: tot
    }
    res.render('pages/result', data);
})

app.get('/math_service', function (req, res) {
//    console.log("this is working");
    var value1 = req.query.val1;
    var value2 = req.query.val2;
    var tot = value1 - value2;
    data = {
        total: tot
    }
    res.json(data);
})
