<!--声明商品类的文件-->
<?php
header("Content-type: text/html; charset=utf-8");

    class Product {
        private  $productId;
        private  $name;
        private  $price;
        private  $description;

        //构造方法，创建商品对象，为成员属性赋初值
        //参数$product:需要一个数组，通常$_POST,保存所有输入表单的值
        public function __construct($product=array()){
            foreach($product as $property=>$value){
                $this->$property = $value;
            }
        }

        //获取商品id
        public function getId(){
            if(!empty($this->productId)){
                return $this->productId;
            } else {
                return false;
            }

        }

        //获取商品名
        public function getName(){
            if(!empty($this->name)){
                return $this->html2text($this->name);
            }else {
                return "未知商品名称";
            }

        }

        //获取没有格式化的商品价格
        public function getSrcPrice(){
            return $this->price;
        }

        //返回商品单价
        public function getPrice(){
            if(!empty($this->price)){
                return $this->moneyFormat($this->price);
            }else {
                return "未知价格";
            }
        }
        //返回商品描述
        public function getDescription(){
            if(!empty($this->description)){
                return $this->html2text($this->description);
            } else {
                return "该商品没有详细的介绍信息";
            }
        }
        //格式化HTMl
        private function html2text($html){
            return htmlspecialchars(stripslashes($html));
        }
        //处理money格式
        private function moneyFormat($price){
            return number_format($price,2,'.',',');
        }


    }
?>