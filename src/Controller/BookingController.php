<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use App\Entity\Booking;
use App\Entity\Location;
use App\Form\BookingType;
/**
 * Booking controller.
 * @Route("/", name="api_")
 */
class BookingController extends FOSRestController
{
  /**
   * get by booking rating
   * @Rest\Get("/bookingByRating/{rating}")
   *
   * @return Response
   */
  public function getBookingByRatingAction(int $rating): View
  {    
   
    $repository = $this->getDoctrine()->getRepository(Booking::class);
    $booking = $repository->findBy(array('rating'=>$rating));
   
    return View::create($booking, Response::HTTP_OK);
    
  }
    
    
   /**
   * get by booking category
   * @Rest\Get("/bookingByCategory/{category}")
   *
   * @return Response
   */
  public function getBookingByCategoryAction(string $category): View
  {
    
    $repository = $this->getDoctrine()->getRepository(Booking::class);
    $booking = $repository->findBy(array('category'=>$category));

    return View::create($booking, Response::HTTP_OK);
    
  }
    
  /**
   * get by booking city
   * @Rest\Post("/bookingByCity/{city}")
   *
   * @return Response
   */
  public function getBookingByCityAction(string $city): View
  {
      
    $repository = $this->getDoctrine()->getRepository(Booking::class);
    $booking = $repository->find(array('city'=>$city));

    return View::create($booking, Response::HTTP_OK);
    
  }
    
  /**
   * Create Booking.
   * @Rest\Post("/booking")
   *
   * @return Response
   */
  public function postBookingAction(Request $request): View
  {
    $booking = new Booking();
    $form = $this->createForm(BookingType::class, $booking);
    $data = json_decode($request->getContent(), true);
    $form->submit($data);
    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();        

        $location = new Location();        

        $zipcode = isset($data['zipcode']) ? $data['zipcode'] : null;

        $city = isset($data['city']) ? $data['city'] : null;

        $address = isset($data['address']) ? $data['address'] : null;

        $country = isset($data['country']) ? $data['country'] : null;

        $location->setZipcode($zipcode);
        $location->setCity($city);
        $location->setCountry($country);
        $location->setAddress($address);

        $booking->setReputationBadge($data['reputation']);   
        $booking->setLocation($location);       

        $em->persist($booking);
        $em->flush();
        return View::create($booking, Response::HTTP_CREATED);
    }
    return $this->handleView($this->view($form->getErrors()));
  }
}