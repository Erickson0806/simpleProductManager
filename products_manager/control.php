<!--用户触发事件的控制页面-->
<?php
header("Content-type: text/html; charset=utf-8");

    function __autoload($className){
      include $className."_class.php";
    }
    $DbModel = new ProductModel();
    switch($_GET["action"]){
        case "add":
            $product = new Product($_POST);
            if($DbModel->addProduct($product)){
                header("Location:index.php");
            } else {
                echo 'adderror添加商品失败，请<a href="index.php">返回</a>';
            }
            break;
        case "modify":

            $product = new Product($_POST);
            if($DbModel->modifyProduct($product)){
                header("Location:index.php");
            } else {
                echo 'modiftError修改商品失败，请<a href="index.php">返回</a>';
            }
            break;
        case "delete":

            if($DbModel->deleteProduct($_GET["productID"])){
                header("Location:index.php");
            } else {
                echo 'deleError删除商品失败，请<a href="index.php">返回</a>';
            }
            break;
        default:
            echo '不会发生';
            break;

    }
?>