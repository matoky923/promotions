<?php

namespace App\Controller;

use App\DTO\LowestPriceEnquiry;
use App\Service\Serializer\DTOSerializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductsController extends AbstractController
{
    #[Route('/products/{id}/lowest-price', name:'lowest-price', methods: 'POST')]
    public function lowestPrice(Request $request, DTOSerializer $serializer, int $id): Response
    {
        
        if ($request->headers->has('force_fail')) {

            return new JsonResponse(
                ['error' => 'Promotions Engine failure message'],
                $request->headers->get('force_fail')
            );
        }


        $lowestPriceEnquiry = $serializer->deserialize(
            $request->getContent(), LowestPriceEnquiry::class, 'json')
        ;

        $lowestPriceEnquiry->setDiscountedPrice(50);
        $lowestPriceEnquiry->setPrice(100);
        $lowestPriceEnquiry->setPromotionId(3);
        $lowestPriceEnquiry->setPromotionName('Black Friday half price sale');

        $responseContent = $serializer->serialize($lowestPriceEnquiry, 'json');

        return new Response($responseContent, 200);

    }

    #[Route('/products/{id}/promotions', name: 'promotions', methods: 'GET')]
    public function promotions()
    {

    }
}