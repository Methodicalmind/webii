var imgMod = require('../model/imgMod.js');
var path = require('path');
var formidable = require('formidable');
var fs = require('fs');
var cookieSession = require('cookie-session')
var express = require('express');
var app = express();

app.use(cookieSession({
  name: 'session',
  keys: [/* secret keys */],

  // Cookie Options
  maxAge: 24 * 60 * 60 * 1000 // 24 hours
}))


var bodyParser = require('body-parser')
app.use( bodyParser.json() );       // to support JSON-encoded bodies
app.use(bodyParser.urlencoded({     // to support URL-encoded bodies
  extended: true
}));

var imgCon = require('./controller/imgCon.js');
var curCollect = "";
var curAlbum = "";

// views is directory for all template files
app.set('views', __dirname + '/view/pages');
app.set('view engine', 'ejs');
app.set('port', (process.env.PORT || 5000));
app.use(express.static(__dirname + '/view'));

app.get('/', function(req, res){
  res.sendFile(__dirname + '/view/index.html');
});

app.get('/collection', function(req, res) {
   res.render('admin/manage_collection');
});

app.post('/upload', imgCon.handleImgUpload);
app.get('/upload', imgCon.handleImgUpload);
app.get('/upload', imgCon.handleImgUpload);
app.get('/upload', imgCon.handleImgUpload);

app.listen(app.get('port'), function(){
  console.log('Server listening on port ' + app.get('port'));
});
