export function redirectTo(to) {
    window.location.replace(to);
}

export function authorize() {
    fetch("../../backend/api/authorize.php")
        .then(resp => resp.json())
        .then(msg => {
            if (msg.statusCode == 403) {
                console.log(msg);
                alert("You have no access to this page");
                redirectTo("../products/products.html");
            }
            else if (msg.statusCode == 401) {
                redirectTo("../auth/login.html");
            }
        });
}

export async function getAllProducts() {
    return fetch("../../backend/api/products.php")
        .then(resp => resp.json())
        .then(msg => {
            if (msg.statusCode == 302) {
                return msg.body;
            }
            return null;
        });
}

export function getUserProducts() {
    fetch("../../backend/api/products.php?user=")
        .then(resp => resp.json())
        .then(msg => {
            if (msg.statusCode == 302) {
                for(let prod of msg.body) {
                    let prodList = document.getElementById("product-list");
                    let li = document.createElement("li");
                    li.innerHTML = prod.name;
                    prodList.appendChild(li)
                }
            }
        });
}

export function clearProductsList() {
    let productsList = document.getElementById("product-list");
    let children = productsList.children;

    while(children.length) {
        productsList.removeChild(children[0]);
    }
}


export function mapButtons() {
    document.getElementById("btn-logout").addEventListener("click", (event) => {
        fetch("../../backend/api/logout.php")
            .then(() => redirectTo("../auth/login.html"));
    });
}

export function authenticate() {
    fetch("../../backend/api/authenticate.php")
        .then(resp => resp.json())
        .then(msg => {
            if (msg.statusCode == 401) {
                redirectTo("../auth/login.html");
            }
        });
}

export async function getProductTypes() {
    return fetch("../../backend/api/product_types.php")
        .then(resp => resp.json())
        .then(msg => {
            if (msg.statusCode >= 200 && msg.statusCode < 400) {
                return msg.body;
            }
            return null;
        });
}
