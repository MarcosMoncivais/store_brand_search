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

            function test_getName()
            {
                $name = "Allen Edmonds";
                $test_brand = new Brand($name);

                $result = $test_brand->getName();

                $this->assertEquals($name, $result);
            }

            function test_setName()
            {
                $name = "Allen Edmonds";
                $test_brand = new Brand($name, $id);

                $test_brand->setName("Nordstroms");

                $result = $test_brand->getName();

                $this->assertEquals("Nordstroms", $result);
            }

            function test_getId()
            {
                $name = "Allen Edmonds";
                $id = 1;
                $test_brand = new Brand($name, $id);

                $result = $test_brand->getId();

                $this->assertEquals(true, is_numeric($result));
            }

            function test_Save()
            {
                //Arrange 
                $name = "Allen Edmonds";
                $test_brand = new Brand($name, $id);

                //Act
                $test_brand->save();

                //Assert
                $result = Brand::getAll();
                $this->assertEquals($test_brand, $result[0]);
            }

            function test_delete()
            {
                //Arrange
                $name = "Allen Edmonds";
                $test_brand = new Brand($name, $id);
                $test_brand->save();

                $name2 = "To Boot NY";
                $test_brand2 = new Brand($name2, $id);
                $test_brand2->save();

                //Act
                $test_brand->delete();

                //Assert
                $result = Brand::getAll();
                $this->assertEquals([$test_brand2], $result);
            }

            // function test_GetAll()
            // {
            //     //Arrange
            //     $name = "Allen Edmonds";
            //     $id = 1;
            //     $test_brand = new Brand($name, $id);
            //     $test_brand->save();

            //     $id2 = 2;
            //     $name2 = "Nike";
            //     $test_brand2 = new Brand($name2, $id);
            //     $test_brand2->save();

            //     //Act
            //     $result = Brand::getAll();

            //     //Assert
            //     $this->assertEquals([$test_brand, $test_brand2], $result);
            // }

            // function test_Find()
                
            //     {
                
            //     //Arrange
                
            //     $id = null;
            //     $name = "Nike";
            //     $test_brand = new Brand($id, $name);
            //     $test_brand->save();
                
            //     $name2 = "Adidas";
            //     $test_brand2 = new Brand($id, $name2);
            //     $test_brand2->save();
                
            //     //Act
                
            //     $result = Brand::find($test_brand2->getId());
                
            //     //Assert
                
            //     $this->assertEquals($test_brand2, $result);
            //     }

            // function test_AddStore()

            // {
            //     //Arrange
                
            //     $id = null;
            //     $name = "Nike";
            //     $test_brand = new Brand($id, $name);
            //     $test_brand->save();
                
            //     $name2 = "Super Shoes";
            //     $test_store = new Store($id, $name2);
            //     $test_store->save();
                
            //     //Act
                
            //     $test_brand->addStore($test_store);
                
            //     //Assert
                
            //     $result = $test_brand->getStores();
            //     $this->assertEquals([$test_store], $result);
            //     }
            
            // function test_GetStores()
            
            // {
            //     //Arrange
                
            //     $id = null;
            //     $name = "Nike";
            //     $test_brand = new Brand($id, $name);
            //     $test_brand->save();
                
            //     $name2 = "Super Shoes";
            //     $test_store = new Store($id, $name2);
            //     $test_store->save();
                
            //     $name3 = "Nike Outlet";
            //     $test_store2 = new Store($id, $name3);
            //     $test_store2->save();
            //     $test_brand->addStore($test_store);
            //     $test_brand->addStore($test_store2);
                
            //     //Act
            //     $result = $test_brand->getStores();
                
            //     //Assert
            //     $this->assertEquals([$test_store, $test_store2], $result);
            // }
                
        }
?>
