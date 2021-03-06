<?php 
  require_once PATH_TRUNK . 'gulliver/thirdparty/smarty/libs/Smarty.class.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlDocument.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.dbMaintenance.php'; 

  /** 
   * Generated by ProcessMaker Test Unit Generator on 2012-05-10 at 20:39:54.
  */ 

  class classDataBaseMaintenanceTest extends PHPUnit_Framework_TestCase 
  { 
    /**
    * @covers DataBaseMaintenance::__construct
    * @todo   Implement test__construct().
    */
    public function test__construct() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( '__construct', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::setUser
    * @todo   Implement testsetUser().
    */
    public function testsetUser() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'setUser', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::setPasswd
    * @todo   Implement testsetPasswd().
    */
    public function testsetPasswd() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'setPasswd', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::setHost
    * @todo   Implement testsetHost().
    */
    public function testsetHost() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'setHost', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::setTempDir
    * @todo   Implement testsetTempDir().
    */
    public function testsetTempDir() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'setTempDir', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::getTempDir
    * @todo   Implement testgetTempDir().
    */
    public function testgetTempDir() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'getTempDir', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::status
    * @todo   Implement teststatus().
    */
    public function teststatus() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'status', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::connect
    * @todo   Implement testconnect().
    */
    public function testconnect() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'connect', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::setDbName
    * @todo   Implement testsetDbName().
    */
    public function testsetDbName() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'setDbName', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::selectDataBase
    * @todo   Implement testselectDataBase().
    */
    public function testselectDataBase() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'selectDataBase', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::query
    * @todo   Implement testquery().
    */
    public function testquery() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'query', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::error
    * @todo   Implement testerror().
    */
    public function testerror() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'error', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::getTablesList
    * @todo   Implement testgetTablesList().
    */
    public function testgetTablesList() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'getTablesList', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::dumpData
    * @todo   Implement testdumpData().
    */
    public function testdumpData() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'dumpData', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::restoreData
    * @todo   Implement testrestoreData().
    */
    public function testrestoreData() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'restoreData', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::backupData
    * @todo   Implement testbackupData().
    */
    public function testbackupData() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'backupData', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::backupSqlData
    * @todo   Implement testbackupSqlData().
    */
    public function testbackupSqlData() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'backupSqlData', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::restoreAllData
    * @todo   Implement testrestoreAllData().
    */
    public function testrestoreAllData() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'restoreAllData', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::createDb
    * @todo   Implement testcreateDb().
    */
    public function testcreateDb() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'createDb', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::restoreFromSql2
    * @todo   Implement testrestoreFromSql2().
    */
    public function testrestoreFromSql2() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'restoreFromSql2', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::lockTables
    * @todo   Implement testlockTables().
    */
    public function testlockTables() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'lockTables', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::unlockTables
    * @todo   Implement testunlockTables().
    */
    public function testunlockTables() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'unlockTables', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::dumpSqlInserts
    * @todo   Implement testdumpSqlInserts().
    */
    public function testdumpSqlInserts() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'dumpSqlInserts', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::backupDataBase
    * @todo   Implement testbackupDataBase().
    */
    public function testbackupDataBase() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'backupDataBase', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::restoreFromSql
    * @todo   Implement testrestoreFromSql().
    */
    public function testrestoreFromSql() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'restoreFromSql', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::getSchemaFromTable
    * @todo   Implement testgetSchemaFromTable().
    */
    public function testgetSchemaFromTable() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'getSchemaFromTable', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers DataBaseMaintenance::removeCommentsIntoString
    * @todo   Implement testremoveCommentsIntoString().
    */
    public function testremoveCommentsIntoString() 
    { 
        if (class_exists('DataBaseMaintenance')) {
             $methods = get_class_methods( 'DataBaseMaintenance');
            $this->assertTrue( in_array( 'removeCommentsIntoString', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

  } 
