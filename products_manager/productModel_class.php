<!--声明和数据库中商品增、删、改、查相关的类，保存在该文件中-->

<?php
header("Content-type: text/html; charset=utf-8");

    class ProductModel extends MyDB {

        //将商品信息插入数据表中
        public function addProduct($product){
            $query = "INSERT INTO product(name,price,description) VALUES(?,?,?)";

            $stmt = $this->mysqli->prepare($query);

            $stmt->bind_param('sds',$name,$price,$description);
            $name = $product->getName();
            $price = $product->getSrcPrice();
            $description = $product->getDescription();
            $stmt->execute();

            echo "affectROW：".$stmt->affected_rows;
            if($stmt->affected_row!=1){
                $this->printError("insertError数据插入失败：".$stmt->error);
                return false;

            } else {
                return $this->mysqli->insert_id;
            }
        }

        //删除指定的记录
        public function deleteProduct($productID){
            $query = "DELETE FROM product WHERE productID = ".$productID."";

            if($this->mysqli->query($query)){

                return true;
            } else {
                $this->printError("delete error：".$this->mysqli->error);
                return false;
            }
        }
        //修改指定记录
        public function modifyProduct($product){
            echo "11";
            $query = "UPDATE product set name=?,price=?,description=? WHERE productID=?";
            echo "2";
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('sdsi',$name,$price,$description,$productID);
            $name = $product->getName();
            $price = $product->getSrcPrice();
            $description = $product->getDescription();
            $productID = $product->getId();
            $stmt->execute();

            if($stmt->affected_rows!=1){
                $this->printError("数据更新失败：".$stmt->error);
                return false;
            }else {
                return true;
            }
        }

        public function selectSingleProduct($productId){
            $query = "SELECT *FROM product WHERE productID=''.$productId.";
            if($result = $this->mysqli->query($query)){
                if($row=$result->fetch_assoc()){
                    $product = new Product($row);
                    $result->close();
                    return $product;
                } else {
                    $result->close();
                    $this->printError("获取单条数据失败");
                    return false;
                }
            }else {
                $this->printError("数据查询失败：".$this->mysqli->error);
                return false;
            }
        }

        public function selectAllProduct(){
            $query = "SELECT *FROM product ORDER BY productID";
            if($result = $this->mysqli->query($query)){
                if($result->num_rows){
                    while($row=$result->fetch_assoc()){
                        $allproduct[]=new Product($row);

                    }
                    $result->close();
                    return $allproduct;
                } else {
                    $result->close();
                    $this->printError("没有获取任何记录");
                    return false;
                }
            }else {
                $this->printError("数据查询失败：".$this->mysqli->error);
                return false;
            }
        }


    }
?>