<?php

//function glpi_savePHP2File( $tri_uid, $php_content, $force=false) {
//   $tmpfname = $_SERVER['DOCUMENT_ROOT']."/triggers/".$tri_uid.".php" ;
//   if( $force || !file_exists($tmpfname) ) {
//      $handle = fopen($tmpfname, "w+");
//      fwrite($handle, "<?php\n" . $php_content);
//      fclose($handle);
//   }
//   return $tmpfname ;
//}
///**
//* Summary of glpi_saveTrigger2File
//* @param mixed $tri_uid
//* @param mixed $tri_webbot
//*/
//function glpi_saveTrigger2File( $tri_uid, $tri_webbot)
//{
//   $sScript = "";
//   $aFields = [] ;
//   $iAux = 0;
//   $iOcurrences = preg_match_all( '/\@(?:([\@\%\#\?\$\=])([a-zA-Z\_]\w*)|([a-zA-Z\_][\w\-\>\:]*)\(((?:[^\\\\\)]' . '*(?:[\\\\][\w\W])?)*)\))((?:\s*\[[\'"]?\w+[\'"]?\])+)?/', $tri_webbot, $aMatch, PREG_PATTERN_ORDER | PREG_OFFSET_CAPTURE );
//   if ($iOcurrences) {
//      for ($i = 0; $i < $iOcurrences; $i ++) {
//            $bEqual = false;
//            $sAux = substr( $tri_webbot, $iAux, $aMatch[0][$i][1] - $iAux );
//            if (! $bEqual) {
//               if (strpos($sAux, "==") !== false || strpos($sAux, "!=") !== false || strpos($sAux, ">") !== false || strpos($sAux, "<") !== false || strpos($sAux, ">=") !== false || strpos($sAux, "<=") !== false || strpos($sAux, "<>") !== false || strpos($sAux, "===") !== false || strpos($sAux, "!==") !== false) {
//                  $bEqual = false;
//               } else {
//                  if (strpos($sAux, "=") !== false || strpos($sAux, "+=") !== false || strpos($sAux, "-=") !== false || strpos($sAux, "*=") !== false || strpos($sAux, "/=") !== false || strpos($sAux, "%=") !== false || strpos($sAux, ".=") !== false) {
//                        $bEqual = true;
//                  }
//               }
//            }
//            if ($bEqual) {
//               if (strpos( $sAux, ';' ) !== false) {
//                  $bEqual = false;
//               }
//            }
//            if ($bEqual) {
//               if (! isset( $aMatch[5][$i][0] )) {
//                  eval( "if (!isset(\$aFields['" . $aMatch[2][$i][0] . "'])) { \$aFields['" . $aMatch[2][$i][0] . "'] = null; }" );
//               } else {
//                  eval( "if (!isset(\$aFields" . (isset( $aMatch[2][$i][0] ) ? "['" . $aMatch[2][$i][0] . "']" : '') . $aMatch[5][$i][0] . ")) { \$aFields" . (isset( $aMatch[2][$i][0] ) ? "['" . $aMatch[2][$i][0] . "']" : '') . $aMatch[5][$i][0] . " = null; }" );
//               }
//            }
//            $sScript .= $sAux;
//            $iAux = $aMatch[0][$i][1] + strlen( $aMatch[0][$i][0] );
//            switch ($aMatch[1][$i][0]) {
//               case '@':
//                  if ($bEqual) {
//                        if (! isset( $aMatch[5][$i][0] )) {
//                           $sScript .= "pmToString(\$this->aFields['" . $aMatch[2][$i][0] . "'])";
//                        } else {
//                           $sScript .= "pmToString(\$this->aFields" . (isset( $aMatch[2][$i][0] ) ? "['" . $aMatch[2][$i][0] . "']" : '') . $aMatch[5][$i][0] . ")";
//                        }
//                  } else {
//                        if (! isset( $aMatch[5][$i][0] )) {
//                           $sScript .= "\$this->aFields['" . $aMatch[2][$i][0] . "']";
//                        } else {
//                           $sScript .= "\$this->aFields" . (isset( $aMatch[2][$i][0] ) ? "['" . $aMatch[2][$i][0] . "']" : '') . $aMatch[5][$i][0];
//                        }
//                  }
//                  break;
//               case '%':
//                  if ($bEqual) {
//                        if (! isset( $aMatch[5][$i][0] )) {
//                           $sScript .= "pmToInteger(\$this->aFields['" . $aMatch[2][$i][0] . "'])";
//                        } else {
//                           $sScript .= "pmToInteger(\$this->aFields" . (isset( $aMatch[2][$i][0] ) ? "['" . $aMatch[2][$i][0] . "']" : '') . $aMatch[5][$i][0] . ")";
//                        }
//                  } else {
//                        if (! isset( $aMatch[5][$i][0] )) {
//                           $sScript .= "\$this->aFields['" . $aMatch[2][$i][0] . "']";
//                        } else {
//                           $sScript .= "\$this->aFields" . (isset( $aMatch[2][$i][0] ) ? "['" . $aMatch[2][$i][0] . "']" : '') . $aMatch[5][$i][0];
//                        }
//                  }
//                  break;
//               case '#':
//                  if ($bEqual) {
//                        if (! isset( $aMatch[5][$i][0] )) {
//                           $sScript .= "pmToFloat(\$this->aFields['" . $aMatch[2][$i][0] . "'])";
//                        } else {
//                           $sScript .= "pmToFloat(\$this->aFields" . (isset( $aMatch[2][$i][0] ) ? "['" . $aMatch[2][$i][0] . "']" : '') . $aMatch[5][$i][0] . ")";
//                        }
//                  } else {
//                        if (! isset( $aMatch[5][$i][0] )) {
//                           $sScript .= "\$this->aFields['" . $aMatch[2][$i][0] . "']";
//                        } else {
//                           $sScript .= "\$this->aFields" . (isset( $aMatch[2][$i][0] ) ? "['" . $aMatch[2][$i][0] . "']" : '') . $aMatch[5][$i][0];
//                        }
//                  }
//                  break;
//               case '?':
//                  if ($bEqual) {
//                        if (! isset( $aMatch[5][$i][0] )) {
//                           $sScript .= "pmToUrl(\$this->aFields['" . $aMatch[2][$i][0] . "'])";
//                        } else {
//                           $sScript .= "pmToUrl(\$this->aFields" . (isset( $aMatch[2][$i][0] ) ? "['" . $aMatch[2][$i][0] . "']" : '') . $aMatch[5][$i][0] . ")";
//                        }
//                  } else {
//                        if (! isset( $aMatch[5][$i][0] )) {
//                           $sScript .= "\$this->aFields['" . $aMatch[2][$i][0] . "']";
//                        } else {
//                           $sScript .= "\$this->aFields" . (isset( $aMatch[2][$i][0] ) ? "['" . $aMatch[2][$i][0] . "']" : '') . $aMatch[5][$i][0];
//                        }
//                  }
//                  break;
//               case '$':
//                  if ($bEqual) {
//                        if (! isset( $aMatch[5][$i][0] )) {
//                           $sScript .= "pmSqlEscape(\$this->aFields['" . $aMatch[2][$i][0] . "'])";
//                        } else {
//                           $sScript .= "pmSqlEscape(\$this->aFields" . (isset( $aMatch[2][$i][0] ) ? "['" . $aMatch[2][$i][0] . "']" : '') . $aMatch[5][$i][0] . ")";
//                        }
//                  } else {
//                        if (! isset( $aMatch[5][$i][0] )) {
//                           $sScript .= "\$this->aFields['" . $aMatch[2][$i][0] . "']";
//                        } else {
//                           $sScript .= "\$this->aFields" . (isset( $aMatch[2][$i][0] ) ? "['" . $aMatch[2][$i][0] . "']" : '') . $aMatch[5][$i][0];
//                        }
//                  }
//                  break;
//               case '=':
//                  if ($bEqual) {
//                        if (! isset( $aMatch[5][$i][0] )) {
//                           $sScript .= "\$this->aFields['" . $aMatch[2][$i][0] . "']";
//                        } else {
//                           $sScript .= "\$this->aFields" . (isset( $aMatch[2][$i][0] ) ? "['" . $aMatch[2][$i][0] . "']" : '') . $aMatch[5][$i][0];
//                        }
//                  } else {
//                        if (! isset( $aMatch[5][$i][0] )) {
//                           $sScript .= "\$this->aFields['" . $aMatch[2][$i][0] . "']";
//                        } else {
//                           $sScript .= "\$this->aFields" . (isset( $aMatch[2][$i][0] ) ? "['" . $aMatch[2][$i][0] . "']" : '') . $aMatch[5][$i][0];
//                        }
//                  }
//                  break;
//            }
//            //$this->affected_fields[] = $aMatch[2][$i][0];
//      }
//   }
//   $sScript .= substr( $tri_webbot, $iAux );
//   $sScript = "try {\n" . $sScript . "\n} catch (Exception \$oException) {\n " . " \$this->aFields['__ERROR__'] = utf8_encode(\$oException->getMessage());\n}";
//   // saves trigger file into triggers folder
//   glpi_savePHP2File($tri_uid, $sScript, true ) ;
//}


/**
 * Summary of glpi_isHTML
 * @return boolean true if content-type is HTML
 */
function glpi_isHTML( ) {
   $needle = 'content-type' ;
   $type = 'text/html' ;
   foreach( headers_list() as $val ) {
      $parts = explode( ":", $val);
      if( strcasecmp( $parts[0], $needle ) == 0 ) {
         $subparts = explode( ";", $parts[1] ) ;
         if( strcasecmp( trim($subparts[0]), $type ) != 0 ){
            return false ;
         }
      }
   }
   return true ;
}

/**
 * Summary of glpi_ob_handler
 * returns output buffer with document.domain when needed
 * @param string $buffer
 * @return string
 */
function glpi_ob_handler( $buffer ){

   if (isset($_SERVER['HTTP_ORIGIN'])) {
      header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
      header("Access-Control-Allow-Credentials: true");
   }

   if (glpi_isHTML()) { // if payload is empty will pass and permit to manage glpi_init_case

      if (isset($_REQUEST['glpi_init_case']) && $_REQUEST['glpi_init_case'] == 1 && http_response_code() == 302) {
         // this is a workaround to be able to initialize properly SESSION variables to be able to view
         // pages that depend on SESSION variables
         // glpi_init_case is used only by a GET on /cases/cases_Open
         http_response_code(200);
         header_remove('Location');

         return $buffer; // $buffer is normally empty as when http_response_code == 302, there is no payload
      }

      if (preg_match("@/cases/cases_SaveData@", $_SERVER['REQUEST_URI']) && http_response_code() == 200 && strlen($buffer) > 0) {
         // there is a mix in process id
         // then propose a force reload
         $buffer .= "<script type='text/javascript'>
                        function glpi_forceReload() {
                           //debugger;
                           document.getElementById('form[MESSAGE]').value = 'GLPI_FORCE_RELOAD';
                           document.getElementById('form[MESSAGE]').id = 'GLPI_FORCE_RELOAD';
                        }
                     </script>";

         $buffer = preg_replace("@'https{0,1}://.*?'@i", "'javascript:glpi_forceReload();'", $buffer);

         return $buffer;
      }

      // to prevent error message about ProcessMaker existing in another tab
      setcookie("PM-TabPrimary", '101010010', time() + (24 * 60 * 60), '/');

      $matches = array();
      if( preg_match("/(?'start'.*?<script)(?'end'.*)/sm", $buffer,  $matches ) ) {
         $buffer = $matches['start']." type='text/javascript'>";

         $domain = $_SESSION['GLPI_DOMAIN'];
         // add our domain to script list
         if( $domain != '' ) {
            $buffer .= "document.domain='$domain';" ;
         }
         $buffer .= "</script>";

         // add default glpi_helpers.js
         $buffer .= "<script type='text/javascript' src='/glpi/glpi_helpers.js'></script>";

         // add some stuff to change CSS
         $buffer .= "<script type='text/javascript'>
            window.addEventListener('load',
               function() {
                  //debugger;
                  glpi.setClassAttribute( 'panel_modal___processmaker', 'background-color', 'rgb(170, 170, 170)') ;
                  glpi.setClassAttribute( 'panel_modal___processmaker', 'opacity', '0.3') ;
               }
            );
            </script>
         ";

         $buffer .= "<script ".$matches['end'];
      }
   }
   return $buffer;
}

/**
 * Summary of glpi_session_name
 * will prepare unique name for session
 * to prevent mix of sessions when used
 * in and out of GLPI
 * @return string the current skin
 */
function glpi_session_name() {

   ini_set("session.cookie_httponly", 1);

   if (isset($_SERVER['UNENCODED_URL'])) {
      $_SERVER['REQUEST_URI'] = $_SERVER['UNENCODED_URL'];
   }

   $rootDir = realpath(__DIR__ . "/../../") . DIRECTORY_SEPARATOR;

   $addToSessionRegEx = '@^(https{0,1}://[^/]+){0,1}/sys[^/]*/[^/]+/([^/]+)/@i' ;
   $addToSessionRegEx2 = '@^/sys[^/]*/[^/]+/([^/]+)/@i' ;
   if( !isset( $_SERVER['HTTP_REFERER'] ) || preg_match($addToSessionRegEx,  $_SERVER['HTTP_REFERER'], $matches) == 0 ) {
      preg_match($addToSessionRegEx2,  $_SERVER['REQUEST_URI'], $matches) ;
   }

   $skin=array_pop($matches);

   session_name("pm_".md5($rootDir)."_".$skin) ;

   return $skin ;
}

// is called by GLPI?
if( stripos( glpi_session_name(), 'glpi_' ) === 0 ) {
   // we have been called by GLPI
   ob_start( "glpi_ob_handler" ) ;
   ob_start( "glpi_ob_handler" ) ; // seems like there are too much ob_clean() in PM source code

   if (preg_match("@/cases/casesListExtJs@i", $_SERVER['REQUEST_URI'])) {
      session_start(); // start session to be able to get glpi_domain in the ob end handler
      // we have been called by GLPI AND URL is cases/caseslist_Ajax
      // then must reload GLPI page in order to prevent case list to be shown
      echo "<html><body><script>";
      echo "</script><input id='GLPI_FORCE_RELOAD' type='hidden' value='GLPI_FORCE_RELOAD'/></body></html>";
      die();
   }

   if( isset($_SERVER['HTTP_REFERER'])
      && preg_match("@/designer@i", $_SERVER['HTTP_REFERER'])
      && $_SERVER['REQUEST_METHOD'] == 'PUT') {
      // then must cancel this PUT call
      // to prevent saving of the map with extra text
      die();
   }
}

// clean session of _DBArray availableUsers record
session_start();
if( isset( $_SERVER['HTTP_REFERER'] ) && preg_match( "@/cases/main_init$@i", $_SERVER['HTTP_REFERER'] ) ) {
   unset($_SESSION['_DBArray']['availableUsers']);
}
// if glpi_domain is available, then set it into the current session
// to be available into glpi_ob_handler
if (isset($_REQUEST['glpi_domain'])) {
   $_SESSION['GLPI_DOMAIN'] = $_REQUEST['glpi_domain'];
}

session_write_close();
// back to PM normal app.php
include '../app.php' ;