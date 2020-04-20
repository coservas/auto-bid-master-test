<?php

namespace App\Controller;

use App\Entity\Make;
use App\Entity\Model;
use App\Entity\SearchLog;
use App\Entity\VehicleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="vehicle_type_list")
     */
    public function vehicleTypeList(): Response
    {
        /** @var VehicleType[] $types */
        $types = $this->getDoctrine()
            ->getRepository(VehicleType::class)
            ->findBy([], ['code' => 'ASC']);

        return $this->render('vehicle_type_list.html.twig', [
            'types' => $types
        ]);
    }

    /**
     * @Route("/makes/{type}", name="make_list_by_vehicle_type")
     */
    public function makeListByVehicleType(string $type): Response
    {
        /** @var VehicleType $vehicleType */
        $vehicleType = $this->getDoctrine()
            ->getRepository(VehicleType::class)
            ->findOneBy(['code' => $type]);

        /** @var VehicleType[] $types */
        $makes = $this->getDoctrine()
            ->getRepository(Make::class)
            ->findBy(['type' => $vehicleType], ['code' => 'ASC']);

        return $this->render('make_list_by_vehicle_type.html.twig', [
            'makes' => $makes
        ]);
    }

    /**
     * @Route("/models/{type}/{makeCode}", name="model_list_by_vehicle_type_and_make_code")
     */
    public function modelListByVehicleTypeAndMakeCode(string $type, string $makeCode, Request $request): JsonResponse
    {
        /** @var VehicleType $vehicleType */
        $vehicleType = $this->getDoctrine()
            ->getRepository(VehicleType::class)
            ->findOneBy(['code' => $type]);

        /** @var Make $make */
        $make = $this->getDoctrine()
            ->getRepository(Make::class)
            ->findOneBy(['code' => $makeCode]);

        /** @var Model[] $models */
        $models = $this->getDoctrine()
            ->getRepository(Model::class)
            ->findBy(['type' => $vehicleType, 'make' => $make], ['code' => 'ASC']);

        $log = (new SearchLog())
            ->setVehicleTypeCode($type)
            ->setMakeCode($makeCode)
            ->setNumberModels(count($models))
            ->setRequestTime(new \DateTime())
            ->setIp($request->getClientIp())
            ->setUserAgent($request->headers->get('User-Agent'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($log);
        $em->flush();

        $func = fn(Model $model): array => [
            'code' => $model->getCode(),
            'description' => $model->getDescription()
        ];

        return $this->json(array_map($func, $models));
    }
}
