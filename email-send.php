<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get POSTed values
    $name    = strip_tags(trim($_POST["name"]));
    $email   = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));

    // Email Location
    $to = "kspivey@counselingsecure.com";

    // Email Subject
    $subject = "Website Contact! ( $name )";

    // Email Body
    $body = "
    You have received a new message from the contact form:

    Name: $name
    Email: $email

    Message:
    $message
    ";

    //Mail-Back Headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send Email
    if (mail($to, $subject, $body, $headers)) {
        // Redirect on success
        header("Location: contact_us.html?success=1");
        exit;
    } else {
        // Redirect on failure
        header("Location: contact_us.html?error=1");
        exit;
    }
} else {
    // If someone opens the PHP file directly
    header("Location: contact_us.html");
    exit;
}
?>