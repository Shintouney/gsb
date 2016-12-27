<html>

<head>
    <title>Sending HTML email using PHP</title>
</head>

<body>

<?php
$to =  $user->getEmail();
$subject = "Votre compte a été créé";

$message = "<b>This is HTML message.</b>";
$message .= "<h1>This is headline.</h1>";

$header = "From:admin@gsb.fr \r\n";
$header .= "Cc:avinint@hotmail.com \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";

$retval = mail ($to,$subject,$message,$header);

if( $retval == true ) {
    echo "Message sent successfully...";
}else {
    echo "Message could not be sent...";
}
?>

</body>
</html>