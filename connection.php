<?php

class Connection{
private $servername=&quot;localhost&quot;;
private $username=&quot;root&quot;;
private $password=&quot;&quot;;
public $conn;
public function __construct(){
// Create connection
$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
    die("La connexion a échoué : " . mysqli_connect_error());
}
echo "Connexion réussie<br>";
// Check connection
//code
}
function createDatabase($dbName){ 
    //creating a database with the conn in the class ($this-&gt;conn)
    //code
}
function selectDatabase($dbName){
    //select database with the conn of the class, using mysqli_select..
    //code
}
function createTable($query){
    //creating a table with the query
    //code
}

}
?>