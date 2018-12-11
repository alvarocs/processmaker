<?php

 class chartsPlugin extends PMPlugin
 {
     public function chartsPlugin($sNamespace, $sFilename = null)
     {
         $res = parent::PMPlugin($sNamespace, $sFilename);
         $this->sFriendlyName = 'Charts Plugin';
         $this->sDescription  = 'This plugin shows generic charts for ProcessMaker';
         $this->sPluginFolder = 'charts';
         $this->sSetupPage    = 'setupPage';
         $this->aWorkspaces = array(  );
         $this->iVersion = 0.45;
         $this->bPrivate = true;
         return $res;
     }

     public function setup()
     {
         $this->registerTrigger(10000, 'createCaseFolder');
     }

     public function install()
     {
     }
 }

 $oPluginRegistry = PMPluginRegistry::getSingleton();
 $oPluginRegistry->registerPlugin('charts', __FILE__);
