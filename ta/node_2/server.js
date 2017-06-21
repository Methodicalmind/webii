var express = require('express');
var app = express();

const { Pool } = require('pg');
const connectionString = "postgresql://ta_user:ta_pass@localhost:5432/familyhistory";

const pool = new Pool({
  connectionString: connectionString,
});


app.set('port', (process.env.PORT || 5000));

app.use(express.static(__dirname + '/public'));

app.set('views', __dirname + '/views');
app.set('view engine', 'ejs');

//app.get('/getPerson', function(req, res){
//    var id = [];
//    var id[0] = req.query.id;
//    console.log("id: " + id);
//    getPerson();
//});
//
//function getPerson() {
//    get 
//    console.log("getting person");
//    
//}
pool.connect((err, client, done) => {
  if (err) throw err
  client.query('SELECT * FROM person', (err, res) => {
    done();
    if (err) {
      console.log(err.stack);
    } else {
      console.log(res.rows[0]);
    }
  });
});

app.listen(app.get('port'), function() {
  console.log('Node app is running on port', app.get('port'));
});