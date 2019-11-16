<?php

// src/DataFixtures/ProductFixture.php
namespace App\DataFixtures;

use App\Entity\Booking;
use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BookingFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $booking = new Booking();
        $booking->setHotelname('Priceless widget');
        $booking->setPrice(14.50);
        $booking->setCategory('Hotel');
        
        $booking->setRating(14.50);
        $booking->setAvailability(56);
        $booking->setReputation(300);
        $booking->setReputationBadge('Red');
		
		 $booking->setImage('https://image.com');
        
        
        $location = new Location();        

        $zipcode = 50000;

        $city = 'Chennai';

        $address = 'test';

        $country = 'India';

        $location->setZipcode($zipcode);
        $location->setCity($city);
        $location->setCountry($country);
        $location->setAddress($address);
        
        $booking->setReputationBadge(300);   
        $booking->setLocation($location);     
        
        $manager->persist($booking);

        // add more products

        $manager->flush();
    }
}

