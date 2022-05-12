import * as utils from "../products/script.js";

window.onload = () => {
    utils.mapButtons();

    fetch("../../backend/api/authorize.php")
        .then(resp => resp.json())
        .then(msg => {
            if (msg.statusCode == 403) {
                console.log(msg);
                alert("You have no access to this page");
                utils.redirectTo("../products/products.html");
            }
            else if (msg.statusCode == 401) {
                utils.redirectTo("../auth/login.html");
            }
        });

    fetch("../../backend/api/product_types.php")
        .then(resp => resp.json())
        .then(msg => {
            let opt = document.getElementById("product-type");

            for (let prod of msg.message) {
                let sel = document.createElement("option");
                sel.setAttribute("value", prod.id);
                sel.setAttribute("name", prod.name);
                sel.innerHTML = prod.name;

                opt.appendChild(sel);
            }
        });

    document.getElementById("btn-add-product").addEventListener("click", (event) => {
        event.preventDefault();

        let reqInfo = {
            method: "POST",
            body: JSON.stringify({
                productType: document.getElementById("product-type").value,
                name: document.getElementById("product-name").value
            }),
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            }
        };

        fetch("../../backend/api/products.php", reqInfo)
            .then(resp => resp.json())
            .then(msg => console.log(msg));
    });
};
