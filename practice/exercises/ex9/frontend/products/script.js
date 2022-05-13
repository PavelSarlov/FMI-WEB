import * as utils from "../utils.js";

window.onload = () => {
    utils.authenticate();
    utils.mapButtons();

    document.getElementById("btn-user-products").addEventListener("click", () => {
        utils.clearProductsList();
        utils.getUserProducts();
    });

    document.getElementById("btn-all-products").addEventListener("click", () => {
        utils.clearProductsList();
        utils.getAllProducts();
    });

    fetch("../../backend/api/authorize.php")
        .then(resp => resp.json())
        .then(msg => {
            if (msg.statusCode == 200) {
                utils.redirectTo("../admin/admin-panel.html");
            }
        });

    (async () => {
        let products = await utils.getAllProducts();
        let productTypes = await (async () => {
            let types = new Map();
            (await utils.getProductTypes()).forEach(t => {
                types.set(t.id, t.name);
            });
            return types;
        })();

        for (let prod of products) {
            let prodTable = document.getElementById("product-list");
            let tr = document.createElement("tr");
            Object.keys(prod).forEach((k) => {
                if (k=="id") return;
                let td = document.createElement("td");
                td.textContent = (k=='type' ? productTypes.get(prod[k]) : prod[k]);
                tr.appendChild(td);
            });
            tr.classList.add("product-item");
            tr.id = prod.id;
            // tr.addEventListener("click", );
            prodTable.appendChild(tr)
        }
    })();
};
