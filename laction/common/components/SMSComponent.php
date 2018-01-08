<?php
namespace common\components;

class SMSComponent
{

    private $strAuthKey;

    private $strSender;

    private $intRoute;

    private $strSecureURL;

    private $phone;

    private $message;

    public function __construct($arrSmsData)
    {
        $this->strAuthKey = $arrSmsData['key'];
        $this->strSender = $arrSmsData['sender'];
        $this->intRoute = $arrSmsData['route'];
        $this->strSecureURL = $arrSmsData['url'];
        $this->phone = $arrSmsData['phone'];
        $this->message = $arrSmsData['message'];
        unset($arrSmsData);
    }

    public function fireSMS()
    {
        $strSMS = $this->send($this->getData());
        return $strSMS;
    }

    private function getData()
    {
        return [
            'authkey' => $this->strAuthKey,
            'mobiles' => $this->phone,
            'message' => $this->message,
            'sender' => $this->strSender,
            'route' => $this->intRoute,
            'url' => $this->strSecureURL
        ];
    }

    private function send($arrSMS)
    {
        $strSMS = NULL;
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $arrSMS['url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $arrSMS
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $strSMS = curl_exec($ch);
        if (curl_errno($ch)) {
            $strSMS .= ' :: ' . curl_error($ch);
        }
        curl_close($ch);
        return $strSMS;
    }
}
