<?php 
  require_once PATH_TRUNK . 'gulliver/thirdparty/smarty/libs/Smarty.class.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlDocument.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.dynaformhandler.php'; 

  /** 
   * Generated by ProcessMaker Test Unit Generator on 2012-05-10 at 20:39:58.
  */ 

  class classdynaFormHandlerTest extends PHPUnit_Framework_TestCase 
  { 
    /**
    * @covers dynaFormHandler::__construct
    * @todo   Implement test__construct().
    */
    public function test__construct() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( '__construct', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::load
    * @todo   Implement testload().
    */
    public function testload() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'load', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::reload
    * @todo   Implement testreload().
    */
    public function testreload() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'reload', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::__cloneEmpty
    * @todo   Implement test__cloneEmpty().
    */
    public function test__cloneEmpty() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( '__cloneEmpty', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::toString
    * @todo   Implement testtoString().
    */
    public function testtoString() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'toString', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::getNode
    * @todo   Implement testgetNode().
    */
    public function testgetNode() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'getNode', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::setNode
    * @todo   Implement testsetNode().
    */
    public function testsetNode() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'setNode', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::add
    * @todo   Implement testadd().
    */
    public function testadd() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'add', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::replace
    * @todo   Implement testreplace().
    */
    public function testreplace() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'replace', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::save
    * @todo   Implement testsave().
    */
    public function testsave() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'save', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::fixXmlFile
    * @todo   Implement testfixXmlFile().
    */
    public function testfixXmlFile() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'fixXmlFile', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::setHeaderAttribute
    * @todo   Implement testsetHeaderAttribute().
    */
    public function testsetHeaderAttribute() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'setHeaderAttribute', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::modifyHeaderAttribute
    * @todo   Implement testmodifyHeaderAttribute().
    */
    public function testmodifyHeaderAttribute() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'modifyHeaderAttribute', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::updateAttribute
    * @todo   Implement testupdateAttribute().
    */
    public function testupdateAttribute() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'updateAttribute', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::remove
    * @todo   Implement testremove().
    */
    public function testremove() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'remove', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::nodeExists
    * @todo   Implement testnodeExists().
    */
    public function testnodeExists() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'nodeExists', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::moveUp
    * @todo   Implement testmoveUp().
    */
    public function testmoveUp() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'moveUp', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::moveDown
    * @todo   Implement testmoveDown().
    */
    public function testmoveDown() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'moveDown', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::getFields
    * @todo   Implement testgetFields().
    */
    public function testgetFields() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'getFields', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::getFieldNames
    * @todo   Implement testgetFieldNames().
    */
    public function testgetFieldNames() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'getFieldNames', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::addChilds
    * @todo   Implement testaddChilds().
    */
    public function testaddChilds() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'addChilds', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::addOrUpdateChild
    * @todo   Implement testaddOrUpdateChild().
    */
    public function testaddOrUpdateChild() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'addOrUpdateChild', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dynaFormHandler::getArray
    * @todo   Implement testgetArray().
    */
    public function testgetArray() 
    { 
        if (class_exists('dynaFormHandler')) {
             $methods = get_class_methods( 'dynaFormHandler');
            $this->assertTrue( in_array( 'getArray', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

  } 
