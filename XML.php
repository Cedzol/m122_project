<?php

class XML
{
    public function writeXML($paymentNumber, $senderPID, $receiverPID, $date, $referenceNumber, $CHE, $senderName, $senderAdress, $senderZIPLocation,
    $receiverName, $receiverAddress, $receiverZIPLocation, $overallPayment, $days){
        $date = new DateTime($date);
        $date->format("U");
        $timeStamp = date_create();
        $dateUntil = new DateTime(date("Y-m-d", $date->getTimestamp()));
        $dateUntil->add(new DateInterval("P".$days."D"));
        $timeStamp = date_timestamp_get($timeStamp);
        $writer = new XMLWriter();
        $writer->openUri('rechnung' . $paymentNumber . '.xml');

        $writer->setIndentString('  ');
        $writer->setIndent(true);

        $writer->startDocument( '1.0', 'UTF-8' );
        $writer->startElement('XML-FSCM-INVOICE-2003A');
            $writer->startElement('INTERCHANGE');
                $writer->startElement('IC-SENDER');
                    $writer->writeElement('Pid', "$senderPID");
                $writer->endElement();
                    $writer->startElement('IC-RECEIVER');
                        $writer->writeElement('Pid', "$receiverPID");
                $writer->endElement();
                $writer->startElement("IR-Ref");
                $writer->endElement();
                    $writer->startElement('INVOICE');
                        $writer->startElement('HEADER');
                            $writer->startElement('FUNCTION-FLAGS');
                                $writer->startElement('Confirmation-Flag');
                                $writer->endElement();
                                    $writer->startElement('Canellation-Flag');
                                    $writer->endElement();
                                $writer->endElement();
                                $writer->startElement('MESSAGE-REFERENCE');
                                    $writer->startElement('REFERENCE-DATE');
                                    $writer->writeElement("Reference-NO", "$timeStamp");
                                    $writer->writeElement("Date", $date->format("Ymd". "\n"));
                                $writer->endElement();
                            $writer->endElement();
                                $writer->startElement('PRINT-DATE');
                                    $writer->writeElement("Date", $date->format("Ymd". "\n"));
                                $writer->endElement();
                                    $writer->startElement('REFERENCE');
                                        $writer->startElement('INVOICE-REFERENCE');
                                            $writer->startElement('REFERENCE-DATE');
                                                $writer->writeElement("Reference-NO", "$paymentNumber");
                                                $writer->writeElement("Date", $date->format("Ymd". "\n")); //date = 20210731
                                            $writer->endElement();
                                        $writer->endElement();
                                            $writer->startElement('ORDER');
                                                $writer->startElement('REFERENCE-DATE');
                                                    $writer->writeElement("Reference-No", "$referenceNumber"); //A003
                                                    $writer->writeElement("Date", $date->format("Ymd". "\n"));
                                                $writer->endElement();
                                            $writer->endElement();
                                                $writer->startElement('REMINDER');
                                                $writer->writeAttribute('Which', "MAH");
                                                    $writer->startElement('REFERENCE-DATE');
                                                        $writer->writeElement("Reference-No");
                                                        $writer->writeElement("Date");
                                                    $writer->endElement();
                                                $writer->endElement();
                                                    $writer->startElement('OTHER-REFERENCE');
                                                    $writer->writeAttribute('Type', "ADE");
                                                        $writer->startElement('REFERENCE-DATE');
                                                            $writer->writeElement("Reference-No", "$timeStamp");
                                                            $writer->writeElement("Date", $date->format("Ymd". "\n"));
                                                        $writer->endElement();
                                                    $writer->endElement();
                                                $writer->endElement();

        $writer->startElement('BILLER');
            $writer->writeElement("Tax-No", "$CHE MWST");
            $writer->writeElement("Doc-Reference", "$CHE MWST");
            $writer->writeAttribute('Type', "ESR-ALT");
                $writer->startElement('PARTY-ID');
                    $writer->writeElement("Pid", "$senderPID");
                $writer->endElement();

                    $writer->startElement('NAME-ADDRESS');
                    $writer->writeAttribute('Format', "COM");
                        $writer->startElement('NAME-ADDRESS');
                            $writer->writeElement("Line-35", "$senderName");
                            $writer->writeElement("Line-35", "$senderAdress");
                            $writer->writeElement("Line-35", "$senderZIPLocation");
                            $writer->writeElement("Line-35", "");
                            $writer->writeElement("Line-35", "");
                        $writer->endElement();
                    $writer->endElement();
                        $writer->startElement('STREET');
                        $writer->endElement();
                            $writer->startElement('STREET');
                                $writer->writeElement("Line-35", "");
                                $writer->writeElement("Line-35", "");
                                $writer->writeElement("Line-35", "");
                            $writer->endElement();
                            $writer->startElement('City');
                            $writer->endElement();
                            $writer->startElement('State');
                            $writer->endElement();
                            $writer->startElement('Zip');
                            $writer->endElement();
                            $writer->startElement('Country');
                            $writer->endElement();
                        $writer->endElement();
                            $writer->startElement('BANK-INFO');
                                $writer->writeElement("ACCT-No", "");
                                $writer->writeElement("ACCT-Name", "");
                                $writer->writeElement("BankId", "001996");
                                $writer->writeAttribute('Type', "BCNr-nat");
                                $writer->writeAttribute('Country', "CH");
                            $writer->endElement();
                        $writer->endElement();


        $writer->startElement('PAYER');
        $writer->startElement('PARTY-ID');
        $writer->writeElement("Pid", "$receiverPID");
        $writer->endElement();

        $writer->startElement('NAME-ADDRESS');
        $writer->writeAttribute('Format', "COM");
        $writer->startElement('NAME-ADDRESS');
        $writer->writeElement("Line-35", "$receiverName");
        $writer->writeElement("Line-35", "$receiverAddress");
        $writer->writeElement("Line-35", "$receiverZIPLocation");
        $writer->writeElement("Line-35", "");
        $writer->writeElement("Line-35", "");
        $writer->endElement();
        $writer->endElement();
        $writer->startElement('STREET');
        $writer->endElement();
        $writer->startElement('STREET');
        $writer->writeElement("Line-35", "");
        $writer->writeElement("Line-35", "");
        $writer->writeElement("Line-35", "");
        $writer->endElement();
        $writer->startElement('City');
        $writer->endElement();
        $writer->startElement('State');
        $writer->endElement();
        $writer->startElement('Zip');
        $writer->endElement();
        $writer->startElement('Country');
        $writer->endElement();
        $writer->endElement();
        $writer->endElement();
        $writer->endElement();
        $writer->startElement('LINE-ITEM');
        $writer->endElement();
        $writer->startElement('SUMMARY');
            $writer->startElement('INVOICE-AMOUNT');
                $writer->writeElement('Amount', "$overallPayment"); //0000135000 = 1350.00
            $writer->endElement();
                $writer->startElement('VAT-AMOUNT');
                    $writer->writeElement('Amount', '');
                $writer->endElement();
                    $writer->startElement('DEPOSIT-AMOUNT');
                    $writer->writeElement('Amount', '');
                        $writer->startElement('REFERENCE-DATE');
                            $writer->writeElement('Reference-No', '');
                            $writer->writeElement('Date', '');
        $writer->endElement();
        $writer->endElement();
            $writer->startElement('EXTENED-AMOUNT');
            $writer->writeAttribute('Type', '79');
                $writer->writeElement('Amount', '');
        $writer->endElement();
            $writer->startElement('TAX');
                $writer->startElement('TAX-BASIS');
                $writer->writeElement('Amount', '');
            $writer->endElement();
            $writer->writeElement('Rate', '0');
            $writer->writeAttribute("Categorie", "S");
            $writer->writeElement('Amount', '');
            $writer->endElement();
                $writer->startElement('PAYMENT-TERMS');
                    $writer->startElement('BASIC');
                    $writer->writeAttribute("Payment-Type", "ESR");
                    $writer->writeAttribute("TERMS-Type", "1");
                    $writer->startElement('TERMS');
                        $writer->writeElement('Payment-Period', "$days");
                        $writer->writeAttribute("Type", "M");
                        $writer->writeAttribute("On-OrAfter", "1");
                        $writer->writeAttribute("Reference-Day", "31");
                        $writer->writeElement("Date", $dateUntil->format('Ymd'));
                    $writer->endElement();
                $writer->endElement();
        $writer->startElement('DISCOUNT');
        $writer->writeAttribute("Terms-Type", "22");
        $writer->writeElement("Disccount-Percentage", "0.0");
        $writer->startElement('TERMS');
        $writer->writeElement('Payment-Period', "$days");
        $writer->writeAttribute("Type", "M");
        $writer->writeAttribute("On-OrAfter", "1");
        $writer->writeAttribute("Reference-Day", "31");
        $writer->writeElement("Date", "");
        $writer->endElement();
        $writer->writeElement("Back-Pack-Container", "Base64");
        $writer->endElement();
        $writer->endElement();
        $writer->endElement();

        $writer->endElement();

                $writer->endElement();
            $writer->endElement();
        $writer->endElement();
        $writer->endDocument();
    }

}
?>



