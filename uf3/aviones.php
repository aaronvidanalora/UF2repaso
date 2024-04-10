<?php
class Piloto {
    private $nombrePiloto;
    private $numeroLicencia;

    public function __construct($nombrePiloto, $numeroLicencia) {
        $this->nombrePiloto = $nombrePiloto;
        $this->numeroLicencia = $numeroLicencia;
    }

    public function getNombrePiloto() {
        return $this->nombrePiloto;
    }

    public function getNumeroLicencia() {
        return $this->numeroLicencia;
    }
}

class PasajeroAvion {
    private $nombrePasajero;
    private $numeroAsiento;

    public function __construct($nombrePasajero, $numeroAsiento) {
        $this->nombrePasajero = $nombrePasajero;
        $this->numeroAsiento = $numeroAsiento;
    }

    public function getNombrePasajero() {
        return $this->nombrePasajero;
    }

    public function getNumeroAsiento() {
        return $this->numeroAsiento;
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

class TripulacionCollection {
    private $_members = array();

    public function addTripulante($obj, $key = null) {
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

    public function getTripulante($key) {
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

class PasajeroAvionCollection extends TripulacionCollection {
    public function addPasajeroAvion(PasajeroAvion $pasajero, $key = null) {
        $this->addTripulante($pasajero, $key);
    }
}
class AsientoCollection extends TripulacionCollection {
    public function addAsiento(Asiento $asiento, $key = null) {
        $this->addTripulante($asiento, $key);
    }
}

abstract class AbstractMedioAereo {
    protected $piloto;
    protected $pasajerosAvion;
    protected $asientos;

    public function __construct(Piloto $piloto, PasajeroAvionCollection $pasajerosAvion, AsientoCollection $asientos) {
        $this->piloto = $piloto;
        $this->pasajerosAvion = $pasajerosAvion;
        $this->asientos = $asientos;
    }

    public function setPiloto($piloto) {
        $this->piloto = $piloto;
    }

    public function getPiloto() {
        return $this->piloto;
    }

    public function setPasajerosAvion($pasajerosAvion) {
        $this->pasajerosAvion = $pasajerosAvion;
    }

    public function getPasajerosAvion() {
        return $this->pasajerosAvion;
    }

    public function setAsientos($asientos) {
        $this->asientos = $asientos;
    }

    public function getAsientos() {
        return $this->asientos;
    }
}

class AvionComercial extends AbstractMedioAereo {
    private $nombreAvion;
    private $numeroAvion;

    public function __construct(Piloto $piloto, $nombreAvion, $numeroAvion) {
        parent::__construct($piloto, new PasajeroAvionCollection(), new AsientoCollection());
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
        echo "- Piloto: " . $this->getPiloto()->getNombrePiloto() . "<br>";
        echo "- Nombre del avión: " . $this->getNombreAvion() . "<br>";
        echo "- Número del avión: " . $this->getNumeroAvion() . "<br>";
    
        echo "- Pasajeros a bordo:<br>";
        foreach ($this->getPasajerosAvion()->getAllMembers() as $pasajero) {
            echo "  Pasajero: " . $pasajero->getNombrePasajero() . "<br>";
        }
    
        echo "- Asientos ocupados:<br>";
        foreach ($this->getAsientos()->getAllMembers() as $asiento) {
            echo "  Asiento: " . $asiento->getNombreAsiento() . "<br>";
        }
    }
}
$pilotoAvion = new Piloto("Ana García", "ABC123");

$avion = new AvionComercial($pilotoAvion, "Boeing 737", "BA123");

$pasajeroAvion1 = new PasajeroAvion("Pasajero Avión 1", 1);
$avion->getPasajerosAvion()->addPasajeroAvion($pasajeroAvion1);
$pasajeroAvion2 = new PasajeroAvion("Pasajero Avión 2", 2);
$avion->getPasajerosAvion()->addPasajeroAvion($pasajeroAvion2);

$asientoAvion1 = new Asiento("Asiento 1A", 1);
$avion->getAsientos()->addAsiento($asientoAvion1);
$asientoAvion2 = new Asiento("Asiento 2B", 2);
$avion->getAsientos()->addAsiento($asientoAvion2);

echo "Avión Comercial:<br>";
var_dump($avion);

echo "<br>"; // Separador para mejor lectura

$avion->getDescription();
?>
