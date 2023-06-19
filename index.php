<?php
include('./assets/php/connect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Support</title>
</head>
<body>
    <h1>Contact form</h1>
    <form id="AddData" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <div class="form-group">
            <label for="name">Name :</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
            <span class="error"><?php echo $nameError; ?></span>
        </div>
        <br>
        <div class="form-group">
            <label for="firstname">Firstname :</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>" required>
            <span class="error"><?php echo $firstnameError; ?></span>
        </div>
        <br>
        <div class="form-group">
            <label for="addressEmail">Address e-mail :</label>
            <input type="text" id="addressEmail" name="addressEmail" value="<?php echo $addressEmail; ?>" required>
            <span class="error"><?php echo $addressEmailError; ?></span>
        </div>
        <br>

    </form>
</body>
</html>