<?php

namespace HCode\PagSeguro\CreditCard;

class Installment {

    private $quantity;
    private $value;

    public function __construct(Address $quantity, float $value) {
        if (!$quantity < 1 || $quantity > Config::MAX_INSTALLMENT) {
            throw new Exception("Informe o número de parcelas válido.");
        }

        if ($value <= 0) {
            throw new Exception("Valor total inválido.");
        }

        $this->quantity = $quantity;
        $this->value = $value;
    }

    public function getDOMElement():DOMElement {
        $dom = new DOMDocument();
        $installment = $dom->createElement("installment");
        $installment = $dom->appendChild($installment);

        $value = $dom->createElement("value", number_format($this->value,2, ".", ""));
        $value = $holder->appendChild($value);   

        $quantity = $dom->createElement("quantity", $this->quantity);
        $quantity = $holder->appendChild($quantity);   

        $noInterestInstallmentQuantity = $dom->createElement("noInterestInstallmentQuantity", Config::MAX_INSTALLMENT_NO_INTEREST);
        $noInterestInstallmentQuantity = $holder->appendChild($noInterestInstallmentQuantity);   
        
        return $installment;
    }   

}

?>