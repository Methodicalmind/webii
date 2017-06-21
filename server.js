var express = require('express');
var app = express();

app.set('port', (process.env.PORT || 5000));

app.use(express.static(__dirname + '/public'));

app.set('views', __dirname + '/views');
app.set('view engine', 'ejs');

app.get('/price', function(req,res){
    var letter_type = req.query.letter_type;
    var weight = req.query.weight;
    console.log("this is : " + letter_type);
    var price = getPrice(letter_type, weight);
    var data = {
        w: weight,
        lt: letter_type,
        t: price
    }
    res.render("pages/results", data);
});

function getPrice(lt, w){
    if(lt == "flats") {
        var price = (w*.21) + .98
        if(w > 13)
            return price = "Item to Large for letter type."
        return price;
    }
    if(lt == "stamped") {
        var price = (w*.21) + .49
        if(w > 4)
            return price = "Item to Large for letter type."
        return price;
    }
    if(lt == "metered") {
        var price = (w*.21) + .46
        if(w > 4)
            return price = "Item to Large for letter type."
        return price;
    }
    if(lt == "parcels") {
        var price = (w*.18) + 2.67
        if(w > 13)
            return price = "Item to Large for letter type."
        if(w < 4)
            return price = 2.67 
        return price;
    }
}
app.listen(app.get('port'), function() {
  console.log('Node app is running on port', app.get('port'));
});
