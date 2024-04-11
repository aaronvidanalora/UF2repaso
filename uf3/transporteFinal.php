


<?php

class Conductor {
    private $nombreConductor;
    private $numeroConductor;

    public function __construct($nombreConductor, $numeroConductor) {
        $this->setNombreConductor($nombreConductor);
        $this->setNumeroConductor($numeroConductor);
    }

    public function setNombreConductor($nombreConductor) {
        $this->nombreConductor = $nombreConductor;
    }

    public function setNumeroConductor($numeroConductor) {
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
        $this->setNombrePasajero($nombrePasajero);
        $this->setNumeroPasajero($numeroPasajero);
    }

    public function setNombrePasajero($nombrePasajero) {
        $this->nombrePasajero = $nombrePasajero;
    }

    public function setNumeroPasajero($numeroPasajero) {
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
        $this->setNombreButaca($nombreButaca);
        $this->setNumeroButaca($numeroButaca);
    }

    public function setNombreButaca($nombreButaca) {
        $this->nombreButaca = $nombreButaca;
    }

    public function setNumeroButaca($numeroButaca) {
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
        $this->setConductor($conductor);
        $this->setPasajeros($pasajeros);
        $this->setButacas($butacas);
    }


    public function setConductor(Conductor $conductor) {
        $this->conductor = $conductor;
    }

    public function getConductor() {
        return $this->conductor;
    }

    public function setPasajeros(PasajeroCollection $pasajeros) {
        $this->pasajeros = $pasajeros;
    }

    public function getPasajeros() {
        return $this->pasajeros;
    }

    public function setButacas(ButacaCollection $butacas) {
        $this->butacas = $butacas;
    }

    public function getButacas() {
        return $this->butacas;
    }
}

class AutoBus extends AbstractMedioTransporte {
    private $nombreBus;
    private $numeroBus;

    public function __construct(Conductor $conductor, PasajeroCollection $pasajeros, ButacaCollection $butacas, $nombreBus, $numeroBus) {
        parent::__construct($conductor, $pasajeros, $butacas);
        $this->setNombreBus($nombreBus);
        $this->setNumeroBus($numeroBus);
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
            echo "  PasajeroNum: " . $pasajero->getNumeroPasajero() . "<br>";
        }
    
        echo "- Butacas:<br>";
        foreach ($this->getButacas()->getAllMembers() as $butaca) {
            echo "  Butaca: " . $butaca->getNombreButaca() . "<br>";
            echo "  ButacaNum: " . $butaca->getNumeroButaca() . "<br>";
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

    public function __construct(Conductor $conductor, PasajeroCollection $pasajeros, ButacaCollection $butacas, $nombreTren, $numeroTren) {
        parent::__construct($conductor, $pasajeros, $butacas);
        $this->setNombreTren($nombreTren);
        $this->setNumeroTren($numeroTren);
    }

    public function setNombreTren($nombreTren) {
        $this->nombreTren = $nombreTren;
    }

    public function getNombreTren() {
        return $this->nombreTren;
    }


    public function getNumeroTren() {
        return $this->numeroTren;
    }

    public function setNumeroTren($numeroTren) {
        $this->numeroTren = $numeroTren;
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




$conductorBus = new Conductor("Juan Pérez", 1);
$conductorTren = new Conductor("María López", 2);

// Ahora, creamos las colecciones de pasajeros y butacas para cada medio de transporte
$pasajerosBus = new PasajeroCollection();
$butacasBus = new ButacaCollection();

$pasajerosTren = new PasajeroCollection();
$butacasTren = new ButacaCollection();

// Crear pasajeros y butacas y añadirlos a sus respectivas colecciones para el autobús
$pasajerosBus->addPasajero(new Pasajero("Alice Smith", 101));
$pasajerosBus->addPasajero(new Pasajero("Bob Jones", 102));
$butacasBus->addButaca(new Butaca("Asiento 1", 1));
$butacasBus->addButaca(new Butaca("Asiento 2", 2));

// Crear pasajeros y butacas y añadirlos a sus respectivas colecciones para el tren
$pasajerosTren->addPasajero(new Pasajero("Carlos García", 201));
$pasajerosTren->addPasajero(new Pasajero("Diana Prince", 202));
$butacasTren->addButaca(new Butaca("Cabina 1", 1));
$butacasTren->addButaca(new Butaca("Cabina 2", 2));

// Crear el autobús y el tren con sus atributos y colecciones
$autobus = new AutoBus($conductorBus, $pasajerosBus, $butacasBus, "Bus Express", "B100");
$tren = new Tren($conductorTren, $pasajerosTren, $butacasTren, "Tren Rápido", "T200");

// Imprimir información del autobús y tren
echo "Autobús:\n";
$autobus->getDescription();
echo "Total de butacas en el autobús: " . $autobus->sumarButacas() . "\n";
echo "Todos los pasajeros del autobús: \n";
foreach ($autobus->obtenerTodosPasajeros() as $pasajero) {
    echo $pasajero . "\n";
}

echo "\n\nTren:\n";
$tren->getDescription();
echo "Total de butacas en el tren: " . $tren->sumarButacas() . "\n";
echo "Todos los pasajeros del tren: \n";
foreach ($tren->obtenerTodosPasajeros() as $pasajero) {
    echo $pasajero . "\n";
}
?>
