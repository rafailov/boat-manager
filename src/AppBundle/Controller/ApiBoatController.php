<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Boat;
use AppBundle\Form\BoatType;
use AppBundle\Repository\BoatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * API Boat controller.
 *
 * @Route("api/boat")
 */
class ApiBoatController extends Controller
{
    /**
     * @var BoatRepository
     */
    private $boatRepository;

    /**
     * @var Validation
     */
    private $validator;

    /**
     * BoatController constructor.
     * @param BoatRepository $boatRepository
     * @param ValidatorInterface $validator
     */
    public function __construct(BoatRepository $boatRepository, ValidatorInterface $validator)
    {
        $this->boatRepository = $boatRepository;
        $this->validator = $validator;
    }

    /**
     * Lists all boat entities.
     *
     * @Route("/", name="api_list_boats", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function listAction()
    {
        $boats = $this->boatRepository->findActiveBoats();

        return $this->json($boats);
    }

    /**
     * Creates a new boat entity.
     * @param Request $request
     *
     * @Route("/", name="api_create_boat", methods={"POST"})
     *
     * @return JsonResponse
     */
    public function createAction(Request $request)
    {
        $boat = $this->boatRepository->create($request->request->all());

        return $this->json($boat->toArray());
    }

    /**
     * Finds and displays a boat entity.
     * @param $id
     *
     * @Route("/{id}", name="api_show_boat", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function showAction($id): array
    {
        $boat = $this->boatRepository->find($id);

        return $this->json($boat->toArray());
    }

    /**
     * Displays a form to edit an existing boat entity.
     * @param Request $request
     * @param Boat $boat
     *
     * @Route("/{id}/edit", name="api_boat_edit", methods={"POST"})
     *
     * @return JsonResponse
     */
    public function editAction(Request $request, Boat $boat)
    {
        $editForm = $this->createForm(BoatType::class, $boat);
        $editForm->handleRequest($request);

        $violations = $this->validator->validate($boat);
        if (count($violations) > 0) {
            return $this->json($violations, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $this->getDoctrine()->getManager()->flush();

        return $this->json($boat->toArray());
    }

    /**
     * Deletes a boat entity.
     * @param Boat $boat
     *
     * @Route("/{id}", name="boat_delete", methods={"DELETE"})
     *
     * @return JsonResponse
     */
    public function deleteAction(Boat $boat)
    {
        $this->boatRepository->remove($boat);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
