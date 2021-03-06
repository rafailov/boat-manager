<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Boat;
use AppBundle\Form\BoatType;
use AppBundle\Repository\BoatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Boat controller.
 *
 * @Route("boat")
 */
class BoatController extends Controller
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
     * @Route("/", name="boat_index", methods={"GET"})
     */
    public function listAction()
    {
        $boats = $this->boatRepository->findAll();

        return $this->render('boat/index.html.twig', [
            'boats' => $boats,
        ]);
    }

    /**
     * Creates a new boat entity.
     *
     * @Route("/new", name="boat_form_new", methods={"GET"})
     *
     * @return RedirectResponse|Response
     */
    public function createFormAction()
    {
        $form = $this->createForm(BoatType::class);

        return $this->render('boat/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * Creates a new boat entity.
     *
     * @Route("/new", name="boat_new", methods={"POST"})
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $boat = $this->boatRepository->create($request->request->all()['boat']);

        return $this->redirectToRoute('boat_show', ['id' => $boat->getId()]);
    }

    /**
     * Finds and displays a boat entity.
     * @param Boat $boat
     *
     * @Route("/{id}", name="boat_show", methods={"GET"})
     *
     * @return Response
     */
    public function showAction(Boat $boat)
    {
        $deleteForm = $this->createDeleteForm($boat);

        return $this->render('boat/show.html.twig', [
            'boat' => $boat,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Finds and displays a boat entity.
     * @param Boat $boat
     *
     * @Route("/{id}/edit", name="boat_show_form", methods={"GET"})
     *
     * @return Response
     */
    public function editFormAction(Boat $boat)
    {
        $deleteForm = $this->createDeleteForm($boat);
        $editForm = $this->createForm(BoatType::class, $boat);

        return $this->render('boat/edit.html.twig', [
            'boat' => $boat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ]);
    }

    /**
     * Displays a form to edit an existing boat entity.
     * @param Request $request
     * @param Boat $boat
     *
     * @Route("/{id}/edit", name="boat_edit", methods={"POST"})
     *
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, Boat $boat)
    {
        $editForm = $this->createForm(BoatType::class, $boat);
        $editForm->handleRequest($request);

        $violations = $this->validator->validate($boat);
        if (count($violations) > 0) {
            $deleteForm = $this->createDeleteForm($boat);

            return $this->render('boat/edit.html.twig', [
                'boat' => $boat,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
                'violations' => $violations,
            ]);
        }

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('boat_show', ['id' => $boat->getId()]);
    }

    /**
     * Deletes a boat entity.
     * @param Boat $boat
     *
     * @Route("/{id}", name="boat_delete", methods={"DELETE"})
     *
     * @return RedirectResponse
     */
    public function deleteAction(Boat $boat)
    {
        $this->boatRepository->remove($boat);

        return $this->redirectToRoute('boat_index');
    }

    /**
     * Creates a form to delete a boat entity.
     *
     * @param Boat $boat The boat entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Boat $boat): Form
    {
        /** @var Form $form */
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('boat_delete', ['id' => $boat->getId()]))
            ->setMethod('DELETE')
            ->getForm();

        return $form;
    }
}
