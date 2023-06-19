<?php
include('./assets/php/connect.php');

$nameError = $firstnameError = $addressEmailError = $confirmAddressEmailError = $concernsError = $descriptionError = $fileError = '';

$name = $firstname = $addressEmail = $confirmAddressEmail = $concerns = $description = '';

function checkData($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Contact Support</title>
</head>
<body>
    <header>
    <h1>Contact form</h1>
    </header>

    <form id="AddData" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">

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
            <input type="email" id="addressEmail" name="addressEmail" value="<?php echo $addressEmail; ?>" required>
            <span class="error"><?php echo $addressEmailError; ?></span>
        </div>
        <br>
        <div class="form-group">
            <label for="confirmAddressEmail">confirmAddressEmail :</label>
            <input type="email" id="confirmAddressEmail" name="confirmAddressEmail" value="<?php echo $confirmAddressEmail; ?>" required>
            <span class="error"><?php echo $confirmAddressEmailError; ?></span>
        </div>
        <br>
        <div class="form-group">
            <label for="concerns">Concerns :</label>
            <select id="concerns" name="concerns" required>
                <option value="">Select Concern</option>
                <option value="after-sales-service" <?php if ($concerns === 'after-sales-service') echo 'selected'; ?>>After-sales service</option>
                <option value="billing" <?php if ($concerns === 'billing') echo 'selected'; ?>>Billing</option>
                <option value="others" <?php if ($concerns === 'others') echo 'selected'; ?>>Others</option>
            </select>
            <span class="error"><?php echo $concernsError; ?></span>
        </div>
        <br>
        <div class="form-group">
            <label for="description">Description :</label>
            <br>
            <textarea id="description" name="description" rows="5" cols="40" required><?php echo $description; ?></textarea>
            <span class="error"><?php echo $descriptionError; ?></span>
        </div>
        <br>
        <div class="form-group">
            <label for="file">File :</label>
            <input type="file" id="file" name="file" value="<?php echo $file; ?>">
            <span class="error"><?php echo $fileError; ?></span>
        </div>
        <br>

        <input type="submit" name="submit" value="Submit">

    </form>

    <footer>
        &copy; <?php echo date("Y"); ?> Hackers Poulette &#8482;
    </footer>
</body>
</html>