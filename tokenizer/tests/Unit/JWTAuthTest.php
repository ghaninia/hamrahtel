<?php

namespace Tests\Unit;

use Tests\TestCase;
use Src\Auth\Application\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Src\Auth\Application\DTO\LoginDto;
use Src\Auth\Application\Exceptions\InvalidUserCredentialException;

class JWTAuthTest extends TestCase
{
    /**
     * @throws InvalidUserCredentialException
     */
    public function testLoginWithValidCredentials()
    {
        $mockToken = 'mocked_token';
        $mockTtl = 1200; // in seconds
        $credentials = ['username' => 'amin', 'password' => 'secret'];

        Auth::shouldReceive('attempt')
            ->once()
            ->with($credentials)
            ->andReturn($mockToken);

        Auth::shouldReceive('factory->getTTL')
            ->once()
            ->andReturn(20);

        $jwt = new JWTAuth();
        $loginDto = $jwt->login($credentials);

        $this->assertInstanceOf(LoginDto::class, $loginDto);
        $this->assertEquals($mockToken, $loginDto->getAccessToken());
        $this->assertEquals(JWTAuth::TOKEN_TYPE, $loginDto->getTokenType());
        $this->assertEquals($mockTtl, $loginDto->getTTL());
    }

    public function testLoginWithInvalidCredentials()
    {
        $credentials = ['username' => 'invalid_user', 'password' => 'invalid_password'];

        Auth::shouldReceive('attempt')
            ->once()
            ->with($credentials)
            ->andReturn(false);

        $this->expectException(InvalidUserCredentialException::class);

        $jwt = new JWTAuth();
        $jwt->login($credentials);
    }

    public function testLogout()
    {
        Auth::shouldReceive('logout')->once();
        $jwt = new JWTAuth();
        $jwt->logout();
    }
}
