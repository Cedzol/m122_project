<?php

class XML
{
    public function writeXML(){
        $writer = new XMLWriter();
        $writer->openUri('result.xml');

        $writer->setIndentString('  ');
        $writer->setIndent(true);

        $writer->startDocument( '1.0', 'UTF-8' );
        $writer->startElement('XML-FSCM-INVOICE-2003A');
            $writer->startElement('INTERCHANGE');
                $writer->startElement('IC-SENDER');
                    $writer->writeElement('Pid', "41010000001234567");
                $writer->endElement();
                    $writer->startElement('IC-RECEIVER');
                        $writer->writeElement('Pid', "41301000000012497");
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
                            $writer->endElement();
                                $writer->startElement('MESSAGE-REFERENCE');
                                    $writer->startElement('REFERENCE-DATE');
                                    $writer->writeElement("Reference-NO", "202107164522001");
                                    $writer->writeElement("Date", "20210731");
                                $writer->endElement();
                            $writer->endElement();
                                $writer->startElement('PRINT-DATE');
                                    $writer->writeElement("Date", "20210731");
                                $writer->endElement();
                                    $writer->startElement('REFERENCE');
                                        $writer->startElement('INVOICE-REFERENCE');
                                            $writer->startElement('REFERENCE-DATE');
                                                $writer->writeElement("Reference-NO", "202107164522001");
                                                $writer->writeElement("Date", "20210731");
                                            $writer->endElement();
                                        $writer->endElement();
                                            $writer->startElement('ORDER');
                                                $writer->startElement('REFERENCE-DATE');
                                                    $writer->writeElement("Reference-No", "A003");
                                                    $writer->writeElement("Date", "20210731");
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
                                                            $writer->writeElement("Reference-No", "202107164522001");
                                                            $writer->writeElement("Date", "20210731");
                                                        $writer->endElement();
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


<XML-FSCM-INVOICE-2003A>
    <INTERCHANGE>
        <IC-SENDER>
            <Pid>41010000001234567</Pid>
        </IC-SENDER>
        <IC-RECEIVER>
            <Pid>41301000000012497</Pid>
        </IC-RECEIVER>
        <IR-Ref />
    </INTERCHANGE>
    <INVOICE>
        <HEADER>
            <FUNCTION-FLAGS>
                <Confirmation-Flag />
                <Canellation-Flag />
            </FUNCTION-FLAGS>
            <MESSAGE-REFERENCE>
                <REFERENCE-DATE>
                    <Reference-No>202107164522001</Reference-No>
                    <Date>20210731</Date>
                </REFERENCE-DATE>
            </MESSAGE-REFERENCE>
            <PRINT-DATE>
                <Date>20210731</Date>
            </PRINT-DATE>
            <REFERENCE>
                <INVOICE-REFERENCE>
                    <REFERENCE-DATE>
                        <Reference-No>21003</Reference-No>
                        <Date>20210731</Date>
                    </REFERENCE-DATE>
                </INVOICE-REFERENCE>
                <ORDER>
                    <REFERENCE-DATE>
                        <Reference-No>A003</Reference-No>
                        <Date>20210731</Date>
                    </REFERENCE-DATE>
                </ORDER>
                <REMINDER Which="MAH">
                    <REFERENCE-DATE>
                        <Reference-No></Reference-No>
                        <Date></Date>
                    </REFERENCE-DATE>
                </REMINDER>
                <OTHER-REFERENCE Type="ADE">
                    <REFERENCE-DATE>
                        <Reference-No>202107164522001</Reference-No>
                        <Date>20210731</Date>
                    </REFERENCE-DATE>
                </OTHER-REFERENCE>
            </REFERENCE>
            <BILLER>
                <Tax-No>CHE-111.222.333 MWST</Tax-No>
                <Doc-Reference Type="ESR-ALT "></Doc-Reference>
                <PARTY-ID>
                    <Pid>41010000001234567</Pid>
                </PARTY-ID>
                <NAME-ADDRESS Format="COM">
                    <NAME>
                        <Line-35>Adam Adler</Line-35>
                        <Line-35>Bahnhofstrasse 1</Line-35>
                        <Line-35>8000 Zürich</Line-35>
                        <Line-35></Line-35>
                        <Line-35></Line-35>
                    </NAME>
                    <STREET>
                        <Line-35></Line-35>
                        <Line-35></Line-35>
                        <Line-35></Line-35>
                    </STREET>
                    <City></City>
                    <State></State>
                    <Zip></Zip>
                    <Country></Country>
                </NAME-ADDRESS>
                <BANK-INFO>
                    <Acct-No></Acct-No>
                    <Acct-Name></Acct-Name>
                    <BankId Type="BCNr-nat" Country="CH">001996</BankId>
                </BANK-INFO>
            </BILLER>
            <PAYER>
                <PARTY-ID>
                    <Pid>41301000000012497</Pid>
                </PARTY-ID>
                <NAME-ADDRESS Format="COM">
                    <NAME>
                        <Line-35>Autoleasing AG</Line-35>
                        <Line-35>Gewerbestrasse 100</Line-35>
                        <Line-35>5000 Aarau</Line-35>
                        <Line-35></Line-35>
                        <Line-35></Line-35>
                    </NAME>
                    <STREET>
                        <Line-35></Line-35>
                        <Line-35></Line-35>
                        <Line-35></Line-35>
                    </STREET>
                    <City></City>
                    <State></State>
                    <Zip></Zip>
                    <Country></Country>
                </NAME-ADDRESS>
            </PAYER>
        </HEADER>
        <LINE-ITEM />
        <SUMMARY>
            <INVOICE-AMOUNT>
                <Amount>0000135000</Amount>
            </INVOICE-AMOUNT>
            <VAT-AMOUNT>
                <Amount></Amount>
            </VAT-AMOUNT>
            <DEPOSIT-AMOUNT>
                <Amount></Amount>
                <REFERENCE-DATE>
                    <Reference-No></Reference-No>
                    <Date></Date>
                </REFERENCE-DATE>
            </DEPOSIT-AMOUNT>
            <EXTENDED-AMOUNT Type="79">
                <Amount></Amount>
            </EXTENDED-AMOUNT>
            <TAX>
                <TAX-BASIS>
                    <Amount></Amount>
                </TAX-BASIS>
                <Rate Categorie="S">0</Rate>
                <Amount></Amount>
            </TAX>
            <PAYMENT-TERMS>
                <BASIC Payment-Type="ESR" Terms-Type="1">
                    <TERMS>
                        <Payment-Period Type="M" On-Or-After="1" Reference-Day="31">30</Payment-Period>
                        <Date>20210830</Date>
                    </TERMS>
                </BASIC>
                <DISCOUNT Terms-Type="22">
                    <Discount-Percentage>0.0</Discount-Percentage>
                    <TERMS>
                        <Payment-Period Type="M" On-Or-After="1" Reference-Day="31"></Payment-Period>
                        <Date></Date>
                    </TERMS>
                    <Back-Pack-Container Encode="Base64"> </Back-Pack-Container>
                </DISCOUNT>
            </PAYMENT-TERMS>
        </SUMMARY>
    </INVOICE>
</XML-FSCM-INVOICE-2003A>

