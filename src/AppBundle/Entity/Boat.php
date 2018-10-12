<?php

namespace AppBundle\Entity;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
     *
     * @Assert\NotBlank()
     */
    private $boatId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "Your boat name must be at least {{ limit }} characters long",
     *      maxMessage = "Your boat name cannot be longer than {{ limit }} characters"
     * )
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2)
     *
     * @Assert\NotBlank()
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank()
     */
    private $guests;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank()
     */
    private $cabins;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank()
     */
    private $bathrooms;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2)
     *
     * @Assert\NotBlank()
     */
    private $length;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank()
     */
    private $about;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $isActive;

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
        $this->isActive = false;
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

    /**
     * @param $boatId
     * @return void
     */
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

    /**
     * @param $name
     * @return void
     */
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

    /**
     * @param $price
     * @return void
     */
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

    /**
     * @param $guests
     * @return void
     */
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

    /**
     * @param $cabins
     * @return void
     */
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

    /**
     * @param $bathrooms
     * @return void
     */
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

    /**
     * @param $length
     * @return void
     */
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

    /**
     * @param $about
     * @return void
     */
    public function setAbout($about): void
    {
        $this->about = $about;
    }

    /**
     * @return void
     */
    public function toggleActive(): void
    {
        $this->isActive = !$this->isActive;
    }

    /**
     * @return \boolean
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'        => $this->getId(),
            'boatId'    => $this->getBoatId(),
            'name'      => $this->getName(),
            'price'     => $this->getPrice(),
            'guests'    => $this->getGuests(),
            'cabins'    => $this->getCabins(),
            'bathrooms' => $this->getBathrooms(),
            'length'    => $this->getLength(),
            'about'     => $this->getAbout(),
            'is_active' => $this->isActive()
        ];
    }
}
