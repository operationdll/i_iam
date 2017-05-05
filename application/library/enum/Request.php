<?php

/**
 * 用户枚举
 *
 * 2015年7月13日
 */
class Enum_Request {

    const RPC_REQUEST_UA = "YoupuTrip/1.0(rop;)";

    public static function getUrlConfigById($interfaceId) {
        $config = array(
            'B' => 'Rpc_UrlConfigBase',
            'AU' => 'Rpc_UrlConfigAdmin',
            'GH' => 'Rpc_UrlConfigHotel',
            'GA' => 'Rpc_UrlConfigActivity',
            'APP' => 'Rpc_UrlConfigApp',
            'LI' => 'Rpc_UrlConfigLife',
            'R' => 'Rpc_UrlConfigRoom',
            'GS' => 'Rpc_UrlConfigShopping',
            'GSH' => 'Rpc_UrlConfigShowing',
            'F' => 'Rpc_UrlConfigFeedback',
            'T' => 'Rpc_UrlConfigTel',
        );
        $fileKey = preg_replace('/\d+/', '', $interfaceId);
        $fileNameKey = $config[$fileKey];
        if (empty($fileNameKey)) {
            return false;
        }
        $interfaceConfig = $fileNameKey::getConfig($interfaceId);
        if ($interfaceConfig) {
            return $interfaceConfig;
        } else {
            return false;
        }
    }
}
