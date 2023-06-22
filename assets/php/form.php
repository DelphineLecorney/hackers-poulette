
<?php

include('connect.php');
require_once('validation.php');
require ('rakitValidator.php');
require ('vendor/autoload.php');

$nameError = $firstnameError = $addressEmailError = $confirmAddressEmailError = $concernsError = $descriptionError = $filesError = '';
$name = $firstname = $addressEmail = $confirmAddressEmail = $concerns = $description = $files = '';
$optionsConcerns = ['after-sales-service', 'billing', 'others'];
$fileName = null;

if (!isset($_SESSION['csrf_token'])) {
    $token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $token;
} else {
    $token = $_SESSION['csrf_token'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['csrf_token']) || !hash_equals($_POST['csrf_token'], $_SESSION['csrf_token'])) {
        die("An error has occurred. Please try again later.");
    }

    $validator = new \Rakit\Validation\Validator;

    $validation = $validator->make($_POST, [
        'name' => 'required|min:2|max:255',
        'firstname' => 'required|min:2|max:255',
        'addressEmail' => 'required|email',
        'confirmAddressEmail' => 'required|email',
        'concerns' => 'required',
        'description' => 'required|min:2|max:1000',
        'files' => 'uploaded_file:0,2097152,image/jpeg,image/png,image/gif',
    ]);

    $validation->setAliases([
        'name' => 'Name',
        'firstname' => 'Firstname',
        'addressEmail' => 'Address e-mail',
        'confirmAddressEmail' => 'Confirm address e-mail',
        'concerns' => 'Concerns',
        'description' => 'Description',
        'files' => 'Files',
    ]);


    $validation->validate();

    if ($validation->fails()) {
        $errors = $validation->errors();

        $nameError = $errors->firstOfAll()['name'][0] ?? '';
        $firstnameError = $errors->firstOfAll()['firstname'][0] ?? '';
        $addressEmailError = $errors->firstOfAll()['addressEmail'][0] ?? '';
        $confirmAddressEmailError = $errors->firstOfAll()['confirmAddressEmail'][0] ?? '';
        $concernsError = $errors->firstOfAll()['concerns'][0] ?? '';
        $descriptionError = $errors->firstOfAll()['description'][0] ?? '';
        $filesError = $errors->firstOfAll()['files'][0] ?? '';
    } else {
        $name = checkData($_POST['name']);
        $firstname = checkData($_POST['firstname']);
        $addressEmail = checkData($_POST['addressEmail']);
        $confirmAddressEmail = checkData($_POST['confirmAddressEmail']);
        $concerns = checkData($_POST['concerns']);
        $description = checkData($_POST['description']);

        if (!empty($_FILES['files']['name'])) {
            $optionsExtensions = ['jpg', 'png', 'gif'];
            $fileExtension = strtolower(pathinfo($_FILES["files"]["name"], PATHINFO_EXTENSION));
            $fileSize = 2 * 1024 * 1024;

            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $fileMimeType = $finfo->file($_FILES['files']['tmp_name']);
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

            if (!in_array($fileMimeType, $allowedMimeTypes)) {
                $filesError = "Your file isn't valid, only JPG, PNG or GIF files are allowed";
            } elseif ($_FILES['files']['size'] > $fileSize) {
                $filesError = 'Your file must not exceed 2MB';
            } else {
                $fileName = $_FILES["files"]["name"];
                move_uploaded_file($_FILES["files"]["tmp_name"], "./assets/uploads/$fileName");

                $request = "INSERT INTO files (filename) VALUES (:fileName)";
                $statement = $bdd->prepare($request);
                $statement->bindParam(':fileName', $fileName);
                $statement->execute();
            }
            if (!empty($_POST['honeypot'])) {
                die('Please try again.');
            }
            $transport = new Swift_SmtpTransport('smtp-relay.sendinblue.com', 587);
            $transport->setUsername('lecorney.delphine@gmail.com');
            $transport->setPassword('khJ14YdLn7rptV0G');
        
            $mailer = new Swift_Mailer($transport);
        
            $message = new Swift_Message('Confirmation Email');
            $message->setFrom('lecorney.delphine@gmail.com');
            $message->setTo($addressEmail); 
            $message->setBody("Thank you for contacting us! We've received your request.");
        
            $result = $mailer->send($message);


            header("Location: index.php");
            exit();
        }
    }
}

if (empty($nameError) && empty($firstnameError) && empty($addressEmailError) &&
empty($confirmAddressEmailError) && empty($concernsError) && empty($descriptionError) &&
empty($filesError)
) {

    if (!empty($name) && !empty($firstname) && !empty($addressEmail) &&
    !empty($confirmAddressEmail) && !empty($concerns) && !empty($description)
    ) {
        $request = "INSERT INTO contact_support (name, firstname, addressEmail, confirmAddressEmail, concerns, description, filename) 
            VALUES (:name, :firstname, :addressEmail, :confirmAddressEmail, :concerns, :description, :filename)";
        $statement = $bdd->prepare($request);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':firstname', $firstname);
        $statement->bindParam(':addressEmail', $addressEmail);
        $statement->bindParam(':confirmAddressEmail', $confirmAddressEmail);
        $statement->bindParam(':concerns', $concerns);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':filename', $fileName);
        $statement->execute();
    }
}
?>


    <main>
    <form id="AddData" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" onsubmit="return validateForm(event)">

    <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">


        <div class="form-group">
            <label for="name">Name :</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" placeholder="ex. Dupont" required>
            <span class="error"><?php echo $nameError; ?></span>
        </div>

        <br>
        <div class="form-group">
            <label for="firstname">Firstname :</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>" placeholder="ex. Léon" required>
            <span class="error"><?php echo $firstnameError; ?></span>
        </div>
        <br>
        <div class="form-group">
            <label for="addressEmail">Address e-mail :</label>
            <input type="email" id="addressEmail" name="addressEmail" value="<?php echo htmlspecialchars($addressEmail); ?>" placeholder="ex. leon.dupont@example.com" required>
            <span class="error"><?php echo $addressEmailError; ?></span>
        </div>
        <br>
        <div class="form-group">
            <label for="confirmAddressEmail">Confirm address e-mail :</label>
            <input type="email" id="confirmAddressEmail" name="confirmAddressEmail" value="<?php echo $confirmAddressEmail; ?>" placeholder="ex. leon.dupont@example.com" required>
            <span class="error"><?php echo $confirmAddressEmailError; ?></span>
        </div>
        <br>
        <div class="form-group">
            <label for="concerns">Concerns :</label>
            <select id="concerns" name="concerns" required>
                <option value="">Select Concern</option>
                <option value="after-sales-service" <?php if ($concerns === 'after-sales-service') {
                    echo 'selected';
                } ?>>After-sales service</option>
                <option value="billing" <?php if ($concerns === 'billing') {
                    echo 'selected';
                } ?>>Billing</option>
                <option value="others" <?php if ($concerns === 'others') {
                    echo 'selected';
                } ?>>Others</option>
            </select>
            <span class="error"><?php echo $concernsError; ?></span>
        </div>
        <br>
        <div class="form-group">
            <label for="description">Description :</label>
            <br><br>
            <textarea id="description" name="description" rows="5" cols="40" placeholder="Detail your concern as much as possible" required><?php echo $description; ?></textarea>
            <span class="error"><?php echo $descriptionError; ?></span>
        </div>
        <br>
        <div class="form-group">
            <label for="files">Files :</label>
            <input type="file" id="files" name="files" value="<?php echo $files; ?>">
            <span class="error"><?php echo $filesError; ?></span>
        </div>
        <br>
        <div class="display-token">
            <label for="honeypot">Leave this field blank:</label>
            <input type="text" id="honeypot" name="honeypot">
        </div>

        <input type="submit" name="submit" value="Submit">

    </form>
</main>
<script src="./assets/js/script.js"></script>