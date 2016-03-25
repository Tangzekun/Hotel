<?php

session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['Hotel_User_ID']))
{
	header("Location: index.php");
}

    $res=mysql_query("SELECT * FROM Hotel_Info WHERE Hotel_ID =".$_SESSION['Hotel_User_ID']);
    $userRow = mysql_fetch_array($res);
    echo $userRow[2];
    echo $res;


?>


<?php
    echo " Session Hotel User is " . $_SESSION['Hotel_User_ID'] . ".<br>"; // works, it prints 6.

?>


<?php

/*

    $qry="select * from Hotel_Info WHERE Hotel_ID = $_SESSION[Hotel_User_ID]; ";
    $display=mysql_query($qry);
    $basicInfoRow = mysql_fetch_array($display);

    if ($row['Hotel_Name'] == null) 
    {
       break;
    } 
    else 
    { 
    <div id="body">
    <center>
        <div id="Hotel-InfoForm">
        <form method="post">
            <table align="center" width="30%" border="0">
            <tr>
            <td><input type="text" name="input_Hotel_Name" value = $row['Hotel_Name'] required /></td>
            </tr>
        </div>
    </center>
    </div>
    }
    */
?>



<?php
    
    if(isset($_POST['btn_BasicInfo']))
    {

        $Hotel_Name = mysql_real_escape_string($_POST['input_Hotel_Name']);
        $NumStreet = mysql_real_escape_string($_POST['input_NumStreet']);
        $City = mysql_real_escape_string($_POST['input_City']);
        $State = mysql_real_escape_string($_POST['input_State']);
        $Nation = mysql_real_escape_string($_POST['input_Nation']);
        $ZipCode = mysql_real_escape_string($_POST['input_ZipCode']);
        $Phone_Num = mysql_real_escape_string($_POST['input_Phone_Num']);
        $Parking_Fee = mysql_real_escape_string($_POST['input_Parking_Fee']);
        $Wifi_Fee = mysql_real_escape_string($_POST['input_Wifi_Fee']);
        $Breakfast_Fee = mysql_real_escape_string($_POST['input_Breakfast_Fee']);
        $Hotel_Price = mysql_real_escape_string($_POST['input_Hotel_Price']);

        
        
        $Hotel_Name = trim($Hotel_Name);
        $NumStreet = trim($NumStreet);
        $City = trim($City);
        $State = trim($State);
        $Nation = trim($Nation);
        $ZipCode = trim($ZipCode);
        $Phone_Num = trim($Phone_Num);
        $Parking_Fee = trim($Parking_Fee);
        $Wifi_Fee = trim($Wifi_Fee);
        $Breakfast_Fee = trim($Breakfast_Fee);
        $Hotel_Price = trim($Hotel_Price);


        $query = "SELECT NumStreet FROM Hotel_Info WHERE NumStreet = '$NumStreet' ";
        $result = mysql_query($query);

        $count = mysql_num_rows($result);



        // echo $Hotel_Name . "<br>";
        // echo $NumStreet . "<br>";
        // echo $City . "<br>";
        // echo $State . "<br>";
        // echo $Nation . "<br>";
        // echo $ZipCode . "<br>";
        // echo $Phone_Num . "<br>";
        // echo $Parking_Fee . "<br>";
        // echo $Wifi_Fee . "<br>";
        // echo $Breakfast_Fee . "<br>";
        // echo $Hotel_Price . "<br>";

        if($count == 0)
        {


            $update_Info =  "UPDATE Hotel_Info SET Hotel_Name = '$Hotel_Name', 
                            NumStreet = '$NumStreet', City = '$City', 
                            State = '$State', Nation = '$Nation', 
                            ZipCode = '$ZipCode', Phone_Num = '$Phone_Num', 
                            Parking_Fee = '$Parking_Fee', Wifi_Fee = '$Wifi_Fee', 
                            Breakfast_Fee = '$Breakfast_Fee', Hotel_Price = '$Hotel_Price' 
                            WHERE Hotel_ID = $_SESSION[Hotel_User_ID];
                            ";

            echo $update_Info . "<br>";
            if(mysql_query($update_Info))
            
            {
                ?>
                <script>alert('successfully registered ');</script>
                <?php
            }

            else
            {
                ?>
                <script>alert('error while submit new basic info...');</script>
                <?php
            }       
        }

        else
        {
                ?>
                <script>alert('Sorry this address is already taken ...');</script>
                <?php
        }

        

    }

?>









<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hello - <?php echo $userRow['Hotel_Email']; ?></title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>


<div id="header">
	<div id="left">
    <label>Welcome <?php echo $userRow['Hotel_Uname']; ?> </label>
    </div>
    <div id="right">
    	<div id="content">
        	<a href="logout.php?logout">Sign Out</a>
        </div>
    </div>
</div>

<div id="menu">
    <a href="manage.php"> Manage </a> <br>
    <a href="Hotel_Account.php"> Account </a>

</div>



<div id="body">
    <center>
        <div id="Hotel-InfoForm">
        <form method="post">
            <table align="center" width="30%" border="0">
            <tr>
            <td><input type="text" name="input_Hotel_Name" placeholder="Hotel's Name" required <?php if($userRow[1]!='') echo 'value="'.$userRow[1].'"';?> /> </td>
            </tr>
            <tr>
            <td><input type="text" name="input_NumStreet" placeholder="Num & Street" required  <?php if($userRow[2]!='') echo 'value="'.$userRow[2].'"';?> /> </td>
            </tr>
            <tr>
            <td><input type="text" name="input_City" placeholder="City" required <?php if($userRow[3]!='') echo 'value="'.$userRow[3].'"';?> /> </td>
            </tr>
            <tr>
            <td><input type="text" name="input_State" placeholder="State or Province" required <?php if($userRow[4]!='') echo 'value="'.$userRow[4].'"';?> /> </td>
            </tr>
            <tr>
            <td><input type="text" name="input_Nation" placeholder="Country" required <?php if($userRow[5]!='') echo 'value="'.$userRow[5].'"';?> /> </td>
            </tr>
            <tr>
            <td><input type="text" name="input_ZipCode" placeholder="Zip Code" required <?php if($userRow[6]!='') echo 'value="'.$userRow[6].'"';?> /> </td>
            </tr>
            <tr>
            <td><input type="text" name="input_Phone_Num" placeholder="Phone Number" required <?php if($userRow[7]!='') echo 'value="'.$userRow[7].'"';?> /> </td>
            </tr>
            <tr>
            <td><input type="text" name="input_Parking_Fee" placeholder="Parking Fee" required <?php if($userRow[8]!='') echo 'value="'.$userRow[8].'"';?> /> </td>
            </tr>
            <tr>
            <td><input type="text" name="input_Wifi_Fee" placeholder="Wifi Fee" required <?php if($userRow[9]!='') echo 'value="'.$userRow[9].'"';?> /> </td>
            </tr>
            <tr>
            <td><input type="text" name="input_Breakfast_Fee" placeholder="Breakfast Fee" required <?php if($userRow[10]!='') echo 'value="'.$userRow[10].'"';?> /> </td>
            </tr>
            <tr>
            <td><input type="text" name="input_Hotel_Price" placeholder="Basic Hotel Price" required <?php if($userRow[11]!='') echo 'value="'.$userRow[1].'"';?> /> </td>
            </tr>
            <tr>
            <td><button type="submit" name="btn_BasicInfo"> Update </button></td>
            </tr>
            </table>
        </form>
        </div>
    </center>

</div>

</body>
</html>