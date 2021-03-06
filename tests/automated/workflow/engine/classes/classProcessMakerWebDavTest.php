<?php 
  require_once PATH_TRUNK . 'gulliver/thirdparty/smarty/libs/Smarty.class.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlDocument.php'; 
  require_once PATH_TRUNK . 'gulliver/thirdparty/propel/Propel.php' ;
  require_once PATH_TRUNK . 'gulliver/thirdparty/creole/Creole.php' ;
  require_once PATH_TRUNK . 'workflow/engine/classes/class.webdav.php'; 

  /** 
   * Generated by ProcessMaker Test Unit Generator on 2012-05-10 at 20:56:18.
  */ 

  class classProcessMakerWebDavTest extends PHPUnit_Framework_TestCase 
  { 
    /**
    * @covers ProcessMakerWebDav::ServeRequest
    * @todo   Implement testServeRequest().
    */
    public function testServeRequest() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( 'ServeRequest', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers ProcessMakerWebDav::check_auth
    * @todo   Implement testcheck_auth().
    */
    public function testcheck_auth() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( 'check_auth', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers ProcessMakerWebDav::PROPFIND
    * @todo   Implement testPROPFIND().
    */
    public function testPROPFIND() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( 'PROPFIND', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers ProcessMakerWebDav::_can_execute
    * @todo   Implement test_can_execute().
    */
    public function test_can_execute() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( '_can_execute', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers ProcessMakerWebDav::_mimetype
    * @todo   Implement test_mimetype().
    */
    public function test_mimetype() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( '_mimetype', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers ProcessMakerWebDav::GET
    * @todo   Implement testGET().
    */
    public function testGET() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( 'GET', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers ProcessMakerWebDav::getRoot
    * @todo   Implement testgetRoot().
    */
    public function testgetRoot() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( 'getRoot', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers ProcessMakerWebDav::GetDir
    * @todo   Implement testGetDir().
    */
    public function testGetDir() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( 'GetDir', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers ProcessMakerWebDav::PUT
    * @todo   Implement testPUT().
    */
    public function testPUT() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( 'PUT', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers ProcessMakerWebDav::MKCOL
    * @todo   Implement testMKCOL().
    */
    public function testMKCOL() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( 'MKCOL', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers ProcessMakerWebDav::DELETE
    * @todo   Implement testDELETE().
    */
    public function testDELETE() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( 'DELETE', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers ProcessMakerWebDav::MOVE
    * @todo   Implement testMOVE().
    */
    public function testMOVE() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( 'MOVE', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers ProcessMakerWebDav::COPY
    * @todo   Implement testCOPY().
    */
    public function testCOPY() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( 'COPY', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers ProcessMakerWebDav::PROPPATCH
    * @todo   Implement testPROPPATCH().
    */
    public function testPROPPATCH() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( 'PROPPATCH', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers ProcessMakerWebDav::LOCK
    * @todo   Implement testLOCK().
    */
    public function testLOCK() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( 'LOCK', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers ProcessMakerWebDav::UNLOCK
    * @todo   Implement testUNLOCK().
    */
    public function testUNLOCK() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( 'UNLOCK', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers ProcessMakerWebDav::checkLock
    * @todo   Implement testcheckLock().
    */
    public function testcheckLock() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( 'checkLock', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers ProcessMakerWebDav::create_database
    * @todo   Implement testcreate_database().
    */
    public function testcreate_database() 
    { 
        if (class_exists('ProcessMakerWebDav')) {
             $methods = get_class_methods( 'ProcessMakerWebDav');
            $this->assertTrue( in_array( 'create_database', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

  } 
