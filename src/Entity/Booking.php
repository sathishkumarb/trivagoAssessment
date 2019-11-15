<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="booking")
 */
class Booking {
    
    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;

    /**
    * @ORM\Column(type="string", length=150)
    * @Assert\NotBlank()
    *
    */
    private $hotelname;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location", inversedBy="bookings")
     */
    private $location;

    /**
     * @ORM\Column(name="rating", type="boolean")
     * @Assert\GreaterThanOrEqual(
     *     value = 0
     * )
     * @Assert\LessThanOrEqual(
     *     value = 5
     * )
     */
    private $rating;

    /**
    * @ORM\Column(type="string", length=20)
    * @Assert\NotBlank()
    */
    private $category;

    /**
    * @ORM\Column(type="decimal", precision=8, scale=2)
    * @Assert\NotBlank() 
    */
    private $price;

    /**
    * @ORM\Column(type="string", length=150)
    */
    private $image;

    /**
    * @ORM\Column(type="integer", length=5)
    * @Assert\GreaterThanOrEqual(
    *     value = 0
    * )
    * @Assert\LessThanOrEqual(
    *     value = 1000
    * )
    */
    private $reputation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHotelname(): ?string
    {
        return $this->hotelname;
    }

    public function setHotelname(string $hotelname): self
    {
        $this->hotelname = $hotelname;

        return $this;
    }

    public function getRating(): ?bool
    {
        return $this->rating;
    }

    public function setRating(bool $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getReputation(): ?int
    {
        return $this->reputation;
    }

    public function setReputation(int $reputation): self
    {
        $this->reputation = $reputation;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }  

    
}