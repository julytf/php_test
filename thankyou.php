<?php

function validateRequired($value)
{
    if (!$value) {
        return false;
    }
    return true;
}
function validateEmail($value, $regEmail)
{
    if (!preg_match($regEmail, $value)) {
        return false;
    }
    return true;
}
function validatePhone($value, $regPhone)
{
    if (!preg_match($regPhone, $value)) {
        return false;
    }
    return true;
}


function validateData()
{
    $regEmail = '/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i';
    $regPhone = '/(84|0[3|5|7|8|9])+([0-9]{8})\b/';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $company = $_POST['company'];
    $message = $_POST['message'];

    if (
        !validateRequired($name)
        || !validateRequired($email)
        || !validateEmail($email, $regEmail)
        || !validateRequired($phone)
        || !validatePhone($phone, $regPhone)
        || !validateRequired($company)
        || !validateRequired($message)
    ) {
        return false;
    }

    return true;
}

if (!validateData()) {
    header("Location: /");
    exit;
}



$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$company = $_POST['company'];

$html = "
<div style='padding: 64px;'>
        <h2 style='color: #103f6e;'>Thank You for Contacting Us</h2>
        <p>We will be back in touch with you within one business day using the information
            you just provided below:</p>
        <table>
            <tr>
                <td style='text-wrap: nowarp; padding-right: 10px;'>
                    <strong>Name:</strong>
                </td>
                <td>
                    $name
                </td>
            </tr>
            <tr>
                <td style='text-wrap: nowarp; padding-right: 10px;'>
                    <strong>Phone:</strong>
                </td>
                <td>
                    $phone
                </td>
            </tr>
            <tr>
                <td style='text-wrap: nowarp; padding-right: 10px;'>
                    <strong>Email Address:</strong>
                </td>
                <td>
                    <a href='mailto:$email'>$email</a>
                </td>
            </tr>
            <tr>
                <td style='text-wrap: nowarp; padding-right: 10px;'>
                    <strong>Company:</strong>
                </td>
                <td>
                    $company
                </td>
            </tr>
        </table>
    </div>
    ";


// multiple recipients
$to = $_POST['email'];

// subject
$subject = 'Contact Form Submission';

// message
$message = $html;

// To send HTML mail, the Content-type header must be set
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
// $headers .= "To: $email" . "\r\n";
$headers .= 'From: Company <noreply@company.com>' . "\r\n";

mail($to, $subject, $message, $headers);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php echo $html; ?>
</body>

</html>