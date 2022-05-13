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
            let nav = document.getElementsByTagName("nav")[0];
            if (msg.statusCode == 403) {
                nav.removeChild(document.getElementById("btn-admin-panel"));
            }
            else {
                nav.removeChild(document.getElementById("btn-all-products"));
                nav.removeChild(document.getElementById("btn-user-products"));
            }
        });

    utils.getAllProducts();
};
