<?php

declare(strict_types=1);

namespace App\Application\Calculator;

use App\Application\Helper\PrimeNumberProviderInterface;

class PrimeFactorizator implements PrimeFactorizatorInterface
{
    /**
     * @var PrimeNumberProviderInterface
     */
    private $primeNumberProvider;

    public function __construct(PrimeNumberProviderInterface $primeNumberProvider)
    {
        $this->primeNumberProvider = $primeNumberProvider;
    }

    public function factor(int $number): array
    {
        $primes = [];

        $prime = $this->primeNumberProvider->next();
        $remainder = $number;

        do {
            if ($remainder % $prime === 0) {
                $primes[] = $prime;

                $remainder = $remainder/$prime;
            } else {
                $prime = $this->primeNumberProvider->next($prime);
            }
        } while($prime !== $remainder);

        $primes[] = $remainder;

        $nextTreeNode = function ($prime, $number, $nextIndex) use (&$nextTreeNode, $primes) {
            if (!array_key_exists($nextIndex, $primes)) {
                return null;
            }

            return [
                'prime' => $prime,
                'remainder' => $remainder = $number/ $prime,
                'next' => $nextTreeNode($primes[$nextIndex], $remainder, $nextIndex+1)
            ];
        };

        return [
            'number' => $number,
            'primes' => $primes,
            'tree' => $nextTreeNode($primes[0], $number, 1)
        ];
    }
}
