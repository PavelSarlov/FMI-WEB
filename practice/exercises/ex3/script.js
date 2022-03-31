window.onload = () => {
    let list = document.getElementById("result-list");
    let form = document.getElementById("login-form");

    form.addEventListener("submit", (event) => {
        event.preventDefault();
        let listItem = document.createElement("li");
        listItem.innerHTML = document.getElementById("username").value + " " + document.getElementById("password").value;;
        list.appendChild(listItem);
    });
};
