<?php
declare(strict_types=1);

/**
 * Formate une date MySQL en français.
 *
 * Entrée : 2026-11-05 ou 2026-11-05 14:30:00
 * Sortie : 05 novembre 2026 ou 05 novembre 2026 à 14:30
 */
function formatMysqlDate(
    ?string $date,
    bool $withTime = false
): string {

    if (empty($date) || $date === '0000-00-00') {
        return '';
    }

    try {
        $dateObj = new DateTimeImmutable($date);

        $format = $withTime
            ? 'dd MMMM yyyy \'à\' HH:mm'
            : 'dd MMMM yyyy';

        $formatter = new IntlDateFormatter(
            'fr_CH',
            IntlDateFormatter::NONE,
            IntlDateFormatter::NONE,
            'Europe/Zurich',
            IntlDateFormatter::GREGORIAN,
            $format
        );

        return $formatter->format($dateObj) ?: '';

    } catch (Throwable $e) {
        return '';
    }
}

function majuscules($inChaine)
{
	$inChaine =ltrim($inChaine);
	$inChaine =rtrim($inChaine);
    $inChaine = strtolower($inChaine);
    // index du nom changer
    $tiretIndex = strpos($inChaine, '-');
    // Remplace le minus par un espace 
    $inChaine = str_replace("-"," ",$inChaine);
    // Mets en majuscule ddébut de chaque nom
    $inChaine = ucwords($inChaine);
    if ( $tiretIndex  > 0)
    {
    // Remets le tiret d'union 
    $inChaine = substr_replace($inChaine,"-",$tiretIndex,1);

    }
	return $inChaine;
}
?>