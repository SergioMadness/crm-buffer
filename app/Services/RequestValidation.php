<?php namespace App\Services;

use App\Interfaces\Services\RequestValidation as IRequestValidation;

/**
 * Service to validate request
 * @package App\Services
 */
class RequestValidation implements IRequestValidation
{

    /**
     * Validate data by secret key
     *
     * @param array  $data
     * @param string $signature
     * @param string $key
     *
     * @return bool
     */
    public function validate(array $data, string $key, string $signature): bool
    {
        ksort($data, SORT_STRING);

        $stringToHash = http_build_query($data);

        $correctSignature = md5($stringToHash . $key);

        return $correctSignature === $signature;
    }
}