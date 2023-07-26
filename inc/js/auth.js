// DOM
document.addEventListener("DOMContentLoaded", function () {
  // variables
  // get section inscription
  const section_insc = document.querySelector("#inscription");
  let form_insc = section_insc.querySelector("form");
  let login_insc = form_insc.querySelector(".login");
  let password_insc = form_insc.querySelector(".password");
  let password2 = form_insc.querySelector("#password2");
  const btnInsc = document.querySelector("#btnInsc");
  const switchConn = section_insc.querySelector("#switchConn");

  // get section connection
  const section_conn = document.querySelector("#connexion");
  let form_conn = section_conn.querySelector("form");
  let login_conn = form_conn.querySelector(".login");
  let password_conn = form_conn.querySelector(".password");
  const btnConn = document.querySelector("#btnConn");
  const switchInsc = section_conn.querySelector("#switchInsc");

  // other variables
  let validation = false;
  // get choice from url
  let str = window.location.href;
  let url = new URL(str);
  let choice = url.searchParams.get("choice");

  // display functions
  // display connection
  function displayConn() {
    section_insc.style.display = "none";
    section_conn.style.display = "block";
    document.title = "Connection";
  }
  // display inscription
  function displayInsc() {
    section_insc.style.display = "block";
    section_conn.style.display = "none";
    document.title = "Register";
  }

  // display connection if choice = conn
  if (choice === "login") {
    displayConn();
  } else if (choice === "register") {
    displayInsc();
  } else {
    displayInsc();
  }

  // function for switch between connection and inscription
  // switch to connection
  $(switchConn).click(function () {
    // animation
    $(section_insc).hide(1000);
    setTimeout(function () {
      $(section_conn).show(1000);
    }, 500);
  });
  // switch to inscription
  $(switchInsc).click(function () {
    // animation
    $(section_conn).hide(1000);
    setTimeout(function () {
      $(section_insc).show(1000);
    }, 500);
  });

  //////////////////////////////////////////////////
  // Function for inscription                ///////
  //////////////////////////////////////////////////
  // Verif login
  function verifLogin() {
    let loginValue = login_insc.value;
    // verif if login is empty
    if (loginValue === "") {
      login_insc.nextElementSibling.innerHTML = "Please enter a login";
      // change border color and background
      login_insc.style.borderColor = "red";
      login_insc.style.backgroundColor = "#ff000033";

      validation = false;
    } else {
      login_insc.nextElementSibling.innerHTML = "";
      // change border color to default
      login_insc.style.borderColor = "initial";
      login_insc.style.backgroundColor = "#fafafa";
      // verif if login is available
      let dataLogin = new FormData();
      dataLogin.append("verifLogin", loginValue);
      //   console.log(dataLogin);
      fetch("inc/php/auth.php", {
        method: "POST",
        body: dataLogin,
      })
        .then((response) => response.text())
        .then((response) => {
          response = response.trim();
          //   console.log(response);
          if (response === "indispo") {
            login_insc.nextElementSibling.innerHTML = "Login unavailable";
            // change border color and background
            login_insc.style.borderColor = "red";
            login_insc.style.backgroundColor = "#ff000033";

            validation = false;
          } else if (response === "dispo") {
            login_insc.nextElementSibling.innerHTML = "";
            // change border color and background
            login_insc.style.borderColor = "green";
            login_insc.style.backgroundColor = "#fafafa";
            // delete dataLogin key verifLogin
            dataLogin.delete("verifLogin");
            validation = true;
          }
        })
        .catch((error) => console.log(error));
    }
  }

  // Verif password
  function verifPassword() {
    let passwordValue = password_insc.value;

    // verif if password is empty
    if (passwordValue === "") {
      password_insc.nextElementSibling.innerHTML = "Please enter a password";
      // change border color and background
      password_insc.style.borderColor = "red";
      password_insc.style.backgroundColor = "#ff000033";
      validation = false;
    } else {
      password_insc.nextElementSibling.innerHTML = "";
      // change border color and background
      password_insc.style.borderColor = "green";
      password_insc.style.backgroundColor = "#fafafa";
      validation = true;
    }
  }

  // Verif if password and password2 match
  function verifPassword2() {
    let passwordValue = password_insc.value;
    let password2Value = password2.value;

    // verif if password2 is empty
    if (password2Value === "") {
      password2.nextElementSibling.innerHTML = "Please confirm your password";
      // change border color and background
      password2.style.borderColor = "red";
      password2.style.backgroundColor = "#ff000033";
      validation = false;
    } else {
      password2.nextElementSibling.innerHTML = "";
      // change border color and background to default
      password2.style.borderColor = "initial";
      password2.style.backgroundColor = "#fafafa";
      // verif if password and password2 match
      if (passwordValue === password2Value) {
        password2.nextElementSibling.innerHTML = "";
        // change border color and background
        password2.style.borderColor = "green";
        password2.style.backgroundColor = "#fafafa";
        validation = true;
      } else {
        password2.nextElementSibling.innerHTML = "Passwords do not match";
        // change border color and background
        password2.style.borderColor = "red";
        password2.style.backgroundColor = "#ff000033";
        validation = false;
      }
    }
  }

  //////////////////////////////////////////////////
  // Function for connection                  ///////
  //////////////////////////////////////////////////
  // Verif login
  function verifLoginConn() {
    let loginValue = login_conn.value;
    // verif if login is empty
    if (loginValue === "") {
      login_conn.nextElementSibling.innerHTML = "Please enter a login";
      // change border color and background
      login_conn.style.borderColor = "red";
      login_conn.style.backgroundColor = "#ff000033";

      validation = false;
    } else {
      validation = true;
    }
  }

  // Verif password
  function verifPasswordConn() {
    let passwordValue = password_conn.value;

    // verif if password is empty
    if (passwordValue === "") {
      password_conn.nextElementSibling.innerHTML =
        "Enter a password";
      // change border color and background
      password_conn.style.borderColor = "red";
      password_conn.style.backgroundColor = "#ff000033";
      validation = false;
    } else {
      password_conn.nextElementSibling.innerHTML = "";
      // change border color and background
      password_conn.style.borderColor = "green";
      password_conn.style.backgroundColor = "#fafafa";
      validation = true;
    }
  }

  //////////////////////////////////////////////////
  // add event for inscription                 /////     
  //////////////////////////////////////////////////
  // login
  login_insc.addEventListener("blur", verifLogin);
  // password
  password_insc.addEventListener("blur", verifPassword);
  // password2
  password2.addEventListener("keyup", verifPassword2);
  // btnInsc
  btnInsc.addEventListener("click", function (e) {
    e.preventDefault();
    if (validation) {
      let data = new FormData(form_insc);
      data.append("insc", "ok");
      fetch("inc/php/auth.php", {
        method: "POST",
        body: data,
      })
        .then((response) => response.text())
        .then((response) => {
          response = response.trim();
          //   console.log(response);
          if (response === "Successfully registered!") {
            // msg for connection then redirection
            btnInsc.nextElementSibling.innerHTML = "Successfully registered!";
            setTimeout(() => {
              displayConn();
            }, 2000);
          }
        })
        .catch((error) => console.log(error));
    }
  });

  //////////////////////////////////////////////////
  // add event for connection                  /////
  //////////////////////////////////////////////////
  // login
  login_conn.addEventListener("blur", verifLoginConn);
  // password
  password_conn.addEventListener("blur", verifPasswordConn);
  // btnConn
  btnConn.addEventListener("click", function (e) {
    e.preventDefault();
    if (validation) {
      let data = new FormData(form_conn);
      data.append("conn", "ok");
      fetch("inc/php/auth.php", {
        method: "POST",
        body: data,
      })
        .then((response) => response.text())
        .then((response) => {
          response = response.trim();
          //   console.log(response);
          if (response === "Successfull connection !") {
            // msg for connection then redirection
            btnConn.nextElementSibling.innerHTML =
              "Successfull connection, you'll be redirected in 2 seconds";
            setTimeout(() => {
              window.location.href = "index.php";
            }, 2000);
          } else if (response === "error") {
            // msg for login or password error
            btnConn.nextElementSibling.innerHTML = "Wrong login or password";
            btnConn.nextElementSibling.style.color = "red";
            btnConn.nextElementSibling.borderColor = "red";
            validation = false;
          }
        })
        .catch((error) => console.log(error));
    }
  });
});
