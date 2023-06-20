# Hackers Poulette

## Objectives

> Create a fully-functioning online"contact support" form  in PHP.
> It must display a contact form and process the received answer (sanitize, validate, answer the user).

\[ ![Form contact support](https://github.com/DelphineLecorney/hackers-poulette/blob/main/assets/pictures/Form.jpg "Form contact support")

## References

> [Variables, GET, POST](https://www.php.net/manual/fr/language.variables.external.php)
> [error message](http://uxmas.com/2012/the-4-hs-of-writing-error-messages)
> [Accesible Form](https://formspree.io/blog/accessible-forms/)
> [Form](https://www.php.net/manual/fr/tutorial.forms.php)
> [empty](https://www.php.net/manual/en/function.empty.php)
> [Post, Enctype](https://developer.mozilla.org/fr/docs/Learn/Forms/Sending_and_retrieving_form_data)
> [ChekData](https://www.w3schools.com/php/php_form_validation.asp)
> [Form security and validation in PHP](https://www.pierre-giraud.com/php-mysql-apprendre-coder-cours/securiser-valider-formulaire/)
> [class mailer](https://github.com/PHPMailer/PHPMailer)

## Must-have features

* Use of PHP
* Database with PDO connection
* The form's html code must be semantically valid and accessible
* In case of wrong input, the form should display a useful visual clue about the error, 	below the input field.
* The error message must be readable and helpful to users.
* The data has to be sanitised and validated (server side)
* Once the form is validated, the data should be send to the database.
* Spam prevention using honeypot or captcha

## Some explanations

checkData() :

* trim($data) : Removes spaces from a string.
* htmlspecialchars($data) : Converts special characters into HTML entities.

strlen() :

* returns the number of characters in a string.


