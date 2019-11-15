<?php
namespace App\Entity;
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
  private $zipcocde;

  public function getId(): ?int
  {
      return $this->id;
  }

  public function getZipcocde(): ?int
  {
      return $this->zipcocde;
  }

  public function setZipcocde(int $zipcocde): self
  {
      $this->zipcocde = $zipcocde;

      return $this;
  }
 
}