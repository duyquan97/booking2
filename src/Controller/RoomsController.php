<?php

namespace App\Controller;

use App\Entity\Rooms;
use App\Form\RoomsType;
use App\Repository\RoomsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rooms")
 */
class RoomsController extends AbstractController
{
    /**
     * @Route("/", name="rooms_index", methods={"GET"})
     */
    public function index(RoomsRepository $roomsRepository): Response
    {
        
    }

    /**
     * @Route("/new", name="rooms_new", methods={"POST"})
     */
    public function new(Request $request): Response
    {

    }

    /**
     * @Route("/{id}", name="rooms_show", methods={"GET"})
     */
    public function show(Rooms $room): Response
    {

    }

    /**
     * @Route("/{id}/edit", name="rooms_edit", methods={"PATCH"})
     */
    public function edit(Request $request, Rooms $room): Response
    {

    }

    /**
     * @Route("/{id}", name="rooms_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Rooms $room): Response
    {

    }
}
