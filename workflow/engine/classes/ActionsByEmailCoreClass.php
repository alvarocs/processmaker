<?php



class ActionsByEmailCoreClass extends PMPlugin
{
    public function __construct()
    {
    }

    public function setup()
    {

    }

    public function getFieldsForPageSetup()
    {
        return array();
    }

    public function updateFieldsForPageSetup()
    {
    }

    /**
     * @param $data
     * @param $dataAbe
     * @throws Exception
     */
    public function sendActionsByEmail($data, $dataAbe)
    {
        try {
            // Validations
            try {
                if (!is_object($data)) {
                    throw new Exception('The parameter $data is null.');
                }
                if (!isset($data->TAS_UID)) {
                    throw new Exception('The parameter $data->TAS_UID is null.');
                }

                if (!isset($data->APP_UID)) {
                    throw new Exception('The parameter $data->APP_UID is null.');
                }

                if (!isset($data->DEL_INDEX)) {
                    throw new Exception('The parameter $data->DEL_INDEX is null.');
                }

                if (!isset($data->USR_UID)) {
                    throw new Exception('The parameter $data->USR_UID is null.');
                }

                if ($data->TAS_UID === '') {
                    throw new Exception('The parameter $data->TAS_UID is empty.');
                }

                if ($data->APP_UID === '') {
                    throw new Exception('The parameter $data->APP_UID is empty.');
                }

                if ($data->DEL_INDEX === '') {
                    throw new Exception('The parameter $data->DEL_INDEX is empty.');
                }

                if ($data->DEL_INDEX === 1) {
                    error_log('The parameter $data->DEL_INDEX is 1, you can not use ActionsByEmail in the initial task', 0);
                    return;
                }

                if ($data->USR_UID === '') {
                    error_log('The parameter $data->USR_UID is empty, the routed task may be a self-service type, actions by email does not work with self-service task types.', 0);
                }
            } catch(Exception $e) {
                $token = strtotime("now");
                PMException::registerErrorLog($e, $token);
                G::outRes( G::LoadTranslation("ID_EXCEPTION_LOG_INTERFAZ", array($token)) );
                die;
            }

            $emailServer = new \ProcessMaker\BusinessModel\EmailServer();

            $emailSetup = (!is_null(\EmailServerPeer::retrieveByPK($dataAbe['ABE_EMAIL_SERVER_UID']))) ?
                $emailServer->getEmailServer($dataAbe['ABE_EMAIL_SERVER_UID'], true) :
                $emailServer->getEmailServerDefault();

            if (!empty($emailSetup)) {
                $cases = new Cases();
                $caseFields = $cases->loadCase($data->APP_UID, $data->DEL_INDEX);
                $actionEmailTable = new AbeConfiguration();
                $configuration = $actionEmailTable->getTaskConfiguration($caseFields['PRO_UID'], $data->TAS_UID);
                $caseFields['APP_DATA']['PRO_ID'] = $configuration['PRO_ID'];
                $caseFields['APP_DATA']['TAS_ID'] = $configuration['TAS_ID'];

                if (!empty($configuration)) {
                    $configuration['ABE_EMAIL_FIELD'] = str_replace('@@', '', $configuration['ABE_EMAIL_FIELD']);
                    if ($configuration['ABE_EMAIL_FIELD'] != '' && isset($caseFields['APP_DATA'][$configuration['ABE_EMAIL_FIELD']])) {
                        $email = trim($caseFields['APP_DATA'][$configuration['ABE_EMAIL_FIELD']]);
                    } else {
                        $userInstance = new Users();
                        $userInfo     = $userInstance->getAllInformation($data->USR_UID);
                        $email        = $userInfo['mail'];
                    }

                    if ($email != '') {
                        $subject = G::replaceDataField( $configuration['ABE_SUBJECT_FIELD'], $caseFields['APP_DATA'] );
                        if($subject == ''){
                            $subject = $caseFields['APP_TITLE'];
                        }

                        $abeRequest = array();
                        $abeRequest['ABE_REQ_UID']      = '';
                        $abeRequest['ABE_UID']          = $configuration['ABE_UID'];
                        $abeRequest['APP_UID']          = $data->APP_UID;
                        $abeRequest['DEL_INDEX']        = $data->DEL_INDEX;
                        $abeRequest['ABE_REQ_SENT_TO']  = $email;
                        $abeRequest['ABE_REQ_SUBJECT']  = $subject;
                        $abeRequest['ABE_REQ_BODY']     = '';
                        $abeRequest['ABE_REQ_ANSWERED'] = 0;
                        $abeRequest['ABE_REQ_STATUS']   = 'PENDING';

                        try {
                            $abeRequestsInstance = new AbeRequests();
                            $abeRequest['ABE_REQ_UID'] = $abeRequestsInstance->createOrUpdate($abeRequest);
                        } catch (Exception $error) {
                            throw $error;
                        }

                        if ($configuration['ABE_TYPE'] != '') {
                            // Email
                            $_SESSION['CURRENT_DYN_UID'] = $configuration['DYN_UID'];

                            $__ABE__ = '';
                            $conf = new Configurations();
                            $envSkin = defined("SYS_SKIN") ? SYS_SKIN : $conf->getConfiguration('SKIN_CRON', '');
                            $envHost = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : SERVER_NAME;
                            $envProtocol = defined("REQUEST_SCHEME") && REQUEST_SCHEME === "https";
                            if (isset($_SERVER['SERVER_PORT'])) {
                                $envPort = ($_SERVER['SERVER_PORT'] != "80") ? ":" . $_SERVER['SERVER_PORT'] : "";
                            } else if (defined('SERVER_PORT')) {
                                $envPort = (SERVER_PORT . "" != "80") ? ":" . SERVER_PORT : "";
                            } else {
                                $envPort = ""; // Empty by default
                            }
                            if (!empty($envPort) && strpos($envHost, $envPort) === false) {
                                $envHost = $envHost . $envPort;
                            }
                            $link = (G::is_https() || $envProtocol ? 'https://' : 'http://') . $envHost . '/sys' . config("system.workspace") . '/' . SYS_LANG . '/' . $envSkin . '/services/ActionsByEmail';

                            switch ($configuration['ABE_TYPE']) {
                                case 'CUSTOM':
                                    $customGrid = unserialize($configuration['ABE_CUSTOM_GRID']);
                                    $variableService = new \ProcessMaker\Services\Api\Project\Variable();
                                    $variables = $variableService->doGetVariables($caseFields['PRO_UID']);
                                    $field = new stdClass();
                                    $field->label = '';
                                    $actionField = str_replace(array('@@', '@#', '@=', '@%', '@?', '@$'), '', $configuration['ABE_ACTION_FIELD']);

                                    $obj = new PmDynaform($configuration['DYN_UID']);
                                    $configuration['CURRENT_DYNAFORM'] = $configuration['DYN_UID'];
                                    $file = $obj->printPmDynaformAbe($configuration);
                                    $__ABE__ .= $file;
                                    $__ABE__ .= '<div style="width: 100%"></div><strong>' . $field->label . '</strong><table align="left" border="0"><tr>';
                                    $index = 1;
                                    $__ABE__ .= '<td><table align="left" cellpadding="2"><tr>';
                                    foreach ($customGrid as $key => $value) {
                                        $__ABE__ .= '<td align="center"><a style="' . $value['abe_custom_format'] . '" ';
                                        $__ABE__ .= 'href="' . urldecode(urlencode($link)) . '?ACTION=' . G::encrypt('processABE', URL_KEY, true) . '&APP_UID=';
                                        $__ABE__ .= G::encrypt($data->APP_UID, URL_KEY, true) . '&DEL_INDEX=' . G::encrypt($data->DEL_INDEX, URL_KEY);
                                        $__ABE__ .= '&FIELD=' . G::encrypt($actionField, URL_KEY, true) . '&VALUE=' . G::encrypt($value['abe_custom_value'], URL_KEY, true);
                                        $__ABE__ .= '&ABER=' . G::encrypt($abeRequest['ABE_REQ_UID'], URL_KEY, true) . '" target="_blank" >' . $value['abe_custom_label'];
                                        $__ABE__ .= '</a></td>' . (($index % 5 == 0) ? '</tr><tr>' : '  ');
                                        $index++;
                                    }
                                    $__ABE__ .= '</tr></table></div>';
                                    break;
                                case 'LINK':
                                    $__ABE__ .= '<a href="' . $link . 'DataForm?APP_UID=' . G::encrypt($data->APP_UID, URL_KEY, true) . '&DEL_INDEX=' . G::encrypt($data->DEL_INDEX, URL_KEY, true) . '&DYN_UID=' . G::encrypt($configuration['DYN_UID'], URL_KEY, true) . '&ABER=' . G::encrypt($abeRequest['ABE_REQ_UID'], URL_KEY, true) . '" target="_blank">Please complete this form</a>';
                                    break;
                                // coment
                                case 'FIELD':
                                        $variableService = new \ProcessMaker\Services\Api\Project\Variable();
                                        $variables = $variableService->doGetVariables($caseFields['PRO_UID']);
                                        $field = new stdClass();
                                        $field->label = 'Test';
                                        $field->type = 'dropdown';
                                        $field->options = array();
                                        $field->value = '';
                                        $actionField = str_replace(array('@@','@#','@=','@%','@?','@$'), '', $configuration['ABE_ACTION_FIELD']);
                                        $dynaform = $configuration['DYN_UID'];
                                        $variables = G::json_decode($configuration['DYN_CONTENT'], true);
                                        if(isset($variables['items'][0]['items'])){
                                            $fields = $variables['items'][0]['items'];
                                            foreach ($fields as $key => $value) {
                                                foreach($value as $var){
                                                    if(isset($var['variable'])){
                                                        if ($var['variable'] == $actionField) {
                                                             $field->label = $var['label'];
                                                             $field->type  = $var['type'];
                                                             $values = $var['options'];
                                                             foreach ($values as $val){
                                                               $field->options[$val['value']] = $val['value'];
                                                             }
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                        $obj = new PmDynaform($configuration['DYN_UID']);
                                        $configuration['CURRENT_DYNAFORM'] = $configuration['DYN_UID'];
                                        $file = $obj->printPmDynaformAbe($configuration);
                                        $__ABE__ .= $file;
                                        $__ABE__ .= '<strong>' . $field->label . '</strong><br /><table align="left" border="0"><tr>';
                                        switch ($field->type) {
                                            case 'dropdown':
                                            case 'radio':
                                            case 'radiogroup':
                                                $index = 1;
                                                $__ABE__.='<br /><td><table align="left" cellpadding="2"><tr>';
                                                foreach ($field->options as $optValue => $optName) {
                                                    $__ABE__ .= '<td align="center"><a style="text-decoration: none; color: #000; background-color: #E5E5E5; ';
                                                    $__ABE__ .= 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#EFEFEF, endColorstr=#BCBCBC); ';
                                                    $__ABE__ .= 'background-image: -webkit-gradient(linear, left top, left bottom, from(#EFEFEF), #BCBCBC); ';
                                                    $__ABE__ .= 'background-image: -webkit-linear-gradient(top, #EFEFEF, #BCBCBC); ';
                                                    $__ABE__ .= 'background-image: -moz-linear-gradient(top, #EFEFEF, #BCBCBC); background-image: -ms-linear-gradient(top, #EFEFEF, #BCBCBC); ';
                                                    $__ABE__ .= 'background-image: -o-linear-gradient(top, #EFEFEF, #BCBCBC); border: 1px solid #AAAAAA; ';
                                                    $__ABE__ .= 'border-radius: 4px; -moz-border-radius: 4px; -webkit-border-radius: 4px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2); ';
                                                    $__ABE__ .= 'font-family: Arial,serif; font-size: 9pt; font-weight: 400; line-height: 14px; margin: 2px 0; padding: 2px 7px; ';
                                                    $__ABE__ .= 'text-decoration: none; text-transform: capitalize;" href="' .urldecode(urlencode($link)). '?ACTION='.G::encrypt('processABE', URL_KEY, true).'&APP_UID=';
                                                    $__ABE__ .= G::encrypt($data->APP_UID, URL_KEY, true) . '&DEL_INDEX=' . G::encrypt($data->DEL_INDEX, URL_KEY, true);
                                                    $__ABE__ .= '&FIELD=' . G::encrypt($actionField, URL_KEY, true) . '&VALUE=' . G::encrypt($optValue, URL_KEY, true);
                                                    $__ABE__ .= '&ABER=' . G::encrypt($abeRequest['ABE_REQ_UID'], URL_KEY, true) . '" target="_blank" >' . $optName;
                                                    $__ABE__ .= '</a></td>' . (($index % 5 == 0) ? '</tr><tr>' : '  ');
                                                    $index++;
                                                }

                                                $__ABE__.='</tr></table></td>';
                                                break;
                                            case 'yesno':
                                                $__ABE__ .= '<td align="center"><a href="' . $link . '?ACTION=' . G::encrypt('processABE', URL_KEY, true) . '&APP_UID=' . urlencode(G::encrypt($data->APP_UID, URL_KEY, true)) . '&DEL_INDEX=' . urlencode(G::encrypt($data->DEL_INDEX, URL_KEY, true)). '&FIELD=' . urlencode(G::encrypt($actionField, URL_KEY, true)) . '&VALUE=' . urlencode(G::encrypt(1, URL_KEY, true)) . '&ABER=' . urlencode(G::encrypt($abeRequest['ABE_REQ_UID'], URL_KEY, true, true)) . '" target="_blank">' . G::LoadTranslation('ID_YES_VALUE') . '</a></td>';
                                                $__ABE__ .= '<td align="center"><a href="' . $link . '?ACTION=' . G::encrypt('processABE', URL_KEY, true) . '&APP_UID=' . urlencode(G::encrypt($data->APP_UID, URL_KEY, true)) . '&DEL_INDEX=' . urlencode(G::encrypt($data->DEL_INDEX, URL_KEY, true)) . '&FIELD=' . urlencode(G::encrypt($actionField, URL_KEY, true)) . '&VALUE=' . urlencode(G::encrypt(0, URL_KEY, true)) . '&ABER=' . urlencode(G::encrypt($abeRequest['ABE_REQ_UID'], URL_KEY, true, true)) . '" target="_blank">' . G::LoadTranslation('ID_NO_VALUE') . '</a></td>';
                                                break;
                                            case 'checkbox':
                                                $__ABE__ .= '<td align="center"><a href="' . $link . '?ACTION=' . G::encrypt('processABE', URL_KEY, true) . '&APP_UID=' . G::encrypt($data->APP_UID, URL_KEY, true) . '&DEL_INDEX=' . G::encrypt($data->DEL_INDEX, URL_KEY, true) . '&FIELD=' . G::encrypt($actionField, URL_KEY, true) . '&VALUE=' . G::encrypt($field->value, URL_KEY, true) . '&ABER=' . G::encrypt($abeRequest['ABE_REQ_UID'], URL_KEY, true) . '" target="_blank">Check</a></td>';
                                                $__ABE__ .= '<td align="center"><a href="' . $link . '?ACTION=' . G::encrypt('processABE', URL_KEY, true) . '&APP_UID=' . G::encrypt($data->APP_UID, URL_KEY, true) . '&DEL_INDEX=' . G::encrypt($data->DEL_INDEX, URL_KEY, true) . '&FIELD=' . G::encrypt($actionField, URL_KEY, true) . '&VALUE=' . G::encrypt($field->value, URL_KEY, true) . '&ABER=' . G::encrypt($abeRequest['ABE_REQ_UID'], URL_KEY, true) . '" target="_blank">Uncheck</a></td>';
                                                break;
                                        }
                                        $__ABE__ .= '</tr></table>';
                                    break;
                            }

                            $__ABE__ = preg_replace('/\<img src=\"\/js\/maborak\/core\/images\/(.+?)\>/', '' , $__ABE__);
                            $__ABE__ = preg_replace('/\<input\b[^>]*\/>/', '' , $__ABE__);
                            $__ABE__ = preg_replace('/<select\b[^>]*>(.*?)<\/select>/is', "", $__ABE__);
                            $__ABE__ = preg_replace('/align=\"center\"/', '' , $__ABE__);
                            $__ABE__ = preg_replace('/class="tableGrid_view" /', 'class="tableGrid_view" width="100%" ', $__ABE__);
                            $caseFields['APP_DATA']['__ABE__'] = $__ABE__;

                            $user = new Users();

                            if (!$configuration['ABE_MAILSERVER_OR_MAILCURRENT'] && $configuration['ABE_TYPE'] !== '') {
                                if ($data->PREVIOUS_USR_UID !== '') {
                                    $userDetails = $user->loadDetails($data->PREVIOUS_USR_UID);
                                    $emailFrom = ($userDetails["USR_FULLNAME"] . ' <' . $userDetails["USR_EMAIL"] . '>');
                                } else {
                                    global $RBAC;
                                    $currentUser = $RBAC->aUserInfo['USER_INFO'];
                                    $emailFrom = ($currentUser["USR_FIRSTNAME"] . ' ' . $currentUser["USR_LASTNAME"] . ' <' . $currentUser["USR_EMAIL"] . '>');
                                }
                            } else {
                                if (isset($emailSetup["MESS_FROM_NAME"]) && isset($emailSetup["MESS_FROM_MAIL"])) {
                                    $emailFrom = ($emailSetup["MESS_FROM_NAME"] . ' <' . $emailSetup["MESS_FROM_MAIL"] . '>');
                                } else {
                                    $emailFrom = ((isset($emailSetup["MESS_FROM_NAME"])) ? $emailSetup["MESS_FROM_NAME"] : $emailSetup["MESS_FROM_MAIL"]);
                                }
                            }

                            $wsBaseInstance = new WsBase();
                            $result = $wsBaseInstance->sendMessage(
                                $data->APP_UID,
                                $emailFrom,
                                $email,
                                '',
                                '',
                                $subject,
                                $configuration['ABE_TEMPLATE'],
                                $caseFields['APP_DATA'],
                                null,
                                true,
                                $data->DEL_INDEX,
                                $emailSetup,
                                0
                            );
                            $abeRequest['ABE_REQ_STATUS'] = ($result->status_code == 0 ? 'SENT' : 'ERROR');

                            $body = '';
                            $messageSent = executeQuery('SELECT `APP_MSG_BODY` FROM `APP_MESSAGE` ORDER BY `APP_MSG_SEND_DATE` DESC LIMIT 1');

                            if (!empty($messageSent) && is_array($messageSent)) {
                                $body = $messageSent[1]['APP_MSG_BODY'];
                            }

                            $abeRequest['ABE_REQ_BODY'] = $body;

                            // Update 
                            try {
                                $abeRequestsInstance = new AbeRequests();
                                $abeRequestsInstance->createOrUpdate($abeRequest);
                            } catch (Exception $error) {
                                throw $error;
                            }
                        }
                    }
                }
            }
        } catch (Exception $error) {
            throw $error;
        }
    }
}
