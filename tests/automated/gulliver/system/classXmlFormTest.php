<?php 
  require_once PATH_TRUNK . 'gulliver/thirdparty/smarty/libs/Smarty.class.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlDocument.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php'; 

  /** 
   * Generated by ProcessMaker Test Unit Generator on 2012-05-10 at 20:39:57.
  */ 

  class classXmlFormTest extends PHPUnit_Framework_TestCase 
  { 
    /**
    * @covers XmlForm::parseFile
    * @todo   Implement testparseFile().
    */
    public function testparseFile() 
    { 
        if (class_exists('XmlForm')) {
             $methods = get_class_methods( 'XmlForm');
            $this->assertTrue( in_array( 'parseFile', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm::setValues
    * @todo   Implement testsetValues().
    */
    public function testsetValues() 
    { 
        if (class_exists('XmlForm')) {
             $methods = get_class_methods( 'XmlForm');
            $this->assertTrue( in_array( 'setValues', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm::render
    * @todo   Implement testrender().
    */
    public function testrender() 
    { 
        if (class_exists('XmlForm')) {
             $methods = get_class_methods( 'XmlForm');
            $this->assertTrue( in_array( 'render', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm::cloneObject
    * @todo   Implement testcloneObject().
    */
    public function testcloneObject() 
    { 
        if (class_exists('XmlForm')) {
             $methods = get_class_methods( 'XmlForm');
            $this->assertTrue( in_array( 'cloneObject', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

  } 
