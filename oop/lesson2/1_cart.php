<?php

declare(strict_types=1);

/*

Sukurkite klasių hierarchiją, skirtą valdyti kliento prekių krepšelį. Reikalingos klasės - Cart, CartItem, CartDiscount, Customer.


Customer metodai:
__construct(string $name, string $surname, string $level)
getFullName()
getLevel() - gali būti 'A', 'B' arba 'C'

CartItem metodai:
__construct(string $name, int $price)
getName() - prekės pavadinimas pvz.: 'Iphone 13'
getPrice() - prekė kaina pvz.: 1300 (naudokite int)

CartDiscount metodai:
__construct(int $percent, string $userLevel)
getDiscountPercent() - nuolaidos procentas pvz.: 15
getCustomerLevel() - gali būti 'A', 'B' arba 'C'

Cart metodai:
__construct(Customer $customer)
addItem(CartItem $cartItem) - turi leisti pridėti CartItem objektą. Galite saugoti CartItem'us masyve.
addDiscount(CartDiscount $cartDiscount) - turi leisti pridėti CartDiscount objektus
getTotal() - turi grąžinti visą krepšelio sumą su pritaikytomis nuolaidomis.
Suapvalinkite iki 2 skaičių po kablelio
Skaičiuojant total nuolaidos sumuojasi. Turi būti pritaikomos tik tos nuolaidos,
kurių customerLevel sutampa su krepšelio kliento leveliu.


Kaip turėtų būti kviečiamas kodas:

$customer = new Customer('John', 'Smith', 'A');
$cart = new Cart($customer);

$iphone = new CartItem('Iphone 13', 1300);
$airpods = new CartItem('Airpods Pro', 200);
$cart->addItem($iphone);
$cart->addItem($airpods);

$cartDiscount1 = new CartDiscount(15, 'A');
$cart->addDiscount($cartDiscount1);
$cartDiscount2 = new CartDiscount(2, 'A');
$cart->addDiscount($cartDiscount2);
$cartDiscount3 = new CartDiscount(20, 'B');
$cart->addDiscount($cartDiscount2);

$total = $cart->getTotal();
var_dump($total); // 1249.5

*/