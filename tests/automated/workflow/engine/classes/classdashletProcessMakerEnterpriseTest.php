<?php 
  require_once PATH_TRUNK . 'gulliver/thirdparty/smarty/libs/Smarty.class.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlDocument.php'; 
  require_once PATH_TRUNK . 'gulliver/thirdparty/propel/Propel.php' ;
  require_once PATH_TRUNK . 'gulliver/thirdparty/creole/Creole.php' ;
  require_once PATH_TRUNK . 'workflow/engine/classes/class.dashletProcessMakerEnterprise.php'; 

  /** 
   * Generated by ProcessMaker Test Unit Generator on 2012-05-10 at 20:56:17.
  */ 

  class classdashletProcessMakerEnterpriseTest extends PHPUnit_Framework_TestCase 
  { 
    /**
    * @covers dashletProcessMakerEnterprise::getAdditionalFields
    * @todo   Implement testgetAdditionalFields().
    */
    public function testgetAdditionalFields() 
    { 
        if (class_exists('dashletProcessMakerEnterprise')) {
             $methods = get_class_methods( 'dashletProcessMakerEnterprise');
            $this->assertTrue( in_array( 'getAdditionalFields', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dashletProcessMakerEnterprise::getXTemplate
    * @todo   Implement testgetXTemplate().
    */
    public function testgetXTemplate() 
    { 
        if (class_exists('dashletProcessMakerEnterprise')) {
             $methods = get_class_methods( 'dashletProcessMakerEnterprise');
            $this->assertTrue( in_array( 'getXTemplate', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dashletProcessMakerEnterprise::setup
    * @todo   Implement testsetup().
    */
    public function testsetup() 
    { 
        if (class_exists('dashletProcessMakerEnterprise')) {
             $methods = get_class_methods( 'dashletProcessMakerEnterprise');
            $this->assertTrue( in_array( 'setup', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers dashletProcessMakerEnterprise::render
    * @todo   Implement testrender().
    */
    public function testrender() 
    { 
        if (class_exists('dashletProcessMakerEnterprise')) {
             $methods = get_class_methods( 'dashletProcessMakerEnterprise');
            $this->assertTrue( in_array( 'render', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

  } 
