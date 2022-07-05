<?php
class TextFile {
    var $textFile;
    var $invoiceNr;
    var $clientNr;
    var $jobId;
    var $cityWhereInvoiceGotCreated;
    var $dateWhenInvoiceGotCreated;
    var $timeWhenInvoiceGotCreated;
    var $timeToPayInvoice;
    var $clientName;
    var $clientStreet;
    var $clientPlace;
    var $clientIban;
    var $clientMail;
    var $finalName;
    var $finalStreet;
    var $finalPlace;
    var $invoicePos1;
    var $invoicePos2;
    var $billNum;

    function __construct($billNumber) {
        $this->textFile = fopen("$billNumber.txt","w");
        $this->billNum = $billNumber;
    }

    public function getJobs(){
    }

    public function readInvoice($billNumb)
    {
        $file = "rechnung$billNumb.data";
        $myfile = fopen("$file", "r") or die("Unable to open file!");
        $invoiceData = fread($myfile, filesize($file));
        $pieces = explode(";", $invoiceData);
        $ArrInvoiceNr = explode("_", $pieces[0]);
        $ArrJobNr = explode("_", $pieces[1]);
        $timeToPay = explode("_", $pieces[5]);
        $cliIban = explode(" ", $pieces[11]);
        $mwst = explode("_", $pieces[24]);
        $mwst2 = explode("_", $pieces[31]);
        //rechnungs MetaDaten
        $this->invoiceNr = $ArrInvoiceNr[1];
        $this->jobId = $ArrJobNr[1];
        $this->cityWhereInvoiceGotCreated = $pieces[2];
        $this->dateWhenInvoiceGotCreated = $pieces[3];
        $this->timeWhenInvoiceGotCreated = $pieces[4];
        $this->timeToPayInvoice = $timeToPay[1];
        //rechnungs Herkunft Daten
        $this->clientNr = $pieces[7];
        $this->clientName = $pieces[8];
        $this->clientStreet = $pieces[9];
        $this->clientPlace = $pieces[10];
        $this->clientIban = $cliIban[0];
        $this->clientMail = $pieces[12];
        //endkunde Daten
        $this->finalName = $pieces[15];
        $this->finalStreet = $pieces[16];
        $this->finalPlace = $pieces[17];
        //rechnungsPositionen
        $this->invoicePos1 = array(
            "index" => $pieces[19],
            "name" => $pieces[20],
            "amount" => $pieces[21],
            "singelPrice" => $pieces[22],
            "fullPrice" => $pieces[23],
            "mwst" => $mwst[1]
        );
        $this->invoicePos2 = array(
            "index" => $pieces[26],
            "name" => $pieces[27],
            "amount" => $pieces[28],
            "singelPrice" => $pieces[29],
            "fullPrice" => $pieces[30],
            "mwst" => $mwst2[1]
        );
        fclose($myfile);
    }

    public function writeBill($nameSender, $streetSender, $zipSender, $ibanSender, $locationSender, $date,
    $nameRecipient, $streetRecipient, $zipRecipient, $locationRecipient, $clientNumber, $jobNumber,
    $billNumber,
                              $jobs,

    $total,
    $mwst,
    $days,
    $untilDate,
    $totalPayment,
    $totalPaymentMWST

    ){
        $this->readInvoice($this->billNum);
        vfprintf($this->textFile,
            "
%s
%s
%s

%s




%s, den %s                                       %s
                                                 %s
                                                 %s %s

Kundennummer:      %s
Auftragsnummer:    %s

Rechnung Nr       %s
-----------------------
%s
                                                              -----------       
                                                Total CHF            %u

                                                MWST  CHF            %u
















Zahlungsziel ohne Abzug %u Tage (%s)

Einzahlungsschein











    %s                    %s                   %s
                                               %s
0 00000 00000 00000                            %s %s

%s
%s
%s %s
",array($nameSender, $streetSender, $zipSender, $ibanSender, $locationSender, $date,
                $nameRecipient, $streetRecipient, $zipRecipient, $locationRecipient, $clientNumber, $jobNumber,
                $billNumber,
                $jobs,

                $total,
                $mwst,
                $days,
                $untilDate,
                $totalPayment,
                $totalPaymentMWST,
                $nameRecipient, $streetRecipient, $zipRecipient, $locationRecipient,
                $nameRecipient, $streetRecipient, $zipRecipient, $locationRecipient));
    }
}
?>


1   Einrichten E-Mailclients
