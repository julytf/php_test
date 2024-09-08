<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container min-vh-100">
        <div class="row">
            <div class="col-md-8 mt-5 p-5 text-primary">
                <div class="d-flex justify-content-between">
                    <h4>Send Us a Message</h4>
                    <span>
                        <i class="bi bi-envelope fs-1"></i>
                    </span>
                </div>
                <form id="contact-form" action="/thankyou.php" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input name="name" type="text" class="form-control fw-medium" id="name" placeholder="Enter your name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input name="email" type="email" class="form-control fw-medium" id="email"
                                placeholder="Enter your email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input name="phone" type="text" class="form-control fw-medium" id="phone" placeholder="Enter phone">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="company" class="form-label">Company</label>
                            <input name="company" type="company" class="form-control fw-medium" id="company"
                                placeholder="Enter company">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message</label>
                        <textarea name="message" class="form-control fw-medium" id="message" rows="4"
                            placeholder="Enter your message"></textarea>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>

            <div class="col-md-4 bg-primary text-white p-5 mt-5 d-flex flex-column justify-content-between">
                <h4>Contact Information</h4>
                <div class="d-flex flex-column gap-4">
                    <div class="d-flex gap-2">
                        <span class="mr-2 opacity-75">
                            <i class="bi bi-geo-alt"></i>
                        </span>
                        <span>
                            360 King Street, Lorem ipsum dolor sit amet
                        </span>
                    </div>
                    <div class="d-flex gap-2">
                        <span class="mr-2 opacity-75">
                            <i class="bi bi-phone-vibrate"></i>
                        </span>
                        +1 234 567 890
                    </div>
                    <div class="d-flex gap-2">
                        <span class="mr-2 opacity-75">
                            <i class="bi bi-envelope-open"></i>
                        </span>
                        email@domain.com
                    </div>
                </div>
                <div class="fs-3 d-flex gap-4 opacity-75">
                    <i class="bi bi-twitter"></i>
                    <i class="bi bi-linkedin"></i>
                    <i class="bi bi-instagram"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content rounded-0">
                <div class="modal-body d-flex flex-column text-center">
                    <h2>Face-plant!</h2>
                    <p class="fs-4 text-body-secondary">Ooops, something when wrong.</p>
                    <span class="text-danger fw-light my-4" style="font-size: 8rem;">
                        <i class="bi bi-x-circle"></i>
                    </span>
                    <button type="button" class="btn btn-secondary mx-4 rounded-pill bg-danger"
                        data-bs-dismiss="modal">Try again</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        // https://stackoverflow.com/a/46181/25119178
        const emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        // https://anonystick.com/blog-developer/regex-so-dien-thoai-viet-nam-2022080844903653
        const phoneRegex = /(84|0[3|5|7|8|9])+([0-9]{8})\b/;

        const modal = new bootstrap.Modal('#modal')

        document.getElementById('contact-form').addEventListener('submit', function (event) {
            event.preventDefault();

            if (!validateForm(event.target)) {
                modal.show();
                return
            }

            this.submit();
        });

        function validateForm(form) {
            if (
                !validateRequired('name')
                || !validateRequired('email')
                || !validateEmail('email')
                || !validateRequired('phone')
                || !validatePhone('phone')
                || !validateRequired('company')
                || !validateRequired('message')
            ) {
                return false;
            }

            return true;
        }

        function validateRequired(name) {
            const inputEl = document.getElementById(name)
            const value = inputEl?.value
            if (!value) {
                inputEl.classList.add('error')
                return false;
            }
            inputEl.classList.remove('error')
            return true;
        }

        function validateEmail(name) {
            const inputEl = document.getElementById(name)
            const value = inputEl?.value
            if (!emailRegex.test(value)) {
                inputEl.classList.add('error')
                return false;
            }
            inputEl.classList.remove('error')
            return true;
        }

        function validatePhone(name) {
            const inputEl = document.getElementById(name)
            const value = inputEl?.value
            if (!phoneRegex.test(value)) {
                inputEl.classList.add('error')
                return false;
            }
            inputEl.classList.remove('error')
            return true;
        }

    </script>
</body>

</html>