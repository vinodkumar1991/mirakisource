<?php
namespace app\modules\uploads\controllers;

use yii\web\Controller;
use common\components\ExcelComponent;
use Yii;
use backend\modules\uploads\models\Slots;
use common\components\CommonComponent;
use backend\modules\uploads\models\Uploads;

class UploadsController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionCreateSlot()
    {
        $arrInputs = Yii::$app->request->post();
        $arrFiles = [
            // 'slots' => Yii::getAlias('@webroot') . '/uploads/slots.xlsx',
            'slots' => Yii::getAlias('@webroot') . '/uploads/auditions.xlsx'
        ];
        $arrSlots = $this->response('import', $arrFiles)['slots'];
        print_r($arrSlots);
        die();
        // $arrResponse = ! empty($arrSlots) ? $this->saveSlots($arrSlots, [
        // 'category_type' => $arrInputs['category_type']
        // ]) : [];
        
        $arrResponse = ! empty($arrSlots) ? $this->saveSlots($arrSlots, [
            'category_type' => 'audition'
        ]) : [];
        
        print_r($arrResponse);
        die();
    }

    public function response($strMode, $arrFiles)
    {
        $objExcelComponent = new ExcelComponent();
        $objExcelComponent->mode = $strMode;
        $objExcelComponent->files = $arrFiles;
        switch ($strMode) {
            case 'export':
                
                break;
            default:
                $arrResponse = $objExcelComponent->makeImport();
        }
        unset($strMode, $arrFiles);
        return $arrResponse;
    }

    private function saveSlots($arrSlots, $arrOther)
    {
        $arrResponse = $arrEventDates = [];
        $i = 0;
        foreach ($arrSlots as $arrSlot) {
            $arrNewSlot = [];
            $objSlots = new Slots();
            $arrDefaults = $objSlots->getDefaults();
            $arrNewSlot = array_merge($arrSlot, $arrDefaults);
            $arrNewSlot = $this->modifyKeys($arrNewSlot);
            $objSlots->attributes = $arrNewSlot;
            $arrEventDates[$arrNewSlot['event_date']][] = $arrNewSlot['event_date'];
            if ($objSlots->validate()) {
                $arrValidatedInputs = [];
                $arrValidatedInputs = $objSlots->getAttributes();
                unset($arrValidatedInputs['id'], $arrValidatedInputs['last_modified_date'], $arrValidatedInputs['last_modified_by']);
                $arrResponse['new'][] = array_values($arrValidatedInputs);
            } else {
                $arrResponse['errors'][$i] = $objSlots->errors;
            }
            $i ++;
        }
        $objSlot = new Slots();
        ! empty($arrEventDates) ? $objSlot->updateSlot([
            'event_dates' => array_keys($arrEventDates),
            'category_type' => $arrOther['category_type']
        ], [
            'status' => 'inactive'
        ]) : 0;
        // $intInsert = ! isset($arrResponse['errors']) ? $objSlot->create($arrResponse['new']) : 0;
        $intInsert = isset($arrResponse['new']) ? $objSlot->create($arrResponse['new']) : 0;
        unset($arrResponse['new']);
        $arrResponse['inserted_count'] = $intInsert;
        unset($arrSlots, $arrOther, $i, $intInsert);
        return $arrResponse;
    }

    private function keyStore()
    {
        return [
            'categorytype' => 'category_type',
            'eventdate' => 'event_date',
            'fromtime' => 'from_time',
            'totime' => 'to_time'
        ];
    }

    private function modifyKeys($arrData)
    {
        $arrResponse = [];
        $arrKeys = $this->keyStore();
        foreach ($arrData as $strKey => $strValue) {
            isset($arrKeys[$strKey]) ? ($arrResponse[$arrKeys[$strKey]] = $strValue) : ($arrResponse[$strKey] = $strValue);
        }
        unset($arrData, $arrKeys);
        return $arrResponse;
    }

    public function actionUploadFiles()
    {
        $arrResponse = [];
        $arrFileTypes = CommonComponent::getFileTypes();
        $arrInputs = Yii::$app->request->post();
        $arrInputs = [
            'file_type' => 'video',
            'file_link' => 'https://www.youtube.com/watch?v=cZXrYAF_sh8&list=RDMMcZXrYAF_sh8',
            'publish_date' => '2018-01-04 09:25:00',
            'status' => 'active'
        ];
        $arrResponse = ! empty($arrInputs) ? $this->saveFiles($arrInputs) : [];
        print_r($arrResponse);
        die();
        return $this->render('/upload', [
            'file_types' => $arrFileTypes,
            'errors' => isset($arrResponse['errors']) ? $arrResponse['errors'] : []
        ]);
    }

    private function saveFiles($arrInputs)
    {
        $arrResponse = [];
        $objUploads = new Uploads();
        $arrDefaults = $objUploads->getDefaults();
        $arrInputs = array_merge($arrInputs, $arrDefaults);
        $objUploads->attributes = $arrInputs;
        if ($objUploads->validate()) {
            $objUploads->save();
            $arrResponse['file_id'] = $objUploads->id;
        } else {
            $arrResponse['errors'] = $objUploads->errors;
        }
        unset($arrInputs);
        return $arrResponse;
    }
}
