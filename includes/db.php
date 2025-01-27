<?php
function db_connect(){
    $host="localhost";
    $dbUser="root";
    $dbpassword="";
    $dbName="contactsbook";
    $connection=mysqli_connect($host,$dbUser,$dbpassword,$dbName) or die("DB Connection Error".
    mqsqli_connect_error());
    return $connection;
}
function db_close($connection){
    mysqli_close($connection);

}
?>