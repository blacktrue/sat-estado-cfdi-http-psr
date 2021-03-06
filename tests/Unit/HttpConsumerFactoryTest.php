<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoCfdi\Tests\HttpPsr\Unit;

use PhpCfdi\SatEstadoCfdi\HttpPsr\HttpConsumerFactory;
use PhpCfdi\SatEstadoCfdi\Tests\HttpPsr\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class HttpConsumerFactoryTest extends TestCase
{
    private function createFactoryWithMockObjects()
    {
        /** @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject $client */
        $client = $this->createMock(ClientInterface::class);
        /** @var RequestFactoryInterface&\PHPUnit\Framework\MockObject\MockObject $requestFactory */
        $requestFactory = $this->createMock(RequestFactoryInterface::class);
        /** @var StreamFactoryInterface&\PHPUnit\Framework\MockObject\MockObject $streamFactory */
        $streamFactory = $this->createMock(StreamFactoryInterface::class);

        return new HttpConsumerFactory($client, $requestFactory, $streamFactory);
    }

    public function testFactoryHttpClientAlwaysReturnTheSameObject(): void
    {
        $factory = $this->createFactoryWithMockObjects();
        $first = $factory->httpClient();
        $second = $factory->httpClient();
        $this->assertSame($first, $second);
    }

    public function testFactoryRequestFactoryAlwaysReturnTheSameObject(): void
    {
        $factory = $this->createFactoryWithMockObjects();
        $first = $factory->requestFactory();
        $second = $factory->requestFactory();
        $this->assertSame($first, $second);
    }

    public function testFactoryStreamFactoryAlwaysReturnTheSameObject(): void
    {
        $factory = $this->createFactoryWithMockObjects();
        $first = $factory->streamFactory();
        $second = $factory->streamFactory();
        $this->assertSame($first, $second);
    }

    public function testFactoryNewConsumerClientResponseReturnsNewObjects(): void
    {
        $factory = $this->createFactoryWithMockObjects();
        $first = $factory->newConsumerClientResponse();
        $second = $factory->newConsumerClientResponse();
        $this->assertNotSame($first, $second);
    }
}
