<?php
    
    //Connect to the database
    $host = "127.0.0.1";
    $user ="ramyapabbu";                     //Your Cloud 9 username
    $pass = "";                                  //Remember, there is NO password by default!
    $db = "country_project";                                  //Your database name you want to connect to
    $port = 3306;                                //The port #. It is always 3306
    
    $connection = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());


    $query = "DROP TABLE IF EXISTS country";
    $result = mysqli_query($connection, $query);
    $query = "DROP TABLE IF EXISTS city";
    $result = mysqli_query($connection, $query);
    $query = "CREATE TABLE country (id INT(11),countryName VARCHAR(128), CONSTRAINT city_pk PRIMARY KEY (id))";
    $result = mysqli_query($connection, $query);
    $query = "CREATE TABLE city (id INT(11), cityName VARCHAR(128), countryId int(11), invanare int(11), FOREIGN KEY(countryId) REFERENCES country(id),CONSTRAINT city_pk PRIMARY KEY (id))";
    $result = mysqli_query($connection, $query);
    
    $str = file_get_contents('stad.json');
    $json = json_decode($str, true);
    
    foreach ($json as $field => $value) {
        $id = $value['id'];
        $countryname=$value['countryname'];
        $query = "INSERT INTO country (id, countryName) VALUES ($id, $countryname)";
        $result = mysqli_query($connection, $query);
    }
    
     $str = file_get_contents('city.json');
     $json = json_decode($str, true);
    
    foreach ($json as $field => $value) {
        $id = $value['id'];
        $stadname=$value['stadname'];
        $countryId = $value['countryid'];
        $population=$value['population'];
        $query = "INSERT INTO city (id, cityName, countryId, invanare) VALUES ($id, $stadname, $countryId, $population)";
        $result = mysqli_query($connection, $query);
    }
    
    $query = "SELECT * FROM country";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) { ?>
    <body>
        <a href="cities.php?countryid=<?php echo $row['id'] ?>&&countryname=<?php echo $row['countryName'] ?>"><?php echo $row['countryName'] ?></a>
        <br>
    </body>
  <?php  } ?>
