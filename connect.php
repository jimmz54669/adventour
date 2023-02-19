
<?php
class Database{
  protected $host = "localhost"; /* Host name */
  protected $user = "root"; /* User */
  protected $password = "root"; /* Password */
  protected $dbname = "adventour_db"; /* Database name */

  public function connect()
  {
   $conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);

    // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      return $conn;
  }


}
?>