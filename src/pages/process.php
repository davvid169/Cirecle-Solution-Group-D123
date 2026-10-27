<?php
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$message =trim( $_POST['message']);

$error = [];

if(empty($name)){
    $error['name'] = "Name is required";
}else if(strlen($name) < 5){
    $error['name'] = "Name must be at least 5 characters.";
}else if(!preg_match('/[A-Z]/',$name)){
    $error['name'] = "Name must contain at least 1 uppercase letter";
}

if(empty($email)){
    $error['email'] = "Email is required";
}elseif(!str_contains($email, '@')){
    $error['email'] = "Email must contain @";
}

if(empty($message)){
    $error['message'] = "Message is required";
}else if(strlen($message) < 5){
    $error['message'] = "Message must be at least 5 characters.";
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Result page</title>
        <link rel="stylesheet" href="../css/david.css">
    </head>
    <body>
            <?php if(count($error) > 0){ ?>
                <section class="errors">
                    <h3>Solve these problems:</h3>

                    <?php foreach($error as $err) { ?>
                            <p><?= $err ?></p>
                </section>
            <?php } ?>
                <?php } else { ?>
                    <section class="answer">
                        <h3>Thank you your message has been succesfully sent</h3>
                        <p>Name : <?= $name ?></p>
                        <p>Email : <?= $email ?></p>
                        <p>Message : <?= $message ?></p>
                   
                        <?php } ?>
                    </section>
        <div>
            <a href="../pages/contact.html">Back to the form</a>
        </div>
    </body>
</html>