<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Kantumruy+Pro:wght@300&family=Lato:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="container-login100">

        <div class="wrap-login100">
            <div class="login100-pic">
                <img src="img/batangascitylogo.png" alt="IMG">
            </div>

            <form class="login100-form" id="reset-form">
                <span class="login100-form-title text-wrap">
                    Reset Password
                </span>
                <div class="wrap-input100">
                    <input class="input100 is-invalid" type="text" id="userEmail" name="userEmail" placeholder="Code" autocomplete>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa-solid fa-hashtag"></i>
                </div>
                <div class="wrap-input100">
                    <input class="input100 is-invalid" type="text" id="userEmail" name="userEmail" placeholder="New Password" autocomplete>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                </div>
                <div class="container-login100-form-btn">
                    <button type="submit" name="login-submit" class="login100-form-btn">
                        <span class="submit-text">Reset</span>
                    </button>
                    <!-- <span id="loading"></span> -->

                </div>
                <div class="pt-3 float-end"><a href="login.php"><i class="fa-solid fa-arrow-left"></i> Go back to login page</a></div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="scripts/mdb.min.js"></script>
    <script src="scripts/sweetalert2.all.min.js"></script>

</body>

</html>