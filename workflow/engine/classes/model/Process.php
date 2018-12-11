<?php

class Process extends BaseProcess
{
    /**
     * This value goes in the content table
     *
     * @var string
     */
    protected $pro_title_content = '';
    public $dir = 'ASC';
    public $sort = 'PRO_TITLE';

    /**
     * Get the [Pro_title] column value.
     *
     * @return string
     */
    public function getProTitleContent()
    {
        if ($this->getProUid() == '') {
            throw (new Exception("Error in getProTitle, the PRO_UID can't be blank"));
        }
        $lang = defined('SYS_LANG') ? SYS_LANG : 'en';
        $this->pro_title_content = Content::load('PRO_TITLE', '', $this->getProUid(), $lang);
        return $this->pro_title_content;
    }

    /**
     * Set the [Pro_title] column value.
     *
     * @param string $v new value
     * @return void
     */
    public function setProTitleContent($v)
    {
        if ($this->getProUid() == '') {
            throw (new Exception("Error in setProTitle, the PRO_UID can't be blank" . print_r(debug_backtrace(), 1)));
        }
        // Since the native PHP type for this column is string,
        // we will cast the input to a string (if it is not).
        if ($v !== null && ! is_string($v)) {
            $v = (string) $v;
        }

        if (in_array(ProcessPeer::PRO_TITLE, $this->modifiedColumns) || $v === '') {
            $this->pro_title_content = $v;
            $lang = defined('SYS_LANG') ? SYS_LANG : 'en';

            $res = Content::addContent('PRO_TITLE', '', $this->getProUid(), $lang, $this->pro_title_content);
        }
    } // set()


    /**
     * This value goes in the content table
     *
     * @var string
     */
    protected $pro_description_content = '';

    /**
     * Get the [Pro_description] column value.
     *
     * @return string
     */
    public function getProDescriptionContent()
    {
        if ($this->getProUid() == '') {
            throw (new Exception("Error in getProDescription, the PRO_UID can't be blank"));
        }
        $lang = defined('SYS_LANG') ? SYS_LANG : 'en';
        $this->pro_description_content = Content::load('PRO_DESCRIPTION', '', $this->getProUid(), $lang);
        return $this->pro_description_content;
    }

    /**
     * Set the [Pro_description] column value.
     *
     * @param string $v new value
     * @return void
     */
    public function setProDescriptionContent($v)
    {
        if ($this->getProUid() == '') {
            throw (new Exception("Error in setProDescription, the PRO_UID can't be blank"));
        }
        // Since the native PHP type for this column is string,
        // we will cast the input to a string (if it is not).
        if ($v !== null && ! is_string($v)) {
            $v = (string) $v;
        }

        if (in_array(ProcessPeer::PRO_DESCRIPTION, $this->modifiedColumns) || $v === '') {
            $this->pro_description_content = $v;
            $lang = defined('SYS_LANG') ? SYS_LANG : 'en';

            $res = Content::addContent('PRO_DESCRIPTION', '', $this->getProUid(), $lang, $this->pro_description_content);
        }
    } // set()


    /**
     * Creates the Process
     *
     * @param array $aData Fields with :
     * $aData['PRO_UID'] the process id
     * $aData['USR_UID'] the userid
     * $aData['PRO_CATEGORY'] the id category
     * @return string
     */

    public function create($aData, $generateUid = true)
    {
        if (! isset($aData['USR_UID'])) {
            throw (new PropelException('The process cannot be created. The USR_UID is empty.'));
        }
        $con = Propel::getConnection(ProcessPeer::DATABASE_NAME);
        try {
            if ($generateUid) {
                do {
                    $sNewProUid = G::generateUniqueID();
                } while ($this->processExists($sNewProUid));
            } else {
                $sNewProUid = $aData['PRO_UID'];
                if (!empty($aData['PRO_ID'])) {
                    $this->setProId($aData['PRO_ID']);
                }
            }

            $this->setProUid($sNewProUid);
            $this->setProTitle((isset($aData['PRO_TITLE'])) ? $aData['PRO_TITLE'] : 'Default Process Title');
            $this->setProDescription((isset($aData['PRO_DESCRIPTION'])) ? $aData['PRO_DESCRIPTION'] : 'Default Process Description');
            $this->setProParent($sNewProUid);
            $this->setProTime(1);
            $this->setProTimeunit('DAYS');
            $this->setProStatus((isset($aData["PRO_STATUS"])) ? $aData["PRO_STATUS"] : 'ACTIVE');
            $this->setProTypeDay('');
            $this->setProType((isset($aData["PRO_TYPE"]))? $aData["PRO_TYPE"]: "NORMAL");
            $this->setProAssignment('FALSE');
            $this->setProShowMap('');
            $this->setProShowMessage('');
            $this->setProShowDelegate('');
            $this->setProShowDynaform('');
            $this->setProCategory((isset($aData["PRO_CATEGORY"]))? $aData["PRO_CATEGORY"]: "");
            $this->setProSubCategory('');
            $this->setProIndustry('');
            $this->setProCreateDate(date("Y-m-d H:i:s"));
            $this->setProCreateUser($aData['USR_UID']);
            $this->setProHeight(5000);
            $this->setProWidth(10000);
            $this->setProTitleX(0);
            $this->setProTitleY(0);
            $this->setProItee(1);
            $this->setProDynaforms(isset($aData['PRO_DYNAFORMS']) ? (is_array($aData['PRO_DYNAFORMS']) ? serialize($aData['PRO_DYNAFORMS']) : $aData['PRO_DYNAFORMS']) : '');

            if ($this->validate()) {
                $con->begin();

                if (isset($aData['PRO_TITLE'])) {
                    $this->setProTitleContent($aData['PRO_TITLE']);
                } else {
                    $this->setProTitleContent('Default Process Title');
                }

                if (isset($aData['PRO_DESCRIPTION'])) {
                    $this->setProDescriptionContent($aData['PRO_DESCRIPTION']);
                } else {
                    $this->setProDescriptionContent('Default Process Description');
                }

                $res = $this->save();
                $con->commit();

                $this->memcachedDelete();

                return $this->getProUid();
            } else {
                $msg = '';
                foreach ($this->getValidationFailures() as $objValidationFailure) {
                    $msg .= $objValidationFailure->getMessage() . "<br/>";
                }
                throw (new PropelException('The row cannot be created!', new PropelException($msg)));
            }
        } catch (Exception $e) {
            $con->rollback();
            throw ($e);
        }
    }

    /**
     * verify if Process row specified in [pro_id] exists.
     *
     * @param string $sProUid the uid of the Prolication
     */
    public function processExists($ProUid)
    {
        $con = Propel::getConnection(ProcessPeer::DATABASE_NAME);
        try {
            $oPro = ProcessPeer::retrieveByPk($ProUid);
            if (is_object($oPro) && get_class($oPro) == 'Process') {
                return true;
            } else {
                return false;
            }
        } catch (Exception $oError) {
            throw ($oError);
        }
    }

    /**
     * Load the Process row specified in [pro_id] column value.
     *
     * @param string $ProUid the uid of the Prolication
     * @return array $Fields the fields
     */
    public function load($ProUid, $getAllLang = false)
    {
        $con = Propel::getConnection(ProcessPeer::DATABASE_NAME);
        try {
            $oPro = ProcessPeer::retrieveByPk($ProUid);
            if (is_object($oPro) && get_class($oPro) == 'Process') {
                $aFields = $oPro->toArray(BasePeer::TYPE_FIELDNAME);
                $this->fromArray($aFields, BasePeer::TYPE_FIELDNAME);
                //optimized to avoid double and multiple execution of the same query
                //        $aFields['PRO_TITLE']       = $oPro->getProTitle();
                //        $aFields['PRO_DESCRIPTION'] = $oPro->getProDescription();
                //        $this->pro_title = $aFields['PRO_TITLE'];
                //        $this->pro_description = $aFields['PRO_DESCRIPTION'];

                //the following code is to copy the parent in old process, when the parent was empty.
                if ($oPro->getProParent() == '') {
                    $oPro->setProParent($oPro->getProUid());
                    $oPro->save();
                }

                //Get category Name, by default No category
                $aFields['PRO_CATEGORY_LABEL'] = G::LoadTranslation("ID_PROCESS_NO_CATEGORY");
                if ($aFields['PRO_CATEGORY'] != "") {
                    $oProCat = ProcessCategoryPeer::retrieveByPk($aFields['PRO_CATEGORY']);
                    if (is_object($oProCat) && get_class($oProCat) == 'ProcessCategory') {
                        $aFields['PRO_CATEGORY_LABEL'] = $oProCat->getCategoryName();
                    }
                }

                $aFields['PRO_DYNAFORMS'] = @unserialize($aFields['PRO_DYNAFORMS']);
                //Check if is BPMN process
                $aFields['PRO_BPMN'] = $this->isBpmnProcess($ProUid);

                return $aFields;
            } else {
                throw (new Exception("The row '$ProUid' in table Process doesn't exist!"));
            }
        } catch (Exception $oError) {
            throw ($oError);
        }
    }

    public function getAll()
    {
        $oCriteria = new Criteria('workflow');

        $oCriteria->addSelectColumn(ProcessPeer::PRO_UID);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_TITLE);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_DESCRIPTION);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_PARENT);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_STATUS);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_CATEGORY);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_CREATE_DATE);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_CREATE_USER);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_DEBUG);

        $oCriteria->add(ProcessPeer::PRO_UID, '', Criteria::NOT_EQUAL);
        $oCriteria->add(ProcessPeer::PRO_STATUS, 'DISABLED', Criteria::NOT_EQUAL);

        //execute the query
        $oDataset = ProcessPeer::doSelectRS($oCriteria, Propel::getDbConnection('workflow_ro'));
        $oDataset->setFetchmode(ResultSet::FETCHMODE_ASSOC);
        $processes = array();
        $uids = array();
        while ($oDataset->next()) {
            $row = $oDataset->getRow();

            $processes[] = $row;
            $uids[] = $processes[sizeof($processes) - 1]['PRO_UID'];
        }

        $oConf = new Configurations();
        $oConf->loadConfig($obj, 'ENVIRONMENT_SETTINGS', '');

        if ($this->dir=='ASC') {
            usort($processes, array($this, "ordProcessAsc"));
        } else {
            usort($processes, array($this, "ordProcessDesc"));
        }

        return $processes;
    }

    /**
     * Update the Prolication row
     *
     * @param array $aData
     * @return variant
     *
     */
    public function update($aData)
    {
        if (isset($aData['PRO_DYNAFORMS']) && is_array($aData['PRO_DYNAFORMS'])) {
            $aData['PRO_DYNAFORMS'] = @serialize($aData['PRO_DYNAFORMS']);
        }

        $con = Propel::getConnection(ProcessPeer::DATABASE_NAME);
        try {
            $con->begin();
            $oPro = ProcessPeer::retrieveByPK($aData['PRO_UID']);
            if (is_object($oPro) && get_class($oPro) == 'Process') {
                $oPro->fromArray($aData, BasePeer::TYPE_FIELDNAME);
                if ($oPro->validate()) {
                    if (isset($aData['PRO_TITLE'])) {
                        $oPro->setProTitleContent($aData['PRO_TITLE']);
                    }
                    if (isset($aData['PRO_DESCRIPTION'])) {
                        $oPro->setProDescriptionContent($aData['PRO_DESCRIPTION']);
                    }
                    $res = $oPro->save();
                    $con->commit();

                    $this->memcachedDelete();

                    return $res;
                } else {
                    $msg = '';
                    foreach ($oPro->getValidationFailures() as $objValidationFailure) {
                        $msg .= $objValidationFailure->getMessage() . "<br/>";
                    }

                    throw (new Exception('The row cannot be updated!' . $msg));
                }
            } else {
                $con->rollback();
                throw (new Exception("The row '" . $aData['PRO_UID'] . "' in table Process doesn't exist!"));
            }
        } catch (Exception $oError) {
            throw ($oError);
        }
    }

    /**
     * creates an Application row
     *
     * @param array $aData
     * @return variant
     *
     */
    public function createRow($aData)
    {
        $con = Propel::getConnection(ProcessPeer::DATABASE_NAME);
        //$con->begin(); //does not allow dual BEGIN
        $this->setProUid($aData['PRO_UID']);
        $this->setProTitle((isset($aData['PRO_TITLE'])) ? $aData['PRO_TITLE'] : 'Default Process Title');
        $this->setProDescription((isset($aData['PRO_DESCRIPTION'])) ? $aData['PRO_DESCRIPTION'] : 'Default Process Description');
        $this->setProParent($aData['PRO_PARENT']);
        $this->setProTime($aData['PRO_TIME']);
        $this->setProTimeunit($aData['PRO_TIMEUNIT']);
        $this->setProStatus($aData['PRO_STATUS']);
        $this->setProTypeDay($aData['PRO_TYPE_DAY']);
        $this->setProType($aData['PRO_TYPE']);
        $this->setProAssignment($aData['PRO_ASSIGNMENT']);
        $this->setProShowMap($aData['PRO_SHOW_MAP']);
        $this->setProShowMessage($aData['PRO_SHOW_MESSAGE']);
        $this->setProSubprocess(isset($aData['PRO_SUBPROCESS']) ? $aData['PRO_SUBPROCESS'] : '');
        $this->setProTriDeleted(isset($aData['PRO_TRI_DELETED']) ? $aData['PRO_TRI_DELETED'] : '');
        $this->setProTriCanceled(isset($aData['PRO_TRI_CANCELED']) ? $aData['PRO_TRI_CANCELED'] : '');
        $this->setProTriPaused(isset($aData['PRO_TRI_PAUSED']) ? $aData['PRO_TRI_PAUSED'] : '');
        $this->setProTriReassigned(isset($aData['PRO_TRI_REASSIGNED']) ? $aData['PRO_TRI_REASSIGNED'] : '');
        $this->setProTriUnpaused(isset($aData['PRO_TRI_UNPAUSED']) ? $aData['PRO_TRI_UNPAUSED'] : '');
        $this->setProShowDelegate($aData['PRO_SHOW_DELEGATE']);
        $this->setProShowDynaform($aData['PRO_SHOW_DYNAFORM']);
        $this->setProDerivationScreenTpl(isset($aData['PRO_DERIVATION_SCREEN_TPL']) ? $aData['PRO_DERIVATION_SCREEN_TPL'] : '');

        // validate if the category exists
        $criteria = new Criteria('workflow');
        $criteria->add(ProcessCategoryPeer::CATEGORY_UID, $aData['PRO_CATEGORY']);
        $ds = ProcessCategoryPeer::doSelectRS($criteria, Propel::getDbConnection('workflow_ro'));
        $ds->setFetchmode(ResultSet::FETCHMODE_ASSOC);
        $ds->next();
        // if it is not set, set value as empty "No Category"
        if (! $ds->getRow()) {
            $aData['PRO_CATEGORY'] = '';
        }

        $this->setProCategory($aData['PRO_CATEGORY']);
        $this->setProSubCategory($aData['PRO_SUB_CATEGORY']);
        $this->setProIndustry($aData['PRO_INDUSTRY']);
        $this->setProCreateDate($aData['PRO_CREATE_DATE']);
        $this->setProCreateUser($aData['PRO_CREATE_USER']);
        $this->setProHeight($aData['PRO_HEIGHT']);
        $this->setProWidth($aData['PRO_WIDTH']);
        $this->setProTitleX($aData['PRO_TITLE_X']);
        $this->setProTitleY($aData['PRO_TITLE_Y']);
        $this->setProDynaforms(isset($aData['PRO_DYNAFORMS']) ? (is_array($aData['PRO_DYNAFORMS']) ? serialize($aData['PRO_DYNAFORMS']) : $aData['PRO_DYNAFORMS']) : '');
        if ($this->validate()) {
            $con->begin();

            if (isset($aData['PRO_TITLE']) && trim($aData['PRO_TITLE']) != '') {
                $this->setProTitleContent($aData['PRO_TITLE']);
            } else {
                $this->setProTitleContent('Default Process Title');
            }
            if (isset($aData['PRO_DESCRIPTION'])) {
                $this->setProDescriptionContent($aData['PRO_DESCRIPTION']);
            } else {
                $this->setProDescriptionContent('Default Process Description');
            }

            $res = $this->save();
            $con->commit();

            $this->memcachedDelete();

            return $this->getProUid();
        } else {
            $msg = '';
            foreach ($this->getValidationFailures() as $objValidationFailure) {
                $msg .= $objValidationFailure->getMessage() . "<br/>";
            }

            throw (new PropelException('The row cannot be created!', new PropelException($msg)));
        }
    }

    /**
     * Remove the Prolication document registry
     *
     * @param array $aData or string $ProUid
     * @return string
     *
     */
    public function remove($ProUid)
    {
        if (is_array($ProUid)) {
            $ProUid = (isset($ProUid['PRO_UID']) ? $ProUid['PRO_UID'] : '');
        }
        try {
            $oPro = ProcessPeer::retrieveByPK($ProUid);
            if (! is_null($oPro)) {
                Content::removeContent('PRO_TITLE', '', $oPro->getProUid());
                Content::removeContent('PRO_DESCRIPTION', '', $oPro->getProUid());
                $this->memcachedDelete();
                return $oPro->delete();
            } else {
                throw (new Exception("The row '$ProUid' in table Process doesn't exist!"));
            }
        } catch (Exception $oError) {
            throw ($oError);
        }
    }

    public function exists($ProUid)
    {
        $oPro = ProcessPeer::retrieveByPk($ProUid);
        return (is_object($oPro) && get_class($oPro) == 'Process');
    }

    /**
     * @param $proTitle
     * @return bool
     * @throws PropelException
     */
    public static function existsByProTitle($proTitle)
    {
        $oCriteria = new Criteria("workflow");
        $oCriteria->addSelectColumn(ProcessPeer::PRO_TITLE);
        $oCriteria->add(ProcessPeer::PRO_TITLE, $proTitle);
        $oDataset = ProcessPeer::doSelectRS($oCriteria, Propel::getDbConnection('workflow_ro'));
        $oDataset->setFetchmode(ResultSet::FETCHMODE_ASSOC);
        $oDataset->next();
        $aRow = $oDataset->getRow();
        return ($aRow) ? true : false;
    }

    public static function getByProTitle($proTitle)
    {
        $oCriteria = new Criteria("workflow");
        $oCriteria->add(ProcessPeer::PRO_TITLE, $proTitle);
        $oDataset = ProcessPeer::doSelectRS($oCriteria, Propel::getDbConnection('workflow_ro'));
        $oDataset->setFetchmode(ResultSet::FETCHMODE_ASSOC);
        $oDataset->next();
        $aRow = $oDataset->getRow();
        return isset($aRow) ? $aRow : null;
    }

    public static function getNextTitle($proTitle)
    {
        $oCriteria = new Criteria('workflow');
        $oCriteria->addSelectColumn(ProcessPeer::PRO_TITLE);
        $oCriteria->add(ProcessPeer::PRO_TITLE, $proTitle . '-%', Criteria::LIKE);
        $oCriteria->addAscendingOrderByColumn(ProcessPeer::PRO_TITLE);
        $oDataset = ProcessPeer::doSelectRS($oCriteria, Propel::getDbConnection('workflow_ro'));
        $oDataset->setFetchmode(ResultSet::FETCHMODE_ASSOC);
        $data = array();
        $may = 0;
        while ($oDataset->next()) {
            $row = $oDataset->getRow();
            $number = explode("-", $row["PRO_TITLE"]);
            $number = $number[count($number) - 1] + 0;
            if ($number > $may) {
                $may = $number;
            }
            $row["PRO_TITLE"] = $number;
            $data[] = $row;
        }
        return $proTitle . "-" . ($may + 1);
    }

    public function getAllProcessesCount()
    {
        $c = $this->tmpCriteria;
        $c->clearSelectColumns();
        $c->addSelectColumn('COUNT(*)');
        $oDataset = ProcessPeer::doSelectRS($c, Propel::getDbConnection('workflow_ro'));
        $oDataset->next();
        $aRow = $oDataset->getRow();

        if (is_array($aRow)) {
            return $aRow[0];
        } else {
            return 0;
        }
    }

    public function getAllProcesses($start, $limit, $category = null, $processName = null, $counters = true, $reviewSubProcess = false, $userLogged = "")
    {
        require_once PATH_RBAC . "model/RbacUsers.php";
        require_once "classes/model/ProcessCategory.php";
        require_once "classes/model/Users.php";

        $user = new RbacUsers();
        $aProcesses = array();
        $categories = array();
        $oCriteria = new Criteria('workflow');

        $oCriteria->addSelectColumn(ProcessPeer::PRO_UID);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_TITLE);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_DESCRIPTION);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_PARENT);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_STATUS);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_TYPE);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_CATEGORY);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_UPDATE_DATE);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_CREATE_DATE);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_CREATE_USER);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_DEBUG);
        $oCriteria->addSelectColumn(ProcessPeer::PRO_TYPE_PROCESS);

        $oCriteria->addSelectColumn(UsersPeer::USR_UID);
        $oCriteria->addSelectColumn(UsersPeer::USR_USERNAME);
        $oCriteria->addSelectColumn(UsersPeer::USR_FIRSTNAME);
        $oCriteria->addSelectColumn(UsersPeer::USR_LASTNAME);

        $oCriteria->addSelectColumn(ProcessCategoryPeer::CATEGORY_UID);
        $oCriteria->addSelectColumn(ProcessCategoryPeer::CATEGORY_NAME);

        $oCriteria->add(ProcessPeer::PRO_UID, '', Criteria::NOT_EQUAL);
        $oCriteria->add(ProcessPeer::PRO_STATUS, 'DISABLED', Criteria::NOT_EQUAL);
        if ($reviewSubProcess) {
            $oCriteria->add(ProcessPeer::PRO_SUBPROCESS, '1', Criteria::NOT_EQUAL);
        }

        if (isset($category)) {
            $oCriteria->add(ProcessPeer::PRO_CATEGORY, $category, Criteria::EQUAL);
        }

        $oCriteria->addJoin(ProcessPeer::PRO_CREATE_USER, UsersPeer::USR_UID, Criteria::LEFT_JOIN);
        $oCriteria->addJoin(ProcessPeer::PRO_CATEGORY, ProcessCategoryPeer::CATEGORY_UID, Criteria::LEFT_JOIN);

        if ($this->sort == "PRO_CREATE_DATE") {
            if ($this->dir == "DESC") {
                $oCriteria->addDescendingOrderByColumn(ProcessPeer::PRO_CREATE_DATE);
            } else {
                $oCriteria->addAscendingOrderByColumn(ProcessPeer::PRO_CREATE_DATE);
            }
        }

        if ($userLogged != "") {
            $oCriteria->add(
                $oCriteria->getNewCriterion(ProcessPeer::PRO_TYPE_PROCESS, "PUBLIC", Criteria::EQUAL)->addOr(
                $oCriteria->getNewCriterion(ProcessPeer::PRO_CREATE_USER, $userLogged, Criteria::EQUAL)
                )
            );
        }

        $this->tmpCriteria = clone $oCriteria;

        //execute a query to obtain numbers, how many cases there are by process
        if ($counters) {
            $casesCnt = $this->getCasesCountInAllProcesses();
        }

        // getting bpmn projects
        $c = new Criteria('workflow');
        $c->addSelectColumn(BpmnProjectPeer::PRJ_UID);
        $ds = ProcessPeer::doSelectRS($c, Propel::getDbConnection('workflow_ro'));
        $ds->setFetchmode(ResultSet::FETCHMODE_ASSOC);
        $bpmnProjects = array();

        while ($ds->next()) {
            $row = $ds->getRow();
            $bpmnProjects[] = $row['PRJ_UID'];
        }

        //execute the query
        $oDataset = ProcessPeer::doSelectRS($oCriteria);
        $oDataset->setFetchmode(ResultSet::FETCHMODE_ASSOC);
        $processes = array();
        $uids = array();
        while ($oDataset->next()) {
            $row = $oDataset->getRow();

            $row["PROJECT_TYPE"] = ($row["PRO_TYPE"] == "NORMAL")? ((in_array($row["PRO_UID"], $bpmnProjects))? "bpmn" : "classic") : $row["PRO_TYPE"];

            $processes[] = $row;
            $uids[] = $processes[sizeof($processes) - 1]['PRO_UID'];
        }

        $oConf = new Configurations();
        $oConf->loadConfig($obj, 'ENVIRONMENT_SETTINGS', '');

        foreach ($processes as $process) {
            $proTitle = isset($process['PRO_TITLE'])? $process['PRO_TITLE'] : '';
            $proDescription = isset($process['PRO_DESCRIPTION']) ? htmlspecialchars($process['PRO_DESCRIPTION']) : '';
            $process["PRO_TYPE_PROCESS"] = ($process["PRO_TYPE_PROCESS"] == "PUBLIC") ? G::LoadTranslation("ID_PUBLIC") : G::LoadTranslation("ID_PRIVATE");
            // verify if the title is already set on the current language
            if (trim($proTitle) == '') {
                // if not, then load the record to generate content for current language
                $proData = $this->load($process['PRO_UID']);
                $proTitle = $proData['PRO_TITLE'];
                $proDescription = htmlspecialchars($proData['PRO_DESCRIPTION']);
            }

            //filtering by $processName
            if (isset($processName) && $processName != '' && stripos($proTitle, $processName) === false) {
                continue;
            }

            if ($counters) {
                $casesCountTotal = 0;
                if (isset($casesCnt[$process['PRO_UID']])) {
                    foreach ($casesCnt[$process['PRO_UID']] as $item) {
                        $casesCountTotal += $item;
                    }
                }
            }

            //get user format from configuration
            $userOwner = isset($oConf->aConfig['format']) ? $oConf->aConfig['format'] : '';
            $creationDateMask = isset($oConf->aConfig['dateFormat']) ? $oConf->aConfig['dateFormat'] : '';
            if ($userOwner != '') {
                $userOwner = str_replace('@userName', $process['USR_USERNAME'], $userOwner);
                $userOwner = str_replace('@firstName', $process['USR_FIRSTNAME'], $userOwner);
                $userOwner = str_replace('@lastName', $process['USR_LASTNAME'], $userOwner);
                if ($userOwner == " ( )") {
                    $userOwner = '-';
                }
            } else {
                $userOwner = $process['USR_FIRSTNAME'] . ' ' . $process['USR_LASTNAME'];
            }

            //get date format from configuration
            if ($creationDateMask != '') {
                list($date, $time) = explode(' ', $process['PRO_CREATE_DATE']);
                list($y, $m, $d) = explode('-', $date);
                list($h, $i, $s) = explode(':', $time);

                $process['PRO_CREATE_DATE'] = date($creationDateMask, mktime($h, $i, $s, $m, $d, $y));
            }

            $process['PRO_CATEGORY_LABEL'] = trim($process['PRO_CATEGORY']) != '' ? $process['CATEGORY_NAME'] : '- ' . G::LoadTranslation('ID_PROCESS_NO_CATEGORY') . ' -';
            $process['PRO_TITLE'] = $proTitle;
            $process['PRO_DESCRIPTION'] = $proDescription;
            $process['PRO_DEBUG'] = $process['PRO_DEBUG'];
            $process['PRO_DEBUG_LABEL'] = ($process['PRO_DEBUG'] == "1") ? G::LoadTranslation('ID_ON') : G::LoadTranslation('ID_OFF');
            $process['PRO_STATUS_LABEL'] = $process['PRO_STATUS'] == 'ACTIVE' ? G::LoadTranslation('ID_ACTIVE') : G::LoadTranslation('ID_INACTIVE');
            $process['PRO_CREATE_USER_LABEL'] = $userOwner;
            if ($counters) {
                $process['CASES_COUNT_TO_DO'] = (isset($casesCnt[$process['PRO_UID']]['TO_DO']) ? $casesCnt[$process['PRO_UID']]['TO_DO'] : 0);
                $process['CASES_COUNT_COMPLETED'] = (isset($casesCnt[$process['PRO_UID']]['COMPLETED']) ? $casesCnt[$process['PRO_UID']]['COMPLETED'] : 0);
                $process['CASES_COUNT_DRAFT'] = (isset($casesCnt[$process['PRO_UID']]['DRAFT']) ? $casesCnt[$process['PRO_UID']]['DRAFT'] : 0);
                $process['CASES_COUNT_CANCELLED'] = (isset($casesCnt[$process['PRO_UID']]['CANCELLED']) ? $casesCnt[$process['PRO_UID']]['CANCELLED'] : 0);
                $process['CASES_COUNT'] = $casesCountTotal;
            }

            unset($process['PRO_CREATE_USER']);

            $aProcesses[] = $process;
        }

        $memcache = PMmemcached::getSingleton(config("system.workspace"));
        if (isset($memcache) && $memcache->enabled == 1) {
            return $aProcesses;
        }

        if ($limit == '') {
            $limit = count($aProcesses);
        }

        if ($this->sort != "PRO_CREATE_DATE") {
            if ($this->dir == "ASC") {
                usort($aProcesses, array($this, "ordProcessAsc"));
            } else {
                usort($aProcesses, array($this, "ordProcessDesc"));
            }
        }

        return $aProcesses;
    }

    public function getCasesCountInAllProcesses()
    {
        /*SELECT PRO_UID, APP_STATUS, COUNT( * )
          FROM APPLICATION
          GROUP BY PRO_UID, APP_STATUS*/
        require_once 'classes/model/Application.php';

        $memcache = PMmemcached::getSingleton( config("system.workspace") );
        $memkey = 'getCasesCountInAllProcesses';
        if (($aProcesses = $memcache->get($memkey)) === false) {
            $oCriteria = new Criteria('workflow');
            $oCriteria->addSelectColumn(ApplicationPeer::PRO_UID);
            $oCriteria->addSelectColumn(ApplicationPeer::APP_STATUS);
            $oCriteria->addSelectColumn('COUNT(*) AS CNT');
            $oCriteria->addGroupByColumn(ApplicationPeer::PRO_UID);
            $oCriteria->addGroupByColumn(ApplicationPeer::APP_STATUS);

            $oDataset = ProcessPeer::doSelectRS($oCriteria, Propel::getDbConnection('workflow_ro'));
            $oDataset->setFetchmode(ResultSet::FETCHMODE_ASSOC);

            $aProcesses = array();
            while ($oDataset->next()) {
                $row = $oDataset->getRow();
                $aProcesses[$row['PRO_UID']][$row['APP_STATUS']] = $row['CNT'];
            }
            $memcache->set($memkey, $aProcesses, PMmemcached::ONE_HOUR);
        }
        return $aProcesses;
    }

    public function getCasesCountForProcess($pro_uid)
    {
        $oCriteria = new Criteria('workflow');
        $oCriteria->addSelectColumn('COUNT(*) AS TOTAL_CASES');
        $oCriteria->add(ApplicationPeer::PRO_UID, $pro_uid);
        $oDataset = ApplicationPeer::doSelectRS($oCriteria, Propel::getDbConnection('workflow_ro'));
        $oDataset->setFetchmode(ResultSet::FETCHMODE_ASSOC);

        $oDataset->next();
        $cases = $oDataset->getRow();
        return (int)$cases['TOTAL_CASES'];
    }

    public function getAllProcessesByCategory()
    {
        $oCriteria = new Criteria('workflow');
        $oCriteria->addSelectColumn(ProcessPeer::PRO_CATEGORY);
        $oCriteria->addSelectColumn('COUNT(*) AS CNT');
        $oCriteria->addGroupByColumn(ProcessPeer::PRO_CATEGORY);
        $oDataSet = ProcessPeer::doSelectRS($oCriteria, Propel::getDbConnection('workflow_ro'));
        $oDataSet->setFetchmode(ResultSet::FETCHMODE_ASSOC);
        $aProc = array();
        while ($oDataSet->next()) {
            $row = $oDataSet->getRow();
            $aProc[$row['PRO_CATEGORY']] = $row['CNT'];
        }
        return $aProc;
    }

    public function getTriggerWebBotProcess($proUid, $action)
    {
        require_once("classes/model/Triggers.php");

        if ((! isset($proUid) && $proUid == '') || (! isset($action) && $action == '')) {
            return false;
        }

        $action = G::toUpper($action);
        $arrayWebBotTrigger = [];

        switch ($action) {
            case 'CREATE':
                $var = ProcessPeer::PRO_TRI_CREATE;
                break;
            case 'OPEN':
                $var = ProcessPeer::PRO_TRI_OPEN;
                break;
            case 'DELETED':
                $var = ProcessPeer::PRO_TRI_DELETED;
                break;
            case 'CANCELED':
                $var = ProcessPeer::PRO_TRI_CANCELED;
                break;
            case 'PAUSED':
                $var = ProcessPeer::PRO_TRI_PAUSED;
                break;
            case 'REASSIGNED':
                $var = ProcessPeer::PRO_TRI_REASSIGNED;
                break;
            case "UNPAUSE":
                $var = ProcessPeer::PRO_TRI_UNPAUSED;
                break;
        }

        $oCriteria = new Criteria('workflow');
        $oCriteria->addSelectColumn($var);
        $oCriteria->addSelectColumn(TriggersPeer::TRI_UID);
        $oCriteria->addSelectColumn(TriggersPeer::TRI_WEBBOT);
        $oCriteria->addJoin($var, TriggersPeer::TRI_UID, Criteria::LEFT_JOIN);
        $oCriteria->add(ProcessPeer::PRO_UID, $proUid);
        $oDataSet = ProcessPeer::doSelectRS($oCriteria, Propel::getDbConnection('workflow_ro'));

        $oDataSet->setFetchmode(ResultSet::FETCHMODE_ASSOC);
        if ($oDataSet->next()) {
            $row = $oDataSet->getRow();
            $arrayWebBotTrigger = ['TRI_UID' => $row['TRI_UID'], 'TRI_WEBBOT' => $row['TRI_WEBBOT']];
        }

        //Return
        return $arrayWebBotTrigger;
    }

    public function memcachedDelete()
    {
        //Limit defined in processmaker/workflow/engine/templates/processes/main.js
        $limit = 25;
        $start = 0;

        $memcache = PMmemcached::getSingleton( config("system.workspace") );

        for ($start = 0; $start <= 50 - 1; $start ++) {
            $memkey = "processList-allProcesses-" . ($start * $limit) . "-" . $limit;
            $memkeyTotal = $memkey . "-total";

            $r = $memcache->delete($memkey);
            $r = $memcache->delete($memkeyTotal);
        }
    }

    public function orderMemcache($dataMemcache, $start, $limit)
    {
        if ($this->dir=='ASC') {
            usort($dataMemcache, array($this, "ordProcessAsc"));
        } else {
            usort($dataMemcache, array($this, "ordProcessDesc"));
        }
        $response = new stdclass();
        $response->totalCount = count($dataMemcache);
        $dataMemcache = array_splice($dataMemcache, $start, $limit);
        $response->dataMemcache = $dataMemcache;
        return $response;
    }

    public function ordProcessAsc($a, $b)
    {
        if (($this->sort) == '') {
            $this->sort = 'PRO_TITLE';
        }
        if (strtolower($a[$this->sort]) > strtolower($b[$this->sort])) {
            return 1;
        } elseif (strtolower($a[$this->sort]) < strtolower($b[$this->sort])) {
            return - 1;
        } else {
            return 0;
        }
    }

    public function ordProcessDesc($a, $b)
    {
        if (($this->sort) == '') {
            $this->sort = 'PRO_TITLE';
        }
        if (strtolower($a[$this->sort]) > strtolower($b[$this->sort])) {
            return - 1;
        } elseif (strtolower($a[$this->sort]) < strtolower($b[$this->sort])) {
            return 1;
        } else {
            return 0;
        }
    }
    /**
     * Check is the Process is BPMN.
     *
     * @param string $ProUid the uid of the Prolication
     * @return int 1 if is BPMN process or 0 if a Normal process
    */
    public function isBpmnProcess($proUid)
    {
        $c = new Criteria("workflow");
        $c->add(BpmnProcessPeer::PRJ_UID, $proUid);
        $res = BpmnProcessPeer::doSelect($c);
        if (sizeof($res) == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    public function getAllConfiguredCurrencies()
    {
        $oCriteria = new Criteria('workflow');
        $oCriteria->addSelectColumn(ProcessPeer::PRO_UNIT_COST);
        $oCriteria->setDistinct();
        $oDataSet = ProcessPeer::doSelectRS($oCriteria, Propel::getDbConnection('workflow_ro'));
        $oDataSet->setFetchmode(ResultSet::FETCHMODE_ASSOC);
        $aProc = array();
        while ($oDataSet->next()) {
            $row = $oDataSet->getRow();
            $aProc[$row['PRO_UNIT_COST']] = $row['PRO_UNIT_COST'];
        }
        return $aProc;
    }

    public function deleteProcessCases($proUid)
    {
        try {
            /*get cases by process uid*/
            $oCase = new Cases();
            $oCriteria = new Criteria('workflow');
            $oCriteria->addSelectColumn(ApplicationPeer::APP_UID);
            $oCriteria->add(ApplicationPeer::PRO_UID, $proUid);
            $oDataset = ApplicationPeer::doSelectRS($oCriteria, Propel::getDbConnection('workflow_ro'));
            $oDataset->setFetchmode(ResultSet::FETCHMODE_ASSOC);
            while ($oDataset->next()) {
                $row = $oDataset->getRow();
                $oCase->removeCase($row['APP_UID'], false);
            }
        } catch (Exception $e) {
            throw ($e);
        }
    }

    public function refreshUserAllCountersByProcessesGroupUid($proUidArray)
    {
        $aTypes = array(
            'to_do',
            'draft',
            'cancelled',
            'sent',
            'paused',
            'completed',
            'selfservice'
        );
        $usersArray = array();
        $users = new Users();
        $oCase = new Cases();
        $oCriteria = new Criteria();
        $oCriteria->addSelectColumn(AppDelegationPeer::APP_UID);
        $oCriteria->addSelectColumn(AppDelegationPeer::USR_UID);
        $oCriteria->setDistinct();
        $oCriteria->add(AppDelegationPeer::PRO_UID, $proUidArray, Criteria::IN);
        $oRuleSet = AppDelegationPeer::doSelectRS($oCriteria);
        $oRuleSet->setFetchmode(ResultSet::FETCHMODE_ASSOC);
        while ($oRuleSet->next()) {
            $row = $oRuleSet->getRow();
            if (isset($row['USR_UID']) && $row['USR_UID'] != '') {
                $usersArray[$row['USR_UID']] = $row['USR_UID'];
            }
            $oCase->deleteDelegation($row['APP_UID']);
        }

        foreach ($usersArray as $value) {
            $oAppCache = new AppCacheView();
            $aCount = $oAppCache->getAllCounters($aTypes, $value);
            $newData = array(
                'USR_UID'                   => $value,
                'USR_TOTAL_INBOX'           => $aCount['to_do'],
                'USR_TOTAL_DRAFT'           => $aCount['draft'],
                'USR_TOTAL_CANCELLED'       => $aCount['cancelled'],
                'USR_TOTAL_PARTICIPATED'    => $aCount['sent'],
                'USR_TOTAL_PAUSED'          => $aCount['paused'],
                'USR_TOTAL_COMPLETED'       => $aCount['completed'],
                'USR_TOTAL_UNASSIGNED'      => $aCount['selfservice']
            );
            $users->update($newData);
        }
    }

    /**
     * Load a process object by PRO_ID
     *
     * @param type $id
     * @return Process
     */
    public static function loadById($id)
    {
        $criteria = new Criteria(ProcessPeer::DATABASE_NAME);
        $criteria->add(ProcessPeer::PRO_ID, $id);
        return ProcessPeer::doSelect($criteria)[0];
    }
}
