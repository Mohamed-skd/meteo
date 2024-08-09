<?php

namespace Util\Func;

use DateTime;
use DateTimeZone;
use Exception;
use Util\Base;

class Date extends Base
{
  /**
   * Format Date
   * @param string $date Input date
   * @param string $format Input format (default:"d/m/Y H:i:s")
   * @param string $timezone Timezone (default:"Europe/Paris") 
   */
  function formatDate(
    string $date = "now",
    string $format = "d/m/Y",
    string $timezone = "Europe/Paris"
  ) {
    try {
      $dateTime = new DateTime($date);
      $dateTime->setTimezone(new DateTimeZone($timezone));
      $formated = $dateTime->format($format);
    } catch (Exception $err) {
      return $this->error($err);
    }
    return $formated;
  }
}