<?php
// Clases de Avión

class Conductor {
    private $nombreConductor;
    private $numeroConductor;

    public function __construct($nombreConductor, $numeroConductor) {
        $this->nombreConductor = $nombreConductor;
        $this->numeroConductor = $numeroConductor;
    }

    public function getNombreConductor() {
        return $this->nombreConductor;
    }

    public function getNumeroConductor() {
        return $this->numeroConductor;
    }
}

class Pasajero {
    private $nombrePasajero;
    private $numeroPasajero;

    public function __construct($nombrePasajero, $numeroPasajero) {
        $this->nombrePasajero = $nombrePasajero;
        $this->numeroPasajero = $numeroPasajero;
    }

    public function getNombrePasajero() {
        return $this->nombrePasajero;
    }

    public function getNumeroPasajero() {
        return $this->numeroPasajero;
    }
}

class Asiento {
    private $nombreAsiento;
    private $numeroAsiento;

    public function __construct($nombreAsiento, $numeroAsiento) {
        $this->nombreAsiento = $nombreAsiento;
        $this->numeroAsiento = $numeroAsiento;
    }

    public function getNombreAsiento() {
        return $this->nombreAsiento;
    }

    public function getNumeroAsiento() {
        return $this->numeroAsiento;
    }
}

class Collection {
    private $_members = array();

    public function addCollection($obj, $key = null) {
        if ($key == null) {
            $this->_members[] = $obj;
        } else {
            if (isset($this->_members[$key])) {
                throw new KeyHasUseException("Key $key already in use.");
            } else {
                $this->_members[$key] = $obj;
            }
        }
    }

    public function getCollection($key) {
        if (isset($this->_members[$key])) {
            return $this->_members[$key];
        } else {
            throw new KeyInvalidException("Invalid key $key.");
        }
    }

    public function getAllMembers() {
        return $this->_members;
    }
}

class PasajeroCollection extends Collection {
    public function addPasajero(Pasajero $pasajero, $key = null) {
        $this->addCollection($pasajero, $key);
    }
}

class AsientoCollection extends Collection {
    public function addAsiento(Asiento $asiento, $key = null) {
        $this->addCollection($asiento, $key);
    }
}

abstract class AbstractMedioTransporte {
    protected $conductor;
    protected $pasajeros;
    protected $asientos;

    public function __construct(Conductor $conductor, PasajeroCollection $pasajeros, AsientoCollection $asientos) {
        $this->conductor = $conductor;
        $this->pasajeros = $pasajeros;
        $this->asientos = $asientos;
    }

    public function setConductor($conductor) {
        $this->conductor = $conductor;
    }

    public function getConductor() {
        return $this->conductor;
    }

    public function setPasajeros($pasajeros) {
        $this->pasajeros = $pasajeros;
    }

    public function getPasajeros() {
        return $this->pasajeros;
    }

    public function setAsientos($asientos) {
        $this->asientos = $asientos;
    }

    public function getAsientos() {
        return $this->asientos;
    }
}

class Avion extends AbstractMedioTransporte {
    private $nombreAvion;
    private $numeroAvion;

    public function __construct(Conductor $conductor, $nombreAvion, $numeroAvion) {
        parent::__construct($conductor, new PasajeroCollection(), new AsientoCollection());
        $this->nombreAvion = $nombreAvion;
        $this->numeroAvion = $numeroAvion;
    }

    public function setNombreAvion($nombreAvion) {
        $this->nombreAvion = $nombreAvion;
    }

    public function getNombreAvion() {
        return $this->nombreAvion;
    }

    public function setNumeroAvion($numeroAvion) {
        $this->numeroAvion = $numeroAvion;
    }

    public function getNumeroAvion() {
        return $this->numeroAvion;
    }

    public function getDescription() {
        echo "- Conductor: " . $this->getConductor()->getNombreConductor() . "<br>";
        echo "- Nombre del avión: " . $this->getNombreAvion() . "<br>";
        echo "- Número del avión: " . $this->getNumeroAvion() . "<br>";

        echo "- Pasajeros:<br>";
        foreach ($this->getPasajeros()->getAllMembers() as $pasajero) {
            echo "  Pasajero: " . $pasajero->getNombrePasajero() . "<br>";
        }

        echo "- Asientos:<br>";
        foreach ($this->getAsientos()->getAllMembers() as $asiento) {
            echo "  Asiento: " . $asiento->getNombreAsiento() . "<br>";
        }
    }

    public function sumarAsientos() {
        return count($this->getAsientos()->getAllMembers());
    }

    public function obtenerTodosPasajeros() {
        $pasajeros = array();
        foreach ($this->getPasajeros()->getAllMembers() as $pasajero) {
            $pasajeros[] = $pasajero->getNombrePasajero();
        }
        return $pasajeros;
    }
}

// Creación de instancias
$conductorAvion = new Conductor("Laura Martínez", 3);
$avion = new Avion($conductorAvion, "Avión 1", "003");

$pasajeroAvion1 = new Pasajero("Pasajero Avión 1", 301);
$avion->getPasajeros()->addPasajero($pasajeroAvion1);
$pasajeroAvion2 = new Pasajero("Pasajero Avión 2", 302);
$avion->getPasajeros()->addPasajero($pasajeroAvion2);

$asientoAvion1 = new Asiento("Asiento 1", 1);
$avion->getAsientos()->addAsiento($asientoAvion1);

// Mostrar información y llamar a las nuevas funciones
echo "Avión:<br>";
$avion->getDescription();
echo "Total de asientos en el avión: " . $avion->sumarAsientos() . "<br>";
echo "Todos los pasajeros del avión: <br>";
foreach ($avion->obtenerTodosPasajeros() as $pasajero) {
    echo $pasajero . "<br>";
}
?>
