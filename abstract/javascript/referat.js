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
        const headers = document.querySelectorAll(".header-article");

        for (let header of headers) {
            let field = document.createElement("a");
            field.href = "#" + header.id;
            field.className = "toc-header nav-btn";
            field.innerHTML = header.innerHTML;
            toc.appendChild(field);

            const subheaders = document.querySelectorAll("#" + header.id + " ~ section h2.subheader");
            
            for (let subheader of subheaders) {
                let field = document.createElement("a");
                field.href = "#" + subheader.id;
                field.className = "toc-subheader nav-btn";
                field.innerHTML = subheader.innerHTML;
                toc.appendChild(field);
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
