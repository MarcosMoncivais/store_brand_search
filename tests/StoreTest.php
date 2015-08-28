<?php
        /**
        * @backupGlobals disabled
        * @backupStatic Attributes disabled
        */
                
        require_once 'src/Store.php';
        require_once 'src/Brand.php';
        
        $server = 'mysql:host=localhost;dbname=shoes_test';
        $username = 'root';
        $password = 'root';
        $DB = new PDO($server, $username, $password);
        
        class StoreTest extends PHPUnit_Framework_TestCase
        {
            protected function tearDown()
            {
                Store::deleteAll();
                Brand::deleteAll();
            }

            
            function testSave()
            {
                //Arrange
                $id = null;
                $name = "Nordstroms";
                $test_store = new Store($id, $name);
                
                //Act
                $test_store->save();
                
                //Assert
                $result = Store::getAll();
                $this->assertEquals([$test_store], $result);
            }
                    
            function testGetAll()
            {
                //Arrange
                $id = null;
                $name = "Nordstroms";
                $test_store = new Store($id, $name);
                $test_store->save();
            
                $name2 = "Footlocker";
                $test_store2 = new Store($id, $name2);
                $test_store2->save();
            
                //Act
                $result = Store::getAll();
                
                //Assert
                $this->assertEquals([$test_store, $test_store2], $result);
            }
            
            function testDeleteAll()           
            {
                //Arrange
                $id = null;
                $name = "Nordstroms";
                $test_store = new Store($id, $name);
                $test_store->save();
                
                $name2 = "Zumiez";
                $test_store2 = new Store($id, $name2);
                $test_store2->save();
                
                //Act
                Store::deleteAll();
                
                //Assert
                $result = Store::getAll();
                $this->assertEquals([], $result);
                }
            function testFind()
            {
                //Arrange
                $id = null;
                $name = "Nordstroms";
                $test_store = new Store($id, $name);
                $test_store->save();
                
                 $name2 = "Zumiez";
                $test_store2 = new Store($id, $name2);
                $test_store2->save();
                
                //Act
                
                $result = Store::find($test_store->getId());
                
                //Assert
                $this->assertEquals($test_store, $result);
            }
            
            function testUpdate()
            {
                //Arrange
                $id = null;
                $name = "Nordstroms";
                $test_store = new Store($id, $name);
                $test_store->save();
                $new_name = "Nordies";
                
                //Act
                
                $test_store->update($new_name);
                
                //Assert
                $result = $test_store->getName();
                $this->assertEquals($new_name, $result);
            }
            
            function testDeleteStore()
            {
                //Arrange
                $id = null;
                $name = "Nordstroms";
                $test_store = new Store($id, $name);
                $test_store->save();
                
                $name2 = "Zumiez";
                $test_store2 = new Store($id, $name2);
                $test_store2->save();
                
                //Act
                $test_store->delete();
                
                //Assert
                $result = Store::getAll();
                $this->assertEquals([$test_store2], $result);
            }
            
            function testAddBrand()
            {
                //Arrange
                $id = null;
                $name = "Nike";
                $test_brand = new Brand($id, $name);
                $test_brand->save();
                
                $name2 = "Nordstroms";
                $test_store = new Store($id, $name2);
                $test_store->save();
                
                //Act
                $test_store->addBrand($test_brand);
                
                //Assert
                $result = $test_store->getBrands();
                $this->assertEquals([$test_brand], $result);
            }
            function testGetBrands()
            {
                //Arrange
                $id = null;
                $name = "Nike";
                $test_brand = new Brand($id, $name);
                $test_brand->save();
                
                $name2 = "Adidas";
                $test_brand2 = new Brand($id, $name);
                $test_brand2->save();
                
                $name3 = "Nordstroms";
                $test_store = new Store($id, $name3);
                $test_store->save();
                
                $test_store->addBrand($test_brand);
                $test_store->addBrand($test_brand2);
                
                //Act
                $result = $test_store->getBrands();
                
                //Assert
                $this->assertEquals([$test_brand, $test_brand2], $result);
        }
    }
?>