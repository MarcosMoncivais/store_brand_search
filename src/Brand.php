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

		
	}
?>