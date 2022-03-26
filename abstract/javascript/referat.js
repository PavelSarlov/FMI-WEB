window.onload = () => {
    document.body.onscroll = handlePageScroll;

    function handlePageScroll() {
        if (scrolledFarEnough(0)) {
            document.getElementById("to-top-btn").style.visibility = "visible";
        }
        else {
            document.getElementById("to-top-btn").style.visibility = "hidden";
        }

        stickyHeaders();
    }

    function scrolledFarEnough(scrollDist) {
        return document.body.scrollTop > scrollDist || document.documentElement.scrollTop > scrollDist;
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
