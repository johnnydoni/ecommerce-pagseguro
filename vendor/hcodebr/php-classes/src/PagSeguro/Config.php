<?php

namespace Hcode\PagSeguro;

class Config {

    const SANDBOX = true;
    
    const SANDBOX_EMAIL = "inods@hotmail.com";
    const PRODUCTION_EMAIL = "inods@hotmail.com";

    const SANDBOX_TOKEN = "948C197E48DE478BBC90AF535D6EAFB0";
    const PRODUCTION_TOKEN = "";

    const SANDBOX_SESSIONS = "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions";
    const PRODUCTION_SESSIONS = "https://ws.pagseguro.uol.com.br/v2/sessions";

    const SANDBOX_URL_JS = "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";
    const PRODUCTION_URL_JS = "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";

    const SANDBOX_URL_TRANSACTION = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions";
    const PRODUCTION_URL_TRANSACTION = "https://ws.pagseguro.uol.com.br/v2/transactions";
        
    const MAX_INSTALLMENT_NO_INTEREST = 10;
    const MAX_INSTALLMENT = 10;

    const SANDBOX_URL_NOTIFICATION = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/";
    const PRODUCTION_URL_NOTIFICATION = "https://ws.pagseguro.uol.com.br/v2/transactions/notifications/";

    const NOTIFICATION_URL = "http://html5dev.com.br/payment/notification";

    public static function getAuthentication():array {
        if (Config::SANDBOX === true) {
            return [
                "email"=>Config::SANDBOX_EMAIL,
                "token"=>Config::SANDBOX_TOKEN
            ];
        } else {
            return [
                "email"=>Config::PRODUCTION_EMAIL,
                "token"=>Config::PRODUCTION_TOKEN
            ];
        }
    }

    public static function getUrlSessions():string {
        return (Config::SANDBOX === true) ? Config::SANDBOX_SESSIONS : Config::PRODUCTION_SESSIONS;
    }

    public static function getUrlJS() {
        return (Config::SANDBOX === true) ? Config::SANDBOX_URL_JS : Config::PRODUCTION_URL_JS;   
    }
    
    public static function getUrlTransaction() {
        return (Config::SANDBOX === true) ? Config::SANDBOX_URL_TRANSACTION : Config::PRODUCTION_URL_TRANSACTION;   
    }

    public static function getNotificationTransactionURL() {
        return (Config::SANDBOX === true) ? Config::SANDBOX_URL_NOTIFICATION : Config::PRODUCTION_URL_NOTIFICATION;   
    }   

}

?>