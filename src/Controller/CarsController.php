<?php

namespace App\Controller;

use App\Form\UkCarBillType;
use Exception;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route(
                '/cars',
    name:       'cars_',
    methods:    ['GET']
)]
class CarsController extends AbstractController
{
    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly Pdf $knpSnappyPdf
    ) { }

    #[Route(
                '/fr-customs-tax-calculator',
        name:   'fr-customs-tax-calculator'
    )]
    public function frCustomsTaxCalculator(): Response
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

        return $this->render('cars/fr-customs-tax-calculator.html.twig', [
            "title" => "Calculateur des frais de douane pour l'importation de voiture anglaise",
            "description" => "Cet outil a pour but de calculer rapidement est de manière plutôt précise les frais de dédouanement d'un véhicule anglais importé sur le sol français.",
            "REVSQUAD_TUTO_ARTICLE_LINK" => $_ENV["REVSQUAD_TUTO_ARTICLE_LINK"],
            "LATEST_UPDATE" => $_ENV["LATEST_UPDATE"],
            "exchangeRate" => $exchangeRate,
            "exchangeIsUpdated" => $exchangeIsUpdated
        ]);
    }

    #[Route(
                    '/uk-car-bill-generator',
        name:       'uk-car-bill-generator',
        methods:    ["GET", "POST"]
    )]
    public function ukCarBillGenerator(Request $request)
    {
        $form = $this->createForm(UkCarBillType::class);

        $form->handleRequest($request);
        if($form->isSubmitted()) {
            $data = $form->getData();

            $html = $this->renderView('cars/uk-car-bill-generator-pdf.html.twig', [
                "title" => "Used vehicle sale agreement",
                "description" => "",
                "data" => $data
            ]);

            $this->knpSnappyPdf->setOption("enable-local-file-access", true);
            $this->knpSnappyPdf->setOption("margin-top", "2.5cm");
            $this->knpSnappyPdf->setOption("margin-bottom", "2.5cm");
            $this->knpSnappyPdf->setOption("margin-left", "2.5cm");
            $this->knpSnappyPdf->setOption("margin-right", "2.5cm");

            return new PdfResponse(
                $this->knpSnappyPdf->getOutputFromHtml($html),
                "facture_" . str_replace(" ", "_", $data["carBrand"]) . "_" . str_replace(" ", "_", $data["carModel"]) . ".pdf"
            );
        }

        return $this->render('cars/uk-car-bill-generator.html.twig', [
            "title" => "Générateur de facture d'achat d'un véhicule anglais",
            "description" => "Cet outil permet de générer une facture d'achat d'un véhicule anglais valide auprès des autorités.",
            "form" => $form,
            "REVSQUAD_TUTO_ARTICLE_LINK" => $_ENV["REVSQUAD_TUTO_ARTICLE_LINK"],
            "LATEST_UPDATE" => $_ENV["LATEST_UPDATE"]
        ]);
    }
}
