<?php
class Database {
    private static $dsn = 'mysql:host=localhost;dbname=megaglassincdb';
    private static $username = 'root';
    private static $password = 'Pa$$w0rd';
    private static $db;

    private function __construct() {}

    public static function getDB () {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                                     self::$username,
                                     self::$password);
            } catch (PDOException $e) {
//                $error_message = $e->getMessage();
//                include('../errors/database_error.php');
                exit();
            }
        }
        return self::$db;
    }
}

class Employee {
    private $id;
    private $first_name;
    private $last_name;

    public function __construct($id, $first_name, $last_name) {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($value) {
        $this->id = $value;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function setFirstName($value) {
        $this->first_name = $value;
    }
    
    public function getLastName() {
        return $this->last_name;
    }

    public function setLastName($value) {
        $this->last_name = $value;
    }
}
class EmployeeDB {
    public static function getEmployees() {
        $db = Database::getDB();
        $query = 'SELECT * FROM employee
                  ORDER BY employeeID';
        $statement = $db->prepare($query);
        $statement->execute();
        
        $employees = array();
        foreach ($statement as $row) {
            $employee = new Employee($row['employeeID'],
                                     $row['first_name'],
                                     $row['last_name']);
            $employees[] = $employee;
        }
        return $employees;
    }
}

$employees = EmployeeDB::getEmployees();
?>


<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>Thank you!</title>
        <style type="text/css">
            @import url("CSS/stylesheet.css");
            body {
                background-image: url(images/bkgdContact.jpg);
            }
        </style>
        <!-- Mobile -->
        <link href="css/bp_styles1.css" rel="stylesheet" />
        <script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
    </head>

    <body>
<!--        <div id="logo"><img src="images/logo.png" width="220" height="103" alt="Eva Jones Design"></div>-->
        <nav>
                <ul>
                    <li><a href="home.html">Home</a></li>
                    <li><a href="newsletter.html">Subscribe to our Newsletter!</a></li>
                    <li><a href="contact.html">Questions, Comments, or Concerns?</a></li>
                </ul>
            </nav>
        <header>
            <h1>contact <span class="fancy">Eva Jones</span></h1>
        </header>
        <section>
            <h2>Employee List</h2>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <ul>
            <?php 
            
            foreach($employees as $employee): ?>
                <li>
                    <?php echo $employee->getFirstName(). " ". $employee->getLastName() ?>
                </li>
            <?php endforeach;   ?>    
            </ul>
            <p>&nbsp;</p>
        </section>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <h1>&nbsp;</h1>
        <h2>&nbsp;</h2>
        <script type="text/javascript">
            var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown: "SpryAssets/SpryMenuBarDownHover.gif", imgRight: "SpryAssets/SpryMenuBarRightHover.gif"});
        </script>
    </body>
</html>
