<?php
interface IMovableVehicle
{
    function moveForward();
    function moveBackward() ;
}
interface ISpecialVehicle extends IMovableVehicle
{
    function moveSpecial();
}

abstract class Vehicle implements IMovableVehicle
{
    public function __construct(string $interior)
    {
        $this->interior = $interior;
    }
    public function moveForward() 
    {
        print($this->vehicleType."(".$this->interior.")\n");
    }
    public function moveBackward() 
    {
        //...
    }
    protected $vehicleType = '';
    protected $interior = '';
    
}

class Car extends Vehicle implements ISpecialVehicle
{
    public function __construct(string $interior)
    {
        parent::__construct($interior);
        $this->vehicleType = 'Машина';
        
    }   
    public function moveSpecial()
    {
        $this->nitrousOxide();
    }
    private function nitrousOxide()
    {
        print("Power On!\n");
    }
    
    private $wipersOn = false;
    public function toggleWipers(bool $newState)
    {
        $this->wipersOn = $newState;
    }
}

class Tank extends Vehicle
{
    public function __construct(string $interior)
    {
        parent::__construct($interior);
        $this->vehicleType = 'Танк';
    }
}

class Bulldozer extends Vehicle implements ISpecialVehicle
{
    public function __construct(string $interior)
    {
        parent::__construct($interior);
        $this->vehicleType = 'Бульдозер';
        
    }
    public function moveSpecial()
    {
        $this->moveLadle ();
    }
    private function moveLadle ()
    {
        print("Stay back!\n");
    }
}

$vehicles = [new Car('Lux'), new Car('Econom'),new Tank('Military'), new Bulldozer('Minimalistic')];

for($i=0;$i<count($vehicles);$i++)
{
    moveVehicle($vehicles[$i]);
}

function moveVehicle(IMovableVehicle $vehicle)
{
    $vehicle->moveForward();
    $class = new ReflectionClass($vehicle);
    if ($class->implementsInterface('ISpecialVehicle'))
    {
      $vehicle->moveSpecial();
    }    
}


?>