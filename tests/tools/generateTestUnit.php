#!/usr/bin/php
<?php
  /** 
    this file is used to generate test units for all files folders in processmaker class folder
  */
  
  define('ROOT_PATH', realpath(dirname(__FILE__) . '/..') . '/');
  global $tokens;
  global $dispatchIniFile;
  global $fp;

  $dispatchIniFile = ROOT_PATH . "configs/dispatch.ini";
  $inputDir        = ROOT_PATH . 'businessLogic/modules/home/Services';
  
//  $fp = fopen( $dispatchIniFile , 'w');

  //parsingFolder('gulliver/system', 'class.form.php class.objectTemplate.php class.tree.php class.xmlform.php class.filterForm.php');
  //parsingFolder('gulliver/system', '');
  parsingFolder('workflow/engine/classes', '');
  
  function parsingFolder ( $folder, $exceptionsText ) {
    $baseDir         = ROOT_PATH;
    $exceptions = explode( ' ', trim($exceptionsText) ) ;
  	if ($handle = opendir( $baseDir . $folder) ) {
    	while (false !== ($entry = readdir($handle))) {
    		if ( is_dir($baseDir . $folder . '/' . $entry) ) {
    		}
    	  	if ( is_file($baseDir . $folder . '/' . $entry)  && substr($entry,-4) == ".php" && substr($entry,0,6) == "class." ) {
    	  		if ( !in_array($entry,$exceptions)  ) {
    			  //print "parsing $baseDir$folder/$entry \n";
    			  parsingFile ( $folder , $entry);
    	  		}
    	  	}
    	}
  	closedir($handle);
    }
  }

  function parsingFile ( $folder, $entry ) {
    global $tokens;
    global $fp;
    
    $baseDir = ROOT_PATH;
    $outputDir = ROOT_PATH . 'tests/';

    $file = $baseDir . $folder . '/' . $entry;
    $content = file_get_contents ( $file );

    //get all tokens
    $tokens = token_get_all ($content);
    
    //remove spaces
    $temp = array();
    foreach ( $tokens as $k => $token ) {
      if ( is_array($token) && $token[0] != T_WHITESPACE ) {
        $temp[] = $tokens[$k];
      }
      if ( !is_array($token)) {
      	$temp[] = $token;
      }
    }
    $tokens = $temp;
    
    $className = '';
    $comments  = '';
    $path = '/' . str_replace (ROOT_PATH, '', $file);
    
    $atLeastOneClass = false;
    
    foreach ( $tokens as $k => $token ) {
      if ( is_array($token) ) {
      	//looking for classes
        if ( $token[0] == T_CLASS  ) {
          if ( $atLeastOneClass ) {
          	fprintf ( $fp, "  } \n" );          	 
          }
          $atLeastOneClass = true;
          $className = nextToken( T_STRING, $k );
          print "--> $className\n";
          $classFile = $folder . '/' . $entry;
          if ( !is_dir($outputDir . $folder)) {
            mkdir($outputDir . $folder, 0777, true);
          }
          $fp = fopen ( $outputDir . $folder . '/class' . $className . 'Test.php', 'w' );
          fprintf ( $fp, "<?php \n" );
          
          fprintf ( $fp, "  require_once PATH_TRUNK . 'gulliver/thirdparty/smarty/libs/Smarty.class.php'; \n" );
          fprintf ( $fp, "  require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php'; \n" );
          fprintf ( $fp, "  require_once PATH_TRUNK . 'gulliver/system/class.xmlDocument.php'; \n" );
          // setup propel definitions and logging
          fprintf ( $fp, "  require_once PATH_TRUNK . 'gulliver/thirdparty/propel/Propel.php' ;\n" );
          fprintf ( $fp, "  require_once PATH_TRUNK . 'gulliver/thirdparty/creole/Creole.php' ;\n" );          
          fprintf ( $fp, "  require_once PATH_TRUNK . '%s/%s'; \n\n", $folder, $entry );
          fprintf ( $fp, "  /** \n" );
          fprintf ( $fp, "   * Generated by ProcessMaker Test Unit Generator on %s at %s.\n", date('Y-m-d'), date('H:i:s') );
          fprintf ( $fp, "  */ \n\n" );
          fprintf ( $fp, "  class class%sTest extends PHPUnit_Framework_TestCase \n", $className );
          fprintf ( $fp, "  { \n" );
        }
        
        if ( $token[0] == T_FUNCTION ) {
          $functionName = nextToken( T_STRING, $k );
          $public       = previousToken( T_PUBLIC, $k );
          $comments     = previousToken( T_DOC_COMMENT, $k );
          parseFunction ( $k, $path, $className, $functionName, $comments);
          //if ( strtolower($public) == 'public' ) parsePublic ( $path, $className, $functionName, $comments );
        }
      }
    }
    if ( $atLeastOneClass ) {
    	fprintf ( $fp, "  } \n" );
    }
    
  }

/*
[GetCaseInfo]  
  class = BpmnEngine_Services_Case
  path = /businessLogic/modules/bpmnEngine/Services/Case.php
  gearman = false
  rest = false
  background = false
*/

  function parseFunction ( $k, $path, $className, $functionName, $comments ) {
    global $fp;
    global $tokens;
    if ( trim($className) == '' ) return;
    $comm = explode ("\n", $comments);
    
    $params = array();
    //print "     --> $functionName ( ";
    
    //search for first ( open parenthesis
    $openParenthesis = false; 
    $closeParenthesis = false; 
    while ( ! $openParenthesis ) {
    	if (! is_array($tokens[$k]) && $tokens[$k] == '(' )
    		$openParenthesis = true;
    	$k++; 
    }
    while ( ! $closeParenthesis ) {
        if (is_array($tokens[$k]) && $tokens[$k][0] == T_VARIABLE ) { 
       	  //print " " . $tokens[$k][1];
        }
        if (! is_array($tokens[$k]) && $tokens[$k] == ')' ) {
    		$closeParenthesis = true;
    		//print " \n";
        }
    	$k++; 
    }
    
    
    fprintf ( $fp, "    /**\n" );
    fprintf ( $fp, "    * @covers %s::%s\n", $className, $functionName );
    fprintf ( $fp, "    * @todo   Implement test%s().\n", $functionName );
    fprintf ( $fp, "    */\n" );
    fprintf ( $fp, "    public function test%s() \n", $functionName );
    fprintf ( $fp, "    { \n" );
    fprintf ( $fp, "        if (class_exists('%s')) {\n ", $className );
    fprintf ( $fp, "            \$methods = get_class_methods( '%s');\n", $className );
    fprintf ( $fp, "            \$this->assertTrue( in_array( '%s', \$methods ), 'seems like this function is outside this class' ); \n", $functionName );
//    fprintf ( $fp, "          \$x = new %s(); \n", $className );
//    fprintf ( $fp, "          \$this->assertTrue( is_a(\$x, '%s') ); \n", $className );
    fprintf ( $fp, "        } \n" );
    
    
    fprintf ( $fp, "    } \n\n" );
    //fprintf ( $fp, "[$functionName]\n  class = $className\n  path  = $path\n" );
    //fprintf ( $fp, "\n" );
  }
  
  function parsePublic ( $path, $className, $functionName, $comments ) {
  	global $fp;
  	$comm = explode ("\n", $comments);
  	$gearman    = false;
  	$rest       = false;
  	$background = false;
  	foreach ( $comm as $k => $line ) {
  		$line = trim(str_replace('*','',$line));
  		if (substr($line,0, 13) == '@background =') $background = strtolower(trim(substr( $line,14 )));
  		if (substr($line,0, 10) == '@gearman =')    $gearman    = strtolower(trim(substr( $line,11 )));
  		if (substr($line,0,  7) == '@rest =')       $rest       = strtolower(trim(substr( $line,7 )));
  	}
  	fprintf ( $fp, "[$functionName]\n  class = $className\n  path  = $path\n" );
  	fprintf ( $fp, "  gearman = " .    ($gearman   == 'true' ? 'true' : 'false') . "\n" );
  	fprintf ( $fp, "  background = " . ($background== 'true' ? 'true' : 'false') . "\n" );
  	fprintf ( $fp, "  rest = " .       ($rest      == 'true' ? 'true' : 'false') . "\n" );
  	fprintf ( $fp, "\n" );
  }
  

  
  function nextToken( $type, $k ) {
    global $tokens;
    do {
     $k++;
      if ($tokens[$k][0] == T_FUNCTION  || $tokens[$k][0] == T_CLASS ) {
        return '';
      }
    } while ( $k < count($tokens) && $tokens[$k][0] != $type );
    if ( isset($tokens[$k]) ) {
      return $tokens[$k][1];
    }
    else {
      return '';
    }
  }
  
  function previousToken( $type, $k ) {
    global $tokens;
    do {
      $k--;
      if ($tokens[$k][0] == T_FUNCTION || $tokens[$k][0] == T_CLASS ) {
        return '';
      }
    } while ( $k > 0 && $tokens[$k][0] != $type );

    if ( isset($tokens[$k]) ) {
      return $tokens[$k][1];
    }
    else {
      return '';
    }
  }
  
  
