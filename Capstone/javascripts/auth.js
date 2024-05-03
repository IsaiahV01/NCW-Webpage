var contentDiv = document.getElementById("account");
var signOutBtn = document.getElementById("signOutBtn");

 
    fetch('./php/verifyAuth.php')
    .then(response => response.json())
    .then(function(data) {
        console.log(data);
        if(data.auth) {
            contentDiv.innerHTML = "Welcome Back " + data.username;
            document.getElementById("login").classList.add("hidden");
            document.getElementById("signup").classList.add("hidden");
            document.getElementById("signOutBtn").style.display = "inline-block";
            document.getElementById("signOutBtn").classList.add("revealed");
        }
    });

    signOutBtn.onclick = function() {
        fetch('./php/signout.php')
        .then(function() {
            location.reload();
        });
    }

