<?php

	class Brand
	{
		private $name;
		private $id;
		

		function __construct($name, $id = null)
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
		    $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands ORDER BY name;");
		    $brands = array();
		    
		    foreach ($returned_brands as $brand) {
		        $name = $brand['name'];
		        $id = $brand['id'];
		        $new_brand = new Brand($name, $id);
		        array_push($brands, $new_brand);
		    }
		    return $brands;
		 }

		function delete()
		{
			$GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
			$GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE brand_id = {$this->getId()};");

		}
		
		static function deleteAll()
		
		{
		    $GLOBALS['DB']->exec("DELETE FROM brands;");
		
		}
		
		
		
		// function addStore($new_store)
		
		// {
		//     $GLOBALS['DB']->exec("INSERT INTO brands_stores (store_id, brand_id) VALUES ({$new_store->getId()}, {$this->getId()});");
		// }
		
		// function getStores()
		
		// {
		//     $query = $GLOBALS['DB']->query(
		//         "SELECT stores.* FROM
		//             brands JOIN brands_stores ON (brands.id = brands_stores.brand_id)
		//             JOIN stores ON (brands_stores.store_id = stores.id)
		//             WHERE brands.id = {$this->getId()};
		//         ");
		// 	    $stores = array();
		// 	    foreach ($query as $store) {
		// 	        $id = $store['id'];
		// 	        $name = $store['name'];
		// 	        $new_store = new Store($id, $name);
		// 	        array_push($stores, $new_store);
		//     }
		
		//     return $stores;
  //       }
    }
?>