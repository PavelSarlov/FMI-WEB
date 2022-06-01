window.onload = () => {
    utils.authorize();

    let hidePanel = (panel) => {
        form.style.display = "none";
    }

    let showPanel = (panel) => {
        form.style.display = "flex";
    }
};
