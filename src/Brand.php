<?php

	class Brand
	{
		private $id;
		private $name;

		function __construct($id, $name)
		{
			$this->id = $id;
			$this->name = $name; 
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

		function save()
		{
			$GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
			$this->id = $GLOBALS['DB']->lastInsertId(); 
		}

		static function getAll()
		
		{
		    $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
		    $brands = array();
		    
		    foreach ($returned_brands as $brand) {
		        $id = $brand['id'];
		        $name = $brand['name'];
		        $new_brand = new Brand($id, $name);
		        array_push($brands, $new_brand);
		    }
		    return $brands;
		}
		
		static function deleteAll()
		
		{
		    $GLOBALS['DB']->exec("DELETE FROM brands;");
		    $GLOBALS['DB']->exec("DELETE FROM stores_brands;");
		
		}
		
		static function find($search_id)
		
		{
		    $brands = Brand::getAll();
		    $found_brand = null;
		    foreach ($brands as $brand) {
		        $brand_id = $brand->getId();
		        if ($brand_id == $search_id) {
		            $found_brand = $brand;
		        }
		    }
		
		    return $found_brand;
		
		}
		
		function addStore($new_store)
		
		{
		    $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$new_store->getId()}, {$this->getId()});");
		}
		
		function getStores()
		
		{
		    $query = $GLOBALS['DB']->query(
		        "SELECT stores.* FROM
		            brands JOIN stores_brands ON (brands.id = stores_brands.brand_id)
		            JOIN stores ON (stores_brands.store_id = stores.id)
		            WHERE brands.id = {$this->getId()};
		        ");
			    $stores = array();
			    foreach ($query as $store) {
			        $id = $store['id'];
			        $name = $store['name'];
			        $new_store = new Store($id, $name);
			        array_push($stores, $new_store);
		    }
		
		    return $stores;
        }
    }
?>