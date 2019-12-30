<!DOCTYPE HTML>

<?php
$defaultimage = "fruit/cherry.png"; //display image when page is loaded which is pic of cherry

$image1 = $defaultimage;
$image2 = $defaultimage;
$image3 = $defaultimage;



$setcredit = "100"; // sets usercredit to 100

$name; //variable for username
$credit = $setcredit;

//error messages to be displayed for server side validation
$outcomemessage = "";
$message1 = "";
$message2 = "";
$message3 = "";
$message4 = "";
$message5 = "";
$message6 = "";

//if spin button is clicked by the user then this function will run
if (array_key_exists('spin', $_POST)) {
    $error = 0;
    $credit = $_POST['credit'];

    if (empty($_POST['name'])) { // server validation for name entry
        $message1 = "<p>Please enter your 'Name'</p>";
        $error++;
    }
    if (is_numeric($_POST['name']) && !empty($_POST['name'])) {//server validation if name entery  is numeric 
        $message6 = "<p>'Name' must not be in numeric</p>";
        $error++;
    }
    if (empty($_POST['bet'])) { //server validation if bet is empty
        $message2 = "<p>Please enter the 'Bet'</p>";
        $error++;
    }
    if (!is_numeric($_POST['bet']) && !empty($_POST['bet'])) {  //server side validation if bet is a number or not and if its empty or not
        $message3 = "<p>'Bet' must be a number</p>";
        $error++;
    }
    if ($_POST['bet'] <= "0") {   //if bet< 0 then this messgae is displayed
        $message4 = "<p>'Bet' must be greater than '0'</p>";
        $error++;
    }
    if ($_POST['bet'] > $credit || $credit == 0) { // if bet> credit or bet=0 then this message is displayed
        $message5 = "<p>You don't have enough credit</p>";
        $error++;
    }
    $name = $_POST['name'];


    if ($error == 0) {

        //if no errors then an aray or images will be created	  
        $images[0] = "fruit/apple.png";
        $images[1] = "fruit/cherry.png";
        $images[2] = "fruit/grapes.png";
        $images[3] = "fruit/lemon.png";
        $images[4] = "fruit/orange.png";
        $images[5] = "fruit/pear.png";
        $images[6] = "fruit/watermelon.png";

        //this function generates random images between 0 and 6
        $randomimage1 = rand(0, 6);
        $randomimage2 = rand(0, 6);
        $randomimage3 = rand(0, 6);

//based on the random numbers images wi be stored in the location for image 1,2 and 3      
        $image1 = $images[$randomimage1];
        $image2 = $images[$randomimage2];
        $image3 = $images[$randomimage3];

        $name = $_POST['name'];

        $bet = $_POST['bet'];

        // if image 1,2 and 3 are same then this will run
        if ($randomimage1 == $randomimage2 && $randomimage1 == $randomimage3) {
            // The user will get credit of 10 times of bet 
            $newcredit = $bet * 10;
            $credit = $credit + $newcredit;
            $outcomemessage = "YOU WON !";
        }
        //if two images match this will run
        elseif ($randomimage1 == $randomimage2 || $randomimage2 == $randomimage3 || $randomimage1 == $randomimage3) {
            // The user will get credit of twice of bet
            $newcredit = $bet * 2;
            $credit = $credit + $newcredit;
            $outcomemessage = "YOU WON !";
            //If no image match this runs
        } else {

            $credit = $credit - $bet;
            $outcomemessage = "YOU LOSE !";
        }
    }
}
?>

<html>
    <br>
    <br>
    <h1 align='center'> The Virtual Slot Machine! </h1>
    <br>
    <br>
    <table cellpadding="0" border="1.5" cellspacing="0" align = center>
        <tr>

            <td>
                <img src="<?php echo $image1; ?>" height=110 width=110></img>
            </td>

            <td>
                <img src="<?php echo $image2; ?>" height=110 width=110></img>
            </td>

            <td>
                <img src="<?php echo $image3; ?>" height=110 width=110></img>
            </td>

            <td style="background-color:black">

                <form name="form" action="" method="POST">

                    <input type="submit" name="spin" value="SPIN" 
                           style=" border-color: black;   background-color:black;   color: white;   height: 105px;   width: 110px;   font-size : 35px; "></button>
                    </td>

                    </tr>
                    </table>
                    <br>
                    <br>
                    <h3 align='center'>

                        Name:<input type="text" name="name" value="<?php echo $name; ?>" required><br><br>
                        Your Bet:<input type="text" name="bet" size=1 required>
                        Credit:<input type="text" name="credit" value="<?php echo $credit; ?>" readonly="true" size=1>

                        </h4>

                        </form>

                        <br>

                        <h3 align='center'> <?php echo $message1; ?></h3>
                        <h3 align='center'> <?php echo $message2; ?></h3>
                        <h3 align='center'> <?php echo $message3; ?></h3>
                        <h3 align='center'> <?php echo $message4; ?></h3>
                        <h3 align='center'> <?php echo $message5; ?></h3>
                        <h3 align='center'> <?php echo $message6; ?></h3>
                        <h1 align='center'> <?php echo $outcomemessage; ?></h1>


                        </html>