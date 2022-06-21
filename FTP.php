<?php
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

$f = new FTP();
$f->getFile();
$f->closeConnection();
?>