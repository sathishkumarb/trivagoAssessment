<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Booking;
use App\Entity\Location;
use App\Form\BookingType;
/**
 * Booking controller.
 * @Route("/api", name="api_")
 */
class BookingController extends FOSRestController
{
  /**
   * Lists all Booking.
   * @Rest\Get("/booking")
   *
   * @return Response
   */
  public function getBookingAction()
  {
    $repository = $this->getDoctrine()->getRepository(Booking::class);
    $booking = $repository->findall();
    return $this->handleView($this->view($booking));
  }
  /**
   * Create Booking.
   * @Rest\Post("/movie")
   *
   * @return Response
   */
  public function postBookingAction(Request $request)
  {
    $booking = new Booking();
    $form = $this->createForm(BookingType::class, $booking);
    $data = json_decode($request->getContent(), true);
    $form->submit($data);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();        
        
        $location = new Location();
        $location->setZipcode($data['zipcode']);
        $booking->setLocation($location);       
        
      $em->persist($booking);
      $em->flush();
      return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
    }
    return $this->handleView($this->view($form->getErrors()));
  }
}