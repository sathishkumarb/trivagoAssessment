<?php
namespace App\Tests\Booking;

use App\Controller\BookingController;
use PHPUnit\Framework\TestCase;


class BookingControllerTest extends TestCase
{
    protected $data=[];   
    
    
    public function testPOST()
    {
       
        $client = new \GuzzleHttp\Client([
            'base_url' => 'http://127.0.0.1:8000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        
         $this->data = [
           "hotelname" => "ooh lah pasa sa", 
           "category" => "hostel", 
           "price" => "1200", 
           "rating" => 1, 
           "reputation" => 789, 
           "image" => "https://www.google.com/sa/sasa/sa", 
           "availability" => 34, 
           "zipcode" => 98656, 
           "city" => "", 
           "address" => "", 
           "country" => "" 
        ];  

        
        $response = $client->post('http://127.0.0.1:8000/api/booking', [
            'body' => json_encode($this->data),
             'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);
        
        $this->assertEquals(201, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $this->assertTrue($response->hasHeader('Content-Type'));
        $data = json_decode($response->getBody(true), true);
        $this->assertArrayHasKey('hotelname', $data);
        
    }
    
    
    public function testGetBookingCity()
    {
        
        $client = new \GuzzleHttp\Client([
            'base_url' => 'http://127.0.0.1:8000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        
        $response = $client->get('http://127.0.0.1:8000/api/bookingByCity/Chennai', []);

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        
    }
    
    public function testGetBookingCategory()
    {
        
        $client = new \GuzzleHttp\Client([
            'base_url' => 'http://127.0.0.1:8000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        
        $response = $client->get('http://127.0.0.1:8000/api/bookingByCategory/Hotel', []);

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        
    }
    
    public function testGetBookingReputationBadge()
    {
        
        $client = new \GuzzleHttp\Client([
            'base_url' => 'http://127.0.0.1:8000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        
        $response = $client->get('http://127.0.0.1:8000/api/bookingByReputationBadge/yellow', []);

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        
    }

    
    public function testGetBookingRating()
    {
        
        $client = new \GuzzleHttp\Client([
            'base_url' => 'http://127.0.0.1:8000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        
        $response = $client->get('http://127.0.0.1:8000/api/bookingByRating/1', []);

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        
    }

    
    public function testGetBookingByAvailabilityLess()
    {
        
        $client = new \GuzzleHttp\Client([
            'base_url' => 'http://127.0.0.1:8000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        
        $response = $client->get('http://127.0.0.1:8000/api/bookingByAvailabilityLess/1', []);

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        
    }

    
    public function testGetBookingByAvailabilityGreater()
    {
        
        $client = new \GuzzleHttp\Client([
            'base_url' => 'http://127.0.0.1:8000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        
        $response = $client->get('http://127.0.0.1:8000/api/bookingByAvailabilityGreater/1', []);

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        
    }


    
}
?>