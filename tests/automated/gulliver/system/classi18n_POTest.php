<?php 
  require_once PATH_TRUNK . 'gulliver/thirdparty/smarty/libs/Smarty.class.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlDocument.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.i18n_po.php'; 

  /** 
   * Generated by ProcessMaker Test Unit Generator on 2012-05-10 at 20:39:57.
  */ 

  class classi18n_POTest extends PHPUnit_Framework_TestCase 
  { 
    /**
    * @covers i18n_PO::__construct
    * @todo   Implement test__construct().
    */
    public function test__construct() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( '__construct', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::buildInit
    * @todo   Implement testbuildInit().
    */
    public function testbuildInit() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( 'buildInit', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::readInit
    * @todo   Implement testreadInit().
    */
    public function testreadInit() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( 'readInit', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::addHeader
    * @todo   Implement testaddHeader().
    */
    public function testaddHeader() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( 'addHeader', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::addTranslatorComment
    * @todo   Implement testaddTranslatorComment().
    */
    public function testaddTranslatorComment() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( 'addTranslatorComment', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::addExtractedComment
    * @todo   Implement testaddExtractedComment().
    */
    public function testaddExtractedComment() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( 'addExtractedComment', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::addReference
    * @todo   Implement testaddReference().
    */
    public function testaddReference() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( 'addReference', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::addFlag
    * @todo   Implement testaddFlag().
    */
    public function testaddFlag() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( 'addFlag', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::addPreviousUntranslatedString
    * @todo   Implement testaddPreviousUntranslatedString().
    */
    public function testaddPreviousUntranslatedString() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( 'addPreviousUntranslatedString', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::addTranslation
    * @todo   Implement testaddTranslation().
    */
    public function testaddTranslation() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( 'addTranslation', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::_writeLine
    * @todo   Implement test_writeLine().
    */
    public function test_writeLine() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( '_writeLine', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::_write
    * @todo   Implement test_write().
    */
    public function test_write() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( '_write', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::prepare
    * @todo   Implement testprepare().
    */
    public function testprepare() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( 'prepare', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::headerStroke
    * @todo   Implement testheaderStroke().
    */
    public function testheaderStroke() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( 'headerStroke', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::skipCommets
    * @todo   Implement testskipCommets().
    */
    public function testskipCommets() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( 'skipCommets', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::readHeaders
    * @todo   Implement testreadHeaders().
    */
    public function testreadHeaders() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( 'readHeaders', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::getHeaders
    * @todo   Implement testgetHeaders().
    */
    public function testgetHeaders() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( 'getHeaders', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::getTranslation
    * @todo   Implement testgetTranslation().
    */
    public function testgetTranslation() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( 'getTranslation', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers i18n_PO::__destruct
    * @todo   Implement test__destruct().
    */
    public function test__destruct() 
    { 
        if (class_exists('i18n_PO')) {
             $methods = get_class_methods( 'i18n_PO');
            $this->assertTrue( in_array( '__destruct', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

  } 
