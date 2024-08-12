<?php 
namespace config\connect;

use config\componentes\configSistema as configSistema;
use PDO;
use PDOException;

class connectDB extends configSistema {

    protected $conex;
    private $puerto;
    private $usuario;
    private $password;
    private $local;
    private $nameDB;

    public function __construct() {
        $this->usuario = parent::_USER_();
        $this->password = parent::_PASS_();
        $this->local = parent::_LOCAL_();
        $this->nameDB = parent::_BD_();
        $this->conectarDB();
    }

    protected function conectarDB() {
        $dsn = "mysql:host={$this->local};dbname={$this->nameDB};charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->conex = new PDO($dsn, $this->usuario, $this->password, $options);
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function getConnection() {
        return $this->conex;
    }
}