<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Send Mail</title>
    </head>
    <body>
        <form class="" action="send.php" method="POST">
            <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];}  ?>">
            Email <input type="email" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];}  ?>"> <br/>
            New Password <input type="password" name="new_password" value=""> <br/>
            Confirm Password <input type="password" name="confirm_password" value=""> <br/>
            <button type="submit" name="password_update">Change</button>
        </form>
    </body>
</html>