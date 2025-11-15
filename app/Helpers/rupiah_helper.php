<?php

if (!function_exists('format_rupiah')) {
    /**
     * Format number to Indonesian Rupiah
     * @param float|int $angka
     * @param bool $with_symbol Default: true (Rp)
     * @return string
     */
    function format_rupiah($angka, bool $with_symbol = true): string
    {
        $result = number_format($angka, 0, ',', '.');

        return $with_symbol ? 'Rp ' . $result : $result;
    }
}

if (!function_exists('unformat_rupiah')) {
    /**
     * Remove all non-digit from Rupiah string (e.g., "Rp 1.250.000" → 1250000)
     * @param string $rupiah
     * @return float
     */
    function unformat_rupiah(string $rupiah): float
    {
        return (float) preg_replace('/\D/', '', $rupiah);
    }
}
