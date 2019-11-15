<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;


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
    * @Assert\NotBlank()
    * @Assert\Length(
    * min = 10,
    * minMessage = "Your hotel name must be at least {{ limit }} characters long"     
    * )
    * @ORM\Column(type="string", length=150)    
    */
    private $hotelname;
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addConstraint(new Assert\Callback('validate'));
        
        $metadata->addPropertyConstraint('category', new Assert\Choice([
            'callback' => 'getCategories',
        ]));
        
        $metadata->addPropertyConstraint('rating', new Assert\GreaterThanOrEqual([
            'value' => 0,
        ]));
        
        
        $metadata->addPropertyConstraint('rating', new Assert\LessThanOrEqual([
            'value' => 5,
        ]));
        
        
        $metadata->addPropertyConstraint('reputation', new Assert\GreaterThanOrEqual([
            'value' => 0,
        ]));
        
        
        $metadata->addPropertyConstraint('reputation', new Assert\LessThanOrEqual([
            'value' => 1000,
        ]));
        
        
    }
    
    public function validate(ExecutionContextInterface $context, $payload)
    {
        // somehow you have an array of "fake names"
        $fakeNames = ["Free", "Offer", "Book", "Website"];

        // check if the name is actually a fake name
        if (in_array($this->getHotelname(), $fakeNames)) {
            $context->buildViolation('This hotel name sounds totally fake!')
                ->atPath('hotelname')
                ->addViolation();
        }
        
    }
    
    public static function getCategories()
    {
        return ["hotel","alternative", "hostel", "lodge", "resort", "guest-house"];
    }   

    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location", inversedBy="bookings", cascade={"persist"})
     */
    private $location;

    /**
    * @Assert\NotBlank()
    * @Assert\Regex(
    *     pattern="/^[0-5]+$/",
    *     message="Only numbers allowed"
    * )
    * @ORM\Column(type="integer", length=2)
    */
    private $rating;

    /**
    * @Assert\NotBlank()
    * @Assert\Regex(
    *     pattern="/^[A-Za-z]+$/",
    *     message="Only letters allowed"
    * )
    * @ORM\Column(type="string", length=20)
    */
    private $category;

    /**
    * @Assert\NotBlank()
    * @Assert\Regex(
    *     pattern="/^[0-9]+$/",
    *     message="Only numbers allowed"
    * )
    * @ORM\Column(type="decimal", precision=8, scale=2)    
    */
    private $price;

    /**
    * @Assert\NotBlank()
    * @ORM\Column(type="text")
    */
    private $image;

    /**
    * @ORM\Column(type="integer", length=5)    
    */
    private $reputation;
    
    /**
    * @ORM\Column(type="integer")    
    */
    private $availability;
    
    /**
    * @Assert\Regex(
    *     pattern="/^[0-9]+$/",
    *     message="Only numbers allowed"
    * )
    * @Assert\Length(
    * min = 5,
    * minMessage = "Your zipcode must be at least {{ limit }} characters long"     
    * )
    */
    private $zipcode;

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

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
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
    
    public function getZipcode()
    {
        return $this->zipcode;
    }
    
   public function setZipcode(int $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }
    
    public function __toString()
    {
        return;
    }

    public function getAvailability(): ?int
    {
        return $this->availability;
    }

    public function setAvailability(int $availability): self
    {
        $this->availability = $availability;

        return $this;
    }

    
}