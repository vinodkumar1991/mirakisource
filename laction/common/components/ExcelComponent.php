<?php
namespace common\components;

use moonland\phpexcel\Excel;

class ExcelComponent
{

    public $mode, $files, $model, $file_name, $columns;

    public function makeImport()
    {
        $arrResponse = Excel::widget([
            'mode' => $this->mode,
            'fileName' => $this->files,
            'setFirstRecordAsKeys' => true,
            'setIndexSheetByName' => true,
            'getOnlySheet' => ''
        ]);
        return $arrResponse;
    }

    public function makeExport()
    {
        \moonland\phpexcel\Excel::widget([
            'isMultipleSheet' => true,
            'models' => $this->files,
            'mode' => $this->mode, // default value as 'export'
            'columns' => [
                'sheet1' => $this->columns
            ],
            // without header working, because the header will be get label from attribute label.
            'headers' => [
                'sheet1' => [
                    'column1' => 'Header Column 1',
                    'column2' => 'Header Column 2',
                    'column3' => 'Header Column 3'
                ],
                'sheet2' => [
                    'column1' => 'Header Column 1',
                    'column2' => 'Header Column 2',
                    'column3' => 'Header Column 3'
                ],
                'sheet3' => [
                    'column1' => 'Header Column 1',
                    'column2' => 'Header Column 2',
                    'column3' => 'Header Column 3'
                ]
            ]
        ]);
    }
}
