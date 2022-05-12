window.onload = () => {
    let prodList = document.getElementById("product-list");

    let getProducts = (user) => {
        fetch("../../backend/api/products.php", { 'method': "GET" })
            .then(resp => resp.json())
            .then(msg => {
                if (msg.statusCode == 302) {
                    for(let prod of msg.message) {
                        let li = document.createElement("li");
                        li.innerHTML = prod.name;
                        prodList.appendChild(li)
                    }
                }
            });
    };

    let redirectToLogin = () => window.location.replace("../auth/login.html");

    (() => {
        fetch("../../backend/api/authenticate.php")
            .then(resp => resp.json())
            .then(msg => {
                if (msg.statusCode == 302) {
                    getProducts(msg.message);
                }
                else if (msg.statusCode == 401) {
                    redirectToLogin();
                }
            });
    })();

    document.getElementById("btn-logout").addEventListener("click", (event) => {
        fetch("../../backend/api/logout.php")
            .then(() => redirectToLogin());
    });

    document.getElementById("btn-admin-panel").addEventListener("click", (event) => {
    });
};
