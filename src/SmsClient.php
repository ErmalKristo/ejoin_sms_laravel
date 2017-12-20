<?php
namespace Wangjian\Alisms;

use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;

class SmsClient {
    /**
     * AscClient
     * @var Aliyun\Core\DefaultAscClient
     */
    protected $acsClient;

    public function __construct($accessKeyId, $accessKeySecret) {
        //the api product name
        $product = "Dysmsapi";

        //the api domain
        $domain = "dysmsapi.aliyuncs.com";

        $region = "cn-hangzhou";
        $endPointName = "cn-hangzhou";

        //load the region config
        Config::load();

        //initiate the profile
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);

        //add end point
        DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);

        $this->acsClient = new DefaultAcsClient($profile);
    }

    public function sendSms($signName, $templateCode, $phoneNumbers, $templateParam = null, $outId = null) {
        $phoneNumbers = is_string($phoneNumbers) ? $phoneNumbers : implode(',', $phoneNumbers);

        $request = new SendSmsRequest();
        $request->setPhoneNumbers($phoneNumbers);
        $request->setSignName($signName);
        $request->setTemplateCode($templateCode);
        if($templateParam) {
            $request->setTemplateParam(json_encode($templateParam));
        }
        if($outId) {
            $request->setOutId($outId);
        }

        $acsResponse = $this->acsClient->getAcsResponse($request);

        return $acsResponse;
    }

    public function queryDetails($phoneNumbers, $sendDate, $pageSize = 10, $currentPage = 1, $bizId=null) {
        $request = new QuerySendDetailsRequest();
        $request->setPhoneNumber($phoneNumbers);
        $request->setBizId($bizId);
        $request->setSendDate($sendDate);
        $request->setPageSize($pageSize);
        $request->setCurrentPage($currentPage);

        $acsResponse = $this->acsClient->getAcsResponse($request);

        return $acsResponse;
    }
}