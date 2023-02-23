<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductsController
{
    #[Route('/products/{id}/lowest-price', name:'lowest-price', methods: 'POST')]
    public function lowestPrice(Request $request, int $id): Response
    {

        if ($request->headers->has('force_fail')) {

            return new JsonResponse(
                ['error' => 'Promotions Engine failure message'],
                $request->headers->get('force_fail')
            );
        }

        return new JsonResponse([
            "quantity" => 50,
            "request_location" => "UK",
            "voucher_code" => "OU812",
            "request_date" => "2022-04-04",
            "product_id" => $id,
            "price" => 100,
            "discounted_price" => 50,
            "promotion_id" => 3,
            "promotion_name" => "Black Friday half price sale" 
        ]);
    }

    #[Route('/products/{id}/promotions', name: 'promotions', methods: 'GET')]
    public function promotions()
    {

    }
}