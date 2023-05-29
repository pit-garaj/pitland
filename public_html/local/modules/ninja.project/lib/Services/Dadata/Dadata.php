<?php

declare(strict_types=1);

namespace Ninja\Project\Services\Dadata;

use Dadata\DadataClient;

class Dadata
{
    private const TOKEN = '55bc2bf6535b662fef5c514e46202c2025cc02f5';
    private const SECRET = '333dd60189115b198f996d1cdfa047de0a6752d8';

    private DadataClient $dadata;

    public function __construct()
    {
        $this->dadata = new DadataClient(self::TOKEN, self::SECRET);
    }

    public function getLocaleByIp(string $ip): ?array
    {
        $result = $this->dadata->iplocate($ip);
        return $result['data'] ?? null;
    }
}
