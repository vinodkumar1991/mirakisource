<?php
namespace common\components;

use Yii;

class CommonComponent
{

    public static function generatePassword($intLength = 10)
    {
        $strPassword = Yii::$app->params['salt_key'] . bin2hex(openssl_random_pseudo_bytes($intLength));
        unset($intLength);
        return $strPassword;
    }

    public static function getMessageTypes()
    {
        return [
            'sms' => 'SMS',
            'email' => 'E-MAIL'
        ];
    }

    public static function getMessageCategoryTypes()
    {
        return [
            'transactional' => 'Transactional',
            'promotional' => 'Promotional'
        ];
    }

    public static function getRoutes()
    {
        return [
            'sms' => [
                'transactional' => 4,
                'promotional' => 1
            ]
        ];
    }

    public static function getFileTypes()
    {
        return [
            'image' => 'Image',
            'video' => 'Video'
        ];
    }

    private static function cryptoRandSecure($intMin, $intMax)
    {
        $intRanage = $intMax - $intMin;
        if ($intRanage < 1) {
            return $intMin;
        }
        $intLog = ceil(log($intRanage, 2));
        $intBytes = (int) ($intLog / 8) + 1;
        $intBits = (int) $intLog + 1;
        $intFilter = (int) (1 << $intBits) - 1;
        do {
            $intRnd = hexdec(bin2hex(openssl_random_pseudo_bytes($intBytes)));
            $intRnd = $intRnd & $intFilter;
        } while ($intRnd >= $intRanage);
        return ($intMin + $intRnd);
    }

    private static function getToken($intLength, $strTokenSoliders = NULL)
    {
        $strToken = "";
        if (! empty($strTokenSoliders)) {
            $strCodeAlphabet = $strTokenSoliders;
        } else {
            $strCodeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $strCodeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
            $strCodeAlphabet .= "0123456789";
        }
        $intMaxNumber = strlen($strCodeAlphabet) - 1;
        for ($i = 0; $i < $intLength; $i ++) {
            $strSecure = self::cryptoRandSecure(0, $intMaxNumber);
            $strToken .= $strCodeAlphabet[$strSecure];
        }
        return $strToken;
    }

    public static function getNumberToken($intLength = 6)
    {
        $strNumber = "0123456789";
        $strToken = self::getToken($intLength, $strNumber);
        unset($strNumber, $intLength);
        return $strToken;
    }

    public static function getSamllAlphaToken($intLength = 12)
    {
        $strSmall = "abcdefghijklmnopqrstuvwxyz";
        $strToken = self::getToken($intLength, $strSmall);
        unset($strSmall, $intLength);
        return $strToken;
    }

    public static function getBigAlphaToken($intLength = 12)
    {
        $strBig = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $strToken = self::getToken($intLength, $strBig);
        unset($strBig, $intLength);
        return $strToken;
    }

    public static function getCustomToken($strCustomSolider, $intLength = 6)
    {
        $strToken = self::getToken($intLength, $strCustomSolider);
        unset($strCustomSolider, $intLength);
        return $strToken;
    }

    public static function getDateDifferences($strStartDate, $strEndDate)
    {
        $strTimestampStartDate = strtotime($strStartDate);
        $strTimestampEndDate = strtotime($strEndDate);
        $doubleTimeInterval = abs($strTimestampStartDate - $strTimestampEndDate);
        $arrDateDiffInfo['seconds'] = round($doubleTimeInterval);
        $arrDateDiffInfo['minutes'] = round($doubleTimeInterval / 60);
        unset($strTimestampStartDate, $strTimestampEndDate, $doubleTimeInterval, $strStartDate, $strEndDate);
        return $arrDateDiffInfo;
    }
}
