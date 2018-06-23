<?php

namespace HCode\PagSeguro;

use Exception;
use DOMDocument;
use DOMElement;
use \Hcode\PagSeguro\Payment\Method;

class Payment {

    private $mode = "default";
    private $currency = "BRL";
    private $extraAmout = 0;
    private $reference = "";
    private $items = [];
    private $sender;
    private $shipping;
    private $method;
    private $creditCard;
    private $bank;

    public function __construct(string $reference, Sender $sender, Shipping $shipping, float $extraAmount = 0) {
        $this->sender = $sender;
        $this->shipping = $shipping;
        $this->reference = $reference;
        $this->extraAmount = number_format($extraAmount,2,".","");
    }

    public function addItem(Item $item) {
        array_push($this->items, $item);
    }

    public function setCreditCard(CreditCard $creditCard) {
        $this->creditCard = $creditCard;
        $this->method = Method::CREDIT_CARD;
    }

    public function setBank(Bank $bank) {
        $this->bank = $bank;
        $this->method = Method::DEBIT;
    }

    public function setBoleto() {
        $this->method = Method::BOLETO;
    }

    public function getDOMDocument():DOMDocument {
        $dom = new DOMDocument("1.0", "ISO-8859-1");

        // payment
        $payment = $dom->createElement("payment");
        $payment = $dom->appendChild($payment);
        
        // mode
        $mode = $dom->createElement("mode", $this->mode);
        $mode = $payment->appendChild($mode);

        // method
        $method = $dom->createElement("method", $this->method);
        $method = $payment->appendChild($method);

        // sender
        $sender = $this->sender->getDOMElement();
        $sender = $dom->importNode($sender, true);
        $sender = $payment->appendChild($sender);

        // currency
        $currency = $dom->createElement("currency", $this->currency);
        $currency = $payment->appendChild($currency);

        // notificationURL
        $notificationURL = $dom->createElement("notificationURL", Config::NOTIFICATION_URL);
        $notificationURL = $payment->appendChild($notificationURL);

        // items
        $items = $dom->createElement("items");
        $items = $payment->appendChild($items);
        foreach($this->items as $_item) {
            $item = $_item->getDOMElement();
            $item = $dom->importNode($item, true);
            $item = $items->appendChild($item);
        }
        
        // extraAmount
        $extraAmount = $dom->createElement("extraAmount", $this->extraAmount);
        $extraAmount = $payment->appendChild($extraAmount);

        // reference
        $reference = $dom->createElement("reference", $this->reference);
        $reference = $payment->appendChild($reference);

        // shipping
        $shipping = $this->shipping->getDOMElement();
        $shipping = $dom->importNode($shipping, true);
        $shipping = $payment->appendChild($shipping);

        switch ($this->method) {
            case Method::CREDIT_CARD:
                // creditCard
                $creditCard = $this->creditCard->getDOMElement();
                $creditCard = $dom->importNode($creditCard, true);
                $creditCard = $payment->appendChild($creditCard); 
            break;
            
            case Method::DEBIT:
                // bank
                $bank = $this->bank->getDOMElement();
                $bank = $dom->importNode($bank, true);
                $bank = $payment->appendChild($bank); 
            break;
        }

        return $dom;
    }

}

?>
