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

app.use(bodyParser.urlencoded({ extended: false }));
// parse application/json
app.use(bodyParser.json());

///////////////////////////////////

app.get('/',function (req, res) {
  res.render('pages/index')
});

app.get('/signup',function (req, res) {
  res.render('pages/signup')
});

app.get('/login',function (req, res) {
  res.render('pages/login')
});

app.post('/loginauth',function (req, res) {
  var username = req.body.username;
	var password = req.body.password;
	if (username && password) {
		con.query('SELECT * FROM user_login WHERE username = ? AND password = ?', [username, password], function(error, results, fields) {
			if (results.length > 0) {
				req.session.loggedin = true;
                req.session.username = username;
                var username_dash = username;
				res.render('pages/dashboard',{username_dash:username_dash});
			} else {
				res.send('Incorrect Username and/or Password!');
			}			
			res.end();
		});
	} else {
		res.send('Please enter Username and Password!');
		res.end();
	}
});

app.get('/dashboard',function (req, res) {
  res.render('pages/dashboard')
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
