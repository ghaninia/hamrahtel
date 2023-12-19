<?php

namespace Src\Shared\Infrastructure\Communicator;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Src\Shared\Infrastructure\Communicator\DTO\UserInformationDTO;
use Src\Shared\Infrastructure\Communicator\Exceptions\InvalidArgumentException;
use Src\Shared\Infrastructure\Communicator\Exceptions\UnAuthorizedException;

class Communicator
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return UserInformationDTO
     * @throws InvalidArgumentException
     * @throws UnAuthorizedException
     * @throws Exception
     */
    public function me(): UserInformationDTO
    {
        try {
            $response = $this->sendRequest("me");
            return $this->handleSuccessfulResponse($response);

        } catch (InvalidArgumentException $argumentException) {
            throw $argumentException;
        } catch (Exception $exception) {
            throw match ($exception->getCode()) {
                \Illuminate\Http\Response::HTTP_UNAUTHORIZED => new UnAuthorizedException(),
                default => throw $exception,
            };
        }
    }

    /**
     * @param string $endpoint
     * @return Response
     */
    private function sendRequest(string $endpoint): Response
    {
        $baseUrl = trim(config("communicator.base_url"), "/");
        return Http::retry(config("communicator.retries"))
            ->baseUrl($baseUrl)
            ->withoutVerifying()
            ->withHeaders([
                'Authorization' => 'Bearer ' . $this->token,
            ])
            ->get($endpoint);
    }

    /**
     * @param Response $response
     * @return UserInformationDTO
     * @throws InvalidArgumentException
     */
    private function handleSuccessfulResponse(Response $response): UserInformationDTO
    {
        $data = $response['data'] ?? [];

        if (isset($data['id'], $data['mobile'])) {
            return new UserInformationDTO(
                $data['id'],
                $data['mobile']
            );
        }

        throw new InvalidArgumentException();
    }
}
