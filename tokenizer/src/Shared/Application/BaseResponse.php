<?php

namespace Src\Shared\Application;

use Symfony\Component\HttpFoundation\Response;

class BaseResponse
{

    private string $message;
    private int $statusCode = Response::HTTP_OK;
    private array $payload, $headers = [];

    const SERVERTIME_FORMAT = 'Y-m-d\TH:i:s\Z';

    /**
     * @param array $response
     * @return $this
     */
    public function payload(array $payload): static
    {
        $this->payload = array_merge($this->payload ?? [], $payload);
        return $this;
    }

    /**
     * @param string $msg
     * @return $this
     */
    public function message(string $msg): static
    {
        $this->message = $msg;
        return $this;
    }

    /**
     * @param int $statusCode
     * @return $this
     */
    public function status(int $statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }


    /**
     * @param array $headers
     * @return $this
     */
    public function headers(array $headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return Response
     */
    final public function echo(): Response
    {
        $responses['server_time'] = (new \DateTime())->format(self::SERVERTIME_FORMAT);

        if (isset($this->message)) {
            $responses['message'] = $this->message;
        }

        if (!empty($this->payload)) {
            $responses['data'] = $this->payload;
        }

        return response($responses, $this->statusCode, $this->headers);
    }
}
