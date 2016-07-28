<!--商品添加和商品修改的表单界面所在的文件-->
<?php
    require("header.inc.php");
    function __autoload($className){
        include $className."_class.php";
    }
    $title = "1";
    if($_GET["action"]=="add"){
        $title="添加商品";
        $view = true;
    } else {
        $title = "修改商品";
        $view = false;
        $Dbmodel = new ProductModel();
        $product = $Dbmodel->selectSingleProduct($_GET["productId"]);
    }
?>

<form action="control.php?action=<?php echo $view?'add':'modify';?>" method="POST">
    <table align="center" width="60%" border="0">
        <caption><h2><?php echo $title ?></h2></caption>
        <input type="hidden" name="productID" value="<?php echo $view?'':$_GET["productID"];?>">
        <tr>
            <th>商品名称：</th>
            <td><input type="text" name="name" value="<?php echo $view?'':$product->getName();?>"></td>

        </tr>
        <tr>
            <th>商品价格：</th>
            <td><input type="text" name="price" value="<?php echo $view?'':$product->getPrice();?>"></td>

        </tr>
        <tr>
            <th>商品介绍：</th>
            <td><textarea cols="40" role="5" name="description"><?php echo $view?'':$product->getDescription()?> </textarea></td>

        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" value="提交"><input type="reset" value="重置">
            </td>
        </tr>


    </table>

</form>
<?php require("footer.inc.php");?>