<?php
/**
 * main.php Cases List main processor
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
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * For more information, contact Colosa Inc, 2566 Le Jeune Rd.,
 * Coral Gables, FL, 33134, USA, or email info@colosa.com.
 */

use ProcessMaker\Plugins\PluginRegistry;

/** @var RBAC $RBAC */
global $RBAC;
$RBAC->requirePermissions('PM_SETUP');

$headPublisher = headPublisher::getSingleton();
$headPublisher->addExtJsScript('setup/pluginsMain', false);
$headPublisher->assign("PROCESSMAKER_URL", "/sys" . config("system.workspace") . "/" . SYS_LANG . "/" . SYS_SKIN);
$headPublisher->assign("SYS_SKIN", SYS_SKIN);

$oPluginRegistry = PluginRegistry::loadSingleton();
if ($oPluginRegistry->getStatusPlugin('pmWorkspaceManagement') && $oPluginRegistry->getStatusPlugin('pmWorkspaceManagement') == "enabled") {
    $headPublisher = $oPluginRegistry->executeMethod('pmWorkspaceManagement', 'disableButtonsPluginMain',
        $headPublisher);
}

if (isset($_SESSION['__PLUGIN_ERROR__'])) {
    $headPublisher->assign('__PLUGIN_ERROR__', $_SESSION['__PLUGIN_ERROR__']);
    unset($_SESSION['__PLUGIN_ERROR__']);
}
G::RenderPage('publish', 'extJs');