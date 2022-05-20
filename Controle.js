function test() {
  var mail = document.getElementById("mail");
  if (
    mail.value.indexOf("@") != "-1" &&
    mail.value.indexOf(".") != "-1" &&
    mail.value.indexOf("@") < mail.value.indexOf(".") &&
    mail.value.length <= 50
  ) {
    ch1 = mail.value.substring(0, mail.value.indexOf("@"));
    ch2 = mail.value.substring(
      mail.value.indexOf("@") + 1,
      mail.value.indexOf(".")
    );
    ch3 = mail.value.substring(mail.value.indexOf(".") + 1);
    console.log(ch1);
    console.log(ch2);
    console.log(ch3);
    if (
      !(
        alnum(ch1) &&
        alnum(ch2) &&
        ch1.length >= 3 &&
        ch2.length >= 3 &&
        ch3.length >= 2 &&
        ch3.length <= 4
      )
    ) {
      alert("verifier le mail1");
      return false;
    }
  } else {
    alert("verifier le mail2");
    return false;
  }
  var mdp = document.getElementById("mdp");
  if (
    mdp.value.length != 6 ||
    mdp.value == mdp.value.toLocaleLowerCase() ||
    mdp.value == mdp.value.toUpperCase() ||
    numeric(mdp.value) == false
  ) {
    alert("verifier mdp");
    return false;
  }
  if (document.getElementById("Genre").value == "0") {
    alert("verifier genre");
    return false;
  }
  if (ck("#A") == false || ck("#B") == false || ck("#C") == false) {
    alert("repondre aux questions");
    return false;
  }
}
function alnum(ch) {
  return /^[a-zA-Z0-9]+$/.test(ch);
}
function numeric(ch) {
  for (i = 0; i < ch.length; i++) {
    if (isNaN(ch[i]) == false) {
      return true;
    }
  }
  return false;
}
function ck(id) {
  q = document.querySelectorAll(id);
  if (q[0].checked || q[1].checked || q[2].checked) {
    return true;
  }
  return false;
}
