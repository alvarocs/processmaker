<?php
/**
 * cron_single.php
 * @package workflow-engine-bin
 */
ini_set ( 'display_errors', 1 );
error_reporting ( E_ALL );
ini_set ( 'memory_limit', '256M' ); // set enough memory for the script

if (! defined ( 'SYS_LANG' )) {
  define ( 'SYS_LANG', 'en' );
}

if (! defined ( 'PATH_HOME' )) {
  if (! defined ( 'PATH_SEP' )) {
    define ( 'PATH_SEP', (substr ( PHP_OS, 0, 3 ) == 'WIN') ? '\\' : '/' );
  }
  $docuroot = explode ( PATH_SEP, str_replace ( 'engine' . PATH_SEP . 'methods' . PATH_SEP . 'services', '', dirname ( __FILE__ ) ) );
  array_pop ( $docuroot );
  array_pop ( $docuroot );
  $pathhome = implode ( PATH_SEP, $docuroot ) . PATH_SEP;
  // try to find automatically the trunk directory where are placed the RBAC and
  // Gulliver directories
  // in a normal installation you don't need to change it.
  array_pop ( $docuroot );
  $pathTrunk = implode ( PATH_SEP, $docuroot ) . PATH_SEP;
  array_pop ( $docuroot );
  $pathOutTrunk = implode ( PATH_SEP, $docuroot ) . PATH_SEP;
  // to do: check previous algorith for Windows $pathTrunk = "c:/home/";
  
  define ( 'PATH_HOME', $pathhome );
  define ( 'PATH_TRUNK', $pathTrunk );
  define ( 'PATH_OUTTRUNK', $pathOutTrunk );
  
  require_once (PATH_HOME . 'engine' . PATH_SEP . 'config' . PATH_SEP . 'paths.php');
  
  G::LoadThirdParty ( 'pear/json', 'class.json' );
  G::LoadThirdParty ( 'smarty/libs', 'Smarty.class' );
  G::LoadSystem ( 'error' );
  G::LoadSystem ( 'dbconnection' );
  G::LoadSystem ( 'dbsession' );
  G::LoadSystem ( 'dbrecordset' );
  G::LoadSystem ( 'dbtable' );
  G::LoadSystem ( 'rbac' );
  G::LoadSystem ( 'publisher' );
  G::LoadSystem ( 'templatePower' );
  G::LoadSystem ( 'xmlDocument' );
  G::LoadSystem ( 'xmlform' );
  G::LoadSystem ( 'xmlformExtension' );
  G::LoadSystem ( 'form' );
  G::LoadSystem ( 'menu' );
  G::LoadSystem ( "xmlMenu" );
  G::LoadSystem ( 'dvEditor' );
  G::LoadSystem ( 'table' );
  G::LoadSystem ( 'pagedTable' );
  G::LoadClass ( 'system' );
  require_once ("propel/Propel.php");
  require_once ("creole/Creole.php");
}

require_once 'classes/model/AppDelegation.php';
require_once 'classes/model/Event.php';
require_once 'classes/model/AppEvent.php';
require_once 'classes/model/CaseScheduler.php';
// G::loadClass('pmScript');

// //default values
// $bCronIsRunning = false;
// $sLastExecution = '';
// if ( file_exists(PATH_DATA . 'cron') ) {
// $aAux = unserialize( trim( @file_get_contents(PATH_DATA . 'cron')) );
// $bCronIsRunning = (boolean)$aAux['bCronIsRunning'];
// $sLastExecution = $aAux['sLastExecution'];
// }
// else {
// //if not exists the file, just create a new one with current date
// @file_put_contents(PATH_DATA . 'cron', serialize(array('bCronIsRunning' =>
// '1', 'sLastExecution' => date('Y-m-d H:i:s'))));
// }

print "PATH_HOME: " . PATH_HOME . "\n";
print "PATH_DB: " . PATH_DB . "\n";
print "PATH_CORE: " . PATH_CORE . "\n";

// define the site name (instance name)
if (! defined ( 'SYS_SYS' )) {
  $sObject = $argv [1];
  $sNow = ''; // $argv[2];
  $sFilter = '';
  
  for($i = 3; $i < count ( $argv ); $i ++) {
    $sFilter .= ' ' . $argv [$i];
  }
  
  $oDirectory = dir ( PATH_DB );
  
  if (is_dir ( PATH_DB . $sObject )) {
    saveLog ( 'main', 'action', "checking folder " . PATH_DB . $sObject );
    if (file_exists ( PATH_DB . $sObject . PATH_SEP . 'db.php' )) {
      
      define ( 'SYS_SYS', $sObject );
      
      // ****************************************
      // read initialize file
      require_once PATH_HOME . 'engine' . PATH_SEP . 'classes' . PATH_SEP . 'class.system.php';
      $config = System::getSystemConfiguration ('', '', SYS_SYS);
      define ( 'MEMCACHED_ENABLED', $config ['memcached'] );
      define ( 'MEMCACHED_SERVER', $config ['memcached_server'] );
      define ( 'TIME_ZONE', $config ['time_zone'] );
      
      date_default_timezone_set ( TIME_ZONE );
      print "TIME_ZONE: " . TIME_ZONE . "\n";
      print "MEMCACHED_ENABLED: " . MEMCACHED_ENABLED . "\n";
      print "MEMCACHED_SERVER: " . MEMCACHED_SERVER . "\n";
      // ****************************************
      
      include_once (PATH_HOME . 'engine' . PATH_SEP . 'config' . PATH_SEP . 'paths_installed.php');
      include_once (PATH_HOME . 'engine' . PATH_SEP . 'config' . PATH_SEP . 'paths.php');
      
      // ***************** PM Paths DATA **************************
      define ( 'PATH_DATA_SITE', PATH_DATA . 'sites/' . SYS_SYS . '/' );
      define ( 'PATH_DOCUMENT', PATH_DATA_SITE . 'files/' );
      define ( 'PATH_DATA_MAILTEMPLATES', PATH_DATA_SITE . 'mailTemplates/' );
      define ( 'PATH_DATA_PUBLIC', PATH_DATA_SITE . 'public/' );
      define ( 'PATH_DATA_REPORTS', PATH_DATA_SITE . 'reports/' );
      define ( 'PATH_DYNAFORM', PATH_DATA_SITE . 'xmlForms/' );
      define ( 'PATH_IMAGES_ENVIRONMENT_FILES', PATH_DATA_SITE . 'usersFiles' . PATH_SEP );
      define ( 'PATH_IMAGES_ENVIRONMENT_USERS', PATH_DATA_SITE . 'usersPhotographies' . PATH_SEP );
      
      // server info file
      if (is_file ( PATH_DATA_SITE . PATH_SEP . '.server_info' )) {
        $SERVER_INFO = file_get_contents ( PATH_DATA_SITE . PATH_SEP . '.server_info' );
        $SERVER_INFO = unserialize ( $SERVER_INFO );
        // print_r($SERVER_INFO);
        define ( 'SERVER_NAME', $SERVER_INFO ['SERVER_NAME'] );
        define ( 'SERVER_PORT', $SERVER_INFO ['SERVER_PORT'] );
      }
      else {
        eprintln ( "WARNING! No server info found!", 'red' );
      }
      
      // read db configuration
      $sContent = file_get_contents ( PATH_DB . $sObject . PATH_SEP . 'db.php' );
      
      $sContent = str_replace ( '<?php', '', $sContent );
      $sContent = str_replace ( '<?', '', $sContent );
      $sContent = str_replace ( '?>', '', $sContent );
      $sContent = str_replace ( 'define', '', $sContent );
      $sContent = str_replace ( "('", "$", $sContent );
      $sContent = str_replace ( "',", '=', $sContent );
      $sContent = str_replace ( ");", ';', $sContent );
      
      eval ( $sContent );
      $dsn = $DB_ADAPTER . '://' . $DB_USER . ':' . $DB_PASS . '@' . $DB_HOST . '/' . $DB_NAME;
      $dsnRbac = $DB_ADAPTER . '://' . $DB_RBAC_USER . ':' . $DB_RBAC_PASS . '@' . $DB_RBAC_HOST . '/' . $DB_RBAC_NAME;
      $dsnRp = $DB_ADAPTER . '://' . $DB_REPORT_USER . ':' . $DB_REPORT_PASS . '@' . $DB_REPORT_HOST . '/' . $DB_REPORT_NAME;
      switch ($DB_ADAPTER) {
        case 'mysql' :
          $dsn .= '?encoding=utf8';
          $dsnRbac .= '?encoding=utf8';
          break;
        case 'mssql' :
          // $dsn .= '?sendStringAsUnicode=false';
          // $dsnRbac .= '?sendStringAsUnicode=false';
          break;
        default :
          break;
      }
      // initialize db
      $pro ['datasources'] ['workflow'] ['connection'] = $dsn;
      $pro ['datasources'] ['workflow'] ['adapter'] = $DB_ADAPTER;
      $pro ['datasources'] ['rbac'] ['connection'] = $dsnRbac;
      $pro ['datasources'] ['rbac'] ['adapter'] = $DB_ADAPTER;
      $pro ['datasources'] ['rp'] ['connection'] = $dsnRp;
      $pro ['datasources'] ['rp'] ['adapter'] = $DB_ADAPTER;
      // $pro['datasources']['dbarray']['connection'] =
      // 'dbarray://user:pass@localhost/pm_os';
      // $pro['datasources']['dbarray']['adapter'] = 'dbarray';
      $oFile = fopen ( PATH_CORE . 'config/_databases_.php', 'w' );
      fwrite ( $oFile, '<?php global $pro;return $pro; ?>' );
      fclose ( $oFile );
      Propel::init ( PATH_CORE . 'config/_databases_.php' );
      // Creole::registerDriver('dbarray', 'creole.contrib.DBArrayConnection');
      
      eprintln ( "Processing workspace: " . $sObject, 'green' );
      try {
        processWorkspace ();
      }
      catch ( Exception $e ) {
        echo $e->getMessage ();
        eprintln ( "Probelm in workspace: " . $sObject . ' it was omitted.', 'red' );
      }
      eprintln ();
      unlink ( PATH_CORE . 'config/_databases_.php' );
    }
  }

}
else {
  processWorkspace ();
}

// finally update the file
// @file_put_contents(PATH_DATA . 'cron', serialize(array('bCronIsRunning' =>
// '0', 'sLastExecution' => date('Y-m-d H:i:s'))));

function processWorkspace() {
  global $sLastExecution;
  
  try {
    
    if (($solrConf = System::solrEnv (SYS_SYS)) !== false) {
      G::LoadClass ( 'AppSolr' );
      $oAppSolr = new AppSolr ( $solrConf ['solr_enabled'], $solrConf ['solr_host'], $solrConf ['solr_instance'] );
      $oAppSolr->reindexAllApplications ();
    }
    else {
      print "Incomplete Solr configuration.";
    }
  
  }
  catch ( Exception $oError ) {
    saveLog ( "main", "error", "Error processing workspace : " . $oError->getMessage () . "\n" );
  }
}

function saveLog($sSource, $sType, $sDescription) {
  try {
    global $isDebug;
    if ($isDebug)
      print date ( 'H:i:s' ) . " ($sSource) $sType $sDescription <br>\n";
    @fwrite ( $oFile, date ( 'Y-m-d H:i:s' ) . '(' . $sSource . ') ' . $sDescription . "\n" );
    
    G::verifyPath ( PATH_DATA . 'log' . PATH_SEP, true );
    if ($sType == 'action') {
      $oFile = @fopen ( PATH_DATA . 'log' . PATH_SEP . 'cron.log', 'a+' );
    }
    else {
      $oFile = @fopen ( PATH_DATA . 'log' . PATH_SEP . 'cronError.log', 'a+' );
    }
    @fwrite ( $oFile, date ( 'Y-m-d H:i:s' ) . '(' . $sSource . ') ' . $sDescription . "\n" );
    @fclose ( $oFile );
  }
  catch ( Exception $oError ) {
    // CONTINUE
  }
}

function setExecutionMessage($m) {
  $len = strlen ( $m );
  $linesize = 60;
  $rOffset = $linesize - $len;
  
  eprint ( "* $m" );
  for($i = 0; $i < $rOffset; $i ++)
    eprint ( '.' );
}

function setExecutionResultMessage($m, $t = '') {
  $c = 'green';
  if ($t == 'error')
    $c = 'red';
  if ($t == 'info')
    $c = 'yellow';
  eprintln ( "[$m]", $c );
}
