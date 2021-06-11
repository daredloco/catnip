<?php
/*
Name: pd0.php (modified)
Version: 04.21
Copyrights: Roman Wanner 2018-2021
*/
namespace Catnip{
	class Database{
		public $DB_HOST;
		public $DB_NAME;
		public $DB_USER;
		public $DB_PASS;
	
		function __construct($host = null, $name = null, $user = null, $pass = null)
		{
			if(is_null($host))
			{
				$host = DB_HOST;
			}
			if(is_null($name))
			{
				$name = DB_NAME;
			}
			if(is_null($user))
			{
				$user = DB_USER;
			}
			if(is_null($pass))
			{
				$pass = DB_PASS;
			}
			
			$this->DB_HOST = $host;
			$this->DB_NAME = $name;
			$this->DB_USER = $user;
			$this->DB_PASS = $pass;
		}
	
		function delete($dbtable, $dbid, $dbhost = null, $dbname = null, $dbuser = null, $dbpass = null){
			if(is_null($dbhost)){ $dbhost = $this->DB_HOST;}
			if(is_null($dbname)){ $dbname = $this->DB_NAME;}
			if(is_null($dbuser)){ $dbuser = $this->DB_USER;}
			if(is_null($dbpass)){ $dbpass = $this->DB_PASS;}
			$db = new \PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser, $dbpass, array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
			$stmt = $db->prepare('DELETE FROM '.$dbtable.' WHERE id = '.$dbid);
			$stmt->execute();
			$affected_rows = $stmt->rowCount();
			$db = NULL;
			return $affected_rows;
		}
		
		function count($dbtable, $dbwhere = "", $dbhost = null, $dbname = null, $dbuser = null, $dbpass = null){
			if(is_null($dbhost)){ $dbhost = $this->DB_HOST;}
			if(is_null($dbname)){ $dbname = $this->DB_NAME;}
			if(is_null($dbuser)){ $dbuser = $this->DB_USER;}
			if(is_null($dbpass)){ $dbpass = $this->DB_PASS;}
			$db = new \PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser, $dbpass, array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
			if($dbwhere == ""){
				$nRows = $db->query('SELECT COUNT(*) FROM '.$dbtable)->fetchColumn(); 
			}else{
				$nRows = $db->query('SELECT COUNT(*) FROM '.$dbtable.' WHERE '.$dbwhere)->fetchColumn(); 
			}
			return $nRows;
		}
		
		function update($dbtable, $dbset, $dbwhere, $dbhost = null, $dbname = null, $dbuser = null, $dbpass = null){
			if(is_null($dbhost)){ $dbhost = $this->DB_HOST;}
			if(is_null($dbname)){ $dbname = $this->DB_NAME;}
			if(is_null($dbuser)){ $dbuser = $this->DB_USER;}
			if(is_null($dbpass)){ $dbpass = $this->DB_PASS;}
			$db = new \PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser, $dbpass, array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
			$stmt = $db->prepare('UPDATE '.$dbtable.' SET '.$dbset.' WHERE '.$dbwhere);
			$stmt->execute();
			$affected_rows = $stmt->rowCount();
			$db = NULL;
			if($affected_rows > 0){ return TRUE;}else{ return FALSE;}
		}
		
		function insert($dbtable, $dbfields, $dbvalues, $dbhost = null, $dbname = null, $dbuser = null, $dbpass = null){
			if(is_null($dbhost)){ $dbhost = $this->DB_HOST;}
			if(is_null($dbname)){ $dbname = $this->DB_NAME;}
			if(is_null($dbuser)){ $dbuser = $this->DB_USER;}
			if(is_null($dbpass)){ $dbpass = $this->DB_PASS;}
			$db = new \PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser, $dbpass, array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
			$stmt = $db->prepare('INSERT INTO '.$dbtable.'('.$dbfields.') VALUES('.$dbvalues.')');
			$stmt->execute();
			$affected_rows = $stmt->rowCount();	
			$db = NULL;
			if($affected_rows > 0){ return TRUE;}else{ return FALSE;}
		}
		
		function query($query, $args = null, $dbhost = null, $dbname = null, $dbuser = null, $dbpass = null){
			if(is_null($dbhost)){ $dbhost = $this->DB_HOST;}
			if(is_null($dbname)){ $dbname = $this->DB_NAME;}
			if(is_null($dbuser)){ $dbuser = $this->DB_USER;}
			if(is_null($dbpass)){ $dbpass = $this->DB_PASS;}
			$db = new \PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser, $dbpass, array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
			$stmt = $db->prepare($query);
			if(is_array($args) !== true){
				$stmt->execute();
			}else{
				$stmt->execute($args);
			}
			return $stmt->fetchAll();
		}
		
		function querypaged($query, $itemsperpage, $maxpages = 5, $args = null, $dbhost = null, $dbname = null, $dbuser = null, $dbpass = null){
			if(is_null($dbhost)){ $dbhost = $this->DB_HOST;}
			if(is_null($dbname)){ $dbname = $this->DB_NAME;}
			if(is_null($dbuser)){ $dbuser = $this->DB_USER;}
			if(is_null($dbpass)){ $dbpass = $this->DB_PASS;}
			$db = new \PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser, $dbpass, array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
			$stmt = $db->prepare($query);
			if(is_array($args) !== true){
				$stmt->execute();
			}else{
				$stmt->execute($args);
			}
			$rows = $stmt->fetchAll();
			
			$pages = [];
			$page = [];
			$count = 0;
			foreach($rows as &$row){
				array_push($page,$row);
				$count++;
				if($count >= $itemsperpage){
					array_push($pages,$page);
					$count = 0;
					$page = [];
					if(count($pages) >= $maxpages){
						break;
					}
				}
			}
			if(count($page) < $itemsperpage){
				array_push($pages,$page);
			}
			return $pages;
		}
		
		function queryarray($query,$args = null,$dbhost = null, $dbname = null, $dbuser = null, $dbpass = null){
			if(is_null($dbhost)){ $dbhost = $this->DB_HOST;}
			if(is_null($dbname)){ $dbname = $this->DB_NAME;}
			if(is_null($dbuser)){ $dbuser = $this->DB_USER;}
			if(is_null($dbpass)){ $dbpass = $this->DB_PASS;}
			$db = new \PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser, $dbpass, array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
			$stmt = $db->prepare($query);
			if(is_array($args) !== true){
				$stmt->execute();
			}else{
				$stmt->execute($args);
			}
			$arr = array();
			while ($row = $stmt->fetch()){
				array_push($arr,$row);
			}
			return $arr;
		}
		
		function exists($table, $where, $dbhost = null, $dbname = null, $dbuser = null, $dbpass = null){
			if(is_null($dbhost)){ $dbhost = $this->DB_HOST;}
			if(is_null($dbname)){ $dbname = $this->DB_NAME;}
			if(is_null($dbuser)){ $dbuser = $this->DB_USER;}
			if(is_null($dbpass)){ $dbpass = $this->DB_PASS;}
			
			$db = new \PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser, $dbpass, array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
			$stmt = $db->prepare("SELECT EXISTS(SELECT 1 FROM ".$table." WHERE ".$where.")");
			$stmt->execute();
			$affected_rows = $stmt->rowCount();
			if($affected_rows > 0){
				return true;
			}
			return false;
		}
		
		protected function replaceHTML($str)
		{
			$search = array('&', '<', '>', '€', '‘', '’', '“', '”', '–', '—', '¡', '¢','£', '¤', '¥', '¦', '§', '¨', '©', 'ª', '«', '¬', '®', '¯', '°', '±', '²', '³', '´', 'µ', '¶', '·', '¸', '¹', 'º', '»', '¼', '½', '¾', '¿', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', '×', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'Þ', 'ß', 'à', 'á', 'â', 'ã','ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', '÷', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'þ', 'ÿ','Œ', 'œ', '‚', '„', '…', '™', '•', '˜');
		
			$replace  = array('&amp;', '&lt;', '&gt;', '&euro;', '&lsquo;', '&rsquo;', '&ldquo;','&rdquo;', '&ndash;', '&mdash;', '&iexcl;','&cent;', '&pound;', '&curren;', '&yen;', '&brvbar;', '&sect;', '&uml;', '&copy;', '&ordf;', '&laquo;', '&not;', '&reg;', '&macr;', '&deg;', '&plusmn;', '&sup2;', '&sup3;', '&acute;', '&micro;', '&para;', '&middot;', '&cedil;', '&sup1;', '&ordm;', '&raquo;', '&frac14;', '&frac12;', '&frac34;', '&iquest;', '&Agrave;', '&Aacute;', '&Acirc;', '&Atilde;', '&Auml;', '&Aring;', '&AElig;', '&Ccedil;', '&Egrave;', '&Eacute;', '&Ecirc;', '&Euml;', '&Igrave;', '&Iacute;', '&Icirc;', '&Iuml;', '&ETH;', '&Ntilde;', '&Ograve;', '&Oacute;', '&Ocirc;', '&Otilde;', '&Ouml;', '&times;', '&Oslash;', '&Ugrave;', '&Uacute;', '&Ucirc;', '&Uuml;', '&Yacute;', '&THORN;', '&szlig;', '&agrave;', '&aacute;', '&acirc;', '&atilde;', '&auml;', '&aring;', '&aelig;', '&ccedil;', '&egrave;', '&eacute;','&ecirc;', '&euml;', '&igrave;', '&iacute;', '&icirc;', '&iuml;', '&eth;', '&ntilde;', '&ograve;', '&oacute;', '&ocirc;', '&otilde;', '&ouml;', '&divide;','&oslash;', '&ugrave;', '&uacute;', '&ucirc;', '&uuml;', '&yacute;', '&thorn;', '&yuml;', '&OElig;', '&oelig;', '&sbquo;', '&bdquo;', '&hellip;', '&trade;', '&bull;', '&asymp;');
		
			//REPLACE VALUES
			$str = str_replace($search, $replace, $str);
		
			//RETURN FORMATED STRING
			return $str;
		}
	}
}	
?>