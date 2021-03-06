<?php
/**
 * roleNew2.php
 *  
 * ProcessMaker Open Source Edition
 * Copyright (C) 2004 - 2008 Colosa Inc.23
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 
 * For more information, contact Colosa Inc, 2566 Le Jeune Rd., 
 * Coral Gables, FL, 33134, USA, or email info@colosa.com.
 * 
 */

$frm = $_POST['form'];

$dbc = new DBConnection(DB_HOST, DB_RBAC_USER, DB_RBAC_PASS, DB_RBAC_NAME );


$parent  = $_SESSION['CURRENT_ROLE_PARENT'];
$appid   = $_SESSION['CURRENT_APPLICATION'];
$code    = strtoupper( $frm['ROL_CODE']);
$descrip = $frm['ROL_DESCRIPTION'];

//crear nuevo ROL
G::LoadClassRBAC ( "roles");
$obj = new RBAC_Role;
$obj->SetTo( $dbc );
$res = $obj->roleCodeRepetido( $code );
if ($res != 0 ) {
  G::SendMessage (14, "error");
  header ("location: roleList.php");
  die;
}

$uid = $obj->createRole( $parent, $appid, $code , $descrip );
header( "location: roleList.html" );
?>
