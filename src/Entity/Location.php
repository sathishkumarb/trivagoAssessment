<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="location")
 */
class Location {
    
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;
    
  /**
   * @ORM\Column(type="integer", length=5)
   * @Assert\NotBlank()
   * @Assert\EqualTo(
   *     value = 5
   * )
   */
  private $zipcode;
    
    /**
    * @ORM\OneToMany(targetEntity="Booking", mappedBy="location" , cascade={"all"}, fetch="EXTRA_LAZY")
    */
  private $bookings;
    
    /**
    * Constructor
    */
    public function __construct()
    {
        $this->bookings = new \Doctrine\Common\Collections\ArrayCollection();

    }

  public function getId(): ?int
  {
      return $this->id;
  }

  public function getZipcode(): ?int
  {
      return $this->zipcode;
  }

  public function setZipcode(int $zipcode): self
  {
      $this->zipcode = $zipcode;

      return $this;
  }
    
       
    public function addBooking(\App\Entity\Booking $bookings)
    {
        $this->bookings[] = $bookings;

        return $this;
    }


    public function removeBooking(\App\Entity\Booking $booking)
    {
        $this->bookings->removeElement($booking);
    }


    public function getBookings()
    {
        return $this->bookings;
    }
 
}