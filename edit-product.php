<?php 
include "libs/crud.php";
include "inc/head.php";
?>

<?php if($product === false): ?>
<p>
    Aucun produit ne correspond à cette requete
</p>
<?php endif; ?>

<?php if($product !== false): ?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
        <input type="hidden" name="id" id="id" class="input" value="<?php echo $product->id ?>">
        <label for="name">Nom du produit :</label>
        <input type="text" name="nom" id="nom" class="input" value="<?php echo $product->nom ?>">
        <label for="prix">Prix du produit en €:</label>
        <input type="text" name="prix" id="prix" class="input" value="<?php echo $product->prix ?>">
        <label for="description">Sa description :</label>
        <textarea name="description" id="description" rows="10" cols="50"><?php echo $product->description ?>
        </textarea>
        <input type="submit" name="update_product" value="send" class="btn">
</form>

<?php endif; ?>