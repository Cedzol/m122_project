
<?php

include 'TextFile.php';
include 'XML.php';
class FTP {
    var $ftp_server = "ftp.haraldmueller.ch";
    var $ftp_conn;

    function __construct() {
        $ftp_username = "schoolerinvoices";
        $ftp_userpass = "Berufsschule8005!";
        $this-> ftp_conn = ftp_connect($this->ftp_server) or die("Could not connect to $this->ftp_server");;
        $login = ftp_login($this->ftp_conn, $ftp_username, $ftp_userpass);
    }

    public function closeConnection(){
        ftp_close($this->ftp_conn);
    }

    public function getFiles(){

            $contents = ftp_nlist($this->ftp_conn, "/out/AP21aZollinger/");
            foreach ($contents as &$value){
                if (str_contains($value, ".data") && str_contains($value, "rechnung")){
                    $localName = explode("/", $value);
                    ftp_get($this->ftp_conn, $localName[3], $value, FTP_ASCII);
                }
            }
    }

    public function uploadFile($local_file, $test_file){
        if (ftp_put($this->ftp_conn, $test_file, $local_file, FTP_ASCII)){
            echo "Succesfully uploaded $test_file\n";
        }

        else {
            echo "Error uploading $test_file\n";
        }
    }
}

$local_file = "local.data";
$server_file = "/out/AP21aZollinger/rechnung21003.data";
$test_file = "/out/AP21aZollinger/test.data";

$x = new XML();

$x->writeXML("234234", "41010000001234567", "41301000000012497", "2021-03-14", "A003",
"CHE-111.222.333", "Adam Adler", "Bahnhofstrasse 1", "8000 Zuerich", "Autoleasing AG",
"Gewerbestrasse 100", "5000 Aarau", "0000135000", "40");

$t = new TextFile("24234");
$t->writeBill();


$f = new FTP();
$f->getFiles();
$f->closeConnection();

?>