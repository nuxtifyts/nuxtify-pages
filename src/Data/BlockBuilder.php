<?php

namespace Nuxtifyts\NuxtifyPages\Data;

use ArrayAccess;
use Illuminate\Support\Collection;

class BlockBuilder
{
    /**
     * @return ?Collection<int, BlockData>
     */
    public static function build(mixed $data): ?Collection
    {
        if (!is_array($data) && !($data instanceof ArrayAccess)) {
            return null;
        }

        $blocks = collect();

        if ($block = self::buildBlock($data)) {
            $blocks->push($block);
        } else {
            foreach ($data as $blockData) {
                if ($block = self::buildBlock($blockData)) {
                    $blocks->push($block);
                }
            }
        }

        return $blocks;
    }

    private static function buildBlock(array|ArrayAccess $data): ?BlockData
    {
        return match(Block::tryFrom($data['type'] ?? '')) {
            Block::HEADING => new HeadingBlockData(
                content: $data['data']['content'],
                level: $data['data']['level'],
            ),
            Block::PARAGRAPH => new ParagraphBlockData(
                content: $data['data']['content'],
            ),
            Block::IMAGE => new ImageBlockData(
                src: $data['data']['src'],
                alt: $data['data']['alt'],
                height: $data['data']['height'] ?? null,
                width: $data['data']['width'] ?? null,
            ),
            default => null
        };
    }
}
