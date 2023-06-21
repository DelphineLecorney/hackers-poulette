<?php
require 'vendor/autoload.php';

use Rakit\Validation\Validator;

function validateForm($formData)
{
    $validator = new Validator;

    $validation = $validator->make($formData, [
        'name' => 'required|min:2|max:255',
        'firstname' => 'required|min:2|max:255',
        'addressEmail' => 'required|email',
        'confirmAddressEmail' => 'required|email',
        'concerns' => 'required|in:after-sales-service,billing,others',
        'description' => 'required|min:2|max:1000',
        'files' => 'uploaded_file:0,2097152,image/jpeg,image/png,image/gif'
    ]);

    $validation->validate();

    if ($validation->fails()) {
        return $validation->errors();
    }

    return true;
}
?>
