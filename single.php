<?php
include 'products.php';
$xml = simplexml_load_file('products.xml');
$oneProduct = new Products($xml);
$products = $oneProduct->returnOneProduct();
?>

<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <h1>PRODUKT:</h1>


    <?php
    foreach ($products as $product) { ?>
        <div class="tableDiv">
          <table>
            <!-- SKU & NAME -->
            <tr>
              <td colspan="3">
                <h3><?= $product['sku']; ?> - <?= $product->name;?></h3>
              </td>
            </tr>
            <!-- DESCRIPTION -->
            <tr>
              <td colspan="3">
                <p><?=$product->description;?></p>
              </td>
            </tr>
            <!-- PRICE INFO -->
            <tr>
              <td colspan="1">
                <p>Pris: <?=$product->price->whs;?></p>
              </td>
              <td colspan="1">
                <p>Pris inkl. moms: <?=$oneProduct->calcPriceInclMoms($product->price->whs, $product->vat->id);?></p>
              </td>
              <td colspan="1">
                <p>CC: <?=$product['cc'];?></p>
              </td>
            </tr>
            <!-- CATEGORIES -->
            <tr>
              <td colspan="3">
                    <p><?=$oneProduct->returnCategoryNames($product->categories);?></p>
              </td>
            </tr>
          </table>
        </div>
  <?php  } ?>
    <p id="tillbakaLank"><a href="index.php">Tillbaks till huvudsidan</a><p>
  </body>
</html>
