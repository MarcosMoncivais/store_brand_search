<?php
        /**
        * @backupGlobals disabled
        * @backupStatic Attributes disabled
        */
                
        require_once 'src/Store.php';
        require_once 'src/Brand.php';
        
        $server = 'mysql:host=localhost:8889;dbname=shoes_test';
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

            function test_getName()
            {
                $name = "Nordstroms";
                $test_store = new Store($name);

                $result = $test_store->getName();

                $this->assertEquals($name, $result);
            }

            function test_setName()
            {
                $name = "Nordstroms";
                $test_store = new Store($name, $id);

                $test_store->setName("Nordies");

                $result = $test_store->getName();

                $this->assertEquals("Nordies", $result);
            }
            
            function test_Save()
            {
                //Arrange
                $name = "Nordstroms";
                $test_store = new Store($name);
                
                //Act
                $test_store->save();
                
                //Assert
                $result = Store::getAll();
                $this->assertEquals($test_store, $result[0]);
            }

            // function test_deleteStore()
            // {
            //     //Arrange
            //     $name = "Allen Edmonds";
            //     $test_store = new Store($name, $id);
            //     $test_store->save();

            //     $name2 = "To Boot NY";
            //     $test_store2 = new Store($name2, $id);
            //     $test_store2->save();

            //     //Act
            //     $test_store->delete();
            //     $result = Store::getAll();
                
            //     //Assert
            //     $this->assertEquals([$test_store2], $result);
            // }
                    
            function test_GetAll()
            {
                //Arrange
                $name = "Nordstroms";
                $test_store = new Store($name);
                $test_store->save();
            
                $name2 = "Footlocker";
                $test_store2 = new Store($name2);
                $test_store2->save();
            
                //Act
                $result = Store::getAll();
                
                //Assert
                //Will be returned, ordered by name.
                $this->assertEquals([$test_store2, $test_store], $result);
            }
            
            // function test_DeleteAll()           
            // {
            //     //Arrange
            //     $name = "Nordstroms";
            //     $test_store = new Store($name);
            //     $test_store->save();
                
            //     $name2 = "Zumiez";
            //     $test_store2 = new Store($name2);
            //     $test_store2->save();
                
            //     //Act
            //     Store::deleteAll();
                
            //     //Assert
            //     $result = Store::getAll();
            //     $this->assertEquals([], $result);
            // }
            
            function test_Find()
            {
                //Arrange
                $name = "Nordstroms";
                $test_store = new Store($name);
                $test_store->save();
                
                 $name2 = "Zumiez";
                $test_store2 = new Store($name2);
                $test_store2->save();
                
                //Act
                
                $result = Store::find($test_store->getId());
                
                //Assert
                $this->assertEquals($test_store, $result);
            }
            
            function test_updateName()
            {
                //Arrange
                $name = "Nordstroms";
                $test_store = new Store($name, $id);
                $test_store->save();
                
                
                //Act
                $new_name = "Nordies";
                $test_store->updateName($new_name);
                
                //Assert
                $this->assertEquals("Nordies", $test_store->getName());
            }

            function test_getId()
            {
                $name = "Nordstroms";
                $id = 1;
                $test_store = new Store($name, $id);

                $result = $test_store->getId();

                $this->assertEquals(true, is_numeric($result));
            }
            
            // function test_DeleteStore()
            // {
            //     //Arrange
            //     $id = null;
            //     $name = "Nordstroms";
            //     $test_store = new Store($name, $id);
            //     $test_store->save();
                
            //     $name2 = "Zumiez";
            //     $test_store2 = new Store($name2, $id);
            //     $test_store2->save();
                
            //     //Act
            //     $test_store->delete();
                
            //     //Assert
            //     $result = Store::getAll();
            //     $this->assertEquals([$test_store2], $result);
            // }
            
            // function test_AddBrand()
            // {
            //     //Arrange
            //     $name = "Nike";
            //     $test_brand = new Brand($name);
            //     $test_brand->save();
                
            //     $name = "Nordstroms";
            //     $test_store = new Store($name);
            //     $test_store->save();
                
            //     //Act
            //     $test_store->addBrand($test_brand);
                
            //     //Assert
            //     $this->assertEquals([$test_brand], $result);
            // }
            
            function test_GetBrands()
            {
                //Arrange
                $name = "Nike";
                $test_brand = new Brand($name);
                $test_brand->save();
                
                $name2 = "Adidas";
                $test_brand2 = new Brand($name2);
                $test_brand2->save();
                
                $name = "Nordstroms";
                $test_store = new Store($name);
                $test_store->save();


                //Act
                $test_store->addBrand($test_brand);
                $test_store->addBrand($test_brand2);
                
                //Assert
                $result = $test_store->getBrands();
                $this->assertEquals([$test_brand, $test_brand2], $result); 
        }

        // function test_deleteBrand()
        // {
        //     $name = "Nordstroms";
        //     $test_store = new Store($name, $id);
        //     $test_store->save();

        //     $brand_name = "Nike";
        //     $test_brand = new Brand($brand_name, $id);
        //     $test_brand->save();

        //     $brand_name2 = "Adidas";
        //     $test_brand2 = new Brand($brand_name2, $id);
        //     $test_brand2->save();

        //     $test_store->addBrand($test_brand->getId());
        //     $test_store->addBrand($test_brand2->getId());

        //     $test_store->deleteBrand($test_brand->getId());
        //     $result = $test_store ->getBrands();

        //     $this->assertEquals([], $result);
        // }

    //     function test_deleteAllbrands()
    //     {
    //         $name = "Nordstroms";
    //         $test_store = new Store($name, $id);
    //         $test_store->save();

    //         $name = "Nike";
    //         $test_brand = new Brand($name, $id);
    //         $test_brand->save();

    //         $name2 = "Adidas";
    //         $test_brand2 = new Brand($name2, $id);
    //         $test_brand2->save();

    //         $test_store->addBrand($test_brand->getId());
    //         $test_store->addBrand($test_brand2->getId());

    //         $test_store->deleteAll();
    //         $result = $test_store ->getBrands();

    //         $this->assertEquals([], $result);
    //     }
    }
?>