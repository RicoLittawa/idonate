<?php
require_once "../../config/config.php";

// Check if the token is provided in the URL
if (isset($_GET["token"])) {
    $token = $_GET["token"];

    // Retrieve the user's stored hashed token and its expiry time from the database based on the provided token
    $stmt = $conn->prepare(
        "SELECT reset_token, reset_token_expiry,email FROM adduser WHERE reset_token = ?"
    );
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Token is invalid or expired
        // Handle the error or redirect the user to an appropriate page
        // For example:
        header("Location: login.php");
        exit();
    }

    $row = $result->fetch_assoc();
    $email = $row["email"];
    $resetTokenExpiry = strtotime($row["reset_token_expiry"]);
    $currentTimestamp = time();

    if ($currentTimestamp > $resetTokenExpiry) {
        // Token is expired
        // Handle the error or redirect the user to an appropriate page
        // For example:
        header("Location: login.php");
        exit();
    }
} else {
    // Token is not provided, redirect the user to an appropriate page
    header("Location: error/SomethingWentWrong.html");
    exit();
}
?>

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
            <div id="form-container">
            <form class="login100-form" id="reset-form">
                <span class="login100-form-title text-wrap fs-2">
                    Reset Password
                </span>
                <div class="wrap-input100">
                    <input type="hidden"  id="email" value="<?php echo htmlentities($email) ?>">
                    <input class="input100 is-invalid" type="text" maxlength="6" id="code" name="code" placeholder="Code" autocomplete>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa-solid fa-hashtag"></i>
                </div>
                <div class="wrap-input100">
                    <input class="input100 is-invalid" type="password" id="newpass" name="newpass" placeholder="New Password" autocomplete>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                </div>
                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        <span class="submit-text">Reset</span>
                        <span class="spinner-border spinner-border-sm  d-none" aria-hidden="true"></span>
                    </button>
                    <!-- <span id="loading"></span> -->
                </div>
                <div class="pt-3 float-end"><a href="login.php"><i class="fa-solid fa-arrow-left"></i> Go back to login page</a></div>
            </form>    
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="scripts/mdb.min.js"></script>
    <script src="scripts/sweetalert2.all.min.js"></script>

    <script>
        $("#reset-form").submit((e) => {
            e.preventDefault();
            let token = $("#code").val();
            let email = $("#email").val();
            let newPassword = $("#newpass").val();
            let isInvalid = false;
            const successMessage = (response,note) => {
                let html = `
            <div class="note100-form note ${response !== "Success" ? "note-danger" : "note-success"}">
            <strong>${response}!</strong> ${note}
            <div class="pt-5 float-end"><a href="login.php"><i class="fa-solid fa-arrow-left"></i> Go back to login page</a></div>
            </div>
              `;
                return html;
            }
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
                $(".submit-text").text("Reset");
                $(".spinner-border").addClass("d-none");
            };
            if (!token) {
                $('#code').css('border', '1px solid #c80000');
                isInvalid = true;
            } else if (!/^[0-9]+$/.test(token)) {
                $('#code').css('border', '1px solid #c80000');
                isInvalid = true;
            } else {
                $('#code').css('border', 'none');
            }
            if (!newPassword) {
                $('#newpass').css('border', '1px solid #c80000');
                isInvalid = true;
            } else {
                $('#newpass').css('border', 'none');
            }

            let data = {
                resetBtn: "",
                token: token,
                email:email,
                newPassword: newPassword
            }
            if (isInvalid) {
                return false;
            }
            $.ajax({
                url: "include/forgotpass.php",
                method: "POST",
                data: data,
                dataType: "json",
                beforeSend: () => {
                    $('button[type="submit"]').prop("disabled", true);
                    $(".submit-text").text("Resetting...");
                    $(".spinner-border").removeClass("d-none");
                },
                success: (response) => {
                    if (response.status === "Success") {
                        setTimeout(() => {
                            $("#form-container").html(successMessage(response.status,response.message)) 
                            resetBtnLoadingState();
                            $('#code').val("");
                            $('#newpass').val("");
                        }, 1000);
                    } else {
                        setTimeout(() => {
                            $('#code').val("");
                            $('#newpass').val("");
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