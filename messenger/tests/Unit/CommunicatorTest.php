<?php

namespace Tests\Unit;


use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Src\Shared\Infrastructure\Communicator\Communicator;
use Src\Shared\Infrastructure\Communicator\DTO\UserInformationDTO;
use Src\Shared\Infrastructure\Communicator\Exceptions\UnAuthorizedException;
use Src\Shared\Infrastructure\Communicator\Exceptions\InvalidArgumentException;

class CommunicatorTest extends TestCase
{
    private Communicator $communicator;

    public function setUp(): void
    {
        parent::setUp();
        config()->set([
            "communicator.base_url" => "http://example.com",
            "communicator.retries" => 3,
        ]);
        $this->communicator = new Communicator('dummy_token');
    }

    public function testMeSuccess()
    {
        Http::fake([
            'http://example.com/me' => Http::response([
                'data' => [
                    'id' => 1,
                    'mobile' => '1234567890',
                ],
            ], Response::HTTP_OK),
        ]);

        $result = $this->communicator->me();
        $this->assertInstanceOf(UserInformationDTO::class, $result);
        $this->assertEquals(1, $result->getUserId());
        $this->assertEquals('1234567890', $result->getMobile());
        Http::assertSent(function ($request) {
            return $request->url() === 'http://example.com/me' && $request->method() === 'GET';
        });
    }


    public function testMeUnauthorized()
    {
        Http::fake([
            'http://example.com/me' => Http::response([], Response::HTTP_UNAUTHORIZED),
        ]);
        $this->expectException(UnAuthorizedException::class);
        $this->communicator->me();
    }

    public function testMeInvalidResponse()
    {
        $responseData = ['invalid' => 'response'];

        Http::fake([
            'http://example.com/me' => Http::response($responseData, 200),
        ]);

        $this->expectException(InvalidArgumentException::class);

        $this->communicator->me();

        Http::assertSent(function ($request) {
            return $request->url() === 'http://example.com/me' && $request->method() === 'GET';
        });
    }
}
