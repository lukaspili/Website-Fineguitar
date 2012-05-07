<?php

/*
 * Name:	phpMyDB
 * URL:		http://neo22s.com/phpmydb/
 * Version:	v1.1
 * Date:	21/11/2010
 * Author:	Chema Garrido
 * License: GPL v3
 * Notes:	Mysql Object with cache integrated
 */

class phpMyDB {//requires wrapper cache class to use caching
	private $dbh;//data base handler
	private $query_counter=0;//count queries
	private $db_time=0;//application start time
	private $query_cache;//fileCache object
	private $query_cache_status=false; //cache deactivated by default
	private $query_cache_counter=0;//count cached queries
	private $debug=false; //no debug by default
	private $log=array();//log for the debug system
	private $insert_last_id;//last insert ID for mysql_insert_id()
    private static $instance;//Instance of this class
    
	    // Always returns only one instance
	    public static function GetInstance($dbuser='', $dbpass='', $dbname='', $dbhost='',$dbcharset='utf8',$dbtimezone='',$dbconnectiontype='default'){
	        if (!isset(self::$instance)){//doesn't exists the isntance
	        	 self::$instance = new self($dbuser, $dbpass, $dbname, $dbhost,$dbcharset,$dbtimezone,$dbconnectiontype);//goes to the constructor
	        }
	        return self::$instance;
	    }
	    
	 	// Prevent users to clone the instance
	    public function __clone(){
	       $this->print_error('Clone is not allowed.');
	    }
	    
		// DB Constructor - connects to the server and selects a database
		private function __construct($dbuser, $dbpass, $dbname, $dbhost,$dbcharset,$dbtimezone,$dbconnectiontype){
			$this->db_time=microtime(true);//db time starts
			if ($dbconnectiontype=='persistent') $this->dbh = @mysql_pconnect($dbhost,$dbuser,$dbpass);
			else $this->dbh = @mysql_connect($dbhost,$dbuser,$dbpass);
			
			if (!$this->dbh){
				$this->print_error('<ol><li><b>Error establishing a database connection!</b>
									<li>Are you sure you have the correct user/password?
									<li>Are you sure that you have typed the correct hostname?
									<li>Are you sure that the database server is running?</ol>');
			}
			$this->selectDB($dbname);
			$this->query('SET NAMES '.$dbcharset);
			if (!empty($dbtimezone))$this->query('SET time_zone =  \''.$dbtimezone.'\'');
		}
		
		public function __destruct() {
		    $this->closeDB();
		}
		
		// Select a DB (if another one needs to be selected)
		public function selectDB($db){
			if ( !@mysql_select_db($db,$this->dbh)){
				$this->print_error('<ol><li><b>Error selecting database <u>'.$db.'</u>!
									</b><li>Are you sure it exists?
									<li>Are you sure there is a valid database connection?</ol>');
			}
		}
		
		// Closes DB connection
		public function closeDB(){
			if (isset($this->dbh)){
				mysql_close();
				unset($this->dbh);
			}
			$msg=$this->query_counter.' queries generated in '.round( (microtime(true) - $this->db_time),5).'s';
			if ($this->query_cache) $msg.= ' and '.$this->query_cache_counter.' queries cached';
			//echo $msg;
			$this->addLog('Function closeDB: '.$msg);
		}
		
		// Normal query
		public function query($query) {
			$this->addLog('Function query: '.$query);
			$this->query_counter++;
			$return_val=@ mysql_query($query) or $this->print_error('('.mysql_errno().') in line '.__LINE__.' error:'.mysql_error().' 
																	<br/>Query: '. $query.' <br/>File: '. $_SERVER['PHP_SELF'] );
			$this->addLog('End function query');
			return $return_val;
		}
		
		///Select functions
		
		//normal select
		public function select($fields, $from, $where='') {  
			$this->addLog('Function select');
			if (!empty($where)) $where = ' WHERE ' . $where;   
            $query = 'SELECT ' . $fields . ' FROM `' . $from . '`'. $where;  
            $result = $this->query($query);  
            return $result;  
        }  
        
        //insert into
		public function insert($into, $values) {  
			$this->addLog('Function insert');
			$query = 'INSERT INTO ';
			
			if (is_array($values)){
				$fields='';
				$valuesf='';				
				foreach ($values as $f => $v){
					$fields.=$f.',';
					$valuesf.='\''.$v.'\',';
				}
				$query .=  $into .' ('.substr($fields,0,-1). ') VALUES(' . substr($valuesf,0,-1) . ')';  
			}
            else $query .= $into . ' VALUES(' . $values . ')';        
            
            if($this->query($query)) {
            	$this->setLastID(mysql_insert_id(),$this->dbh);
            	return $this->getLastID();//true;  //succed
            }
            else  return false;  //not succed    
        } 
        
        //delete from
        public function delete($from, $where='') {  
        	$this->addLog('Function delete');
        	if (!empty($where)) $where = ' WHERE ' . $where;   
            $query = 'DELETE FROM ' . $from . $where;  
            if($this->query($query))   return true;  //succed
            else  return false;  //not succed        
         } 
         
        //update, aware! $value= column='test', name='test2' .....
        public function update($table,$values, $where='') {  
        	$this->addLog('Function update');
        	if (is_array($values)){
				$valuesf='';				
				foreach ($values as $f => $v) $valuesf.= $f.'=\''.$v.'\',';
				$values = substr($valuesf,0,-1);  
			}
        	if (!empty($where)) $where = ' WHERE ' . $where;   
            $query = 'UPDATE '. $table. ' SET '.$values. $where;
            if($this->query($query))   return true;  //succed
            else  return false;  //not succed        
        } 
                         
        //returns an array with the SQL values, uses cache if enabled
		public function getRows($query,$type='assoc'){
			$this->addLog('Function getRows '. $type);
			if ($this->query_cache_status){//cache activated??
				$values = $this->query_cache->cache($query);//setting values from cache//var_dump($values);
				if ($type=='object'){//if type is object and the cache is activated we use assoc since object can't be cached
					$type='assoc';
					$this->addLog('Fetch mode changed to object, if cache is activated not possible to use.');
				}
			}
			else $values=null;
			
			if ($values==null) {	//not value from cache found
				$result=$this->query($query);
				if (mysql_num_rows($result)>0){//checking if there's more than one result
					$values=array();
					switch ($type){
						case 'assoc':
							while($row = mysql_fetch_assoc($result))  array_push($values, $row);  
						break;
						case  'row':
							while($row = mysql_fetch_row($result))	   array_push($values, $row);  
						break;
						case 'object':
							while($row = mysql_fetch_object($result))  array_push($values, $row);  
						break;
						case 'value':
							$row=mysql_fetch_row($result);
							$values=$row[0];//return value
						break;	
						default:
							$this->print_error('Not recognized fetch mode: '.$type);
						break;
					} 
					if ($this->query_cache_status){//save cache
						$this->query_cache->cache($query, $values);
						$this->addLog('Function getRows saved in cache');
					}
				}//theres more than 1 row
				else $values=null;//not found any row
			}//if values was false
			else{//found in cache
				$this->addLog('Function getRows from cache query:'. $query);
				$this->query_cache_counter++;
			}
			return $values;
		}
		
		// return the 1st value from a field of a query
		public function getValue($query){
			return $this->getRows($query,'value');
		}
		
		private function setLastID($id){
			if (is_numeric($id)) $this->insert_last_id=$id;
			else $this->insert_last_id=false;//will return false in case can't retrieve last id
		}
		public function getLastID(){
			return $this->insert_last_id;
		}
		/////////////Tool functions
		
		//sets cache active or inactive
		public function setCache($state){			
			if ($state && class_exists('wrapperCache')){//importanto to check that the class exists
				$this->query_cache_status=true;
				$this->query_cache = wrapperCache::GetInstance();//active
			}
			else{
				$this->query_cache_status=false;
				unset($this->query_cache);//unset
			}
		}
		
		//sets debug on or off
		public function setDebug($state){
			$this->debug=(bool) $state;
		}
		
		public function returnDebug($type='HTML'){
			if ($this->debug){
				switch($type){
					case 'array':
						return $this->log;
					break;
					case 'HTML'://returns debug as HTML
						echo '<ol>';
						foreach($this->log as $key=>$value){//loop in the log var
							echo '<li>'.$value.'</li>';
						}
						echo '</ol>';	
					break;
				}	
			}
			else return false;	
		}
		
		//add debug log
		public function addLog($message){
			if ($this->debug){//only if debug enabled
				array_push($this->log, round((microtime(true) - $this->db_time),5).'s - '. $message);  
			}
		}
		
		// Print SQL/DB error.
		private function print_error($str = ''){
			if ( empty($str) ) $str = mysql_error();
			// If there is an error then take note of it
			ocSqlError('<b>phpMyDB Error</b> <br />'.$str);
		}
		
		public function getQueryCounter($type='queries'){
			switch($type){
				case 'queries':
					return $this->query_counter;
				break;
				case 'cache':
					return $this->query_cache_counter;
				break;
			}			
		}
		
		public function getTime(){
			return $this->db_time;
		}
}
?>
