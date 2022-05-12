
export function redirectTo(to) {
    window.location.replace(to);
}

export function mapButtons() {
    document.getElementById("btn-logout").addEventListener("click", (event) => {
        fetch("../../backend/api/logout.php")
            .then(() => redirectTo("../auth/login.html"));
    });

    document.getElementById("btn-admin-panel").addEventListener("click", (event) => {
        redirectTo("../admin/admin-panel.html");
    });
}

window.onload = () => {
    mapButtons();

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

    (() => {
        fetch("../../backend/api/authenticate.php")
            .then(resp => resp.json())
            .then(msg => {
                if (msg.statusCode == 302) {
                    getProducts(msg.message);
                }
                else if (msg.statusCode == 401) {
                    redirectTo("../auth/login.html");
                }
            });
    })();

};
