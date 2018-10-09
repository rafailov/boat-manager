<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Boat;
use Doctrine\ORM\EntityRepository;

class BoatRepository extends EntityRepository
{
    /**
     * @param $data
     * @return Boat
     */
    public function create($data): Boat
    {
        $boat = new Boat(
            (int) $data['boatId'],
            $data['name'],
            floatval($data['price']),
            (int) $data['guests'],
            (int) $data['cabins'],
            (int) $data['bathrooms'],
            floatval($data['length']),
            $data['about']
        );

        $this->_em->persist($boat);
        $this->_em->flush();

        return $boat;
    }

    /**
     * @param $boat
     */
    public function remove($boat): void
    {
        $this->_em->remove($boat);
        $this->_em->flush();
    }
}
