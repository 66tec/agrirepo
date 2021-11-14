const express = require('express');
var multer = require('multer');
var path = require('path');
var cookieParser = require('cookie-parser');
var logger = require('morgan');
var http = require('http');  
var url = require('url');    
var session = require('express-session');
var bodyParser = require('body-parser');
const app = express();
const port = 3000;
var mysql = require('mysql');
const { Script } = require('vm');
var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "tecozk_tecozk_agritech1"});
con.connect(function(err) {
  if (err) throw err;
console.log("Connected!");
});  
var indexRouter = require('./routes/index');
var usersRouter = require('./routes/users');
//////////////

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

app.use('/', indexRouter);









//Upload File///////
var Storage=multer.diskStorage({
  destination:"./public/uploads/",
  filename:(req,file,cb)=>{
    cb(null,file.fieldname+"_"+Date.now()+path.extname(file.originalname));
  }
}); 

var upload = multer({
  storage:Storage
}).single('file');

app.post('/upload', upload, function(req, res, next) {
  
  var success='uploads/'+req.file.filename;
  console.log(success);
  pathi = success;
  if (req.session.loggedin) {
    var username_dash = req.session.username;
    con.query('select id from user_login where username=?',username_dash,function(error,userid){

    var formdata = {
      username : username_dash,
      path:pathi,
      user_id:userid[0].id

    }

    con.query('Insert into album_gallery set ?',formdata, function(error,tttt){
      con.query('select * from album_gallery',function(error,tfa){

      con.query('Select * from farm', function(error,tf){
      var tfarm=tf.length;
    con.query('Select * from chamber', function(error,tc){
      var tchamber=tc.length;
    con.query('Select * from zone', function(error,tz){
      var tzone=tz.length;
    con.query('Select * from component', function(error,tcm){
      var tcomponent=tcm.length;
    con.query('Select * from user_login', function(error,tlog){
      var tlogin=tlog.length;
    con.query('SELECT role from user_login where username = ?',username_dash, function (error, rsi) {
      var usertype = rsi[0].role;
      if(usertype == 'super_admin')
    res.render('pages/dashboardsuper',{username_dash:username_dash,usertype:usertype,tfarm:tfarm,tchamber:tchamber,tchamber:tchamber,tzone:tzone,tcomponent:tcomponent,tlogin:tlogin,tfa:tfa});
   else if(usertype == 'admin')
    res.render('pages/dashboardadmin',{username_dash:username_dash,usertype:usertype,tfarm:tfarm,tchamber:tchamber,tchamber:tchamber,tzone:tzone,tcomponent:tcomponent,tlogin:tlogin,tfa:tfa});
    else if(usertype == 'customer')
    res.render('pages/dashboarduser',{username_dash:username_dash,usertype:usertype,tfarm:tfarm,tchamber:tchamber,tchamber:tchamber,tzone:tzone,tcomponent:tcomponent,tlogin:tlogin,tfa:tfa });
  
  });
    });
    });
    });
    });
  });
  });
  });
    });
  } else {
    res.send('Please login to view this page!');
  }
});


////////////////////////////////


// app.get('/newzone',function (req, res) {
//   var username_dash = req.session.username;
//     res.render('pages/newzone',{username_dash:username_dash });
//   });




// app.get('/dashboardadmin',function (req, res) {
//   res.render('pages/dashboardadmin')
// });




// app.get('/buychamber',function (req, res, next){
//   if (req.session.loggedin) {
//       // res.send('Welcome back, ' + req.session.username + '!');
//        var username_dash = req.session.username;
//       //con.query('SELECT * from stream_chamber ORDER BY stream_id DESC LIMIT 10', function (err, rs) {
//           res.render('pages/buychamber', {username_dash:username_dash});
//       //});
//   } else {
//       res.send('Please login to view this page!');
//   }  
// });

// app.get('/croptimeline',function (req, res, next){
//   if (req.session.loggedin) {
//       // res.send('Welcome back, ' + req.session.username + '!');
//        var username_dash = req.session.username;
//       //con.query('SELECT * from stream_chamber ORDER BY stream_id DESC LIMIT 10', function (err, rs) {
//           res.render('pages/croptimeline', {username_dash:username_dash });
//       //});
//   } else {
//       res.send('Please login to view this page!');
//   }
  // res.end();
// });


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
