<?php 
  require_once PATH_TRUNK . 'gulliver/thirdparty/smarty/libs/Smarty.class.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlDocument.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php'; 

  /** 
   * Generated by ProcessMaker Test Unit Generator on 2012-05-10 at 20:39:56.
  */ 

  class classXmlForm_FieldTest extends PHPUnit_Framework_TestCase 
  { 
    /**
    * @covers XmlForm_Field::XmlForm_Field
    * @todo   Implement testXmlForm_Field().
    */
    public function testXmlForm_Field() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'XmlForm_Field', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::validateValue
    * @todo   Implement testvalidateValue().
    */
    public function testvalidateValue() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'validateValue', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::executeXmlDB
    * @todo   Implement testexecuteXmlDB().
    */
    public function testexecuteXmlDB() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'executeXmlDB', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::executePropel
    * @todo   Implement testexecutePropel().
    */
    public function testexecutePropel() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'executePropel', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::executeSQL
    * @todo   Implement testexecuteSQL().
    */
    public function testexecuteSQL() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'executeSQL', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::htmlentities
    * @todo   Implement testhtmlentities().
    */
    public function testhtmlentities() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'htmlentities', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::render
    * @todo   Implement testrender().
    */
    public function testrender() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'render', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::renderGrid
    * @todo   Implement testrenderGrid().
    */
    public function testrenderGrid() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'renderGrid', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::renderTable
    * @todo   Implement testrenderTable().
    */
    public function testrenderTable() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'renderTable', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::dependentOf
    * @todo   Implement testdependentOf().
    */
    public function testdependentOf() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'dependentOf', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::mask
    * @todo   Implement testmask().
    */
    public function testmask() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'mask', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::getAttributes
    * @todo   Implement testgetAttributes().
    */
    public function testgetAttributes() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'getAttributes', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::getEvents
    * @todo   Implement testgetEvents().
    */
    public function testgetEvents() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'getEvents', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::attachEvents
    * @todo   Implement testattachEvents().
    */
    public function testattachEvents() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'attachEvents', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::createXmlNode
    * @todo   Implement testcreateXmlNode().
    */
    public function testcreateXmlNode() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'createXmlNode', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::updateXmlNode
    * @todo   Implement testupdateXmlNode().
    */
    public function testupdateXmlNode() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'updateXmlNode', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::getXmlAttributes
    * @todo   Implement testgetXmlAttributes().
    */
    public function testgetXmlAttributes() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'getXmlAttributes', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::maskValue
    * @todo   Implement testmaskValue().
    */
    public function testmaskValue() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'maskValue', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::cloneObject
    * @todo   Implement testcloneObject().
    */
    public function testcloneObject() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'cloneObject', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::getPMTableValue
    * @todo   Implement testgetPMTableValue().
    */
    public function testgetPMTableValue() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'getPMTableValue', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::NSRequiredValue
    * @todo   Implement testNSRequiredValue().
    */
    public function testNSRequiredValue() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'NSRequiredValue', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::NSGridLabel
    * @todo   Implement testNSGridLabel().
    */
    public function testNSGridLabel() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'NSGridLabel', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::NSDefaultValue
    * @todo   Implement testNSDefaultValue().
    */
    public function testNSDefaultValue() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'NSDefaultValue', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::NSGridType
    * @todo   Implement testNSGridType().
    */
    public function testNSGridType() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'NSGridType', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::NSDependentFields
    * @todo   Implement testNSDependentFields().
    */
    public function testNSDependentFields() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'NSDependentFields', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers XmlForm_Field::renderHint
    * @todo   Implement testrenderHint().
    */
    public function testrenderHint() 
    { 
        if (class_exists('XmlForm_Field')) {
             $methods = get_class_methods( 'XmlForm_Field');
            $this->assertTrue( in_array( 'renderHint', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

  } 
