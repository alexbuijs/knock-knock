<?php
// Inspired by https://github.com/lhapaipai/vite-bundle/blob/4510dab0b8d9d4c6ff410468d76c00449046fdc4/src/Asset/ViteAssetVersionStrategy.php

namespace App\Classes;

use Exception;
use JsonException;
use Symfony\Component\Asset\Exception\AssetNotFoundException;
use Symfony\Component\Asset\Exception\RuntimeException;
use Symfony\Component\Asset\VersionStrategy\VersionStrategyInterface;

class ViteAssetVersionStrategy implements VersionStrategyInterface
{
    private array $assets;

    /**
     * @param string $manifestPath Absolute path to the entrypoints file
     * @param bool   $strictMode      Throws an exception for unknown paths
     */
    public function __construct(
        private string $manifestPath,
        private bool $strictMode = true,
    ) {
    }

    /**
     * With a entrypoints, we don't really know or care about what
     * the version is. Instead, this returns the path to the
     * versioned file.
     */
    public function getVersion(string $path): string
    {
        return $this->applyVersion($path);
    }

    public function applyVersion(string $path): string
    {
        return $this->getAssetPath($path) ?: $path;
    }

    private function getAssetPath(string $path): ?string
    {
        if (!isset($this->assets)) {
            $this->loadManifest();
        }

        if (isset($this->assets[$path])) {
            return $this->assets[$path]["file"];
        }

        if ($this->strictMode) {
            throw new AssetNotFoundException(
                sprintf(
                    'assets "%s" not found in entrypoints file "%s".',
                    $path,
                    $this->manifestPath,
                ),
            );
        }

        return null;
    }

    private function loadManifest()
    {
        if (!is_file($this->manifestPath)) {
            throw new RuntimeException("Manifest does not exist.");
        }

        try {
            $this->assets = json_decode(
                file_get_contents($this->manifestPath),
                true,
                512,
                \JSON_THROW_ON_ERROR,
            );
        } catch (JsonException $e) {
            throw new RuntimeException(
                "Error parsing JSON from manifest: " . $e->getMessage(),
            );
        }
    }
}
