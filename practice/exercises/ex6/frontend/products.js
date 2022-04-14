window.onload = () => {
    let prodList = document.getElementById("result-list");

    fetch("../backend/index.php")
        .then(resp => resp.json())
        .then(msg => {
            for (prod of msg.data) {
                let li = document.createElement("li");
                li.innerHTML = `${prod.id}, ${prod.name}, ${prod.type}`;
                
                prodList.appendChild(li);
            }
        })
}
