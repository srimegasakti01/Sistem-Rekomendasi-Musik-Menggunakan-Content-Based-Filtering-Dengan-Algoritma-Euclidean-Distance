var btnLogin = document.getElementById('do-login');
var idLogin = document.getElementById('in-login');
var username = document.getElementById('username');
btnLogin.onclick = function(){
  idLogin.innerHTML = '<p>Welcome to Music RUNGO, </p><h1>' +username.value+ '</h1>';
}