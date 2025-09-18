<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Form\DateTimeType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/task')]
final class TaskController extends AbstractController
{
    #[Route('/', name: 'app_task_index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(Request $request, TaskRepository $taskRepository): Response
    {
        $sort = $request->query->get('sort', 'createdAt');
        $direction = $request->query->get('direction', 'desc');

        $tasks = $taskRepository->findBy([], [$sort => $direction]);

        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
            'sort' => $sort,
            'direction' => $direction,
        ]);
    }

    #[Route('/new', name: 'app_task_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setUser($this->getUser());
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('task/new.html.twig', [
            'task' => $task,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_task_show', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function show(Task $task): Response
    {
        $this->denyAccessUnlessOwner($task);

        return $this->render('task/show.html.twig', [
            'task' => $task,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_task_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function edit(Request $request, Task $task, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessOwner($task);

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('task/edit.html.twig', [
            'task' => $task,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_task_delete', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Request $request, Task $task, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessOwner($task);

        if ($this->isCsrfTokenValid('delete'.$task->getId(), $request->request->get('_token'))) {
            $entityManager->remove($task);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
    }

    private function denyAccessUnlessOwner(Task $task): void
    {
        if ($task->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Você não pode acessar esta tarefa.');
        }
    }
}
