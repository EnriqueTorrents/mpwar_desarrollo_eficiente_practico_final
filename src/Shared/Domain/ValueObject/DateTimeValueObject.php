<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain\ValueObject;

use DateTime;

class DateTimeValueObject
{
    const today = "NOW";
    const dateFormat = 'Y-m-d H:i:s';
    const defaultTime = '00:00:00';

    public function __construct(protected DateTime $value)
    {
    }

    public function value(): DateTime
    {
        return $this->value;
    }

    public static function createDateTimeValueObjectFromString(string $date): DateTimeValueObject
    {
        if (self::checkStringDateHasNoTime($date)) {
            $date .= ' ' . self::defaultTime;
        }

        return new self(DateTime::createFromFormat(self::dateFormat, $date));
    }

    public static function convertDateTimeToString(DateTimeValueObject $date): string
    {
        return $date->value()->format(self::dateFormat);
    }

    public function isPastDate(): bool
    {
        return $this->value < new DateTime(self::today);
    }

    private static function checkStringDateHasNoTime(string $date): bool
    {
        $dateParse = date_parse($date);
        return empty($dateParse['hour']);
    }
}
