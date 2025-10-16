<?php

namespace App\Services;

use App\Models\Snippet;

class PuzzleValidationService
{
    /**
     * Beautify HTML content with proper indentation.
     */
    private function beautifyHtml(string $html): string
    {
        // Remove extra whitespace and newlines
        $html = preg_replace('/\s+/', ' ', $html);
        $html = trim($html);

        // Tags that should have newlines
        $blockTags = [
            'html', 'head', 'body', 'div', 'section', 'article', 'header', 'footer',
            'nav', 'main', 'aside', 'form', 'table', 'thead', 'tbody', 'tr',
            'ul', 'ol', 'li', 'dl', 'dt', 'dd', 'script', 'style', 'title'
        ];

        // Add newlines around block tags
        foreach ($blockTags as $tag) {
            $html = preg_replace('/<' . $tag . '([^>]*)>/i', "\n<{$tag}$1>", $html);
            $html = preg_replace('/<\/' . $tag . '>/i', "</{$tag}>\n", $html);
        }

        // Split by newlines for indentation
        $lines = explode("\n", $html);
        $formatted = [];
        $indent = 0;
        $indentString = '  '; // 2 spaces

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            // Decrease indent for closing tags
            if (preg_match('/^<\//', $line)) {
                $indent = max(0, $indent - 1);
            }

            // Add indented line
            $formatted[] = str_repeat($indentString, $indent) . $line;

            // Increase indent for opening tags (but not self-closing)
            if (preg_match('/^<[^!\/][^>]*[^\/]>/', $line)) {
                $indent++;
            }

            // Special case: check for closing tag on same line
            if (preg_match('/<[^>]+>.*<\/[^>]+>/', $line)) {
                $indent = max(0, $indent - 1);
            }
        }

        return implode("\n", $formatted);
    }
    /**
     * Normalize content for comparison.
     */
    private function normalizeContent(string $content): string
    {
        $normalized = html_entity_decode($content, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $normalized = preg_replace("/\r\n?/", "\n", trim($normalized));
        
        return $normalized;
    }

    /**
     * Validate if the provided order matches the correct order.
     */
    public function validateOrder(array $order): array
    {
        if (empty($order)) {
            return [
                'success' => false,
                'message' => 'Payload urutan tidak valid.',
                'html' => '',
            ];
        }

        // Normalize user input
        $normalizedOrder = array_map(
            fn($content) => $this->normalizeContent($content),
            $order
        );

        // Get correct order from database
        $correctOrder = $this->getCorrectOrder();

        // Validate
        $isValid = $this->compareOrders($normalizedOrder, $correctOrder);

        // Combine current order HTML (beautified)
        $combinedHtml = implode('', $order);
        $beautifiedHtml = $this->beautifyHtml($combinedHtml);

        if ($isValid) {
            return [
                'success' => true,
                'message' => '🎉 Selamat! Urutan sudah benar dan sesuai!',
                'html' => $beautifiedHtml,
                'html_raw' => $combinedHtml,
            ];
        }

        return [
            'success' => false,
            'message' => '❌ Susunan belum sesuai. Silakan coba lagi.',
            'html' => $beautifiedHtml,
            'html_raw' => $combinedHtml,
        ];
    }

    /**
     * Get the correct order from database.
     */
    private function getCorrectOrder(): array
    {
        return Snippet::ordered()
            ->pluck('content')
            ->map(fn($content) => $this->normalizeContent($content))
            ->toArray();
    }

    /**
     * Compare two orders.
     */
    private function compareOrders(array $order1, array $order2): bool
    {
        if (count($order1) !== count($order2)) {
            return false;
        }

        return !array_diff_assoc($order1, $order2);
    }

    /**
     * Get combined HTML from correct order.
     */
    private function getCombinedHtml(): string
    {
        return Snippet::getCombinedHtml();
    }
}

