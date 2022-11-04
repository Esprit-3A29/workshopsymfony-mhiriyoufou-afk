<?php

namespace App\Controller;

use App\Form\ClassroomType;
use App\Entity\Classroom;
use App\Repository\ClassroomRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }
    #[Route('/classroomAfficher', name: 'listAfficher')]
    public function ClassroomList(ClassroomRepository $repo)
    {
        $v = $repo->findAll();
        return $this->render("classroom/listClassroom.html.twig", array("aff" => $v));
    }
    #[Route('/classroomAdd', name: 'listAdd')]
    public function ClassroomAdd(ManagerRegistry $ajout, Request $request, ClassroomRepository $repo)
    {
        $classroom = new Classroom();
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $repo->add($classroom, true);
            return $this->redirectToRoute("listAfficher");
        }
        return $this->renderForm("classroom/listAdd.html.twig", array("formClassroom" => $form));
    }
    #[Route('/classroomUpdate/{id}', name: 'listUpdate')]
    public function ClassroomUpdate($id, ManagerRegistry $update, Request $request, ClassroomRepository $repo)
    {
        $classroom = $repo->find($id);
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $update->getManager();
            $em->flush();
            return  $this->redirectToRoute("listAfficher");
        }
        return $this->renderForm("classroom/listUpdate.html.twig", array("formClassroom" => $form));
    }

    #[Route('/classroomRemove/{id}', name: 'listRemove')]

    public function removeStudent(ManagerRegistry $remove, $id, ClassroomRepository $repo)
    {
        $classroom = $repo->find($id);
        $em = $remove->getManager();
        $em->remove($classroom);
        $em->flush();
        return  $this->redirectToRoute("listAfficher");
    }
}
