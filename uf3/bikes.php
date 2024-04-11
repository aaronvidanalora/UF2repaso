<?php
class Bike {
    protected $gear;
    protected $nombre;

    public function __construct($nombre, $gear) {
        $this->setNombre($nombre);
        $this->setGear($gear);
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setGear($gear) {
        $this->gear = $gear;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getGear() {
        return $this->gear;
    }
}

class Delivery extends Bike {
    private $nombreDelivery;
    private $numeroDelivery;

    public function __construct($nombre, $gear, $nombreDelivery, $numeroDelivery) {
        parent::__construct($nombre, $gear);
        $this->setNombreDelivery($nombreDelivery);
        $this->setNumeroDelivery($numeroDelivery);
    }

    public function setNombreDelivery($nombreDelivery) {
        $this->nombreDelivery = $nombreDelivery;
    }

    public function setNumeroDelivery($numeroDelivery) {
        $this->numeroDelivery = $numeroDelivery;
    }

    public function getNombreDelivery() {
        return $this->nombreDelivery;
    }

    public function getNumeroDelivery() {
        return $this->numeroDelivery;
    }
}

class Urban extends Bike {
    private $nombreUrban;
    private $numeroUrban;

    public function __construct($nombre, $gear, $nombreUrban, $numeroUrban) {
        parent::__construct($nombre, $gear);
        $this->setNombreUrban($nombreUrban);
        $this->setNumeroUrban($numeroUrban);
    }

    public function setNombreUrban($nombreUrban) {
        $this->nombreUrban = $nombreUrban;
    }

    public function setNumeroUrban($numeroUrban) {
        $this->numeroUrban = $numeroUrban;
    }

    public function getNombreUrban() {
        return $this->nombreUrban;
    }

    public function getNumeroUrban() {
        return $this->numeroUrban;
    }
}

abstract class Collection {
    protected $_members = array();

    public function addCollection($obj, $key = null) {
        if ($key === null) {
            $this->_members[] = $obj;
        } else {
            if (isset($this->_members[$key])) {
                throw new Exception("Key $key already in use.");
            } else {
                $this->_members[$key] = $obj;
            }
        }
    }

    public function getCollection($key) {
        if (isset($this->_members[$key])) {
            return $this->_members[$key];
        } else {
            throw new Exception("Invalid key $key.");
        }
    }

    public function getAllMembers() {
        return $this->_members;
    }
}

class BikeCollection extends Collection {
    public function addBike(Bike $bike, $key = null) {
        $this->addCollection($bike, $key);
    }
}
$deliveryBike = new Delivery("Delivery Bike 1", 21, "D-001", 1);
$urbanBike = new Urban("Urban Bike 1", 7, "U-001", 2);

// Crear una instancia de BikeCollection y añadir las bicicletas
$bikeCollection = new BikeCollection();
$bikeCollection->addBike($deliveryBike);
$bikeCollection->addBike($urbanBike);



// Iterar sobre BikeCollection e imprimir la descripción de cada bicicleta
foreach ($bikeCollection->getAllMembers() as $bike) {
    echo $bike . "\n";
}
?>
