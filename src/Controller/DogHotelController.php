<?php



namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Add this use statement
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\BookingRequestType;
use App\Entity\BookingRequest;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DogHotelController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    // ...

    /**
     * @Route("/booking-requests/create", name="create_booking_request")
     */
    public function createBookingRequest(Request $request): Response
    {
        $bookingRequest = new BookingRequest();
        $form = $this->createForm(BookingRequestType::class, $bookingRequest);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $bookingRequest->setApproved(false);
            $this->entityManager->persist($bookingRequest);
            $this->entityManager->flush();

            return $this->redirectToRoute('booking_requests_index');
        }

        return $this->render('dog_hotel/create_booking_request.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/booking-requests", name="booking_requests_index")
     */
    public function index(): Response
    {
        $bookingRequests = $this->entityManager->getRepository(BookingRequest::class)->findAll();

        return $this->render('dog_hotel/index.html.twig', [
            'bookingRequests' => $bookingRequests,
        ]);
    }

    /**
     * @Route("/booking-requests/{id}/approve", name="approve_booking")
     */
    public function approveBooking(BookingRequest $bookingRequest): Response
    {
        $bookingRequest->setApproved(true);
        $this->entityManager->flush();

        return $this->redirectToRoute('booking_requests_index');
    }

    /**
     * @Route("/booking-requests/{id}/decline", name="decline_booking")
     */
    public function declineBooking(BookingRequest $bookingRequest): Response
    {
        $this->entityManager->remove($bookingRequest);
        $this->entityManager->flush();

        return $this->redirectToRoute('booking_requests_index');
    }

    // ...
}

