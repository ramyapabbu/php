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
    $query = "CREATE TABLE IF NOT EXISTS country (id INT(11),countryName VARCHAR(128), CONSTRAINT country_pk PRIMARY KEY (id))";
    $result = mysqli_query($connection, $query);
    $query = "CREATE TABLE IF NOT EXISTS city (id INT(11), cityName VARCHAR(128), countryId int(11), invanare int(11), FOREIGN KEY(countryId) REFERENCES country(id),CONSTRAINT city_pk PRIMARY KEY (id))";
    $result = mysqli_query($connection, $query);
    
    $str = file_get_contents('stad.json');
    $json = json_decode($str, true);
    
    foreach ($json as $field => $value) {
        $id = $value['id'];
        $countryname=$value['countryname'];
        $query = "INSERT IGNORE INTO country (id, countryName) VALUES ('$id', '$countryname')";
        if(mysqli_query($connection, $query)){
             // Do nothing
        } else{
            echo "ERROR: Could not able to execute $query. " . mysqli_error($connection);
        }
    }
    
     $str = file_get_contents('city.json');
     $json = json_decode($str, true);
    
    foreach ($json as $field => $value) {
        $id = $value['id'];
        $stadname=$value['stadname'];
        $countryId = $value['countryid'];
        $population=$value['population'];
        $query = "INSERT IGNORE INTO city (id, cityName, countryId, invanare) VALUES ('$id', '$stadname', '$countryId', '$population')";
        if(mysqli_query($connection, $query)){
            // Do nothing
        } else{
            echo "ERROR: Could not able to execute $query. " . mysqli_error($connection);
        }
    }
    
    $query = "SELECT * FROM country";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) { ?>
    <body>
        <a href="cities.php?countryid=<?php echo $row['id'] ?>&&countryname=<?php echo $row['countryName'] ?>"><?php echo $row['countryName'] ?></a>
        <br>
    </body>
  <?php  } ?>
