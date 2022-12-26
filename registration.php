<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Sign In/Up Form</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
<?php
if($_COOKIE['user'] == ''): // Если в ассоциативном массиве переданном через HTTP Cookie нету куки с именем user то выводится 2 формы

?>

    <div class="login-box">
        <h2>Registration</h2>
        <form action="validation-form/check.php" method="post">
            <div class="user-box">
                <input type="text" name="login" required="">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="pass" required="">
                <label>Password</label>
            </div>
            <div class="user-box">
                <input type="password" name="repass" required="">
                <label>Confirm password</label>
            </div>
            <button type="submit">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Submit
            </button>
        </form>
        <p style="color: white">Already have an account?</p>
        <a href="/lab_2_egor/login.php" class="not__account">Sign in</a>
    </div>

<?php
else: // если была найдена такая кука то выводится следущее
    header('Location: /lab_2_egor/user.php');
    ?>

<?php
endif;
?>

</body>
