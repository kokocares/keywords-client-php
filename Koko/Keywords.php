<?php

namespace Koko;

use FFI;
use Exception;

final class Keywords {
    private static $ffi = null;
    function __construct() {
      if (is_null(self::$ffi)) {
        if (array_values(explode(' ',php_uname()))[0] == 'Darwin')
          $lib_suffix = "dylib";
      } else {
        $lib_suffix = "so";
      }
      self::$ffi = FFI::cdef("
        int c_koko_keywords_match(const char *input, const char *filter);
        const char* c_koko_keywords_error_description(int error);

      ", "libkoko_keywords." . $lib_suffix);
    }
    function match($input, $filter) {
      $result = self::$ffi->c_koko_keywords_match($input, $filter);
      if ($result < 0) {
        throw new Exception(self::$ffi->c_koko_keywords_error_description($result));
      }
      return (int) $result == 1;
    }
}
?>
