<?php
    
    class Store
    {
        private $name;
        private $id;
        
        
        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }
        
        function getId()
        {
            return $this->id;
        }
        
        function getName()
        {
            return $this->name;
        }
        
        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function updateName($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name = '{new_name}'
                WHERE id = {$this->getId()}");
            $this->setName($new_name);
        }
        
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

<<<<<<< HEAD
=======
        function deleteBrand($brand_id)
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE store_id = {$this->getId()};");
        }

>>>>>>> 8d7fa0448bc6486935a887a361e0cb57057bfb13
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands_stores");
               $GLOBALS['DB']->exec("DELETE FROM stores;");

        }
        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores ORDER BY name;");
            $stores = array();
            foreach ($returned_stores as $store) {
                $name = $store['name'];
                $id = $store['id'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            
            return $stores;
        }

        static function find($search_id)
        {
            $found_store = null;
            $stores = Store::getAll();
            foreach ($stores as $store) {
                $store_id = $store->getId();
                if ($store_id == $search_id) {
                    $found_store = $store;
                }
            }
            return $found_store;
        }

<<<<<<< HEAD
        function addBrand($brand)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (store_id, brand_id) VALUES ({$this->getId()}, {$brand->getId()});");
=======
        function addBrand($brand_id)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (store_id, brand_id) VALUES ({$this->getId()}, {$brand_id});");
>>>>>>> 8d7fa0448bc6486935a887a361e0cb57057bfb13
        }
        
        function getBrands()
        {
            $returned_brands = $GLOBALS['DB']->query(
                "SELECT brands.* FROM
                    stores JOIN brands_stores ON (stores.id = brands_stores.store_id)
                    JOIN brands ON (brands_stores.brand_id = brands.id)
                    WHERE stores.id = {$this->getId()};
                ");
            $brands = array();
            foreach ($returned_brands as $brand) {
                $id = $brand['id'];
                $name = $brand['name'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }
<<<<<<< HEAD
        function deleteBrand($brand_id)
        {
            $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE brand_id = {$brand_id} AND store_id = {$this->id}");
        }
        
        function deleteAllBrands()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE store_id = {$this->id}");
        }
=======
>>>>>>> 8d7fa0448bc6486935a887a361e0cb57057bfb13
    }
?>