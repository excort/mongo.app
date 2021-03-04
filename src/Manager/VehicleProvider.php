<?php
namespace App\Manager;

use App\Entity\Vehicle;
use App\Service\MongoProvider;
use MongoDB\Collection;

class VehicleProvider
{
    private Collection $collection;

    public function __construct(
        private MongoProvider $mongoProvider
    ) {
        $this->collection = $this->mongoProvider->getVehicleCollection();
    }

    public function createVehicle(Vehicle $vehicle)
    {
        $res = $this->collection->insertOne($vehicle);

        return $res->getInsertedId();
    }

    public function clearVehicle()
    {
        $this->mongoProvider->deleteCollection($this->collection->getCollectionName());
    }
}