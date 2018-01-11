<?php 
include "libs/crud.php";
include "inc/head.php";

?>

    <!-- syntaxe alternative de if en PHP, plus adaptée au templating -->
    <?php if(isset($msg_crud)): ?>
    <p>
        <?php echo $msg_crud; unset($msg_crud) ?>
    </p>
    <?php endif; ?>

    <p>Ajouter un produit à votre stock :</p>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
       <p>Nom: <input class="input" name="nom" type="text" placeholder="Nom du produit" value="" required=""> Prix: <input class="input" name="prix" type="number" placeholder="Prix du produit" value="" required=""> Description: <input class="input" name="description" id="" cols="30" rows="10" placeholder="Description du produit" required=""></input></p>
        <div>
            <input class="submit" name="create_product" type="submit" value="Ajouter" class="btn">
        </div>
    </form>


    <?php if (isset($products) && count($products)): ?>
    <p>Liste des produits présent dans votre stock :</p>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table>
            <tr>
                <?php
                $meta2 = $exec->getColumnMeta(0);
                $nbrCol = $exec->columnCount();
                     for ($x=0; $x < $nbrCol ; $x++){
                         $meta = $exec->getColumnMeta($x);
                         echo "<th>" . $meta['name'] . "</th>";
                     }?>
                    <th>Editer</th>
                    <th>
                        <input type="submit" name="delete_products" class="btn danger" value="Effacer">
                    </th>
            </tr>

            <?php foreach($products as $product) {
                echo "<tr>";
                foreach($product as $val) {
                    $col_name = isset($val) ? $val : "N.R";
                    echo " <td> $col_name </td>";
                }
                echo "<td class=\"tdCenter\"><a class=\"btn\" href=\"edit-product.php?id=$product->id\">Editer</td>";
                echo "
                <td class=\"tdCenter\"><input id=\"user_$product->id\" name=\"delete_product_ids[]\" type=\"checkbox\" value=\"$product->id\"></td>
                </tr>";
            } ?>
            </table>
    </form>        
    <?php endif ?>
    </div>
</body>
</html>