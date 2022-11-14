<!DOCTYPE html>
<html>
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Sales Analysis - 2022</title>
        <!-- CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" />
        <link rel='stylesheet' href='../css/style_pass_reset.css'/>
        <link rel="shortcut icon" href="../img/free-bar-chart-icon-676-thumb.png">

        <!-- JavaScripts -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    </head>
    <body>
        <div class="container-fluid text-light">
        <div class="row">
            <form class="" action="send.php" method="POST">
                <h3>Reset your password</h3>
                <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];}  ?>">
                <div class="mail">
                    <input type="email" name="email" id="email" value="your@email.com">
                </div>
                <div class="new-password">
                    <input type="text" name="new_password" id="new_pass" placeholder="Enter your new password">
                </div>
                <div class="confirm-password">
                    <input type="text" name="confirm_password" id="confirm_pass" placeholder="Confirm your new password">
                </div>
                <br><br>
                <button type="submit" name="send" id="send">Change Password</button>
            </form>
        </div>
    </div>
    </body>
</html>