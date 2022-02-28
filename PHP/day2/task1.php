<?php
    $name = $email = $message = "";
    const NAME_MAX_LENGTH = 100;
    const MSG_MAX_LENGTH = 255;

    $fp = fopen("log.txt","a+");

    $data = array();
    //date & time:
    $d=strtotime("10:30pm April 15 2014");
    $date = date( 'F j, Y, g:i a', $d);
    //date without comma:
    $result = str_replace(',', '', $date);
    //ip address:
    $ip_add = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:"there is no ip address";
    //Email:
    $email = isset($_POST["email"])?$_POST["email"]:"No email sent";
    //Name:
    $name = isset($_POST["name"])?$_POST["name"]:"No name sent";
    //adding data to array:
    $data = array("Visit Date"=>$result,"IP Address"=>$ip_add,"Email"=>$email,"Name"=>$name);
    //convert array to string:
    $final_result = implode(",",$data);
    //adding array to file:
    fwrite($fp, print_r($final_result, true));

    fclose($fp);

    function nameValidation()
    {
        if(empty($_POST["name"])){
            $nameError =  "please enter your name";
            echo $nameError;
        }elseif(strlen($_POST["name"]) > NAME_MAX_LENGTH){
            $nameError =  "you exceed the max length";
            echo $nameError;
        }
        else{
           $name = $_POST["name"];
        }
    }
    function emailValidation()
    {
        if(empty($_POST["email"])){
            $emailError = "please enter your email";
            echo $emailError;
        }
        elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
            echo $emailError;
        }
        else{
            $email = $_POST["email"];
        }
    }
    function msgValidation()
    {
        if(empty($_POST["message"])){
            $msgError = "please enter your message";
            echo $msgError;
        }
        elseif(strlen($_POST["message"]) > MSG_MAX_LENGTH){
            $nameError =  "you exceed the max length";
            echo $nameError;
        }
        else{
            $message = $_POST["message"];
        }
    }
?>


<html>
    <head>
        <title> contact form </title>
    </head>

    <body>
        <h3> Contact Form </h3>
        <div id="after_submit">
            <?php 
                if(isset($_POST["submit"])){
                    nameValidation();
                    echo "<br>";
                    emailValidation();
                    echo "<br>";
                    msgValidation();
                }
            ?>
        </div>
        <form id="contact_form" action="#" method="POST" enctype="multipart/form-data">

            <div class="row">
                <label class="required" for="name">Your name:</label><br />
                <input id="name" class="input" name="name" type="text" value="<?php if(isset($_POST["name"])) echo $_POST["name"]; ?>" size="30" /><br />

            </div>
            <div class="row">
                <label class="required" for="email">Your email:</label><br />
                <input id="email" class="input" name="email" type="text" value="<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>" size="30" /><br />

            </div>
            <div class="row">
                <label class="required" for="message">Your message:</label><br />
                <textarea id="message" class="input" name="message" rows="7" cols="30"></textarea><br />

            </div>

            <input id="submit" name="submit" type="submit" value="Send email" />
            <input id="clear" name="clear" type="reset" value="clear form" />

        </form>
    </body>

</html>