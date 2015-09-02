<?php
    
        /**
        * @backupGlobals disabled
        * @backupStatic Attributes disabled
        */


        require_once "src/Brand.php";
        require_once "src/Store.php";

        $server = 'mysql:host=localhost:8889;dbname=shoes_test';
        $username = 'root';
        $password = 'root';
        $DB = new PDO($server, $username, $password);

        class BrandTest extends PHPUnit_Framework_TestCase
        {
            protected function tearDown()
            {
                Brand::deleteAll();
                Store::deleteAll();
            }

            function testSave()
            {
                //Arrange
                $id = null; 
                $name = "Allen Edmonds";
                $test_brand = new Brand($id, $name);

                //Act
                $test_brand->save();

                //Assert
                $result = Brand::getAll();
                $this->assertEquals([$test_brand], $result);
            }

            function testDeleteAll()
            {
                //Arrange
                $id = null;
                $name = "Allen Edmonds";
                $test_brand = new Brand($id, $name);

                $name2 = "To Boot NY";
                $test_brand2 = new Brand ($id, $name2);
                $test_brand2->save();

                //Act
                Brand::deleteAll();

                //Assert
                $result = Brand::getAll();
                $this->assertEquals([], $result);
            }

            function testGetAll()
            {
                //Arrange
                $id = null;
                $name = "Allen Edmonds";
                $test_brand = new Brand($id, $name);
                $test_brand->save();

                $id2 = null;
                $name2 = "Nike";
                $test_brand2 = new Brand($id, $name2);
                $test_brand2->save();

                //Act
                $result = Brand::getAll();

                //Assert
                $this->assertEquals([$test_brand, $test_brand2], $result);
            }

            function testFind()
                
                {
                
                //Arrange
                
                $id = null;
                $name = "Nike";
                $test_brand = new Brand($id, $name);
                $test_brand->save();
                
                $name2 = "Adidas";
                $test_brand2 = new Brand($id, $name2);
                $test_brand2->save();
                
                //Act
                
                $result = Brand::find($test_brand2->getId());
                
                //Assert
                
                $this->assertEquals($test_brand2, $result);
                }

            function testAddStore()

            {
                //Arrange
                
                $id = null;
                $name = "Nike";
                $test_brand = new Brand($id, $name);
                $test_brand->save();
                
                $name2 = "Super Shoes";
                $test_store = new Store($id, $name2);
                $test_store->save();
                
                //Act
                
                $test_brand->addStore($test_store);
                
                //Assert
                
                $result = $test_brand->getStores();
                $this->assertEquals([$test_store], $result);
                }
            
            function testGetStores()
            
            {
                //Arrange
                
                $id = null;
                $name = "Nike";
                $test_brand = new Brand($id, $name);
                $test_brand->save();
                
                $name2 = "Super Shoes";
                $test_store = new Store($id, $name2);
                $test_store->save();
                
                $name3 = "Nike Outlet";
                $test_store2 = new Store($id, $name3);
                $test_store2->save();
                $test_brand->addStore($test_store);
                $test_brand->addStore($test_store2);
                
                //Act
                $result = $test_brand->getStores();
                
                //Assert
                $this->assertEquals([$test_store, $test_store2], $result);
            }
                
        }
?>
