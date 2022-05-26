window.onload = async () => {
    let users = await fetch('https://jsonplaceholder.typicode.com/users')
        .then(resp => resp.json());

    function removeAlerts() {
        document.querySelectorAll(".alert").forEach(e => e.parentNode.removeChild(e));
    }

    function popAlert(success, msg, parent) {
        let alert = document.createElement("div");
        alert.textContent = msg;
        alert.classList.add("alert");
        alert.classList.add((success ? "success" : "error"));

        if (success) {
            let a = document.createElement("a");
            a.href = "https://www.youtube.com/watch?v=dQw4w9WgXcQ";
            a.innerHTML = "Вход";
            alert.appendChild(a);
            alert.id = "success";
        }

        parent.append(alert);
    }

    let form = document.getElementById("registration-form");

    form.addEventListener("submit", (event) => {
        event.preventDefault();

        removeAlerts();

        let errors = [];

        let username = document.getElementById("username");
        let firstName = document.getElementById("name");
        let familyName = document.getElementById("family-name");
        let email = document.getElementById("email");
        let password = document.getElementById("password");
        let postalCode = document.getElementById("postal-code");

        if (!username.value.match(/^\w{3,10}$/)) {
            errors.push(['Невалидно потребителско име. Трябва да съдържа между 3 и 10 символа включително.', username.parentNode]);
        }
        if (!password.value.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[\da-zA-Z]{6,10}$/)) {
            errors.push(['Невалидна парола. Трябва да съдържа между 6 и 10 символа включително, малка буква, главна буква и цифра.', password.parentNode]);
        }
        if (!email.value.match(/^(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/)) {
            errors.push(['Невалиден e-mail. Трябва да отговаря на общоприетия формат RFC 5322.', email.parentNode]);
        }
        if (!firstName.value.match(/^\w{1,50}$/)) {
            errors.push(['Невалидно име. Трябва да съдържа до 50 символа.', firstName.parentNode]);
        }
        if (!familyName.value.match(/^\w{1,50}$/)) {
            errors.push(['Невалидна фамилно име. Трябва да съдържа до 50 символа.', familyName.parentNode]);
        }
        if (!postalCode.value.match(/^((\d{5}-)?\d{4})?$/)) {
            errors.push(['Невалиден пощенски код. Трябва да е във формат 1111 или 11111-1111 и да съдържа само цифри.', postalCode.parentNode]);
        }

        if (errors.length != 0) {
            errors.forEach(e => {
                popAlert(false, e[0], e[1])
            });
        }
        else {
            for (let user of users) {
                if (user.username == username.value) {
                    popAlert(false, `Вече съществува потребител с потребителско име ${username.value}.`, form);
                    return;
                }
            }
            popAlert(true, "Регистрацията успешна. ", form);
        }
    });
};
