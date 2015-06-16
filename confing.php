<?php

/**
 * A very simple  Connect to MySqL
 *
 * @author  Zeyad Besiso <zeyad.besiso@gmail.com>
 *
 */

//
// Thrown when an error occurs.
//
class errorsServerException extends Exception {
    // custom string representation of object
    public function __toString() {
        if ($this->code) {
            return "[{$this->code}] {$this->message}\n";
        } else {
            return "{$this->message}\n";

        }
    }
}



class ConMysql{

    private $dbhost,$dbuser,$dbpass,$db;


    function __construct($host,$user,$pass,$db){

        $this->dbhost = $host;
        $this->dbuser = $user;
        $this->dbpass = $pass;
        $this->db     = $db;
        /**
         * @throws errors
         *
         */
            try {
                $this->Connect();
                $this->selectDb();
           	} catch (errorsServerException $why) {
        	    echo $why->getMessage();
        	    }
    }
    /**
	 * make Connect
	 *
	 * @access private
	 * @return static
	 */
    private function Connect() {

        $sql =  @mysql_connect($this->dbhost,$this->dbuser,$this->dbpass);
        if(!$sql) throw new errorsServerException("<pre> Error => Not Connect !</pre>");
        else return true;

    }
    /**
	 * make selectDb
	 *
	 * @access private
	 * @return static
	 */
    private function selectDb() {

        $sql = @mysql_select_db($this->db);
        if(!$sql) throw new errorsServerException("<pre> Error => NO DATABASE SELECTED !</pre>");
        else return true;

    }



}
//run class
 new ConMysql("localhost","usersDB","passwordDB","yourDB");
