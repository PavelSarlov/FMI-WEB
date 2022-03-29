window.onload = () => {
    document.body.onscroll = handlePageScroll;
    populateTOC();

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

    function populateTOC() {
        let toc = document.getElementById("toc");
        const headers = document.querySelectorAll("h1");

        function createTocLink(href, className, innerHTML) {
            let link = document.createElement("a");
            link.href = href;
            link.className = className;
            link.innerHTML = innerHTML;
            return link;
        }

        for (let header of headers) {
            const link = createTocLink("#" + header.id, "toc-h1 nav-btn", header.innerHTML);
            const subheaders = document.querySelectorAll("#" + header.id + " ~ section h2");

            if (subheaders.length > 0) {
                let headerDropdown = document.createElement("div");
                headerDropdown.className = "dropdown-toggle";
                
                let dropBtn = document.createElement("button");
                dropBtn.className = "dropdown-btn-toggle nav-btn toc-h1";
                dropBtn.innerHTML = "▼";
                dropBtn.addEventListener("click", event => {
                    let el = event.target.nextSibling;
                    el.style.fontSize = (el.style.fontSize != "1vmax" ? "1vmax" : "0vmax");
                    event.target.innerHTML = (event.target.innerHTML != "▲" ? "▲" : "▼");
                });

                let dropdownContents = document.createElement("div");
                dropdownContents.className = "dropdown-contents";

                for (let subheader of subheaders) {
                    dropdownContents.appendChild(createTocLink("#" + subheader.id, "toc-h2 nav-btn", subheader.innerHTML));
                }

                toc.appendChild(headerDropdown);
                headerDropdown.appendChild(link);
                headerDropdown.appendChild(dropBtn);
                headerDropdown.appendChild(dropdownContents);
            }
            else {
                toc.appendChild(link);
            }
        }
    }

    // function isInViewPort(element) {
    //     const height = element.offsetHeight;
    //     const width = element.offsetWidth;
    //     const rect = element.getBoundingClientRect();
    //     return (
    //         rect.top >= -height &&
    //         rect.left >= -width &&
    //         rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) + height &&
    //         rect.right <= (window.innerHeigth || document.documentElement.clientWidth) + width
    //     );
    // }
}
