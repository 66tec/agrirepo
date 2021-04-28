const express = require('express');
var path = require('path');
var cookieParser = require('cookie-parser');
var logger = require('morgan');
var http = require('http');  
var url = require('url');    
var session = require('express-session');
var bodyParser = require('body-parser');
const app = express();
const port = 7000;
var mysql = require('mysql');
var con = mysql.createConnection({
  host: "localhost",
  user: "tecozk_root",
  password: "dbase_fc",
  database: "tecozk_agritech2"
});
con.connect(function(err) {
  if (err) throw err;
console.log("Connected!");
});  

app.use(session({
	secret: 'secret',
	resave: true,
	saveUninitialized: true
}));
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');
//setup public folder
app.use(express.static('./public'));
app.use('/fa', express.static(__dirname + '/node_modules/font-awesome/css'));
app.use('/fonts', express.static(__dirname + '/node_modules/font-awesome/fonts'));

app.use(bodyParser.urlencoded({ extended: false }));
// parse application/json
app.use(bodyParser.json());

///////////////////////////////////

app.get('/',function (req, res) {
  res.render('pages/login')
});

app.get('/home',function (req, res) {
  res.render('pages/index')
});


app.get('/signup',function (req, res) {
  res.render('pages/signup')
});

app.get('/login',function (req, res) {
  res.render('pages/login')
});

app.get('/logout',function (req, res) {
  req.session.loggedin = false;
  res.render('pages/login')
});
///////////////////////////////////////////

// var async      = require('async');
var credentials = { 
  host: "localhost",
user: "tecozk_root",
password: "dbase_fc",
database: "tecozk_agritech2",
multipleStatements: true
}





//////////////////////////////
app.post('/loginauth',function (req, res) {

   var username = req.body.username;
 	var password = req.body.password;
   var username_dash = username;
  var pool = mysql.createPool(credentials);
  var query1 = "SELECT * FROM user_login WHERE username = ? AND password = ?";
  var query2 = "SELECT * from stream_chamber ORDER BY stream_id DESC LIMIT 5";
  var query3 = "SELECT harvestdate from " // yahan pe kaam karna he harvest date lagani he or wo change hogi har chamber k hisaab se dropdown wapas
  // lagayenge dashboard pe chart wali table pe
  var stream = {};
  
  var countDownDate = new Date("Aug 5, 2021 15:00:00").getTime();
  var rdate;
  // Update the count down every 1 second
  
  
    // Get today's date and time
    var now = new Date().getTime();
  
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
  
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  
  
    // Display the result in the element with id="demo"
    rdate = days 
  
    // If the count down is finished, write some text
    if (distance < 0) {
      clearInterval(x);
      rdate = "Harvest is ready";
    }
    console.log(rdate);
  if (username && password) {
    pool.getConnection(function(err, connection) {
      if (err) throw err; // not connected!
      console.log('connected');
    // Use the connection
    connection.query(query1,[username,password], function (error, results) {
      // connection.release();
      
                     if (results.length > 0) {
                      req.session.loggedin = true;
                              req.session.username = username;
                             // var username_dash = username;
                              var date = new Date().toLocaleString();
                              connection.query('UPDATE user_login set lastlogin = ? where username = ?',[date,username]);
                     }
                     else{
                       res.send('invalid name or pASS')
                     }
      // When done with the connection, release it.
      
      // Handle error after the release.
      if (error) throw error;
    });
  });
  pool.getConnection(function(err, connection) {
    if (err) throw err; // not connected!
    console.log('connected');
  
    connection.query(query2, function (error, rs) {
      res.render('pages/dashboarduser',{username_dash:username_dash,stream: rs,rdate :rdate });
       
      connection.release();
    });

    
      //,stream: rs
      // Don't use the connection here, it has been returned to the pool.
    });
    
  } 
    else{
      res.send('insertueser name and password')
    }
  });

 
app.post('/insertuser' , function(req,res,next){

      let fname = req.body.fname;
      let lname = req.body.lname;
      let username = req.body.username;
      let password = req.body.password;
      let email = req.body.email;
      let phone = req.body.phone;
      
      var form_data = {
          username: username,
          password: password,
          email:email,
          phone:phone
      }

      // res.send('Welcome back, ' + req.session.username + '!');
      con.query('INSERT INTO user_login SET ?', form_data, function (err, result) {
          //res.send({username:username});
          
          res.render('pages/login');
      //  res.render('pages/users');
      

});
});

app.get('/dashboarduser',function (req, res) {
var username_dash = req.session.username;
  res.render('pages/dashboarduser',{username_dash:username_dash });
});

app.get('/dashboardadmin',function (req, res) {
  res.render('pages/dashboardadmin')
});

app.get('/allchambers',function (req, res, next){
  if (req.session.loggedin) {
      // res.send('Welcome back, ' + req.session.username + '!');
       var username_dash = req.session.username;
      con.query('SELECT * from stream_chamber ORDER BY stream_id DESC LIMIT 10', function (err, rs) {
          res.render('pages/allchambers', {username_dash:username_dash,stream: rs });
      //  res.render('pages/users');
      });
  } else {
      res.send('Please login to view this page!');
  }
});

app.get('/currentchambers',function (req, res, next){
  if (req.session.loggedin) {
      // res.send('Welcome back, ' + req.session.username + '!');
       var username_dash = req.session.username;
      con.query('SELECT * from stream_chamber ORDER BY stream_id DESC LIMIT 10', function (err, rs) {
          res.render('pages/currentchambers', {username_dash:username_dash,stream: rs });
      //  res.render('pages/users');
      });
  } else {
      res.send('Please login to view this page!');
  }
});


app.get('/buychamber',function (req, res, next){
  if (req.session.loggedin) {
      // res.send('Welcome back, ' + req.session.username + '!');
       var username_dash = req.session.username;
      //con.query('SELECT * from stream_chamber ORDER BY stream_id DESC LIMIT 10', function (err, rs) {
          res.render('pages/buychamber', {username_dash:username_dash});
      //});
  } else {
      res.send('Please login to view this page!');
  }
  // res.end();
});

app.get('/croptimeline',function (req, res, next){
  if (req.session.loggedin) {
      // res.send('Welcome back, ' + req.session.username + '!');
       var username_dash = req.session.username;
      //con.query('SELECT * from stream_chamber ORDER BY stream_id DESC LIMIT 10', function (err, rs) {
          res.render('pages/croptimeline', {username_dash:username_dash });
      //});
  } else {
      res.send('Please login to view this page!');
  }
  // res.end();
});











app.use(logger('dev'));
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(cookieParser());




// catch 404 and forward to error handler
app.use(function(req, res, next) {
  next(createError(404));
});

// error handler
app.use(function(err, req, res, next) {
  // set locals, only providing error in development
  res.locals.message = err.message;
  res.locals.error = req.app.get('env') === 'development' ? err : {};

  // render the error page
  res.status(err.status || 500);
  res.render('error');
});

module.exports = app;
app.listen(port, () => console.log(`Agritech app Started on port ${port}!`));
