<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up / Register</title>

    <link href="/uikit/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/uikit/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/uikit/css/ruang-admin.min.css" rel="stylesheet">
    <link href="/uikit/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/custom-font-size.css">

    <style>
        /* Add some background colors for visualization */
        .password-message {
                                        color: red;
                                        font-size: 0.9em;
                                        margin-top: 5px;
                                    }
                                    .error-messages {
                                        list-style: none;
                                        padding: 0;
                                        margin: 0;
                                    }
                                    .error-messages li {
                                        margin-bottom: 3px;
                                    }
        .right-column {
          background-color: #cd9f8e;
        }
        .full-height {
      height: 100vh;
    }
    /* CSS for eye icon */
.eye-toggle {
    position: absolute;
    right: 10px;
    top: 10px;
    cursor: pointer;
}
      </style>
</head>
<body>

        <div class="row full-height">
          <div class="col-md-6 left-column d-flex justify-content-center align-items-center">
            <img src="/images/navbar1-logo.webp" style="max-width: 75%" alt="">
          </div>
          <div class="col-md-6 right-column">
            <br><br><br><br>
            <div class="row justify-content-center mt-5">
                <div class="col-md-8">
                    <div class="form-group p-3">
                        <h3 class="text-dark">Register</h3>
                        <form action="/register_" method="post">
                            @csrf
                            <input value="{{ old('first_name') }}" type="text" name="first_name"
                                class="mb-2 form-control form-control-lg" placeholder="First Name" required>

                            <input value="{{ old('middle_name') }}" type="text" name="middle_name"
                                class="mb-2 form-control form-control-lg" placeholder="Middle Name" required>

                            <input value="{{ old('last_name') }}" type="text" name="last_name"
                                class="mb-2 form-control form-control-lg" placeholder="Last Name" required>

                            <input value="{{ old('email') }}" type="email" name="email"
                                class="mb-2 form-control form-control-lg" placeholder="Email" required>

                            <input value="{{ old('phone_number') }}" type="text" name="phone_number"
                                class="mb-2 form-control form-control-lg" placeholder="Phone Number: Ex: +639650859745" required>

                            <input value="{{ old('address') }}" type="text" name="address"
                                class="mb-2 form-control form-control-lg" placeholder="Address" required>



                            <select name="relationType" id="" class="form-control form-control-lg mb-2">
                                <option value="" disabled selected>Select relationship</option>
                                <option value="Guardian">Guardian</option>
                                <option value="Parent">Parent</option>
                            </select>


                            <input value="{{ old('username') }}" type="text" name="username"
                                class="mb-2 form-control form-control-lg" placeholder="Username" required>

                                <input value="{{ old('password') }}" type="password" name="password"
                                class="form-control form-control-lg mb-2" placeholder="Password" required
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                title="Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number.">

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const passwordInput = document.querySelector('input[name="password"]');
                                        const message = document.createElement('div');
                                        message.className = 'password-message';
                                        passwordInput.parentNode.insertBefore(message, passwordInput.nextSibling);

                                        passwordInput.addEventListener('input', function() {
                                            const value = passwordInput.value;
                                            const rules = [
                                                { regex: /.{8,}/, message: "At least 8 characters" },
                                                { regex: /[A-Z]/, message: "At least one uppercase letter" },
                                                { regex: /[a-z]/, message: "At least one lowercase letter" },
                                                { regex: /\d/, message: "At least one number" }
                                            ];

                                            const errors = rules.filter(rule => !rule.regex.test(value)).map(rule => rule.message);

                                            if (errors.length > 0) {
                                                message.innerHTML = `<ul class="error-messages">${errors.map(error => `<li>${error}</li>`).join('')}</ul>`;
                                                passwordInput.setCustomValidity("Password does not meet the requirements");
                                            } else {
                                                message.innerHTML = '';
                                                passwordInput.setCustomValidity('');
                                            }
                                        });
                                    });
                                </script>



                            <input value="{{ old('confirm_password') }}" type="password" name="confirm_password"
                                class="form-control form-control-lg mb-2" placeholder="Confirm Password" required>

                            @if (session('passwords_not_matched'))
                                <div class="alert alert-danger" role="alert">
                                    Passwords do not match
                                </div>
                            @endif
                            @if (session('user_exists'))
                                <div class="alert alert-danger" role="alert">
                                    User Already Exists!
                                </div>
                            @endif
                            @if (session('email_exists'))
                                <div class="alert alert-danger" role="alert">
                                    Email Has Already Taken!
                                </div>
                            @endif
                            <button class="btn btn-lg mb-2 btn-secondary btn-block" type="submit">Register</button>
                        </form>

                        <label class="text-dark" for="">Already have an account? <a href="/login_parent">Login Here</a></label>
                        <div class="mt-3"></div>
                        <a href="/">Go Back</a>
                    </div>
                </div>
            </div>
          </div>
        </div>

<script>1
    document.querySelectorAll('.eye-toggle').forEach(function(icon) {
        icon.addEventListener('click', function() {
            const passwordField = document.querySelector(this.getAttribute('toggle'));
            if (passwordField.getAttribute('type') === 'password') {
                passwordField.setAttribute('type', 'text');
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                passwordField.setAttribute('type', 'password');
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });</script>
</body>
</html>
