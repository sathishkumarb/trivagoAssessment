<?php

// tests/Repository/ProductRepositoryTest.php
namespace App\Tests;

use App\Entity\Booking;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BookingRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSearchByHotelName()
    {
        $booking = $this->entityManager
            ->getRepository(Booking::class)
            ->findOneBy(['hotelname' => 'Priceless widget']);

        $this->assertSame('Priceless widget', $booking->getHotelname());
    }
    
    public function testSearchByPrice()
    {
        $booking = $this->entityManager
            ->getRepository(Booking::class)
            ->findOneBy(['price' => 14.50]);

        $this->assertSame('14.50', $booking->getPrice());
    }
    
    public function testSearchByAvailability()
    {
        $booking = $this->entityManager
            ->getRepository(Booking::class)
            ->findOneBy(['availability' => 56]);

        $this->assertSame(56, $booking->getAvailability());
    }
    
    
    public function testSearchByReputationBadge()
    {
        $booking = $this->entityManager
            ->getRepository(Booking::class)
            ->findOneBy(['reputationBadge' => 'Yellow']);

        $this->assertSame('Yellow', $booking->getReputationBadge());
    }
    
    
    public function testSearchByCategory()
    {
        $booking = $this->entityManager
            ->getRepository(Booking::class)
            ->findOneBy(['category' => 'Hotel']);

        $this->assertSame('Hotel', $booking->getCategory());
    }
    
    
    public function testSearchByRating()
    {
        $booking = $this->entityManager
            ->getRepository(Booking::class)
            ->findOneBy(['rating' => 1]);

        $this->assertSame(1, $booking->getRating());
    }

    protected function tearDown()
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}