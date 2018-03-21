<?php
namespace FontLib;

use FontLib\Exception\FontNotFoundException;

class Font {
 static $debug = false;


 public static function load($file) {
  if(!file_exists($file)){
   throw new FontNotFoundException($file);
  }

  $header = file_get_contents($file, false, null, null, 4);
  $class  = null;

  switch ($header) {
   case "\x00\x01\x00\x00":
   case "true":
   case "typ1":
    $class = "TrueType\\File";
    break;

   case "OTTO":
    $class = "OpenType\\File";
    break;

   case "wOFF":
    $class = "WOFF\\File";
    break;

   case "ttcf":
    $class = "TrueType\\Collection";
    break;

   default:
    $magicNumber = file_get_contents($file, false, null, 34, 2);

    if ($magicNumber === "LP") {
     $class = "EOT\\File";
    }
  }

  if ($class) {
   $class = "FontLib\\$class";

   $obj = new $class;
   $obj->load($file);

   return $obj;
  }

  return null;
 }

 static function d($str) {
  if (!self::$debug) {
   return;
  }
  echo "$str\n";
 }

 static function UTF16ToUTF8($str) {
  return mb_convert_encoding($str, "utf-8", "utf-16");
 }

 static function UTF8ToUTF16($str) {
  return mb_convert_encoding($str, "utf-16", "utf-8");
 }
}