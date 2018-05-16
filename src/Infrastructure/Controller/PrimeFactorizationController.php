<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\Calculators\PrimeFactorizatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PrimeFactorizationController
{
    /**
     * @var PrimeFactorizatorInterface
     */
    private $primeFactorizator;

    public function __construct(PrimeFactorizatorInterface $primeFactorizator)
    {
        $this->primeFactorizator = $primeFactorizator;
    }

    public function factor(int $number): Response
    {
        return new JsonResponse(
            $this->primeFactorizator->factor($number)
        );
    }
}
