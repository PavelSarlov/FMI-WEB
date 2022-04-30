window.onload = () => {
    let url = window.location.href.split('/');

    (() => {
        fetch("../../backend/api/auth.php", { 'method': "GET" })
            .then(resp => resp.json())
            .then(msg => {
                if (msg.statusCode == 302) {
                    window.location.assign("../products/products.html");
                }
            });
    })();

    (() => {
        console.log(document.cookie);
    })();

    if (url[url.length-1].match(/registration/gu)) {
        document.getElementsByTagName("form")[0].addEventListener("submit", (event) => {
            event.preventDefault();

            let email = document.getElementById("email");
            let password = document.getElementById("password");
            let confirmPassword = document.getElementById("confirm-password");

            if (password.value !== confirmPassword.value) {
                alert("Passwords must match");
                return;
            }

            fetch("../../backend/api/register.php", {
                method: 'POST',
                headers: {
                    "Content-Type": 'application/json'
                },
                body: JSON.stringify({
                    email: email.value,
                    password: password.value
                })
            })
                .then(resp => resp.json())
                .then(msg => {
                    if (msg.statusCode >= 200 && msg.statusCode < 300) {
                        window.location.assign("./login.html");
                    }
                    else {
                        alert(msg.message);
                    }
                });
        });

        password.addEventListener("input", (_event) => {
            var lower = /[a-z]/gu;
            var upper = /[A-Z]/gu;
            var digit = /\d/gu;
            var length = 8;
            var passUpper = document.getElementById("password-upper");
            var passLower = document.getElementById("password-lower");
            var passDigit = document.getElementById("password-digit");
            var passLength = document.getElementById("password-length");

            if(password.value.match(lower)) {
                passLower.classList.remove("invalid");
                passLower.classList.add("valid");
            }
            else {
                passLower.classList.remove("valid");
                passLower.classList.add("invalid");
            }

            if(password.value.match(upper)) {
                passUpper.classList.remove("invalid");
                passUpper.classList.add("valid");
            }
            else {
                passUpper.classList.remove("valid");
                passUpper.classList.add("invalid");
            }

            if(password.value.match(digit)) {
                passDigit.classList.remove("invalid");
                passDigit.classList.add("valid");
            }
            else {
                passDigit.classList.remove("valid");
                passDigit.classList.add("invalid");
            }

            if(password.value.length >= length) {
                passLength.classList.remove("invalid");
                passLength.classList.add("valid");
            }
            else {
                passLength.classList.remove("valid");
                passLength.classList.add("invalid");
            }
        });

        document.getElementById("password").addEventListener("focusin", (_event) => {
            document.getElementById("password-msg").style.visibility = 'visible';
        });

        document.getElementById("password").addEventListener("focusout", (_event) => {
            document.getElementById("password-msg").style.visibility = 'hidden';
        });
    }
    else {
        document.getElementsByTagName("form")[0].addEventListener("submit", (event) => {
            event.preventDefault();

            let email = document.getElementById("email");
            let password = document.getElementById("password");

            fetch("../../backend/api/login.php", {
                method: 'POST',
                headers: {
                    "Content-Type": 'application/json'
                },
                body: JSON.stringify({
                    email: email.value,
                    password: password.value
                })
            })
                .then(resp => resp.json())
                .then(msg => {
                    if (msg.statusCode == 302) {
                        window.location.assign("../products/products.html");
                    }
                    else {
                        alert(msg.message);
                    }
                });
        });
    }
};
