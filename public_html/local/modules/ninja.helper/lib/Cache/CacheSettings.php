<?php

namespace Ninja\Helper\Cache;

class CacheSettings
{
    private string $subDir;
    private array $paramsForCacheId;
    private $callback;
    private int $ttl = 3600;
    private bool $skipCache = false;
    private bool $useTags = false;
    private array $customTags = [];

    public function __construct(string $subDir, array $paramsForCacheId, callable $callback)
    {
        $this->subDir = $subDir;
        $this->paramsForCacheId = $paramsForCacheId;
        $this->callback = $callback;
    }

    public function setTtl(int $ttl): self
    {
        $this->ttl = $ttl;

        return $this;
    }

    public function setSkipCache(): self
    {
        $this->skipCache = true;

        return $this;
    }

    public function setUseTags(array $customTags = []): self
    {
        $this->useTags = true;
        $this->customTags = $customTags;

        return $this;
    }

    public function getSubDir(): string
    {
        return $this->subDir;
    }

    public function getCacheId(): string
    {
        return md5(serialize($this->paramsForCacheId));
    }

    public function runCallback()
    {
        return ($this->callback)();
    }

    public function getTtl(): int
    {
        return $this->ttl;
    }

    public function isSkipCache(): bool
    {
        return $this->skipCache;
    }

    public function isUseTags(): bool
    {
        return $this->useTags;
    }

    public function getCustomTags(): array
    {
        return $this->customTags;
    }
}
