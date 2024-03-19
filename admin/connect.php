<?Php
$host_name = "localhost";  //connecting to the database server
$database = "egaming";
$username = "root";
$password = "";
$option=array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',   // to support all languages
);
try {
$con = new PDO('mysql:host='.$host_name.';dbname='.$database, $username, $password, $option); 
} catch (PDOException $e) {
echo "Error!: " . $e->getMessage() . "<br/>"; // display error
die();
}
?>
