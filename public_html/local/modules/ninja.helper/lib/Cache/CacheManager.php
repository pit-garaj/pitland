<?php

declare(strict_types=1);

namespace Ninja\Helper\Cache;

use Bitrix\Main\Application;
use Bitrix\Main\Data\Cache;

class CacheManager
{
    private const CACHE_DIR = '/ninja.project';

    /**
     * Кэширует данные через callback и возвращает их
     *
     * @param CacheSettings $cacheSetting
     * @return mixed
     */
    public static function getDataCache(CacheSettings $cacheSetting)
    {
        if ($cacheSetting->isSkipCache()) {
            return $cacheSetting->runCallback();
        }

        $dir = self::CACHE_DIR . $cacheSetting->getSubDir();

        $cache = Cache::createInstance();
        if ($cache->initCache($cacheSetting->getTtl(), $cacheSetting->getCacheId(), $dir)) {
            $result = $cache->getVars();
        } elseif ($cache->startDataCache()) {
            $taggedCache = null;
            if ($cacheSetting->isUseTags()) {
                $taggedCache = Application::getInstance()->getTaggedCache();
                $taggedCache->startTagCache($dir);

                foreach ($cacheSetting->getCustomTags() as $tag) {
                    $taggedCache->registerTag($tag);
                }
            }

            $result = $cacheSetting->runCallback();

            if ($taggedCache !== null) {
                $taggedCache->endTagCache();
            }

            $cache->endDataCache($result);
        }

        return $result;
    }

    /**
     * Очищает папку с кешем
     *
     * @param string $subDir
     */
    public static function cleanDir(string $subDir): void
    {
        $cache = Cache::createInstance();
        $cache->cleanDir(self::CACHE_DIR . $subDir);
    }
}
