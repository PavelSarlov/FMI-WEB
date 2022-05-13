import * as utils from "../utils.js";

window.onload = () => {
    utils.authorize();
    utils.mapButtons();

    let hideForm = (form) => {
        form.style.display = "none";
    }

    let showForm = (form) => {
        form.style.display = "flex";
    }

    document.getElementById("btn-admin-panel").addEventListener("click", () => {
        utils.redirectTo("../admin/admin-panel.html");
    });

    (async () => {
        let productTypes = getProductTypes();

        let opt = document.getElementById("product-type");

        for (let prod of productTypes) {
            let sel = document.createElement("option");
            sel.setAttribute("value", prod.id);
            sel.setAttribute("name", prod.name);
            sel.innerHTML = prod.name;

            opt.appendChild(sel);
        }
    })();

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
    
    let updateTab = (tab) => {
        [...document.getElementsByClassName("tab")].forEach(e => e.classList.remove("tab-selected"));
        tab.classList.add("tab-selected");

        switch(tab.name) {
            case "delete": {
                [...document.getElementsByTagName("form")].forEach(fm => hideForm(fm));
                showForm(document.getElementById("form-delete"));
                let products = getAllProducts();
                
                for (let prod of products) {
                    let li = document.createElement("li");
                }

                break;
            }
            default: {
                [...document.getElementsByTagName("form")].forEach(fm => hideForm(fm));
                showForm(document.getElementById("form-create"));
            }
        }
    }

    updateTab(document.querySelector('.tab-selected'));
    [...document.getElementsByClassName("tab")].forEach(t => t.addEventListener("click", (event) => updateTab(event.target)));
};
