<?php
if (empty(session_id())) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../../webroot/css/style.css" rel="stylesheet">
    <title>Pie PHP</title>
</head>

<body>
    <div>
        <p>Welcome to your profile !</p>
        <p>Your mail : <?php echo $_SESSION['email'] ?></p>
        <p>Wanna change your informations? Please fill the form</p>

        <form action="home" method="POST">
            <label for="new_email">New email : </label>
            <input type="email" id="new_email" name="new_email"><br>
            <label for="curr_password">Current password : </label>
            <input type="password" id="curr_password" name="curr_password"><br>
            <label for="new_password">New password : </label>
            <input type="password" id="new_password" name="new_password"><br>
            <input type="submit" value="Change !">
        </form>
    </div>
</body>

</html>