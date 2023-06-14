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
                    Forgot Password
                </span>
                <div class="wrap-input100">
                    <input class="input100 is-invalid" type="text" id="userEmail" name="userEmail" placeholder="Email" autocomplete>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>

                </div>
                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        <span class="submit-text">Send</span>
                        <span class="spinner-border spinner-border-sm  d-none" aria-hidden="true"></span>
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
    <script>
        $("#reset-form").on("submit", (e) => {
            e.preventDefault();
            let email = $("#userEmail").val();
            let isInvalid = false;
            let emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            const alertMessage = (title, text, icon) => {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: icon,
                    confirmButtonColor: "#20d070",
                    confirmButtonText: "OK",
                    allowOutsideClick: false,
                });
            };
            const resetBtnLoadingState = () => {
                $('button[type="submit"]').prop("disabled", false);
                $(".submit-text").text("Send");
                $(".spinner-border").addClass("d-none");
            };
            if (!email) {
                $('#userEmail').css('border', '1px solid #c80000');
                isInvalid = true;
            } else if (emailVali.test(email) == false) {
                alertMessage("Warning", "Invalid email address", "warning")
                $('#userEmail').css('border', '1px solid #c80000');
                isInvalid = true;
            } else {
                $('#userEmail').css('border', 'none');
            }


            if (isInvalid) {
                return false;
            }
            $.ajax({
                url: "include/FetchEmail.php",
                method: "POST",
                data: {
                    sendBtn: '',
                    email: email
                },
                dataType: "json",
                beforeSend: () => {
                    $('button[type="submit"]').prop("disabled", true);
                    $(".submit-text").text("Sending...");
                    $(".spinner-border").removeClass("d-none");
                },
                success: function(response) {
                    if (response.status === "Success") {
                        setTimeout(() => {
                            alertMessage(response.status, response.message, response.icon);
                            resetBtnLoadingState();
                            $('#userEmail').val("");
                        }, 1000);
                    } else {
                        setTimeout(() => {
                            $('#userEmail').val("");
                            resetBtnLoadingState();
                            alertMessage(response.status, response.message, response.icon);
                        }, 1000)
                    }
                },
                error: (xhr, status, error) => {
                    // Handle errors
                    resetBtnLoadingState();
                    alertMessage("Error", xhr.responseText, "error");
                },
            });

        })
    </script>
</body>

</html>