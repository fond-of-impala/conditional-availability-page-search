<?php

namespace FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Dependency\Service;

use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class ConditionalAvailabilityPageSearchToUtilEncodingServiceBridge implements ConditionalAvailabilityPageSearchToUtilEncodingServiceInterface
{
    protected UtilEncodingServiceInterface $utilEncodingService;

    /**
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     */
    public function __construct(UtilEncodingServiceInterface $utilEncodingService)
    {
        $this->utilEncodingService = $utilEncodingService;
    }

    /**
     * @param mixed $value
     * @param int|null $options
     * @param int|null $depth
     *
     * @return string
     */
    public function encodeJson($value, ?int $options = null, ?int $depth = null): string
    {
        return $this->utilEncodingService->encodeJson($value, $options, $depth);
    }

    /**
     * @param string $jsonValue
     * @param bool $assoc
     * @param int|null $depth
     * @param int|null $options
     *
     * @return array
     */
    public function decodeJson(string $jsonValue, bool $assoc = false, ?int $depth = null, ?int $options = null): array
    {
        return $this->utilEncodingService->decodeJson($jsonValue, $assoc, $depth, $options);
    }
}
