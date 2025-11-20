<?php
class Ingrediente{
	private $db;
	private $id;
	private $name;
	
	public function __construct($db){
		$this -> db = $db;
	}
	
	public static function getAll($db) {
		$stmt = $db->query("SELECT * FROM ingredientes");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	

	/**
	 * Get the value of db
	 */
	public function getDb()
	{
		return $this->db;
	}

	/**
	 * Set the value of db
	 */
	public function setDb($db): self
	{
		$this->db = $db;

		return $this;
	}

	/**
	 * Get the value of id
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 */
	public function setId($id): self
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Get the value of name
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set the value of name
	 */
	public function setName($name): self
	{
		$this->name = $name;

		return $this;
	}
}