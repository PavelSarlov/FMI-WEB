(window.onload = () => {
    let url = '/practice/ex6/';
    let form = document.getElementById("registration-form");

    form.addEventListener("submit", (event) => {
        event.preventDefault();

        fetch("../backend/index.php", {
            method: 'POST',
            headers: {
                "Content-Type": 'application/json'
            },
            body: JSON.stringify({
                username: document.getElementById("username").value,
                password: document.getElementById("password").value
            })
        })
        .then(resp => resp.json())
        .then(msg => {
            if (msg.success) {
                window.location.assign(url + "frontend/products.html");
            }
            else {
                alert(msg.errors);
            }
        });
    });
})();
