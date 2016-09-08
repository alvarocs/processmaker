<?php

//calculating the max upload file size;

$POST_MAX_SIZE = ini_get( 'post_max_size' );

$mul = substr( $POST_MAX_SIZE, - 1 );

$mul = ($mul == 'M' ? 1048576 : ($mul == 'K' ? 1024 : ($mul == 'G' ? 1073741824 : 1)));

$postMaxSize = (int) $POST_MAX_SIZE * $mul;



$UPLOAD_MAX_SIZE = ini_get( 'upload_max_filesize' );

$mul = substr( $UPLOAD_MAX_SIZE, - 1 );

$mul = ($mul == 'M' ? 1048576 : ($mul == 'K' ? 1024 : ($mul == 'G' ? 1073741824 : 1)));

$uploadMaxSize = (int) $UPLOAD_MAX_SIZE * $mul;



if ($postMaxSize < $uploadMaxSize) {

    $uploadMaxSize = $postMaxSize;

}

$languageManagement = 0;

/*----------------------------------********---------------------------------*/



$arraySystemConfiguration = System::getSystemConfiguration('', '', SYS_SYS);



$oHeadPublisher = & headPublisher::getSingleton();

$oHeadPublisher->addExtJsScript( 'users/users', true ); //adding a javascript file .js

$oHeadPublisher->assign( 'USR_UID', $_GET['USR_UID'] );

$oHeadPublisher->assign( 'MODE', $_GET['MODE'] );

$oHeadPublisher->assign( 'MAX_FILES_SIZE', ' (' . $UPLOAD_MAX_SIZE . ') ' );

$oHeadPublisher->assign('SYSTEM_TIME_ZONE', $arraySystemConfiguration['time_zone']);

$oHeadPublisher->assign('TIME_ZONE_DATA', array_map(function ($value) { return [$value, $value]; }, DateTimeZone::listIdentifiers()));

$oHeadPublisher->assign('__SYSTEM_UTC_TIME_ZONE__', (isset($_SESSION['__SYSTEM_UTC_TIME_ZONE__']) && $_SESSION['__SYSTEM_UTC_TIME_ZONE__'])? 1 : 0);

$oHeadPublisher->assign('LANGUAGE_MANAGEMENT', $languageManagement);



G::RenderPage( 'publish', 'extJs' );


