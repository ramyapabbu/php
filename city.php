<?php
    
    //Connect to the database
    $host = "127.0.0.1";
    $user ="ramyapabbu";                     //Your Cloud 9 username
    $pass = "";                                  //Remember, there is NO password by default!
    $db = "country_project";                                  //Your database name you want to connect to
    $port = 3306;                                //The port #. It is always 3306
    
    $connection = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());


    $cityId = $_GET['cityid']; 
    $countryName = $_GET['countryname'];
    
    //And now to perform a simple query to make sure it's working
    $query = "SELECT * FROM city where id=$cityId";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) { ?>
        <p>Id: <?php echo $row['id'] ?></p>
        <p>City: <?php echo $row['cityName'] ?></p>
        <p>Country: <?php echo $countryName ?></p>
        <p>Invanare: <?php echo $row['invanare'] ?></p>
    <?php } ?>