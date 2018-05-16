<?php

declare(strict_types=1);

namespace App\Application\Calculators;

class MockPrimeFactorizator implements PrimeFactorizatorInterface
{
    public function factor(int $number): array
    {
        return [
            'error' => null,
            'result' => [
                'number' => 32,
                'primes' => [2, 2, 2, 2],
                'tree' => [
                    'prime' => 2,
                    'remainder' => 16,
                    'next' => [
                        'prime' => 2,
                        'remainder' => 8,
                        'next' => [
                            'prime' => 2,
                            'remainder' => 4,
                            'next' => [
                                'prime' => 2,
                                'remainder' => 2,
                                'next' => null
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}
