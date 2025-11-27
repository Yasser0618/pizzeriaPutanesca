<?php
/*
***
* getAll -> Recupera toda la informacion
* getOneById -> Recupera la informacion de un item en concreto
* save:
*     -> insert
*     -> update
* delete -> eliminar un token. Se pude hacer como metodo estatico en la clase
***
*/
class Pizza {
    private $db;//Como va a manejar la base de datos es necesaria una variable para ello
    private $id;
    private $nombre;
    private $descripcion;
    private $imagen;
    private $precio;
    private array $ingredientes;

    public function __construct($db) {
        $this->db = $db;
    }

    public static function getAll($db) {
        $stmt = $db->query("SELECT * FROM pizzas");//$stmt es una variable estandar
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save(){
        try{
            if ($this->id){
                $sql = "UPDATE pizzas
                        SET nombre = :nombre, descripcion = :descripcion, imagen = :imagen, precio = :precio
                        WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":id", $this->id);
            } else{
                $sql = "INSERT INTO pizzas
                        (nombre, descripcion, imagen, precio)
                        VALUES
                        (:nombre, :descripcion, :imagen, :precio)";
                $stmt = $this->db->prepare($sql);
            }
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":descripcion", $this->descripcion);
            $stmt->bindParam(":imagen", $this->imagen);
            $stmt->bindParam(":precio", $this->precio);
            $stmt->execute();

            if(!isset($this -> id)){
                $this -> id = $this -> db -> lastInsertId();
            }

            if(isset($this -> id)){
                $sqlDelete = "DELETE FROM pizza_ingrediente WHERE id_pizza = :id:pizza";
                $stmtDelete = $this -> db -> prepare($sqlDelete);
                $stmtDelete -> bindParam(":id_pizza", $this -> id);
                $stmtDelete -> execute();

                if (!empty($this -> ingredientes)){
                    $sqlInsert = "INSERT INTO pizza_ingrediente(id_pizza, id_ingrediente) VALUES (:id_pizza, :id_ingrediente)";
                    $stmtInsert = $this -> db -> prepare($sqlInsert);

                    foreach($this -> ingredientes as $ingredienteId){
                        $stmtInsert-> bindParam(":id_pizza", $this -> id);
                        $stmtInsert-> bindParam(":id_ingrediente", $ingredienteId);
                        $stmtInsert-> execute();
                    }
                }
            }
            return true;
        } catch (PDOException $e){
            echo "Error al guardar la pizza: " . $e->getMessage();
            return false;
        }
    }

    public function loadById($id){
        $stmt = $this -> db -> prepare("SELECT * FROM pizzas WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $pizza = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($pizza) {
            $this->id = $pizza['id'];
            $this->nombre = $pizza['nombre'];
            $this->descripcion = $pizza['descripcion'];
            $this->precio = $pizza['precio'];
            $this->imagen = $pizza['imagen'];

            $stmtIng = $this->db->prepare("SELECT id_ingrediente FROM pizza_ingrediente WHERE id_pizza = :id_pizza");
            $stmtIng->binParam(":id_pizza", $this->id);
            $stmtIng->excute();
            $this->ingredientes = $stmtIng->fecthAll(PDO::FETCH_COLUMN);
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

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     */
    public function setDescripcion($descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of imagen
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     */
    public function setImagen($imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     */
    public function setPrecio($precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of ingredientes
     */
    public function getIngredientes(): array
    {
        return $this->ingredientes;
    }

    /**
     * Set the value of ingredientes
     */
    public function setIngredientes(array $ingredientes): self
    {
        $this->ingredientes = $ingredientes;

        return $this;
    }
}

