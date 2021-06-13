<?php
/*
Name: Database.php (modified pd0.php)
Version: 06.12
Copyrights: Roman Wanner 2018-2021
*/
namespace Catnip{
	class Database{
		public static function delete($dbtable, $dbid){
			$db = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS, array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
			$stmt = $db->prepare('DELETE FROM '.$dbtable.' WHERE id = '.$dbid);
			$stmt->execute();
			$affected_rows = $stmt->rowCount();
			$db = NULL;
			return $affected_rows;
		}
		
		public static function count($dbtable, $dbwhere = ""){
			$db = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS, array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
			if($dbwhere == ""){
				$nRows = $db->query('SELECT COUNT(*) FROM '.$dbtable)->fetchColumn(); 
			}else{
				$nRows = $db->query('SELECT COUNT(*) FROM '.$dbtable.' WHERE '.$dbwhere)->fetchColumn(); 
			}
			return $nRows;
		}
		
		public static function update($dbtable, $dbset, $dbwhere){
			$db = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS, array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
			$stmt = $db->prepare('UPDATE '.$dbtable.' SET '.$dbset.' WHERE '.$dbwhere);
			$stmt->execute();
			$affected_rows = $stmt->rowCount();
			$db = NULL;
			if($affected_rows > 0){ return TRUE;}else{ return FALSE;}
		}
		
		public static function insert($dbtable, $dbfields, $dbvalues){
			$db = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS, array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
			$stmt = $db->prepare('INSERT INTO '.$dbtable.'('.$dbfields.') VALUES('.$dbvalues.')');
			$stmt->execute();
			$affected_rows = $stmt->rowCount();	
			$db = NULL;
			if($affected_rows > 0){ return TRUE;}else{ return FALSE;}
		}
		
		public static function query($query, $args = null){
			$db = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS, array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
			$stmt = $db->prepare($query);
			if(is_array($args) !== true){
				$stmt->execute();
			}else{
				$stmt->execute($args);
			}
			return $stmt->fetchAll();
		}
		
		public static function querypaged($query, $itemsperpage, $maxpages = 5, $args = null){
			$db = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS, array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
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
		
		public static function queryarray($query,$args = null){
			$db = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS, array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
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
		
		public static function exists($table, $where){
			$db = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS, array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
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