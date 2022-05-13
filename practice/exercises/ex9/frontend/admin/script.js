import * as utils from "../utils.js";

window.onload = () => {
    utils.authorize();
    utils.mapButtons();

    document.getElementById("btn-admin-panel").addEventListener("click", () => {
        utils.redirectTo("../admin/admin-panel.html");
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
