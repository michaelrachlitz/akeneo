<?php

namespace Controller\Vehicle;

use Pim\Component\Catalog\Repository\ProductRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class VehicleController
 * @package Controller\Vehicle
 */
class VehicleController extends AbstractController
{
    /** @var ProductRepositoryInterface */
    private $repository;

    /** @var NormalizerInterface */
    private $normalizer;

    /**
     * VehicleController constructor.
     * @param ProductRepositoryInterface $repository
     * @param NormalizerInterface $normalizer
     */
    public function __construct(
        ProductRepositoryInterface $repository,
        NormalizerInterface $normalizer
    )
    {
        $this->repository = $repository;
        $this->normalizer = $normalizer;
    }


    public function getAction(
        Request $request
    )
    {
        $code = $request->query->get('code');
        $vehicle = $this->repository->findOneByIdentifier($code);
        if (null === $vehicle) {
            throw new NotFoundHttpException(sprintf('Vehicle "%s" does not exist.', $code));
        }

        $vehicleApi = $this->normalizer->normalize($vehicle, 'external_api');

        return new JsonResponse($vehicleApi);
    }

    public function listAction()
    {
        $response = $this->repository->findAll();
        return new JsonResponse($response);
    }
}