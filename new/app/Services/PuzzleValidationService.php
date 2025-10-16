<?php

namespace App\Services;

use App\Models\Snippet;

class PuzzleValidationService
{
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

        // Always return combined HTML from user's order (regardless of correct or not)
        $combinedHtml = $this->getCombinedHtmlFromOrder($order);

        if ($isValid) {
            return [
                'success' => true,
                'message' => 'Selamat! Urutan sudah sesuai.',
                'html' => $combinedHtml,
            ];
        }

        return [
            'success' => false,
            'message' => 'Urutan belum sesuai. Silakan coba lagi.',
            'html' => $combinedHtml,
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

    /**
     * Get combined HTML from user's provided order (for preview).
     */
    private function getCombinedHtmlFromOrder(array $order): string
    {
        // Simply join all content from the provided order
        return implode("\n", array_filter($order));
    }
}

