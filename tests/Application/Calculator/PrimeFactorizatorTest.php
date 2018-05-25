<?php

declare(strict_types=1);

namespace App\Tests\Application\Calculator;

use App\Application\Calculator\PrimeFactorizator;
use App\Application\Helper\MockPrimeNumberProvider;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class PrimeFactorizatorTest extends TestCase
{
    /**
     * @var PrimeFactorizator
     */
    private $primeFactorizator;

    protected function setUp()
    {
        $this->primeFactorizator = new PrimeFactorizator(
            new MockPrimeNumberProvider()
        );
    }

    /**
     * @test
     * @dataProvider numbersAndFactorizations
     *
     * @param int $number
     * @param array $primes
     * @param array $tree
     */
    public function it_can_factor_a_given_number(int $number, array $primes, array $tree): void
    {
        $result = $this->primeFactorizator->factor($number);

        $this->assertEquals($primes, $result['primes']);
        $this->assertEquals($tree, $result['tree']);
    }

    public function numbersAndFactorizations(): array
    {
        return [
            [
                24,
                [2,2,2,3],
                [
                    'prime' => 2,
                    'remainder' => 12,
                    'next' => [
                        'prime' => 2,
                        'remainder' => 6,
                        'next' => [
                            'prime' => 2,
                            'remainder' => 3,
                            'next' => null
                        ],
                    ],
                ],
            ],
            [
                43,
                [43],
                null
            ],
            [
                46,
                [2,23],
                [
                    'prime' => 2,
                    'remainder' => 23,
                    'next' => null
                ]
            ],
        ];
    }
}
