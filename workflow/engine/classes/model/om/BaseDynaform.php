<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'classes/model/DynaformPeer.php';

/**
 * Base class that represents a row from the 'DYNAFORM' table.
 *
 * 
 *
 * @package    workflow.classes.model.om
 */
abstract class BaseDynaform extends BaseObject implements Persistent
{

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        DynaformPeer
    */
    protected static $peer;

    /**
     * The value for the dyn_uid field.
     * @var        string
     */
    protected $dyn_uid = '';

    /**
     * The value for the dyn_id field.
     * @var        int
     */
    protected $dyn_id;

    /**
     * The value for the dyn_title field.
     * @var        string
     */
    protected $dyn_title;

    /**
     * The value for the dyn_description field.
     * @var        string
     */
    protected $dyn_description;

    /**
     * The value for the pro_uid field.
     * @var        string
     */
    protected $pro_uid = '0';

    /**
     * The value for the dyn_type field.
     * @var        string
     */
    protected $dyn_type = 'xmlform';

    /**
     * The value for the dyn_filename field.
     * @var        string
     */
    protected $dyn_filename = '';

    /**
     * The value for the dyn_content field.
     * @var        string
     */
    protected $dyn_content;

    /**
     * The value for the dyn_label field.
     * @var        string
     */
    protected $dyn_label;

    /**
     * The value for the dyn_version field.
     * @var        int
     */
    protected $dyn_version;

    /**
     * The value for the dyn_update_date field.
     * @var        int
     */
    protected $dyn_update_date;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Get the [dyn_uid] column value.
     * 
     * @return     string
     */
    public function getDynUid()
    {

        return $this->dyn_uid;
    }

    /**
     * Get the [dyn_id] column value.
     * 
     * @return     int
     */
    public function getDynId()
    {

        return $this->dyn_id;
    }

    /**
     * Get the [dyn_title] column value.
     * 
     * @return     string
     */
    public function getDynTitle()
    {

        return $this->dyn_title;
    }

    /**
     * Get the [dyn_description] column value.
     * 
     * @return     string
     */
    public function getDynDescription()
    {

        return $this->dyn_description;
    }

    /**
     * Get the [pro_uid] column value.
     * 
     * @return     string
     */
    public function getProUid()
    {

        return $this->pro_uid;
    }

    /**
     * Get the [dyn_type] column value.
     * 
     * @return     string
     */
    public function getDynType()
    {

        return $this->dyn_type;
    }

    /**
     * Get the [dyn_filename] column value.
     * 
     * @return     string
     */
    public function getDynFilename()
    {

        return $this->dyn_filename;
    }

    /**
     * Get the [dyn_content] column value.
     * 
     * @return     string
     */
    public function getDynContent()
    {

        return $this->dyn_content;
    }

    /**
     * Get the [dyn_label] column value.
     * 
     * @return     string
     */
    public function getDynLabel()
    {

        return $this->dyn_label;
    }

    /**
     * Get the [dyn_version] column value.
     * 
     * @return     int
     */
    public function getDynVersion()
    {

        return $this->dyn_version;
    }

    /**
     * Get the [optionally formatted] [dyn_update_date] column value.
     * 
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                          If format is NULL, then the integer unix timestamp will be returned.
     * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
     * @throws     PropelException - if unable to convert the date/time to timestamp.
     */
    public function getDynUpdateDate($format = 'Y-m-d H:i:s')
    {

        if ($this->dyn_update_date === null || $this->dyn_update_date === '') {
            return null;
        } elseif (!is_int($this->dyn_update_date)) {
            // a non-timestamp value was set externally, so we convert it
            $ts = strtotime($this->dyn_update_date);
            if ($ts === -1 || $ts === false) {
                throw new PropelException("Unable to parse value of [dyn_update_date] as date/time value: " .
                    var_export($this->dyn_update_date, true));
            }
        } else {
            $ts = $this->dyn_update_date;
        }
        if ($format === null) {
            return $ts;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $ts);
        } else {
            return date($format, $ts);
        }
    }

    /**
     * Set the value of [dyn_uid] column.
     * 
     * @param      string $v new value
     * @return     void
     */
    public function setDynUid($v)
    {

        // Since the native PHP type for this column is string,
        // we will cast the input to a string (if it is not).
        if ($v !== null && !is_string($v)) {
            $v = (string) $v;
        }

        if ($this->dyn_uid !== $v || $v === '') {
            $this->dyn_uid = $v;
            $this->modifiedColumns[] = DynaformPeer::DYN_UID;
        }

    } // setDynUid()

    /**
     * Set the value of [dyn_id] column.
     * 
     * @param      int $v new value
     * @return     void
     */
    public function setDynId($v)
    {

        // Since the native PHP type for this column is integer,
        // we will cast the input value to an int (if it is not).
        if ($v !== null && !is_int($v) && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->dyn_id !== $v) {
            $this->dyn_id = $v;
            $this->modifiedColumns[] = DynaformPeer::DYN_ID;
        }

    } // setDynId()

    /**
     * Set the value of [dyn_title] column.
     * 
     * @param      string $v new value
     * @return     void
     */
    public function setDynTitle($v)
    {

        // Since the native PHP type for this column is string,
        // we will cast the input to a string (if it is not).
        if ($v !== null && !is_string($v)) {
            $v = (string) $v;
        }

        if ($this->dyn_title !== $v) {
            $this->dyn_title = $v;
            $this->modifiedColumns[] = DynaformPeer::DYN_TITLE;
        }

    } // setDynTitle()

    /**
     * Set the value of [dyn_description] column.
     * 
     * @param      string $v new value
     * @return     void
     */
    public function setDynDescription($v)
    {

        // Since the native PHP type for this column is string,
        // we will cast the input to a string (if it is not).
        if ($v !== null && !is_string($v)) {
            $v = (string) $v;
        }

        if ($this->dyn_description !== $v) {
            $this->dyn_description = $v;
            $this->modifiedColumns[] = DynaformPeer::DYN_DESCRIPTION;
        }

    } // setDynDescription()

    /**
     * Set the value of [pro_uid] column.
     * 
     * @param      string $v new value
     * @return     void
     */
    public function setProUid($v)
    {

        // Since the native PHP type for this column is string,
        // we will cast the input to a string (if it is not).
        if ($v !== null && !is_string($v)) {
            $v = (string) $v;
        }

        if ($this->pro_uid !== $v || $v === '0') {
            $this->pro_uid = $v;
            $this->modifiedColumns[] = DynaformPeer::PRO_UID;
        }

    } // setProUid()

    /**
     * Set the value of [dyn_type] column.
     * 
     * @param      string $v new value
     * @return     void
     */
    public function setDynType($v)
    {

        // Since the native PHP type for this column is string,
        // we will cast the input to a string (if it is not).
        if ($v !== null && !is_string($v)) {
            $v = (string) $v;
        }

        if ($this->dyn_type !== $v || $v === 'xmlform') {
            $this->dyn_type = $v;
            $this->modifiedColumns[] = DynaformPeer::DYN_TYPE;
        }

    } // setDynType()

    /**
     * Set the value of [dyn_filename] column.
     * 
     * @param      string $v new value
     * @return     void
     */
    public function setDynFilename($v)
    {

        // Since the native PHP type for this column is string,
        // we will cast the input to a string (if it is not).
        if ($v !== null && !is_string($v)) {
            $v = (string) $v;
        }

        if ($this->dyn_filename !== $v || $v === '') {
            $this->dyn_filename = $v;
            $this->modifiedColumns[] = DynaformPeer::DYN_FILENAME;
        }

    } // setDynFilename()

    /**
     * Set the value of [dyn_content] column.
     * 
     * @param      string $v new value
     * @return     void
     */
    public function setDynContent($v)
    {

        // Since the native PHP type for this column is string,
        // we will cast the input to a string (if it is not).
        if ($v !== null && !is_string($v)) {
            $v = (string) $v;
        }

        if ($this->dyn_content !== $v) {
            $this->dyn_content = $v;
            $this->modifiedColumns[] = DynaformPeer::DYN_CONTENT;
        }

    } // setDynContent()

    /**
     * Set the value of [dyn_label] column.
     * 
     * @param      string $v new value
     * @return     void
     */
    public function setDynLabel($v)
    {

        // Since the native PHP type for this column is string,
        // we will cast the input to a string (if it is not).
        if ($v !== null && !is_string($v)) {
            $v = (string) $v;
        }

        if ($this->dyn_label !== $v) {
            $this->dyn_label = $v;
            $this->modifiedColumns[] = DynaformPeer::DYN_LABEL;
        }

    } // setDynLabel()

    /**
     * Set the value of [dyn_version] column.
     * 
     * @param      int $v new value
     * @return     void
     */
    public function setDynVersion($v)
    {

        // Since the native PHP type for this column is integer,
        // we will cast the input value to an int (if it is not).
        if ($v !== null && !is_int($v) && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->dyn_version !== $v) {
            $this->dyn_version = $v;
            $this->modifiedColumns[] = DynaformPeer::DYN_VERSION;
        }

    } // setDynVersion()

    /**
     * Set the value of [dyn_update_date] column.
     * 
     * @param      int $v new value
     * @return     void
     */
    public function setDynUpdateDate($v)
    {

        if ($v !== null && !is_int($v)) {
            $ts = strtotime($v);
            //Date/time accepts null values
            if ($v == '') {
                $ts = null;
            }
            if ($ts === -1 || $ts === false) {
                throw new PropelException("Unable to parse date/time value for [dyn_update_date] from input: " .
                    var_export($v, true));
            }
        } else {
            $ts = $v;
        }
        if ($this->dyn_update_date !== $ts) {
            $this->dyn_update_date = $ts;
            $this->modifiedColumns[] = DynaformPeer::DYN_UPDATE_DATE;
        }

    } // setDynUpdateDate()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (1-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param      ResultSet $rs The ResultSet class with cursor advanced to desired record pos.
     * @param      int $startcol 1-based offset column which indicates which restultset column to start with.
     * @return     int next starting column
     * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(ResultSet $rs, $startcol = 1)
    {
        try {

            $this->dyn_uid = $rs->getString($startcol + 0);

            $this->dyn_id = $rs->getInt($startcol + 1);

            $this->dyn_title = $rs->getString($startcol + 2);

            $this->dyn_description = $rs->getString($startcol + 3);

            $this->pro_uid = $rs->getString($startcol + 4);

            $this->dyn_type = $rs->getString($startcol + 5);

            $this->dyn_filename = $rs->getString($startcol + 6);

            $this->dyn_content = $rs->getString($startcol + 7);

            $this->dyn_label = $rs->getString($startcol + 8);

            $this->dyn_version = $rs->getInt($startcol + 9);

            $this->dyn_update_date = $rs->getTimestamp($startcol + 10, null);

            $this->resetModified();

            $this->setNew(false);

            // FIXME - using NUM_COLUMNS may be clearer.
            return $startcol + 11; // 11 = DynaformPeer::NUM_COLUMNS - DynaformPeer::NUM_LAZY_LOAD_COLUMNS).

        } catch (Exception $e) {
            throw new PropelException("Error populating Dynaform object", $e);
        }
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      Connection $con
     * @return     void
     * @throws     PropelException
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete($con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(DynaformPeer::DATABASE_NAME);
        }

        try {
            $con->begin();
            DynaformPeer::doDelete($this, $con);
            $this->setDeleted(true);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollback();
            throw $e;
        }
    }

    /**
     * Stores the object in the database.  If the object is new,
     * it inserts it; otherwise an update is performed.  This method
     * wraps the doSave() worker method in a transaction.
     *
     * @param      Connection $con
     * @return     int The number of rows affected by this insert/update
     * @throws     PropelException
     * @see        doSave()
     */
    public function save($con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(DynaformPeer::DATABASE_NAME);
        }

        try {
            $con->begin();
            $affectedRows = $this->doSave($con);
            $con->commit();
            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollback();
            throw $e;
        }
    }

    /**
     * Stores the object in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      Connection $con
     * @return     int The number of rows affected by this insert/update and any referring
     * @throws     PropelException
     * @see        save()
     */
    protected function doSave($con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;


            // If this object has been modified, then save it to the database.
            if ($this->isModified()) {
                if ($this->isNew()) {
                    $pk = DynaformPeer::doInsert($this, $con);
                    $affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
                                         // should always be true here (even though technically
                                         // BasePeer::doInsert() can insert multiple rows).

                    $this->setNew(false);
                } else {
                    $affectedRows += DynaformPeer::doUpdate($this, $con);
                }
                $this->resetModified(); // [HL] After being saved an object is no longer 'modified'
            }

            $this->alreadyInSave = false;
        }
        return $affectedRows;
    } // doSave()

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return     array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param      mixed $columns Column name or an array of column names.
     * @return     boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();
            return true;
        } else {
            $this->validationFailures = $res;
            return false;
        }
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param      array $columns Array of column names to validate.
     * @return     mixed <code>true</code> if all validations pass; 
                   array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = DynaformPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }



            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TYPE_PHPNAME,
     *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
     * @return     mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = DynaformPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        return $this->getByPosition($pos);
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return     mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch($pos) {
            case 0:
                return $this->getDynUid();
                break;
            case 1:
                return $this->getDynId();
                break;
            case 2:
                return $this->getDynTitle();
                break;
            case 3:
                return $this->getDynDescription();
                break;
            case 4:
                return $this->getProUid();
                break;
            case 5:
                return $this->getDynType();
                break;
            case 6:
                return $this->getDynFilename();
                break;
            case 7:
                return $this->getDynContent();
                break;
            case 8:
                return $this->getDynLabel();
                break;
            case 9:
                return $this->getDynVersion();
                break;
            case 10:
                return $this->getDynUpdateDate();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param      string $keyType One of the class type constants TYPE_PHPNAME,
     *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
     * @return     an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = DynaformPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getDynUid(),
            $keys[1] => $this->getDynId(),
            $keys[2] => $this->getDynTitle(),
            $keys[3] => $this->getDynDescription(),
            $keys[4] => $this->getProUid(),
            $keys[5] => $this->getDynType(),
            $keys[6] => $this->getDynFilename(),
            $keys[7] => $this->getDynContent(),
            $keys[8] => $this->getDynLabel(),
            $keys[9] => $this->getDynVersion(),
            $keys[10] => $this->getDynUpdateDate(),
        );
        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param      string $name peer name
     * @param      mixed $value field value
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TYPE_PHPNAME,
     *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
     * @return     void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = DynaformPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @param      mixed $value field value
     * @return     void
     */
    public function setByPosition($pos, $value)
    {
        switch($pos) {
            case 0:
                $this->setDynUid($value);
                break;
            case 1:
                $this->setDynId($value);
                break;
            case 2:
                $this->setDynTitle($value);
                break;
            case 3:
                $this->setDynDescription($value);
                break;
            case 4:
                $this->setProUid($value);
                break;
            case 5:
                $this->setDynType($value);
                break;
            case 6:
                $this->setDynFilename($value);
                break;
            case 7:
                $this->setDynContent($value);
                break;
            case 8:
                $this->setDynLabel($value);
                break;
            case 9:
                $this->setDynVersion($value);
                break;
            case 10:
                $this->setDynUpdateDate($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME,
     * TYPE_NUM. The default key type is the column's phpname (e.g. 'authorId')
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return     void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = DynaformPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setDynUid($arr[$keys[0]]);
        }

        if (array_key_exists($keys[1], $arr)) {
            $this->setDynId($arr[$keys[1]]);
        }

        if (array_key_exists($keys[2], $arr)) {
            $this->setDynTitle($arr[$keys[2]]);
        }

        if (array_key_exists($keys[3], $arr)) {
            $this->setDynDescription($arr[$keys[3]]);
        }

        if (array_key_exists($keys[4], $arr)) {
            $this->setProUid($arr[$keys[4]]);
        }

        if (array_key_exists($keys[5], $arr)) {
            $this->setDynType($arr[$keys[5]]);
        }

        if (array_key_exists($keys[6], $arr)) {
            $this->setDynFilename($arr[$keys[6]]);
        }

        if (array_key_exists($keys[7], $arr)) {
            $this->setDynContent($arr[$keys[7]]);
        }

        if (array_key_exists($keys[8], $arr)) {
            $this->setDynLabel($arr[$keys[8]]);
        }

        if (array_key_exists($keys[9], $arr)) {
            $this->setDynVersion($arr[$keys[9]]);
        }

        if (array_key_exists($keys[10], $arr)) {
            $this->setDynUpdateDate($arr[$keys[10]]);
        }

    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return     Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(DynaformPeer::DATABASE_NAME);

        if ($this->isColumnModified(DynaformPeer::DYN_UID)) {
            $criteria->add(DynaformPeer::DYN_UID, $this->dyn_uid);
        }

        if ($this->isColumnModified(DynaformPeer::DYN_ID)) {
            $criteria->add(DynaformPeer::DYN_ID, $this->dyn_id);
        }

        if ($this->isColumnModified(DynaformPeer::DYN_TITLE)) {
            $criteria->add(DynaformPeer::DYN_TITLE, $this->dyn_title);
        }

        if ($this->isColumnModified(DynaformPeer::DYN_DESCRIPTION)) {
            $criteria->add(DynaformPeer::DYN_DESCRIPTION, $this->dyn_description);
        }

        if ($this->isColumnModified(DynaformPeer::PRO_UID)) {
            $criteria->add(DynaformPeer::PRO_UID, $this->pro_uid);
        }

        if ($this->isColumnModified(DynaformPeer::DYN_TYPE)) {
            $criteria->add(DynaformPeer::DYN_TYPE, $this->dyn_type);
        }

        if ($this->isColumnModified(DynaformPeer::DYN_FILENAME)) {
            $criteria->add(DynaformPeer::DYN_FILENAME, $this->dyn_filename);
        }

        if ($this->isColumnModified(DynaformPeer::DYN_CONTENT)) {
            $criteria->add(DynaformPeer::DYN_CONTENT, $this->dyn_content);
        }

        if ($this->isColumnModified(DynaformPeer::DYN_LABEL)) {
            $criteria->add(DynaformPeer::DYN_LABEL, $this->dyn_label);
        }

        if ($this->isColumnModified(DynaformPeer::DYN_VERSION)) {
            $criteria->add(DynaformPeer::DYN_VERSION, $this->dyn_version);
        }

        if ($this->isColumnModified(DynaformPeer::DYN_UPDATE_DATE)) {
            $criteria->add(DynaformPeer::DYN_UPDATE_DATE, $this->dyn_update_date);
        }


        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return     Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(DynaformPeer::DATABASE_NAME);

        $criteria->add(DynaformPeer::DYN_UID, $this->dyn_uid);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return     string
     */
    public function getPrimaryKey()
    {
        return $this->getDynUid();
    }

    /**
     * Generic method to set the primary key (dyn_uid column).
     *
     * @param      string $key Primary key.
     * @return     void
     */
    public function setPrimaryKey($key)
    {
        $this->setDynUid($key);
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of Dynaform (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @throws     PropelException
     */
    public function copyInto($copyObj, $deepCopy = false)
    {

        $copyObj->setDynId($this->dyn_id);

        $copyObj->setDynTitle($this->dyn_title);

        $copyObj->setDynDescription($this->dyn_description);

        $copyObj->setProUid($this->pro_uid);

        $copyObj->setDynType($this->dyn_type);

        $copyObj->setDynFilename($this->dyn_filename);

        $copyObj->setDynContent($this->dyn_content);

        $copyObj->setDynLabel($this->dyn_label);

        $copyObj->setDynVersion($this->dyn_version);

        $copyObj->setDynUpdateDate($this->dyn_update_date);


        $copyObj->setNew(true);

        $copyObj->setDynUid(''); // this is a pkey column, so set to default value

    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return     Dynaform Clone of current object.
     * @throws     PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);
        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return     DynaformPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new DynaformPeer();
        }
        return self::$peer;
    }
}

