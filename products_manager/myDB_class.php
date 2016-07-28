<!--数据库功能打包为自定义的类，作为父类，保存在该文件中-->
<?php
header("Content-type: text/html; charset=utf-8");

    class MyDB{
        protected $mysqli;
        protected $showError;

        public function __construct($configFile = "password.inc.php",$showError=true){
            require_once($configFile);
            $this->mysqli = new mysqli($dbhost,$dbuser,$dbpwd,$dbname);
            if(mysqli_connect_errno()){
                $this->printError("连接失败，".mysqli_connect_error());
                $this->mysqli=false;
                exit();
            }
            $this->mysqli->query("set names utf8");
            $this->showError = $showError;
        }
        protected function printError($errorMsg){
            if($this->showError){
                echo '<p><font color="red">'.htmlspecialchars($errorMsg).'</font></p>';
            }
        }
        public function close(){
            if($this->mysqli){
                $this->mysqli->close();
            }
            $this->mysqli=false;
        }
        public function __destruct(){
            $this->close();
        }
    }
?>