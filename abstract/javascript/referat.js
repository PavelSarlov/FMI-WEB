window.onload = () => {
    document.body.onscroll = handlePageScroll;
    populateTOC();
    populatePatternsList();

    document.getElementById("view-switch").addEventListener("change", (event) => {
        let ss = document.getElementById("dark-mode-css");
        let hss = document.getElementById("dark-highlight-css");
        if (event.target.checked) {
            ss.disabled = false;
            hss.disabled = false;
        }
        else {
            ss.disabled = true;
            hss.disabled = true;
        }
    });

    document.getElementById("toc-indicator").addEventListener("click", (event) => {
        let container = document.getElementById("toc-container");
        let indic = document.getElementById("toc-indicator");

        if (indic.innerHTML == "&gt;&gt;") {
            indic.innerHTML = "&lt;&lt;";
            container.style.transform = "translateY(-50%)"; 
        }
        else {
            console.log(indic.innerHTML);
            indic.innerHTML = "&gt;&gt;";
            container.style.transform = "translateY(-50%) translateX(-92%)"; 
        }
    });

    function handlePageScroll() {
        if (scrolledFarEnough(0)) {
            document.getElementById("to-top-btn").style.visibility = "visible";
        }
        else {
            document.getElementById("to-top-btn").style.visibility = "hidden";
        }
    }

    function scrolledFarEnough(scrollDist) {
        return document.body.scrollTop > scrollDist || document.documentElement.scrollTop > scrollDist;
    }

    function createTocLink(href, className, innerHTML) {
        let link = document.createElement("a");
        link.href = href;
        link.className = className;
        link.innerHTML = innerHTML;
        return link;
    }

    function populatePatternsList() {
        let pl = document.getElementById("patterns-list");
        const headers = Array.from(document.querySelectorAll("h1.pattern"));

        headers.forEach(h => {
            let li = document.createElement("li");
            li.appendChild(createTocLink("#" + h.id, "", h.innerHTML));
            pl.appendChild(li);
        });
    }

    function populateTOC() {
        let toc = document.getElementById("toc");
        const headers = document.querySelectorAll("h1");

        for (let header of headers) {
            const link = createTocLink("#" + header.id, "toc-h1 nav-btn", header.innerHTML);
            const subheaders = document.querySelectorAll("#" + header.id + " ~ section h2");

            if (subheaders.length > 0) {
                let headerDropdown = document.createElement("div");
                headerDropdown.className = "dropdown-toggle";

                let fieldWrapper = document.createElement("div");
                fieldWrapper.className = "dropdown-field-wrapper";
                
                let dropBtn = document.createElement("button");
                dropBtn.className = "dropdown-btn-toggle nav-btn toc-h1";
                dropBtn.innerHTML = "▼";
                dropBtn.addEventListener("click", event => {
                    let el = event.target.parentElement.nextElementSibling;
                    el.style.fontSize = (el.style.fontSize != "1vmax" ? "1vmax" : "0vmax");
                    event.target.innerHTML = (event.target.innerHTML != "▲" ? "▲" : "▼");
                });

                let dropdownContents = document.createElement("div");
                dropdownContents.className = "dropdown-contents";

                for (let subheader of subheaders) {
                    dropdownContents.appendChild(createTocLink("#" + subheader.id, "toc-h2 nav-btn", subheader.innerHTML));
                }

                toc.appendChild(headerDropdown);
                fieldWrapper.appendChild(link);
                fieldWrapper.appendChild(dropBtn);
                headerDropdown.appendChild(fieldWrapper);
                headerDropdown.appendChild(dropdownContents);
            }
            else {
                toc.appendChild(link);
            }
        }
    }

    Array.from(document.getElementsByClassName("copy-to-clipboard"))
        .forEach(e => {
            e.addEventListener("click", () => {
                navigator.clipboard.writeText(e.nextElementSibling.textContent);
                e.innerHTML = "Copied!";
            });
        });
}
