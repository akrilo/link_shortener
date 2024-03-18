<?php
namespace App\Controller;

use App\Entity\Link;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;


class LinkController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/create-short-link", name="create_short_link", methods={"POST"})
     */
    public function createShortLink(Request $request): Response
    {
        $originalUrl = $request->request->get('original_url');

        $link = new Link();
        $link->setOriginalUrl($originalUrl);
        $link->setShortUrl($this->generateShortUrl());
        $link->setExpirationDate(new \DateTimeImmutable('+1 week')); // Настройка времени действия ссылки
        $link->setCreatedAt(new \DateTimeImmutable());

        $this->entityManager->persist($link);
        $this->entityManager->flush();

        return $this->json(['short_url' => $link->getShortUrl()]);
    }

    /**
     * @Route("/{shortUrl}", name="redirect_short_link", methods={"GET"})
     */
    public function redirectShortLink($shortUrl): Response
    {
        $linkRepository = $this->entityManager->getRepository(Link::class);
        $link = $linkRepository->findOneBy(['shortUrl' => $shortUrl]);

        if (!$link || $link->getExpirationDate() < new \DateTimeImmutable()) {
            return new RedirectResponse('/');
        }

        return $this->redirect($link->getOriginalUrl());
    }

    private function generateShortUrl(): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';
        $length = 6;
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}