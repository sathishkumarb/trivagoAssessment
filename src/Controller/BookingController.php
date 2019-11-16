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
   * @Rest\Get("/bookingByCity/{city}")
   *
   * @return Response
   */
  public function getBookingByCityAction(string $city): View
  {
        $entityManager = $this->getDoctrine()->getManager();        

        $qb = $entityManager->createQueryBuilder();

        $qb->select('c')
            ->from(Booking::class, 'c')
            ->innerJoin('c.location', 'p', 'WITH', 'p.id = c.location')
            ->where('p.city = :city')
            ->setParameter('city', $city);

        $repository = $this->getDoctrine()->getRepository(Booking::class);
        $query = $qb->getQuery();
        $booking = $query->getResult();

        return View::create($booking, Response::HTTP_OK);
    
  }
    
    /**
    * get by booking reputationbadge
    * @Rest\Get("/bookingByReputationBadge/{reputationbadge}")
    *
    * @return Response
    */
    public function getBookingByReputationBadgeAction(string $reputationbadge): View
    {    

        $repository = $this->getDoctrine()->getRepository(Booking::class);
        $booking = $repository->findBy(array('reputationBadge'=>$reputationbadge));

        return View::create($booking, Response::HTTP_OK);

    }
    
    /**
    * get by booking availability less than x
    * @Rest\Get("/bookingByAvailabilityLess/{availability}")
    *
    * @return Response
    */
    public function getBookingByAvailabilityLessAction(string $availability): View
    {    
        $entityManager = $this->getDoctrine()->getManager();        
        
        $qb = $entityManager->createQueryBuilder();
        $qb->select('e')
           ->from(Booking::class, 'e')
           ->where('e.availability < :old')
           ->setParameter('old', $availability);

        $entities = $qb->getQuery()->getResult();

        return View::create($entities, Response::HTTP_OK);

    }
    
    /**
    * get by booking availability greater than x
    * @Rest\Get("/bookingByAvailabilityGreater/{availability}")
    *
    * @return Response
    */
    public function getBookingByAvailabilityGreaterAction(string $availability): View
    {    
        $entityManager = $this->getDoctrine()->getManager();        
        
        $qb = $entityManager->createQueryBuilder();
        $qb->select('e')
           ->from(Booking::class, 'e')
           ->where('e.availability > :old')
           ->setParameter('old', $availability);

        $entities = $qb->getQuery()->getResult();

        return View::create($entities, Response::HTTP_OK);

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