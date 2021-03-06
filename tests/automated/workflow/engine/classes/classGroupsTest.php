<?php 
  require_once PATH_TRUNK . 'gulliver/thirdparty/smarty/libs/Smarty.class.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlDocument.php'; 
  require_once PATH_TRUNK . 'gulliver/thirdparty/propel/Propel.php' ;
  require_once PATH_TRUNK . 'gulliver/thirdparty/creole/Creole.php' ;
  require_once PATH_TRUNK . 'workflow/engine/classes/class.groups.php'; 

  /** 
   * Generated by ProcessMaker Test Unit Generator on 2012-05-10 at 20:56:12.
  */ 

  class classGroupsTest extends PHPUnit_Framework_TestCase 
  { 
    /**
    * @covers Groups::getUsersOfGroup
    * @todo   Implement testgetUsersOfGroup().
    */
    public function testgetUsersOfGroup() 
    { 
        if (class_exists('Groups')) {
             $methods = get_class_methods( 'Groups');
            $this->assertTrue( in_array( 'getUsersOfGroup', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers Groups::getActiveGroupsForAnUser
    * @todo   Implement testgetActiveGroupsForAnUser().
    */
    public function testgetActiveGroupsForAnUser() 
    { 
        if (class_exists('Groups')) {
             $methods = get_class_methods( 'Groups');
            $this->assertTrue( in_array( 'getActiveGroupsForAnUser', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers Groups::addUserToGroup
    * @todo   Implement testaddUserToGroup().
    */
    public function testaddUserToGroup() 
    { 
        if (class_exists('Groups')) {
             $methods = get_class_methods( 'Groups');
            $this->assertTrue( in_array( 'addUserToGroup', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers Groups::removeUserOfGroup
    * @todo   Implement testremoveUserOfGroup().
    */
    public function testremoveUserOfGroup() 
    { 
        if (class_exists('Groups')) {
             $methods = get_class_methods( 'Groups');
            $this->assertTrue( in_array( 'removeUserOfGroup', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers Groups::getAllGroups
    * @todo   Implement testgetAllGroups().
    */
    public function testgetAllGroups() 
    { 
        if (class_exists('Groups')) {
             $methods = get_class_methods( 'Groups');
            $this->assertTrue( in_array( 'getAllGroups', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers Groups::getUserGroups
    * @todo   Implement testgetUserGroups().
    */
    public function testgetUserGroups() 
    { 
        if (class_exists('Groups')) {
             $methods = get_class_methods( 'Groups');
            $this->assertTrue( in_array( 'getUserGroups', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers Groups::getAvailableGroupsCriteria
    * @todo   Implement testgetAvailableGroupsCriteria().
    */
    public function testgetAvailableGroupsCriteria() 
    { 
        if (class_exists('Groups')) {
             $methods = get_class_methods( 'Groups');
            $this->assertTrue( in_array( 'getAvailableGroupsCriteria', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers Groups::getAssignedGroupsCriteria
    * @todo   Implement testgetAssignedGroupsCriteria().
    */
    public function testgetAssignedGroupsCriteria() 
    { 
        if (class_exists('Groups')) {
             $methods = get_class_methods( 'Groups');
            $this->assertTrue( in_array( 'getAssignedGroupsCriteria', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers Groups::getGroupsForUser
    * @todo   Implement testgetGroupsForUser().
    */
    public function testgetGroupsForUser() 
    { 
        if (class_exists('Groups')) {
             $methods = get_class_methods( 'Groups');
            $this->assertTrue( in_array( 'getGroupsForUser', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers Groups::removeUserOfAllGroups
    * @todo   Implement testremoveUserOfAllGroups().
    */
    public function testremoveUserOfAllGroups() 
    { 
        if (class_exists('Groups')) {
             $methods = get_class_methods( 'Groups');
            $this->assertTrue( in_array( 'removeUserOfAllGroups', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers Groups::getUsersGroupCriteria
    * @todo   Implement testgetUsersGroupCriteria().
    */
    public function testgetUsersGroupCriteria() 
    { 
        if (class_exists('Groups')) {
             $methods = get_class_methods( 'Groups');
            $this->assertTrue( in_array( 'getUsersGroupCriteria', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers Groups::getUserGroupsCriteria
    * @todo   Implement testgetUserGroupsCriteria().
    */
    public function testgetUserGroupsCriteria() 
    { 
        if (class_exists('Groups')) {
             $methods = get_class_methods( 'Groups');
            $this->assertTrue( in_array( 'getUserGroupsCriteria', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers Groups::getNumberGroups
    * @todo   Implement testgetNumberGroups().
    */
    public function testgetNumberGroups() 
    { 
        if (class_exists('Groups')) {
             $methods = get_class_methods( 'Groups');
            $this->assertTrue( in_array( 'getNumberGroups', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers Groups::getAvailableUsersCriteria
    * @todo   Implement testgetAvailableUsersCriteria().
    */
    public function testgetAvailableUsersCriteria() 
    { 
        if (class_exists('Groups')) {
             $methods = get_class_methods( 'Groups');
            $this->assertTrue( in_array( 'getAvailableUsersCriteria', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers Groups::verifyUsertoGroup
    * @todo   Implement testverifyUsertoGroup().
    */
    public function testverifyUsertoGroup() 
    { 
        if (class_exists('Groups')) {
             $methods = get_class_methods( 'Groups');
            $this->assertTrue( in_array( 'verifyUsertoGroup', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers Groups::verifyGroup
    * @todo   Implement testverifyGroup().
    */
    public function testverifyGroup() 
    { 
        if (class_exists('Groups')) {
             $methods = get_class_methods( 'Groups');
            $this->assertTrue( in_array( 'verifyGroup', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers Groups::load
    * @todo   Implement testload().
    */
    public function testload() 
    { 
        if (class_exists('Groups')) {
             $methods = get_class_methods( 'Groups');
            $this->assertTrue( in_array( 'load', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

  } 
