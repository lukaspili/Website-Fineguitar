<?php
/*
 * Name:	wrapperCache
 * URL:		http://neo22s.com/wrappercache/
 * Version:	v0.1
 * Date:	29/10/2010
 * Author:	Chema Garrido
 * License: GPL v3
 * Notes:	wrapper cache for fileCache, memcache, APC, Xcache and eaccelerator
 */

/////////////////////class file cache

class wrapperCache {
	private $cache_params;//extra params for external caches like path or connection option memcached
	private $cache_expire;//seconds that the cache expires
	private $cache_type;//type of cache to use
	private $cache_external; //external instance of cache, can be fileCache or memcache
	private static $instance;//Instance of this class
	    
    // Always returns only one instance
    public static function GetInstance($type='auto',$exp_time=3600,$params='cache/'){
        if (!isset(self::$instance)){//doesn't exists the isntance
        	 self::$instance = new self($type,$exp_time,$params);//goes to the constructor
        }
        return self::$instance;
    }
    
	//cache constructor, optional expiring time and cache path
	private function __construct($type,$exp_time,$params){
		$this->cache_expire=$exp_time;
		$this->cache_params=$params;
		$this->setCacheType($type);
	}
	
	public function __destruct() {
		unset($this->cache_external);
	}
	
	// Prevent users to clone the instance
    public function __clone(){
        $this->cacheError('Clone is not allowed.');
    }
	
	//deletes cache from folder
	public function clearCache(){
		switch($this->cache_type){
			case 'eaccelerator':
		    	@eaccelerator_clean();
                @eaccelerator_clear();
	        break;

		    case 'apc':
		    	apc_clear_cache('user');
			break;

		    case 'xcache':
	    		xcache_clear_cache(XC_TYPE_VAR, 0);
		   	break;

		    case 'memcache':
		    	@$this->cache_external->flush();
	        break;
	        
	        case 'filecache':
		     	$this->cache_external->deleteCache();
	        break;
		}	
	}
	
	//writes or reads the cache
	public function cache($key, $value='',$ttl=''){
		if ($value!=''){//wants to write
			if ($ttl=='') $ttl=$this->cache_expire;
			$this->put($key, $value,$ttl);
		}
		else return $this->get($key);//reading value
	}
	
	//creates new cache files with the given data, $key== name of the cache, data the info/values to store
	private function put($key,$data,$ttl='' ){
		if ($ttl=='') $ttl=$this->cache_expire;
		
		switch($this->cache_type){
			case 'eaccelerator':
		    	eaccelerator_put($key, serialize($data), $ttl);
	        break;

		    case 'apc':
		    	apc_store($key, $data, $ttl);
			break;

		    case 'xcache':
	    		xcache_set($key, serialize($data), $ttl);
		   	break;

		    case 'memcache':
                $data=serialize($data);
		    	if (!$this->cache_external->replace($key, $data, false, $ttl))
			    $this->cache_external->set($key, $data, false, $ttl);
	        break;
	        
	        case 'filecache':
		     	$this->cache_external->cache($key,$data);
	        break;
		}	
    }
    
	//returns cache for the given key
	private function get($key){
		switch($this->cache_type){
			case 'eaccelerator':
		    	$data =  @unserialize(eaccelerator_get($key));
	        break;

		    case 'apc':
		    	$data =  apc_fetch($key);
			break;

		    case 'xcache':
	    		$data =  @unserialize(xcache_get($key));
		   	break;

		    case 'memcache':
		    	$data = @unserialize($this->cache_external->get($key));
	        break;
	        
	        case 'filecache':
		     	$data = $this->cache_external->cache($key);
	        break;
		}	
		/*echo '<br />--returnning data for key:'.$key;
		var_dump($data);*/
		return $data;
 	}
 	
 	//delete key from cache
 	public function delete($key){
 	    switch($this->cache_type){
			case 'eaccelerator':
		    	eaccelerator_rm($key);
	        break;

		    case 'apc':
		    	apc_delete($key);
			break;

		    case 'xcache':
	    		xcache_unset($key);
		   	break;

		    case 'memcache':
		    	$this->cache_external->delete($key);
	        break;
	        
	        case 'filecache':
		     	$this->cache_external->delete($key);
	        break;
		}	
 	
 	}
	// Overloading for the Application variables and automatically cached
	 	public function __set($name, $value) {
	 		$this->put($name, $value, $this->cache_expire);
	    }
	
	    public function __get($name) {
	        return $this->get($name);
	    }
	
	    public function __isset($key) {//echo "Is '$name' set?\n"
            if ($this->get($key) !== false)  return true;
            else return false; 
	    }
	
	    public function __unset($name) {//echo "Unsetting '$name'\n";
            $this->delete($name);
	    }
	//end overloads
	
	public function getCacheType(){
	    return $this->$this->cache_type;
	}	
	
	//sets the cache if its installed if not triggers error
	public function setCacheType($type){
	    $this->cache_type=strtolower($type);
		
		switch($this->cache_type){
			case 'eaccelerator':
		    	if (function_exists('eaccelerator_get')) $this->cache_type = 'eaccelerator';
		    	else $this->cacheError('eaccelerator not found');  	
	        break;

		    case 'apc':
		    	if (function_exists('apc_fetch')) $this->cache_type = 'apc' ;
		    	else $this->cacheError('APC not found');  
			break;

		    case 'xcache':
	    		if (function_exists('xcache_get')) $this->cache_type = 'xcache' ;
	    		else $this->cacheError('Xcache not found'); 
		   	break;

		    case 'memcache':
		    	if (class_exists('Memcache')) $this->init_memcache();
		    	else $this->cacheError('memcache not found'); 
	        break;
	        
	        case 'filecache':
		     	if (class_exists('fileCache'))$this->init_filecache();
		     	else $this->cacheError('fileCache not found'); 
	        break;
	        
	        case 'auto'://try to auto select a cache system
		    	if (function_exists('eaccelerator_get'))  	$this->cache_type = 'eaccelerator';                                       
				elseif (function_exists('apc_fetch'))    	$this->cache_type = 'apc' ;                                     
				elseif (function_exists('xcache_get'))  	$this->cache_type = 'xcache' ;                                        
				elseif (class_exists('Memcache'))			$this->init_memcache();
				elseif (class_exists('fileCache'))			$this->init_filecache();
				else $this->cacheError('not any compatible cache was found');
	        break;
	        
	        default://not any cache selected or wrong one selected
	        	if (isset($type)) $msg='Unrecognized cache type selected <b>'.$type.'</b>';
	        	else $msg='Not any cache type selected';
	        	$this->cacheError($msg);  	
	        break;
		}
	}	
		
	private function init_memcache(){//get instance of the memcache class
    	if (is_array($this->cache_params)){
    		$this->cache_type = 'memcache';
    		$this->cache_external = new Memcache;
    		foreach ($this->cache_params as $server) {
    			$server['port'] = isset($server['port']) ? (int) $server['port'] : ini_get('memcache.default_port'); 
            	$server['persistent'] = isset($server['persistent']) ? (bool) $server['persistent'] : true; 
    			$this->cache_external->addServer($server['host'], $server['port'], $server['persistent']);
    		}
    	}
    	else $this->cacheError('memcache needs an array, example: 
    				wrapperCache::GetInstance(\'memcache\',30,array(array(\'host\'=>\'localhost\')));');
    }
    
 	private function init_filecache(){//get instance of the filecache class
    	$this->cache_type = 'filecache';
    	$this->cache_external = fileCache::GetInstance($this->cache_expire,$this->cache_params);
    }
    
	public function getAvailableCache($return_format='html'){//returns the available cache
		$avCaches	= array();
		$avCaches[] = array('eaccelerator',function_exists('eaccelerator_get'));                                       
		$avCaches[] = array('apc',function_exists('apc_fetch')) ;                                     
		$avCaches[] = array('xcache',function_exists('xcache_get'));                                        
		$avCaches[] = array('memcache',class_exists('Memcache'));
		$avCaches[] = array('fileCache',class_exists('fileCache'));
		
		if ($return_format=='html'){
			$ret='<ul>';
			foreach ($avCaches as $c){
				$ret.='<li>'.$c[0].' - ';
				if ($c[1]) $ret.='Found/Compatible';
				else $ret.='Not Found/Incompatible';
				$ret.='</ll>';
			}
			return $ret.'</ul>';
		}
		else return $avCaches;	
	}
	
    private function cacheError($msg){//triggers error
    	trigger_error('<br /><b>wrapperCache error</b>: '.$msg.
	        		'<br />If you want you can try with \'auto\' for auto select a compatible cache. 
	        		<br />Or choose a supported cache from list:'.$this->getAvailableCache(), E_USER_ERROR);
    }
}
?>
