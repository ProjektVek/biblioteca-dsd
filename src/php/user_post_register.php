</form>
<?php
include "users_crud.php";

function returnToRegister($message)
{
    if ($message == "success") {
        echo "<script>window.location='/src/new_user.php?message=success'</script>";
    } else {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $type = $_POST['type'];

        echo <<<END
            <form id="userinfo" action="/src/new_user.php?message=$message" method="post">
                <input type="hidden" id="username" name="username" value="$username" >
                <input type="hidden" id="name" name="name" value="$name" >
                <input type="hidden" id="type" name="type" value="$type" > 
            </form>
            <script>document.getElementById('userinfo').submit()</script>
            END;
    }
}

if (strlen($_POST['username']) < 2) {

    returnToRegister('min-login-size');

} else if (strlen($_POST['username']) > 50) {

    returnToRegister('max-login-size');

} else if (strlen($_POST['name']) < 2) {

    returnToRegister('min-name-size');

} else if (strlen($_POST['name']) > 50) {

    returnToRegister('max-name-size');

} else if (strlen($_POST['password']) < 8) {

    returnToRegister('min-password-size');

} else if (strlen($_POST['password']) > 50) {

    returnToRegister('max-password-size');

} else if (doUserExist($_POST['username'])) {

    returnToRegister('duplicated');

} else if ($_POST['password'] != $_POST['passwordConfirmation']) {

    returnToRegister('unmatched');

}

$registerResult = registerUser($_POST['username'], $_POST['name'], $_POST['password'], $_POST['type']);

if ($registerResult) {

    returnToRegister('success');

} else {

    returnToRegister('server-error');

}
?>