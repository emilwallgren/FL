<?php

class Products {

  //Ge objektet tillgång till xml-filen
  function __construct($xmlFile) {
    	$this->xml = $xmlFile;
    }

  //Lagra varje momssats och koppla ihop dem med rätt vat-id (nr 7 står inte med på arbetsprovets sida)
  public $vatIdToMoms = [1 => 1.25,
                         2 => 1.12,
                         3 => 1.06,
                         4 => 1.0,
                         5 => 1.0,
                         6 => 1.06,
                         8 => 1.0,
                         9 => 1.06,];

  //Beräkna priset inklusive moms baserat på originalpris och vat-id
  public function calcPriceInclMoms($price, $vatId) {
    $vat = $this->vatIdToMoms[(float)$vatId];
    $priceInclMoms = (float)$price * $vat;
    return $priceInclMoms;
  }

  //Begränsa text-längd till 100 karaktärer
  public function reduceTextLength($text) {
    $reducedText = substr($text, 0, 100);
    return $reducedText;
  }

  //Returnera kategorinamn baserat på kategori-input
  public function returnCategoryNames($categories) {
    $presentation = '';
    foreach ($categories->category as $category) {
      $presentation .= $category->name.', ';
    }
    return $presentation;
  }

  //Sanitera url för säkerhets skull
  public function cleanURL($url) {
    $url = mysql_real_escape_string($url);
    $url = htmlspecialchars($url);
    return $url;
  }

  //Returnera all data ifrån XML-filen
  public function returnAllProducts() {
    $xml = $this->xml;
    return $xml;
  }

  //Returnera en produkt ifrån XML-filen baserat på en get-request på SKU
  public function returnOneProduct() {
    if (isset($_GET['sku'])) {
      $skuBeforeSanitization = $_GET['sku'];
      $sku = $this->cleanURL($skuBeforeSanitization);
      $products = $this->xml->xpath('/list/product[@sku="'.$sku.'"]');
      return $products;
    }
    else {
      echo "Produkten du söker finns inte";
    }
  }


}
