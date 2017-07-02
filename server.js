var collectionCon = require('./controller/collectionCon.js');
var collectionMod = require('./model/collectionMod.js');
var path = require('path');
var formidable = require('formidable');
var fs = require('fs');
var session = require('express-session')
var express = require('express');
var app = express();
var bodyParser = require('body-parser')


//use
app.use(express.static(__dirname + '/view'));
app.use( bodyParser.json() );       // to support JSON-encoded bodies
app.use(bodyParser.urlencoded({     // to support URL-encoded bodies
  extended: true
}));
app.use(session({secret:'bhyb89tb2z2tyinbhifewhbisoubcq8097341', resave:true, saveUninitialized: false}));


//set
// views is directory for all template files
app.set('views', __dirname + '/view/pages');
app.set('view engine', 'ejs');
app.set('port', (process.env.PORT || 5000));


//route
app.get('/', function(req, res){
  res.sendFile(__dirname + '/view/index.html');
});

app.get('/manage_collection', function(req, res) {
   res.render('admin/sort_album');
});

app.post('/upload', collectionCon.handleImgUpload);


//listen
app.listen(app.get('port'), function(){
  console.log('Server listening on port ' + app.get('port'));
});
