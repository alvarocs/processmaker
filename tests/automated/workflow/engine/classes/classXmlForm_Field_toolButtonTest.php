<?php 
  require_once PATH_TRUNK . 'gulliver/thirdparty/smarty/libs/Smarty.class.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlDocument.php'; 
  require_once PATH_TRUNK . 'gulliver/thirdparty/propel/Propel.php' ;
  require_once PATH_TRUNK . 'gulliver/thirdparty/creole/Creole.php' ;
  require_once PATH_TRUNK . 'workflow/engine/classes/class.toolBar.php'; 

  /** 
   * Generated by ProcessMaker Test Unit Generator on 2012-05-10 at 20:56:17.
  */ 

  class classXmlForm_Field_toolButtonTest extends PHPUnit_Framework_TestCase 
  { 
    /**
    * @covers XmlForm_Field_toolButton::render
    * @todo   Implement testrender().
    */
    public function testrender() 
    { 
        if (class_exists('XmlForm_Field_toolButton')) {
             $methods = get_class_methods( 'XmlForm_Field_toolButton');
            $this->assertTrue( in_array( 'render', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

  } 
