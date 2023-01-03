function s() {
  let pass = document.getElementById("pass").value;
  let pass2 = document.getElementById("pass2").value;
  var user = document.sign.user;
  var first_name = document.sign.first_name;
  var last_name = document.sign.last_name;
  if (allLetters(first_name)) {
    if (allLetters(last_name)) {
      if (pass_validation(pass)) {
        if (pass2_validation(pass, pass2)) {
          if (user_validation(user)) {
            alert("signup successfull");
            document.getElementById("sign").action = "signup.php";
          }
        }
      }
    }
  }
}

function pass_validation(pass) {
  var p = pass.length;

  if (p <= 7) {
    alert("minimum length for password is 8");

    return false;
  } else {
    return true;
  }
}
function pass2_validation(pass, pass2) {
  if (pass2 == pass) return true;
  else {
    alert("passwords should match");
    return false;
  }
}
function user_validation(user) {
  var mail = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;
  if (user.value.match(mail)) {
    return true;
  } else {
    alert("Enter Valid user Address");
    user.focus();
    return false;
  }
}

function allLetters(name) {
  var letters = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
  if (name.value.match(letters)) {
    return true;
  } else {
    alert("Enter only  Alphabets");
    fname.focus();
    return false;
  }
}
