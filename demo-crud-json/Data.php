<?php


class Data
{
    public static $path = "core/data.json";

    public static function saveData($data)
    {
        $dataJson = json_encode($data);
        file_put_contents(self::$path, $dataJson);
    }

    public static function loadData(): array
    {
        $dataJson = file_get_contents(self::$path);
        $data = json_decode($dataJson);
        return self::covertToProduct($data);
    }

    public static function covertToProduct($data): array
    {
        $products = [];
        foreach ($data as $item) {
            $product = new Product($item->id, $item->name, $item->price, $item->img);
            array_push($products, $product);
        }
        return $products;
    }

    public static function addProduct($product)
    {
        $products = self::loadData();
        array_push($products, $product);
        self::saveData($products);
    }

    public static function getProductById($id)
    {
        $products = self::loadData();
        foreach ($products as $product) {
            if ($product->getId() == $id) {
                return $product;
            }
        }
    }

    public static function editProductById($id, $newProduct)
    {
        $products = self::loadData();
        foreach ($products as $product) {
            if ($product->getId() == $id) {
                $product->setName($newProduct->getName());
                $product->setPrice($newProduct->getPrice());
                $product->setImg($newProduct->getImg());
            }
        }
        self::saveData($products);
    }

    public static function sortProductByPrice($type): array
    {
        $products = self::loadData();
        usort($products, function ($item1, $item2) use ($type) {
            if ($type == 'up') {
                return $item1->price > $item2->price;
            } else {
                return $item1->price < $item2->price;
            }
        });
        return $products;
    }
}

