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

    (() => {
        fetch("../../backend/api/auth.php", { 'method': "GET" })
            .then(resp => resp.json())
            .then(msg => {
                if (msg.statusCode == 302) {
                    getProducts(msg.message);
                }
                else if (msg.statusCode == 401) {
                    window.location.href = "../auth/login.html";
                }
            });
    })();
};
