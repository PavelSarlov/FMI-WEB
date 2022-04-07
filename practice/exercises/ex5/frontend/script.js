window.onload = () => {
    let list = document.getElementById("result-list");
    let form = document.getElementById("login-form");

    form.addEventListener("submit", (event) => {
        event.preventDefault();
        let listItem = document.createElement("li");

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
            listItem.innerHTML = msg.user;
            list.appendChild(listItem);
        });
    });
};
