<?php
// Supongo que Collection es una clase que ya tienes definida y la estoy omitiendo aquí. Deberías asegurarte de que tenga los métodos adecuados para manejar las colecciones.

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

class Butaca {
    private $nombreButaca;
    private $numeroButaca;

    public function __construct($nombreButaca, $numeroButaca) {
        $this->nombreButaca = $nombreButaca;
        $this->numeroButaca = $numeroButaca;
    }

    public function getNombreButaca() {
        return $this->nombreButaca;
    }

    public function getNumeroButaca() {
        return $this->numeroButaca;
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

class ButacaCollection extends Collection {
    public function addButaca(Butaca $butaca, $key = null) {
        $this->addCollection($butaca, $key);
    }
}

abstract class AbstractMedioTransporte {
    protected $conductor;
    protected $pasajeros;
    protected $butacas;

    public function __construct(Conductor $conductor, PasajeroCollection $pasajeros, ButacaCollection $butacas) {
        $this->conductor = $conductor;
        $this->pasajeros = $pasajeros;
        $this->butacas = $butacas;
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

    public function setButacas($butacas) {
        $this->butacas = $butacas;
    }

    public function getButacas() {
        return $this->butacas;
    }
}

class AutoBus extends AbstractMedioTransporte {
    private $nombreBus;
    private $numeroBus;

    public function __construct(Conductor $conductor, $nombreBus, $numeroBus) {
        parent::__construct($conductor, new PasajeroCollection(), new ButacaCollection());
        $this->nombreBus = $nombreBus;
        $this->numeroBus = $numeroBus;
    }

    public function setNombreBus($nombreBus) {
        $this->nombreBus = $nombreBus;
    }

    public function getNombreBus() {
        return $this->nombreBus;
    }

    public function setNumeroBus($numeroBus) {
        $this->numeroBus = $numeroBus;
    }

    public function getNumeroBus() {
        return $this->numeroBus;
    }

    public function getDescription() {
        echo "- Conductor: " . $this->getConductor()->getNombreConductor() . "<br>";
        echo "- Nombre del autobús: " . $this->getNombreBus() . "<br>";
        echo "- Número del autobús: " . $this->getNumeroBus() . "<br>";

        echo "- Pasajeros:<br>";
        foreach ($this->getPasajeros()->getAllMembers() as $pasajero) {
            echo "  Pasajero: " . $pasajero->getNombrePasajero() . "<br>";
        }

        echo "- Butacas:<br>";
        foreach ($this->getButacas()->getAllMembers() as $butaca) {
            echo "  Butaca: " . $butaca->getNombreButaca() . "<br>";
        }
    }

    public function sumarButacas() {
        return count($this->getButacas()->getAllMembers());
    }

    public function obtenerTodosPasajeros() {
        $pasajeros = array();
        foreach ($this->getPasajeros()->getAllMembers() as $pasajero) {
            $pasajeros[] = $pasajero->getNombrePasajero();
        }
        return $pasajeros;
    }
}

class Tren extends AbstractMedioTransporte {
    private $nombreTren;
    private $numeroTren;

    public function __construct(Conductor $conductor, $nombreTren, $numeroTren) {
        parent::__construct($conductor, new PasajeroCollection(), new ButacaCollection());
        $this->nombreTren = $nombreTren;
        $this->numeroTren = $numeroTren;
    }

    public function setNombreTren($nombreTren) {
        $this->nombreTren = $nombreTren;
    }

    public function getNombreTren() {
        return $this->nombreTren;
    }

    public function setNumeroTren($numeroTren) {
        $this->numeroTren = $numeroTren;
    }

    public function getNumeroTren() {
        return $this->numeroTren;
    }

    public function getDescription() {
        echo "- Conductor: " . $this->getConductor()->getNombreConductor() . "<br>";
        echo "- Nombre del tren: " . $this->getNombreTren() . "<br>";
        echo "- Número del tren: " . $this->getNumeroTren() . "<br>";

        echo "- Pasajeros:<br>";
        foreach ($this->getPasajeros()->getAllMembers() as $pasajero) {
            echo "  Pasajero: " . $pasajero->getNombrePasajero() . "<br>";
        }

        echo "- Butacas:<br>";
        foreach ($this->getButacas()->getAllMembers() as $butaca) {
            echo "  Butaca: " . $butaca->getNombreButaca() . "<br>";
        }
    }

    public function sumarButacas() {
        return count($this->getButacas()->getAllMembers());
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
$conductorBus = new Conductor("Juan Pérez", 1);
$autobus = new AutoBus($conductorBus, "Bus 1", "001");
$pasajeroBus1 = new Pasajero("Pasajero Bus 1", 101);
$autobus->getPasajeros()->addPasajero($pasajeroBus1);
$pasajeroBus2 = new Pasajero("Pasajero Bus 2", 102);
$autobus->getPasajeros()->addPasajero($pasajeroBus2);
$butacaBus1 = new Butaca("Butaca 1", 1);
$autobus->getButacas()->addButaca($butacaBus1);

$conductorTren = new Conductor("María López", 2);
$tren = new Tren($conductorTren, "Tren 1", "002");
$pasajeroTren1 = new Pasajero("Pasajero Tren 1", 201);
$tren->getPasajeros()->addPasajero($pasajeroTren1);
$butacaTren1 = new Butaca("Butaca Premium", 1);
$tren->getButacas()->addButaca($butacaTren1);

// Mostrar información y llamar a las nuevas funciones
echo "Autobús:<br>";
$autobus->getDescription();
echo "Total de butacas en el autobús: " . $autobus->sumarButacas() . "<br>";
echo "Todos los pasajeros del autobús: <br>";
foreach ($autobus->obtenerTodosPasajeros() as $pasajero) {
    echo $pasajero . "<br>";
}

echo "<br>Tren:<br>";
$tren->getDescription();
echo "Total de butacas en el tren: " . $tren->sumarButacas() . "<br>";
echo "Todos los pasajeros del tren: <br>";
foreach ($tren->obtenerTodosPasajeros() as $pasajero) {
    echo $pasajero . "<br>";
}

?>
