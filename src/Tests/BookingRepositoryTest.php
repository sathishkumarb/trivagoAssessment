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
            ->findOneBy(['hotelname' => 'Priceless widget'])
        ;

        $this->assertSame(14.50, $booking->getPrice());
    }

    protected function tearDown()
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}