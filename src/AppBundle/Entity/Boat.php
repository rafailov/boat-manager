<?php

namespace AppBundle\Entity;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BoatRepository")
 * @ORM\Table(name="boats")
 */
class Boat
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", length=6, unique=true)
     */
    private $boatId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $guests;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $cabins;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $bathrooms;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2)
     */
    private $length;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $about;

    /**
     * Boat constructor.
     * @param integer $boatId
     * @param string $name
     * @param float $price
     * @param integer $guests
     * @param integer $cabins
     * @param integer $bathrooms
     * @param float $length
     * @param string $about
     */
    public function __construct(
        $boatId,
        $name,
        $price,
        $guests,
        $cabins,
        $bathrooms,
        $length,
        $about
    ) {
        $this->boatId = $boatId;
        $this->name = $name;
        $this->price = $price;
        $this->guests = $guests;
        $this->cabins = $cabins;
        $this->bathrooms = $bathrooms;
        $this->length = $length;
        $this->about = $about;
    }

    /**
     * @return \string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \integer
     */
    public function getBoatId()
    {
        return $this->boatId;
    }

    public function setBoatId($boatId): void
    {
        $this->boatId = $boatId;
    }

    /**
     * @return \string
     */
    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return \float
     */
    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return \integer
     */
    public function getGuests()
    {
        return $this->guests;
    }

    public function setGuests($guests): void
    {
        $this->guests = $guests;
    }

    /**
     * @return \integer
     */
    public function getCabins()
    {
        return $this->cabins;
    }

    public function setCabins($cabins): void
    {
        $this->cabins = $cabins;
    }

    /**
     * @return \integer
     */
    public function getBathrooms()
    {
        return $this->bathrooms;
    }

    public function setBathrooms($bathrooms): void
    {
        $this->bathrooms = $bathrooms;
    }

    /**
     * @return \float
     */
    public function getLength()
    {
        return $this->length;
    }

    public function setLength($length): void
    {
        $this->length = $length;
    }

    /**
     * @return \string
     */
    public function getAbout()
    {
        return $this->about;
    }

    public function setAbout($about): void
    {
        $this->about = $about;
    }
}
