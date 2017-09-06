<?php
    // My modifications to mailer script from:
    // http://blog.teamtreehouse.com/create-ajax-contact-form
    // Added input sanitizing to prevent injection

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
				$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oups! Il y a eu un problème au moment de l'envoi. Complétez le formulaire et essayez encore s'il vous plaît.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "jb.hallassou@gmail.com";

        // Set the email subject.
        $subject = "Nouveau message de news.pomset.fr";

        // Build the email content.
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Message:\n$message\n";

        // Build the email headers.
        $email_headers = "From: $name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Merci! Votre message a été envoyé";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oups! Quelque chose s'est mal passé, nous n'avons pas pu envoyé votre message.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "Il y a eu un problème au moment de l'envoi, essayez encore s'il vous plaît.";
    }

?>
