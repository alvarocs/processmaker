<?php 
  require_once PATH_TRUNK . 'gulliver/thirdparty/smarty/libs/Smarty.class.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlDocument.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.webResource.php'; 

  /** 
   * Generated by ProcessMaker Test Unit Generator on 2012-05-10 at 20:39:55.
  */ 

  class classWebResourceTest extends PHPUnit_Framework_TestCase 
  { 
    /**
    * @covers WebResource::WebResource
    * @todo   Implement testWebResource().
    */
    public function testWebResource() 
    { 
        if (class_exists('WebResource')) {
             $methods = get_class_methods( 'WebResource');
            $this->assertTrue( in_array( 'WebResource', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers WebResource::_encode
    * @todo   Implement test_encode().
    */
    public function test_encode() 
    { 
        if (class_exists('WebResource')) {
             $methods = get_class_methods( 'WebResource');
            $this->assertTrue( in_array( '_encode', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers WebResource::json_encode
    * @todo   Implement testjson_encode().
    */
    public function testjson_encode() 
    { 
        if (class_exists('WebResource')) {
             $methods = get_class_methods( 'WebResource');
            $this->assertTrue( in_array( 'json_encode', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers WebResource::json_decode
    * @todo   Implement testjson_decode().
    */
    public function testjson_decode() 
    { 
        if (class_exists('WebResource')) {
             $methods = get_class_methods( 'WebResource');
            $this->assertTrue( in_array( 'json_decode', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

  } 
