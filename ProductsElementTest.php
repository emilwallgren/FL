<?php
require 'products.php';

class ProductsElementTest extends PHPUnit_Framework_TestCase
{

  public function setUp() {
    $this->xml = simplexml_load_file('products.xml');
    $this->products = new Products($this->xml);
  }

  public function testIfObjectIsInstanceOfTheClassProducts() {
    $this->assertInstanceOf('Products', $this->products);
  }

  public function testIfArrayMatchIntendedObjectArray() {
    $res = $this->products->vatIdToMoms;
    $exp = array(
       1 => 1.25,
       2 => 1.12,
       3 => 1.06,
       4 => 1.0,
       5 => 1.0,
       6 => 1.06,
       8 => 1.0,
       9 => 1.06
     );
    $this->assertEquals($exp, $res, 'array doesnt match inputs');
  }

  public function testIfXMLObjectContainsProductAttribute() {
    $exp = 'product';
    $this->assertObjectHasAttribute($exp, $this->xml);
  }

  public function testIfCategoriesReturnsAsString() {
    $categories = $this->xml->product[0]->categories;
    $this->assertInternalType("string", $this->products->returnCategoryNames($categories));
  }

  public function testIfReturnedValueOfMomsIsFloat() {
    $this->assertInternalType("float", $this->products->calcPriceInclMoms(1.12, 2));
  }

}
