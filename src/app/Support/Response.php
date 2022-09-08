<?php

namespace App\Support;

use Illuminate\Http\Resources\Json\ResourceCollection as Collection;
use Illuminate\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class Response
{
    /**
     * Http response.
     *
     * @var \Illuminate\Contracts\Routing\ResponseFactory
     */
    private \Illuminate\Contracts\Routing\ResponseFactory|ResponseFactory $response;

    /**
     * Collection.
     */
    private $resource;

    /**
     * Http status code.
     *
     * @var int
     */
    private int $statusCode = HttpResponse::HTTP_OK;

    /**
     * Create a new class instance.
     *
     * @param ResponseFactory $response
     * @param $collection
     */
    public function __construct(ResponseFactory $response, $collection)
    {
        $this->resource = $collection;
        $this->response = $response;
    }

    /**
     * Return json
     *
     * @param array $data
     * @param array $headers
     * @param bool $is_data
     * @return \Illuminate\Http\JsonResponse
     */
    public function json($data = [], array $headers = [], bool $is_data = true): \Illuminate\Http\JsonResponse
    {
        if (!$is_data){
            return $this->response->json($data, $this->statusCode, $headers);
        } else {
            return $this->response->json(['data'=>$data], $this->statusCode, $headers);
        }
    }

    /**
     * Return collection.
     */
    public function withCollection($data): Collection
    {
        return $this->resource::collection($data);
    }

    /**
     * @param null $resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withCreated($resource = null): \Illuminate\Http\JsonResponse
    {
        $this->statusCode = HttpResponse::HTTP_CREATED;

        if (is_null($resource)) {
            return $this->json();
        }

        return $this->json($resource);
    }

    /**
     * Make a 204 no content response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withNoContent(): \Illuminate\Http\JsonResponse
    {
        return $this->setStatusCode(
            HttpResponse::HTTP_NO_CONTENT
        )->json();
    }

    /**
     * Make a 400 'Bad Request' response.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withBadRequest(string $message = 'Bad Request'): \Illuminate\Http\JsonResponse
    {
        return $this->setStatusCode(
            HttpResponse::HTTP_BAD_REQUEST
        )->withError($message);
    }

    /**
     * Make a 403 'Forbidden' response.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withForbidden(string $message = 'Forbidden')
    {
        return $this->setStatusCode(
            HttpResponse::HTTP_FORBIDDEN
        )->json(['message' => $message], [], false);
    }

    /**
     * Make a 404 'Not Found' response.
     *
     * @param string|null $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function withNotFound(string $item = null): \Illuminate\Http\JsonResponse
    {
        if (is_null($item)) {
            return $this->setStatusCode(
                HttpResponse::HTTP_NOT_FOUND
            )->json(['message' => 'Not found']);
        }

        return $this->setStatusCode(
            HttpResponse::HTTP_NOT_FOUND
        )->json(['message' => $item . ' not found', 'errors' => [$item => $item . ' not found']]);
    }

    /**
     * Make a JSON response with the transformed items.
     *
     * @param $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withItem($data): \Illuminate\Http\JsonResponse
    {
        return $this->json(new $this->resource($data));
    }

    /**
     * Make an error response.
     *
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withError($message, array $errors = []): \Illuminate\Http\JsonResponse
    {
        $json = [
            'message' => $message,
        ];

        if (!empty($errors)) {
            $json['errors'] = $errors;
        }

        return $this->setStatusCode(HttpResponse::HTTP_BAD_REQUEST)
            ->json($json, [], false);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function acceptedStatus(): \Illuminate\Http\JsonResponse
    {
        return $this->json(
            [
                'status'=> 'accepted',
            ]
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function moderatedStatus(): \Illuminate\Http\JsonResponse
    {
        return $this->json(
            [
                'status'=> 'moderated',
            ]
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function noChanges(): \Illuminate\Http\JsonResponse
    {
        return $this->withBadRequest(
            'There were no changes'
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function unauthorized(): \Illuminate\Http\JsonResponse
    {
        return $this->setStatusCode(
            HttpResponse::HTTP_UNAUTHORIZED
        )->json(['messages' => 'User unauthorized'], [], true);
    }

    /**
     * Get status code.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Set status code.
     *
     * @param int $statusCode
     *
     * @return Response
     */
    public function setStatusCode(int $statusCode): Response
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Set collection class.
     *
     * @param mixed $resource
     */
    public function setResource($resource): Response
    {
        $this->resource = $resource;

        return $this;
    }
}
