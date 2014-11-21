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
    public function tambahData($deviceId, $x, $y, $z) {

	$sql = "insert into records value ('', '$deviceId', TIMESTAMP(now()), $x,$y, $z)";
      	//echo $sql;
        $result = mysql_query($sql);
        // check for successful store
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
 
    /*
    query all data
    */
    public function queryAll(){
        $json = array();
    	$result = mysql_query("SELECT * FROM records");
	
        while ($row = mysql_fetch_assoc($result)) {
            //print_r($row);
            $json[$row['device_id']][] = array(
                'timestamp' => '2014-10-27 01:36:33',
                'x' => $row['delta_x'],
                'y' => $row['delta_y'],
                'z' => $row['delta_Z']
            ); 
        }

        return $json;
    }

    public function getUpdate() {
        $data = array();
        $sql = "SELECT DISTINCT a.device_id, 
                       (SELECT IFNULL(MAX(b.delta_x), 0) 
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

        $sql = "SELECT (SELECT COUNT(DISTINCT device_id) FROM records WHERE timestamp BETWEEN NOW() - INTERVAL 1 SECOND AND NOW()) as vote, 
                       (SELECT count(DISTINCT device_id) FROM records ) as count 
                FROM   dual;";
        $result = mysql_query($sql);

        while ($row = mysql_fetch_assoc($result)) {
            if ($row['vote'] > $row['count']/2) {
                $flag = true;
            }
        }

        return $flag;
    }
}
?>
