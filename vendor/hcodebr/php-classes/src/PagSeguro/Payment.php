<?php

namespace HCode\PagSeguro;

class Payment {

    private $mode = "default";
    private $currency = "BRL";
    private $extraAmout = 0;
    private $reference ="";
    private $items = [];
    private $sender;
    private $shipping;
    private $method;
    private $creditCard;
    private $bank;

    public function __construct(string $reference, Sender $sender, Shipping $shipping, float $extraAmount) {
        $this->sender = $sender;
        $this->shipping = $shipping;
        $this->reference = $reference;
        $this->extraAmount = number_format($extraAmount,2,".","");
    }

    public function getDOMDocument():DOMDocument {
        $dom = new DOMDocument("1.0", "ISO-8859-1");
    }

}

?>
