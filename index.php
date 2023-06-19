<?php
include('./assets/php/connect.php');

$nameError = $firstnameError = $addressEmailError = $confirmAddressEmailError = $concernsError = $descriptionError = $fileError = '';

$name = $firstname = $addressEmail = $confirmAddressEmail = $concerns = $description = '';

$optionsConcerns = ['after-sales-service', 'billing', 'others'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
        $nameError = 'Please enter your name';
    } elseif (strlen($_POST['name']) < 2 || strlen($_POST['name']) > 255) {
        $nameError = 'Your name must be between 2 and 255 characters';
    } else {
        $name = checkData($_POST['name']);
    }

    if (empty($_POST['firstname'])) {
        $firstnameError = 'Please enter your firstname';
    } elseif (strlen($_POST['firstname']) < 2 || strlen($_POST['firstname']) > 255) {
        $firstnameError = 'Your firstname must be between 2 and 255 characters';
    } else {
        $firstname = checkData($_POST['firstname']);
    }

    if (empty($_POST['addressEmail'])) {
        $addressEmailError = 'Please enter your email';
    } elseif (!filter_var($_POST['addressEmail'], FILTER_VALIDATE_EMAIL)) {
        $addressEmailError = "Your email format isn't valid";
    } else {
        $addressEmail = checkData($_POST['addressEmail']);
    }

    if (empty($_POST['confirmAddressEmail'])) {
        $confirmAddressEmailError = 'Please confirm your email';
    } elseif (!filter_var($_POST['confirmAddressEmail'], FILTER_VALIDATE_EMAIL)) {
        $confirmAddressEmailError = "Your email format isn't valid";
    } else {
        $confirmAddressEmail = checkData($_POST['confirmAddressEmail']);
    }
    if ($addressEmail !== $confirmAddressEmail) {
        $confirmAddressEmailError = "Email confirmation doesn't match";
    }

    if(empty($_POST['concerns'])) {
        $concernsError = 'Please select a concern';
    }else {
        $selectedConcern = checkData($_POST['concerns']);

        if(!in_array($selectedConcern, $optionsConcerns)) {
            $concernsError = 'The selected is incorrect';
        }else{
            $concerns = $selectedConcern;
        }
    }

    if(empty($_POST['description'])) {
        $descriptionError = 'Please enter a descirption';
    }else if(strlen($_POST['description']) < 2 || strlen($_POST['description']) > 1000) {
        $description = checkData($_POST['description']);
    }
}

function checkData($data) {
    $data = trim($data);
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
            <br><br>
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