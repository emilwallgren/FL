<?php
include 'products.php';
$xml = simplexml_load_file('products.xml');
$allproducts = new Products($xml);
$products = $allproducts->returnAllProducts();
?>

<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <h1>PRODUKTER</h1>

    <?php
    foreach ($products as $product) { ?>
      <div class="tableDiv">
        <table>
          <!-- SKU & NAME -->
          <tr>
            <td colspan="3">
              <h3><?php echo $product['sku'].' - '.$product->name;?></h3>
            </td>
          </tr>
          <!-- DESCRIPTION -->
          <tr>
            <td colspan="3">
              <p><?php echo $allproducts->reduceTextLength($product->description);?>... <a href="single.php?sku=<?php echo $product['sku'];?>">Läs mer -></a></p>
            </td>
          </tr>
          <!-- PRICE INFO -->
          <tr>
            <td colspan="1">
              <p>Pris: <?php echo $product->price->whs; ?></p>
            </td>
            <td colspan="1">
              <p>Pris inkl. moms: <?php echo $allproducts->calcPriceInclMoms($product->price->whs, $product->vat->id); ?></p>
            </td>
            <td colspan="1">
              <p>CC: <?php echo $product['cc']; ?></p>
            </td>
          </tr>
          <!-- CATEGORIES -->
          <tr>
            <td colspan="3">
                  <p><?php echo $allproducts->returnCategoryNames($product->categories); ?></p>
            </td>
          </tr>
        </table>
      </div>
    <?php } ?>

  </body>
</html>
