<?php
    
    //Connect to the database
    $host = "127.0.0.1";
    $user ="ramyapabbu";                     //Your Cloud 9 username
    $pass = "";                                  //Remember, there is NO password by default!
    $db = "country_project";                                  //Your database name you want to connect to
    $port = 3306;                                //The port #. It is always 3306
    
    $connection = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());

    $countryId = $_GET['countryid']; 
    $countryName = $_GET['countryname'];
    
    $query = "SELECT * FROM city where countryId=$countryId";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) { ?>
        <a href="city.php?cityid=<?php echo $row['id'] ?>&&countryname=<?php echo $countryName ?>"><?php echo $row['cityName'] ?></a>
        <br>
    <?php } ?>