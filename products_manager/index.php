<!--商品后台管理首页-->
<?php

header("Content-type: text/html; charset=utf-8");

    require("header.inc.php");
    function __autoload($className){
        include $className."_class.php";
    }
    $DbModel = new ProductModel();
    $allProducts = $DbModel->selectAllProduct();
    if($allProducts){
        //以HTML表格的形式输出从数据库中获取到的所有商品记录
        echo '<table align="center" width="90%" border="1">';
        echo '<caption><h2>商品列表</h2></caption>';
        echo '<th>产品ID</th><th>名称</th><th>价格</th><th>编辑</th>';
        foreach ($allProducts as $product) {
            echo '<tr>';
            echo '<td>'.$product->getId().'</td>';
            echo '<td>'.$product->getName().'</td>';
            echo '<td>'.$product->getPrice().'</td>';
            echo '<td><a href="editview.php?action=modify&productID='.$product->getId().'">修改/</a>';
            echo '<a href="control.php?action=delete&productID='.$product->getId().'">删除</a></td>';

            echo '</td></tr>';
        }
        echo '</table>';


    }else {
        echo '<p align="center">没有任何商品</p>';
    }
    echo '<center><a href="editview.php?action=add">添加商品</a></center>';
    require("footer.inc.php");
?>