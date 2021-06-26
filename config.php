<?PHP
//GENERAL CONFIGURATION
const REMOTE_ROOT = "http://localhost:8000"; //URL to the Root Directory
const DEBUG_MODE = true; //Enable/Disable Debug Mode (DISABLE IN PRODUCTION!)

//DATABASE CONFIGURATION
const DB_HOST = "localhost"; //Host of the database
const DB_NAME = "catnip"; //Name of the database
const DB_USER = "root"; //Name of the database user
const DB_PASS = ""; //Password from the database user

//CACHE CONFIGURATION
const CACHE_ACTIVE = false; //Activate/Deactivate Caching
const CACHE_TIME = 16000; //Time until the cache will be refreshed

//LOCALIZATION CONFIGURATION
const LOCA_DIRECTORY = __DIR__.'/localization'; //Directory of the Localization
const LOCA_DEFAULT = "en"; //Default Language for the Localization

//FILESYSTEM CONFIGURATION
const FS_DIRECTORY = __DIR__.'/public/uploads'; //The Upload Directory
const FS_PRIVATEDIRECTORY = __DIR__.'/uploads'; //The Private Directory
const FS_MAXSIZE = 5000 * 1000; //Max. Filesize for an upload (5MB)
const FS_MAXSPACE = 500000 * 1000; //Max. Discspace used (500MB)
?>