<?php

namespace HCode\PagSeguro\CreditCard;

use Exception;
use DOMDocument;
use DOMElement;
use DateTime;
use Hcode\PagSeguro\Document;
use Hcode\PagSeguro\Phone;

class Holder {

    private $name;
    private $cpf;
    private $birthdate;
    private $phone;

    public function __construct(string $name, Document $cpf, DateTime $birthDate, Phone $phone) {
        if (!$name) {
            throw new Exception("Informe o nome do comprador.");
        }

        $this->name = $name;
        $this->cpf = $cpf;
        $this->birthDate = $birthDate;
        $this->phone = $phone;
    }

    public function getDOMElement():DOMElement {
        $dom = new DOMDocument();
        $holder = $dom->createElement("holder");
        $holder = $dom->appendChild($holder);

        $name = $dom->createElement("name", $this->name);
        $name = $holder->appendChild($name);        

        $documents = $dom->createElement("documents");
        $documents = $holder->appendChild($documents);

        $cpf = $this->cpf->getDOMElement();
        $cpf = $dom->importNode($cpf, true);
        $cpf = $documents->appendChild($cpf);

        $birthDate = $dom->createElement("birthDate", $this->birthDate->format("d/m/Y"));
        $birthDate = $holder->appendChild($birthDate);

        $phone = $this->phone->getDOMElement();
        $phone = $dom->importNode($phone, true);
        $phone = $holder->appendChild($phone);

        return $holder;
    }       
}

?>