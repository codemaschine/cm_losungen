<?php
declare(strict_types = 1);

namespace CODEMASCHINE\CmLosungen\Routing\Aspect;

use CODEMASCHINE\BtvEpg\Utility\ProgramApi;
use TYPO3\CMS\Core\Routing\Aspect\StaticMappableAspectInterface;

/**
 * Mapper for a date with syntax YYYY-MM-DD where '-' is the separator.
 * Leading zeros will be ignored.
 *       aspects:
 *         date:
 *           type: DateRangeMapper
 *           separator: '-'
 */
class DateRangeMapper implements StaticMappableAspectInterface
{
    /**
     * @var array
     */
    protected $settings;

    /**
     * @var string
     */
    protected $separator;
    
    /**
     * @param array $settings
     * @throws \InvalidArgumentException
     */
    public function __construct(array $settings)
    {
        $separator = $settings['separator'] ?? '-';

        if (!is_string($separator)) {
            throw new \InvalidArgumentException('separator must be string', 1537277163);
        }

        $this->settings = $settings;
        $this->separator = $separator;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(string $value): ?string
    {
        return $this->parseValue($value);
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(string $value): ?string
    {
        return $this->parseValue($value);
    }
    
    /**
     * @param string $value
     * @return string|null
     */    
    protected function parseValue(string $value): ?string
    {
        $date_components = explode($this->separator, $value);
        if(count($date_components) != 3)
            return null;
        // Year YYYY
        if($date_components[0] != static::respondWhenInRange($date_components[0], static::buildRange(1900, 2899)))
            return null;
        // Month
        $date_components[1] = ltrim($date_components[1], '0');
        if($date_components[1] != static::respondWhenInRange($date_components[1], static::buildRange(1, 12)))
            return null;
        // Day
        $date_components[2] = ltrim($date_components[2], '0');        
        if($date_components[2] != static::respondWhenInRange($date_components[2], static::buildRange(1, 31)))
            return null;
        return $value;
    }    

    /**
     * @param string $value
     * @return string|null
     */
    static protected function respondWhenInRange(string $value, $range): ?string
    {
        if (in_array($value, $range, true)) {
            return $value;
        }
        return null;
    }

    /**
     * Builds range based on given settings and ensures each item is string.
     * The amount of items is limited to 1000 in order to avoid brute-force
     * scenarios and the risk of cache-flooding.
     *
     * In case that is not enough, creating a custom and more specific mapper
     * is encouraged. Using high values that are not distinct exposes the site
     * to the risk of cache-flooding.
     *
     * @return string[]
     * @throws \LengthException
     */
    static protected function buildRange($start, $end): array
    {
        $range = array_map('strval', range($start, $end));
        if (count($range) > 1000) {
            throw new \LengthException(
                'Range is larger than 1000 items',
                1537696771
            );
        }
        return $range;
    }
}
