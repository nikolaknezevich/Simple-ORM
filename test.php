<?php 

require 'model/product.class.php';

use Dal\Model\Product;

//Update product
$Product = new \Dal\Model\Product\Product();
$Product->setId(2);
$Product->setName('Canon EOS 5d MK IV');
$Product->setPrice(7000);
$Product->setDescription('DSLR caamedddra');
$Product->save();

?>