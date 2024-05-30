document.addEventListener("DOMContentLoaded", function () {
    var contactForm = document.getElementById("contactForm");
    var signupResponse = document.getElementById("signupResponse");

    contactForm.addEventListener("submit", function (event) {
        event.preventDefault();

        var formData = new FormData(contactForm);
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var destination = document.getElementById("destination").value;

        formData.append("name", name);
        formData.append("email", email);
        formData.append("destination", destination);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "contact.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    signupResponse.innerHTML = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Your message has been sent. </strong></div>";
                    contactForm.reset();
                } else {
                    signupResponse.innerHTML = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Sorry " + name + ", it seems that our mail server is not responding. Please try again later!</strong></div>";
                    contactForm.reset();
                }
            }
        };
        xhr.onerror = function () {
            signupResponse.innerHTML = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Sorry " + name + ", it seems that our mail server is not responding. Please try again later!</strong></div>";
            contactForm.reset();
        };

        xhr.send(formData);

        return false; // Prevents the default form submission behavior
    });
});
