<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly HttpClientInterface $client,
    ) { }

    #[Route('/fr-customs-tax-calculator', name: 'app_home')]
    public function index(): Response
    {
        $exchangeRate = floatval($_ENV["DEFAULT_EXCHANGE_RATE"]);
        $exchangeIsUpdated = false;

        try {
            $request = $this->client->request("GET", "https://v6.exchangerate-api.com/v6/" . $_ENV["EXCHANGE_RATE_API_KEY"] . "/pair/GBP/EUR");
            $exchangeRate = $request->toArray()["conversion_rate"];
            $exchangeIsUpdated = true;
        } catch (Exception) {
            // Too bad
        }

        return $this->render('home.html.twig', [
            "REVSQUAD_TUTO_ARTICLE_LINK" => $_ENV["REVSQUAD_TUTO_ARTICLE_LINK"],
            "LATEST_UPDATE" => $_ENV["LATEST_UPDATE"],
            "exchangeRate" => $exchangeRate,
            "exchangeIsUpdated" => $exchangeIsUpdated
        ]);
    }
}
