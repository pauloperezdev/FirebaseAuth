<?php ?>
<!DOCTYPE html>
<html>

<head>
  <title>Autenticando con Firebase</title>

  <link href="https://fonts.googleapis.com/css?family=Karla:400" rel="stylesheet" type="text/css">

  <style>
    html,
    body {
      height: 100%;
    }

    body {
      margin: 0;
      padding: 0;
      width: 100%;
      display: table;
      font-weight: 100;
      font-family: 'Karla';
    }

    .container {
      text-align: center;
      display: table-cell;
      vertical-align: middle;
    }

    .content {
      text-align: center;
      display: inline-block;
    }

    .title {
      font-size: 96px;
    }

    .opt {
      margin-top: 30px;
    }

    .opt a {
      text-decoration: none;
      font-size: 150%;
    }

    a:hover {
      color: red;
    }
  </style>
</head>

<body>
  <h3>Registrarse</h3>
  <input type="email" id="email" placeholder="Email">
  <input type="password" id="password" placeholder="Contraseña">
  <button onclick="enviar()">Enviar</button>
  <h3>Ingresar</h3>
  <input type="email" id="emailA" placeholder="Email">
  <input type="password" id="passwordA" placeholder="Contraseña">
  <button onclick="acceso()">Acceder</button>

  <h3 id="login">Usuario: </h3>
  <button onclick="logout()">Salir</button>

  <!-- The core Firebase JS SDK is always required and must be listed first -->
  <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-auth.js"></script>

  <!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->

  <script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
      apiKey: "AIzaSyDuWmTo1Ho3oDoVqTTcqgEZwO9KU89R5gE",
      authDomain: "primal-turbine-97221.firebaseapp.com",
      databaseURL: "https://primal-turbine-97221.firebaseio.com",
      projectId: "primal-turbine-97221",
      storageBucket: "primal-turbine-97221.appspot.com",
      messagingSenderId: "489408903047",
      appId: "1:489408903047:web:3a5a40a4e67de6158f4522"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    firebase.auth().onAuthStateChanged((user) => {
      if (user) {
        // User is signed in, see docs for a list of available properties
        // https://firebase.google.com/docs/reference/js/firebase.User
        var uid = user.uid;
        var usuario = user.displayName;
        var email = user.email;
        // ...
        document.getElementById('login').innerHTML = "Usuario: " + email;
      } else {
        // User is signed out
        // ...
        document.getElementById('login').innerHTML = "No Logueado... ";
      }
    });


    function enviar() {
      var email = document.getElementById('email').value;
      var password = document.getElementById('password').value;
      //alert("mail:"+email+" pass="+password);


      firebase.auth().createUserWithEmailAndPassword(email, password)
        .then((userCredential) => {
          // Signed in
          var user = userCredential.user;
          // ...
        })
        .catch((error) => {
          var errorCode = error.code;
          var errorMessage = error.message;
          alert(errorMessage);
        })
    }

    function acceso() {
      var email = document.getElementById('emailA').value;
      var password = document.getElementById('passwordA').value;
      //alert("Ingresando...");

      firebase.auth().signInWithEmailAndPassword(email, password)
        .then((userCredential) => {
          // Signed in
          var user = userCredential.user;
          // ...
          console.log(user);
          document.getElementById('login').innerHTML = "UsuarioCred: " + user.email;
        })
        .catch((error) => {
          var errorCode = error.code;
          var errorMessage = error.message;
          alert(errorMessage);
        });

    }


    function logout(){
        firebase.auth().signOut()
        .then(function(){
          console.log('Salio');
        })
        .catch(function(error){
          console.log(error);
        })
    }
  </script>
</body>

</html>