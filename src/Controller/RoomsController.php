<?php

namespace App\Controller;

use App\Entity\Rooms;
use App\Repository\RoomsRepository;
use Cocur\Slugify\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rooms")
 */
class RoomsController extends AbstractController
{
    private $roomsRepository;
    public function __construct(RoomsRepository $roomsRepository)
    {
        $this->roomsRepository = $roomsRepository;
    }

    /**
     * @Route("/", name="rooms_index", methods={"GET"})
     */
    public function index(): Response
    {
        return new JsonResponse($this->roomsRepository->getIndex(), Response::HTTP_OK);
    }

    /**
     * @Route("/new", name="rooms_new", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $slugify = new Slugify();
        $room =  new Rooms();
        $room->setName($request->request->get('name'));
        $room->setSlug($slugify->slugify($request->request->get('name')));
        $room->setShortDescription($request->request->get('short_description'));
        $room->setDescription($request->request->get('description'));
        $room->setPerson($request->request->get('person'));
        $room->setProvince($request->request->get('province'));
        $room->setDistrict($request->request->get('district'));
        $room->setStreet($request->request->get('street'));
        $room->setStatus($request->request->get('status'));
        $room->setFeatured($request->request->get('featured'));
        $room->setType($request->request->get('type'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($room);
        $entityManager->flush();
        if ($room) {
            return new JsonResponse(['message' => 'create success'], Response::HTTP_CREATED);
        }

        return new JsonResponse(['error' => 'create not success'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/{id}", name="rooms_show", methods={"GET"})
     */
    public function show(int $id): Response
    {
        return new JsonResponse($this->roomsRepository->findById($id)[0], Response::HTTP_OK);
    }

    /**
     * @Route("/{id}", name="rooms_edit", methods={"PATCH"})
     */
    public function edit(int $id, Request $request, RoomsRepository $roomsRepository): Response
    {
        $slugify = new Slugify();
        $room = $this->roomsRepository->find($id);
        $room->setName($request->request->get('name'));
        $room->setSlug($slugify->slugify($request->request->get('name')));
        $room->setShortDescription($request->request->get('short_description'));
        $room->setDescription($request->request->get('description'));
        $room->setPerson($request->request->get('person'));
        $room->setProvince($request->request->get('province'));
        $room->setDistrict($request->request->get('district'));
        $room->setStreet($request->request->get('street'));
        $room->setStatus($request->request->get('status'));
        $room->setFeatured($request->request->get('featured'));
        $room->setType($request->request->get('type'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        if ($room) {
            return new JsonResponse(['message' => 'edit success'], Response::HTTP_OK);
        }

        return new JsonResponse(['error' => 'edit not success'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/{id}", name="rooms_delete", methods={"DELETE"})
     */
    public function delete(int $id  ): Response
    {
        $room = $this->roomsRepository->find($id);
        if ($room) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($room);
            $entityManager->flush();
            return new JsonResponse(['message' => 'delete success'], Response::HTTP_OK);
        }
        return new JsonResponse(['error' => 'delete not success'], Response::HTTP_BAD_REQUEST);
    }
}
