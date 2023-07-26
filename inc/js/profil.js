// DOM ready
document.addEventListener("DOMContentLoaded", function () {
  // variables
  let validation = false;
  let msg = document.querySelector("#msg");
  // login
  const loginForm = document.querySelector("#loginForm");
  let loginInput = loginForm.querySelector(".login");
  let passwordInput = loginForm.querySelector(".password");
  const loginButton = loginForm.querySelector("#btnModifLogin");
  // old login
  let user = loginInput.value;

  // password
  const passwordForm = document.querySelector("#passwordForm");
  let oldPasswordInput = passwordForm.querySelector("#oldPassword");
  let newPasswordInput = passwordForm.querySelector("#newPassword");
  let newPasswordConfirmInput = passwordForm.querySelector("#newPassword2");
  const passwordButton = passwordForm.querySelector("#btnModifPass");

  /////////////////////////////////////
  // Function for login and password //
  ////////////////////////////////////

  // function to check if the login is valid
  function checkLogin() {
    let loginValue = loginInput.value;
    if (loginValue == "") {
      loginInput.nextElementSibling.innerHTML = "Login required";
      // change border color and background
      loginInput.style.borderColor = "red";
      loginInput.style.backgroundColor = "#fde2e2";
      // loginInput.style.backgroundColor = "#ff000063";
      validation = false;
    } else if (loginValue == user) {
      loginInput.nextElementSibling.innerHTML = "";
      // change border color and background
      loginInput.style.borderColor = "initial";
      loginInput.style.backgroundColor = "fafafa";
      validation = false;
    } else {
      loginInput.nextElementSibling.innerHTML = "";
      // change border color and background
      loginInput.style.borderColor = "initial";
      let dataLogin = new FormData();

      dataLogin.append("verifLogin", loginValue);
      fetch("inc/php/verifProfil.php", {
        method: "POST",
        body: dataLogin,
      })
        .then((response) => response.text())
        .then((data) => {
          data = data.trim();
          if (data == "indispo") {
            loginInput.nextElementSibling.innerHTML = "Login not available";
            // change border color and background
            loginInput.style.borderColor = "red";
            loginInput.style.backgroundColor = "#fde2e2";
            validation = false;
          } else if (data == "dispo") {
            loginInput.nextElementSibling.innerHTML = "Login available";
            // change border color and background
            loginInput.style.borderColor = "initial";
            loginInput.style.backgroundColor = "fafafa";
            validation = true;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }
  }

  // function to check if the password is valid
  function checkPassword(pass) {
    let passwordValue = pass.value;
    if (passwordValue == "") {
      pass.nextElementSibling.innerHTML = "Password required";
      // change border color and background
      pass.style.borderColor = "red";
      pass.style.backgroundColor = "#fde2e2";
      validation = false;
    } else {
      pass.nextElementSibling.innerHTML = "";
      // change border color and background
      pass.style.borderColor = "initial";
      pass.style.backgroundColor = "#fafafa";
      validation = true;
    }
  }

  // function to check if the new password confirm is valid
  function checkNewPasswordConfirm() {
    let newPasswordValue = newPasswordInput.value;
    let newPasswordConfirmValue = newPasswordConfirmInput.value;
    if (newPasswordConfirmValue == "") {
      newPasswordConfirmInput.nextElementSibling.innerHTML =
        "Password required";
      // change border color and background
      newPasswordConfirmInput.style.borderColor = "red";
      newPasswordConfirmInput.style.backgroundColor = "#fde2e2";
      validation = false;
    } else if (newPasswordConfirmValue != newPasswordValue) {
      newPasswordConfirmInput.nextElementSibling.innerHTML =
        "Password does not match";
      // change border color and background
      newPasswordConfirmInput.style.borderColor = "red";
      newPasswordConfirmInput.style.backgroundColor = "#fde2e2";
      validation = false;
    } else {
      newPasswordConfirmInput.nextElementSibling.innerHTML = "";
      // change border color and background
      newPasswordConfirmInput.style.borderColor = "initial";
      newPasswordConfirmInput.style.backgroundColor = "#fafafa";
      validation = true;
    }
  }

  /////////////////////////////////
  // event for login             //
  /////////////////////////////////
  // login
  loginInput.addEventListener("blur", checkLogin);

  // password
  passwordInput.addEventListener("blur", function (e) {
    checkPassword(passwordInput);
  });

  // login form
  loginButton.addEventListener("click", function (e) {
    e.preventDefault();
    if (validation) {
      let data = new FormData(loginForm);
      data.append("oldLogin", user);
      data.append("modifLogin", "ok");
      fetch("inc/php/verifProfil.php", {
        method: "POST",
        body: data,
      })
        .then((response) => response.text())
        .then((response) => {
          response = response.trim();
          if (response === "ok") {
            loginButton.nextElementSibling.innerHTML = "Successfull update";
            loginInput.focus();
            // new login
            user = loginInput.value;
            // reset form
            loginForm.reset();
            loginInput.nextElementSibling.innerHTML = "";
            passwordInput.nextElementSibling.innerHTML = "";
            // change border color and background
            loginInput.style.borderColor = "initial";
            passwordInput.style.borderColor = "initial";
            loginInput.style.backgroundColor = "fafafa";
            passwordInput.style.backgroundColor = "fafafa";
            validation = false;

            // mise en place du nouveau login
            loginInput.value = user;
          } else if (response === "incorrect") {
            passwordInput.nextElementSibling.innerHTML = "Invalid password";
            passwordInput.style.borderColor = "red";
            passwordInput.style.backgroundColor = "#fde2e2";
          }
        })
        .catch((error) => console.log(error));
    }
  });

  /////////////////////////////////
  // event for password          //
  /////////////////////////////////

  // old password
  oldPasswordInput.addEventListener("blur", function (e) {
    checkPassword(oldPasswordInput);
  });

  // new password
  newPasswordInput.addEventListener("blur", function (e) {
    checkPassword(newPasswordInput);
  });

  // new password confirm
  newPasswordConfirmInput.addEventListener("keyup", checkNewPasswordConfirm);

  // password form
  passwordButton.addEventListener("click", function (e) {
    e.preventDefault();
    if (validation) {
      let data = new FormData(passwordForm);
      data.append("modifPass", "ok");
      fetch("inc/php/verifProfil.php", {
        method: "POST",
        body: data,
      })
        .then((response) => response.text())
        .then((response) => {
          response = response.trim();
          // console.log(response);
          if (response === "ok") {
            passwordButton.nextElementSibling.innerHTML = "Successfull update";
            // reset form
            passwordForm.reset();
            oldPasswordInput.nextElementSibling.innerHTML = "";
            newPasswordInput.nextElementSibling.innerHTML = "";
            newPasswordConfirmInput.nextElementSibling.innerHTML = "";
          } else if (response === "incorrect") {
            oldPasswordInput.nextElementSibling.innerHTML = "Invalid password";
            oldPasswordInput.style.borderColor = "red";
            oldPasswordInput.style.backgroundColor = "#fde2e2";
          }
        })
        .catch((error) => console.log(error));
    }
  });
});
