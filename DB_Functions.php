<?php
 
class DB_Functions {
 
    private $db;
 
    //put your code here
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }
 
    // destructor
    function __destruct() {
        mysql_close();
    }
 
    /**
     * Storing new record
     */
    public function tambahData($deviceId, $magnitude, $x, $y, $z) {

	$sql = "insert into records value ('', '$deviceId', TIMESTAMP(now()), $magnitude, $x,$y, $z)";
      	//echo $sql;
        $result = mysql_query($sql);
        // check for successful store
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getUpdate() {
        $data = array();
        $sql = "SELECT DISTINCT a.device_id, 
                       (SELECT IFNULL(MAX(b.magnitude), 0) 
                        FROM records b 
                        WHERE   b.device_id = a.device_id 
                                AND b.timestamp BETWEEN NOW() - INTERVAL 1 SECOND 
                                AND NOW()
                        ) as value 
                FROM records a 
                GROUP BY device_id;";

        $result = mysql_query($sql);
    
        while ($row = mysql_fetch_assoc($result)) {
            $data[$row['device_id']] = $row['value']; 
        }

        return $data;
    }

    public function isGempa() {
        $flag = false;

        $sql = "SELECT (SELECT COUNT(DISTINCT device_id) FROM records WHERE timestamp BETWEEN NOW() - INTERVAL 1 SECOND AND NOW() 
                        AND magnitude >= (SELECT threshold from setting)
                        ) as vote, 
                       (SELECT count(DISTINCT device_id) FROM records ) as count 
                FROM   dual;";
        $result = mysql_query($sql);

        while ($row = mysql_fetch_assoc($result)) {
            if ($row['vote'] != '0' && $row['vote'] >= $row['count']/2) {
                $flag = true;
            }
        }

        return $flag;
    }

    public function setThreshold($param) {

        if($this->isEmpty()) {
            //default value = 5
            $sql = "insert into setting value($param)";
        }
        else {
            $sql = "update setting set threshold = $param";
        }

        $result = mysql_query($sql);
        // check for successful store
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function isEmpty() {
        $sql = "select count(*) as count from setting";
        $result = mysql_query($sql);
        if(mysql_fetch_array($result)['count'] > 0) {
            return false;
        }
        else {
            return true;
        }
    }

    public function getThreshold() {
        $sql = "select threshold from setting";
        $result = mysql_query($sql);

        return mysql_fetch_array($result)['threshold'];
    }
}
?>
