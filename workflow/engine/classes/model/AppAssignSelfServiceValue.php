<?php
class AppAssignSelfServiceValue extends BaseAppAssignSelfServiceValue
{
    /**
     * Create record
     *
     * @param string $applicationUid Unique id of Case
     * @param int $delIndex Delegation index
     * @param array $arrayData Data
     *
     * @return void
     * @throws Exception
     */
    public function create($applicationUid, $delIndex, array $arrayData, $dataVariable = [])
    {
        try {
            $cnn = Propel::getConnection(AppAssignSelfServiceValuePeer::DATABASE_NAME);

            try {
                $appAssignSelfServiceValue = new AppAssignSelfServiceValue();

                $appAssignSelfServiceValue->fromArray($arrayData, BasePeer::TYPE_FIELDNAME);

                $appAssignSelfServiceValue->setAppUid($applicationUid);
                $appAssignSelfServiceValue->setDelIndex($delIndex);

                if ($appAssignSelfServiceValue->validate()) {
                    $cnn->begin();
                    $result = $appAssignSelfServiceValue->save();
                    $cnn->commit();

                    //SELECT LAST_INSERT_ID()
                    $stmt = $cnn->createStatement();
                    $rs = $stmt->executeQuery("SELECT LAST_INSERT_ID()", ResultSet::FETCHMODE_ASSOC);
                    $rs->next();
                    $row = $rs->getRow();
                    $appAssignSelfServiceValueId = $row['LAST_INSERT_ID()'];
                    $appAssignSelfServiceValueGroup = new AppAssignSelfServiceValueGroup();
                    $appAssignSelfServiceValueGroup->createRows($appAssignSelfServiceValueId, $dataVariable);
                } else {
                    $msg = "";

                    foreach ($appAssignSelfServiceValue->getValidationFailures() as $validationFailure) {
                        $msg .= (($msg != "")? "\n" : "") . $validationFailure->getMessage();
                    }

                    throw new Exception(G::LoadTranslation("ID_RECORD_CANNOT_BE_CREATED") . (($msg != "")? "\n" . $msg : ""));
                }
            } catch (Exception $e) {
                $cnn->rollback();

                throw $e;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Remove record
     *
     * @param string $applicationUid Unique id of Case
     * @param int $delIndex Delegation index
     *
     * @return void
     * @throws Exception
     */
    public function remove($applicationUid, $delIndex = 0)
    {
        try {
            $criteria = new Criteria("workflow");

            $criteria->add(AppAssignSelfServiceValuePeer::APP_UID, $applicationUid, Criteria::EQUAL);

            if ($delIndex != 0) {
                $criteria->add(AppAssignSelfServiceValuePeer::DEL_INDEX, $delIndex, Criteria::EQUAL);
            }

            $result = AppAssignSelfServiceValuePeer::doDelete($criteria);

            // Delete related rows and missing relations, criteria don't execute delete with joins
            $cnn = Propel::getConnection(AppAssignSelfServiceValueGroupPeer::DATABASE_NAME);
            $cnn->begin();
            $stmt = $cnn->createStatement();
            $rs = $stmt->executeQuery("DELETE " . AppAssignSelfServiceValueGroupPeer::TABLE_NAME . "
                                       FROM " . AppAssignSelfServiceValueGroupPeer::TABLE_NAME . "
                                       LEFT JOIN " . AppAssignSelfServiceValuePeer::TABLE_NAME . "
                                       ON (" . AppAssignSelfServiceValueGroupPeer::ID . " = " . AppAssignSelfServiceValuePeer::ID . ")
                                       WHERE " . AppAssignSelfServiceValuePeer::ID . " IS NULL");
            $cnn->commit();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Generate data
     * This method is used from the command database-generate-self-service-by-value
     *
     * @return void
     * @throws Exception
     *
     * @deprecated Method deprecated in Release 3.3.0
     */
    public function generateData()
    {
        try {
            AppAssignSelfServiceValuePeer::doDeleteAll(); //Delete all records

            //Generate data
            $case = new Cases();

            $criteria = new Criteria("workflow");

            $criteria->addSelectColumn(AppDelegationPeer::APP_UID);
            $criteria->addSelectColumn(AppDelegationPeer::DEL_INDEX);
            $criteria->addSelectColumn(ApplicationPeer::APP_DATA);
            $criteria->addSelectColumn(AppDelegationPeer::PRO_UID);
            $criteria->addSelectColumn(TaskPeer::TAS_UID);
            $criteria->addSelectColumn(TaskPeer::TAS_GROUP_VARIABLE);
            $criteria->addJoin(AppDelegationPeer::APP_UID, ApplicationPeer::APP_UID, Criteria::LEFT_JOIN);
            $criteria->addJoin(AppDelegationPeer::TAS_UID, TaskPeer::TAS_UID, Criteria::LEFT_JOIN);
            $criteria->add(TaskPeer::TAS_ASSIGN_TYPE, "SELF_SERVICE", Criteria::EQUAL);
            $criteria->add(TaskPeer::TAS_GROUP_VARIABLE, "", Criteria::NOT_EQUAL);
            $criteria->add(AppDelegationPeer::USR_UID, "", Criteria::EQUAL);
            $criteria->add(AppDelegationPeer::DEL_THREAD_STATUS, "OPEN", Criteria::EQUAL);

            $rsCriteria = AppDelegationPeer::doSelectRS($criteria);
            $rsCriteria->setFetchmode(ResultSet::FETCHMODE_ASSOC);

            while ($rsCriteria->next()) {
                $row = $rsCriteria->getRow();

                $applicationData = $case->unserializeData($row["APP_DATA"]);
                $taskGroupVariable = trim($row["TAS_GROUP_VARIABLE"], " @#");

                if ($taskGroupVariable != "" && isset($applicationData[$taskGroupVariable])) {
                    $dataVariable = $applicationData[$taskGroupVariable];
                    $dataVariable = (is_array($dataVariable))? $dataVariable : trim($dataVariable);

                    if (!empty($dataVariable)) {
                        //@todo, will be deprecate the command database-generate-self-service-by-value
                        $this->create(
                            $row["APP_UID"],
                            $row["DEL_INDEX"],
                            [
                                "PRO_UID" => $row["PRO_UID"],
                                "TAS_UID" => $row["TAS_UID"],
                                "GRP_UID" => serialize($dataVariable)
                            ]
                        );
                    }
                }
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}

