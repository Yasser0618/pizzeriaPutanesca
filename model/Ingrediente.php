<?php
class Ingrediente{
	private $db;
	private $id;
	private $nombre;
	
	public function __construct($db){
		$this -> db = $db;
	}
	
	public static function getAll($db) {
		try{
			$stmt = $db->query("SELECT * FROM ingredientes");
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e){ 
			echo "Error al obtener los ingredientes: " . $e->getMessage();
			return [];
		}
	}

	public function save(){
        try {
            if ($this->id) { //
                $sql = "UPDATE ingredientes
                        SET nombre = :nombre
                        WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $this->id);
            } else {
                $sql = "INSERT INTO ingredientes
                        (nombre)
                        VALUES
                        (:nombre)";
                $stmt = $this->db->prepare($sql);
            }
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->execute();
            return true; //No es obligatorio es una opcion el devolver true
        } catch (PDOException $e) {
            echo "Error al guardar el ingrediente: " . $e->getMessage();
            return false;
        }
    }

	public function loadById($id){
		$stmt = $this -> db -> prepare("SELECT * FROM ingredientes WHERE id = :id");
		$stmt -> bindParam(":id", $id);
		$stmt -> execute();
		$ingrediente = $stmt -> fetch(PDO::FETCH_ASSOC);
		if ($ingrediente) {
			$this -> id = $ingrediente["id"];
			$this -> nombre = $ingrediente["nombre"];
			return true;
		}
		return false;
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
	 * Get the value of nombre
	 */
	public function getNombre()
	{
		return $this->nombre;
	}

	/**
	 * Set the value of nombre
	 */
	public function setNombre($nombre): self
	{
		$this->nombre = $nombre;

		return $this;
	}
}