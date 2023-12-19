<?php

use Src\Agenda\User\Infrastructure\EloquentModels\UserEloquentModel;
use Src\Auth\Application\DTO\LoginDto;
use Src\Auth\Application\Exceptions\InvalidUserCredentialException;
use Src\Auth\Application\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class AuthControllerTest extends \Tests\TestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    public function testLoginWithValidCredentials()
    {

        /**@var UserEloquentModel $user */
        $user = UserEloquentModel::factory()->create([
            'mobile' => '09114904505',
            'password' => bcrypt($password = 'secret'),
        ]);

        $this->mock(JWTAuth::class, function ($mock) {
            $mock->shouldReceive('login')->andReturn(new LoginDto(
                'mocked_access_token',
                'Bearer',
                3600
            ));
        });

        $response = $this->post(route('api.login'), [
            'mobile' => $user->getMobile(),
            'password' => $password,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'welcome to your account!',
            ])
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'data' => [
                    'access_token' => 'mocked_access_token',
                    'token_type' => 'Bearer',
                    'expires_in' => 3600,
                ]
            ]);
    }

    public function testLoginWithInvalidCredentials()
    {
        $this->mock(JWTAuth::class, function ($mock) {
            $mock->shouldReceive('login')
                ->andThrow(new InvalidUserCredentialException('Invalid user credentials'));
        });

        $response = $this->post(route('api.login'), [
            'mobile' => '09114904505',
            'password' => 'invalid_password',
        ]);

        $response->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJson([
                'message' => 'Invalid user credentials',
            ]);
    }

    public function testMeWithAuthenticatedUser()
    {
        $user = UserEloquentModel::factory()->create([
            'mobile' => $mobile = '09114904505',
            'password' => bcrypt('secret')
        ]);
        $this->actingAs($user);
        $response = $this->get(route('api.me'));
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
               'data' => [
                   'id' => $user->id,
                   'mobile' => $mobile
               ]
            ]);
    }
}
