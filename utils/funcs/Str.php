<?php

namespace Util\Func;

use Exception;
use Util\Base;

class Str extends Base
{
  /**
   * Escape html string
   * @param string $string Input string
   */
  function escape(string $string)
  {
    try {
      $res = trim(htmlspecialchars($string));
    } catch (Exception $err) {
      return $this->error($err);
    }
    return $res;
  }

  /**
   * Format string (capitalized and hyphens replaced by spaces)
   * @param string $text Input string
   */
  function formatString(string $text)
  {
    try {
      $res = str_replace("-", " ", trim(ucfirst(strtolower($text))));
    } catch (Exception $err) {
      return $this->error($err);
    }
    return $res;
  }

  /**
   * Return the first word of a string
   * @param string $str Input string
   */
  function getSlug(string $str)
  {
    try {
      preg_match("/^\w+/i", trim($str), $slug);
      $res = ucfirst($slug[0]);
    } catch (Exception $err) {
      return $this->error($err);
    }
    return $res;
  }
}