<?php

class ShopProduct {

    private $id = 0, $title, $producerMainName, $producerFirstName, $discount = 0;
    protected $price;

    public function __construct($title, $firstName, $mainName, $price) {

        $this->title = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName = $mainName;
        $this->price = $price;
    }

    public function getProducerFirstName() {
        return $this->producerFirstName;
    }

    public function getProducerMainName() {
        return $this->producerMainName;
    }

    public function getProducer() {
        return"{$this->producerFirstName}" . "{$this->producerMainName}";
    }

    public function getSummaryLine() {
        $base = "{$this->title} ({$this->producerMainName}, ";
        $base .= "{$this->producerFirstName})";
        return $base;
    }

    public function setDiscount($num) {
        $this->discount = $num;
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function getPrice() {
        return ($this->price - $this->discount);
    }

    public function getTitle() {
        return $this->title;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public static function getInstance($id, PDO $pdo) {
        $stmt = $pdo->prepare("SELECT * FROM `products` WHERE id=?");
        $result = $stmt->execute(array($id));
        $row = $stmt->fetch();
        if (empty($row)) {
            return NULL;
        } elseif ($row['type'] == 'book') {
            $product = new BookProduct(
                    $row['title'], $row['firstname'], $row['mainname'], $row['price'], $row['numpages']);
        } elseif ($row['type'] == 'cd') {
            $product = new CdProduct(
                    $row['title'], $row['firstname'], $row['mainname'], $row['price'], $row['playlength']);
        } else {
            $product = new ShopProduct(
                    $row['title'], $row['firstname'], $row['mainname'], $row['price']);
        }
        $product->setID($row['id']);
        $product->setDiscount($row['discount']);
        return $product;
    }

}

$pdo = new PDO("mysql:host=localhost;dbname=livro", 'luiscarlos', 'mother');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$obj = ShopProduct::getInstance(1, $pdo);