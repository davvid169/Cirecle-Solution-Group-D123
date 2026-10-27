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

if(empty($error)){
    echo "Your message has been sent";
}else{
    foreach($error as $msg){
        echo $msg;
        echo "<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result page</title>
    <link rel="stylesheet" href="david.css">
</head>
<body>
    <h2>Results</h2>
        <?php if(count($error) > 0){ ?>
            <section class="errors">
                <h3>Solve these problems:</h3>

                <?php foreach($error as $err) { ?>
                        <p><?= $err ?></p>
                <?php } ?>
            </section>
            <?php } else { ?>
            <section class="answer">
                <h3>Thank You</h3>
                <p>Name : <?= $name ?></p>
                <p>Email : <?= $email ?></p>
                <p>Message : <?= $message ?></p>
                <?php } ?>
            </section>
</body>
</html>