<?php

declare(strict_types=1);

namespace App\Application\Helper;

use PHPUnit\Framework\TestCase;

class MockPrimeNumberProviderTest extends TestCase
{
    /** @var PrimeNumberProviderInterface */
    private $provider;

    protected function setUp()
    {
        $this->provider = new MockPrimeNumberProvider();
    }

    /**
     * @test
     *
     * @dataProvider primesAndNextPrimes
     *
     * @param int $prime
     * @param int $nextPrime
     */
    public function it_returns_the_next_prime_number(int $prime, int $nextPrime): void
    {
        $result = $this->provider->next($prime);

        $this->assertEquals($nextPrime, $result);
    }

    public function primesAndNextPrimes(): array
    {
        return [
            [0,2],
            [31, 37],
            [137, 139],
            [18, 19],
            [17, 19],
        ];
    }
}
