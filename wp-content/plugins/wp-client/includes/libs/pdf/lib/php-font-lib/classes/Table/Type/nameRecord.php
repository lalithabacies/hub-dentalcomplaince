<?php
 namespace FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Table<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Type; use FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Font; use FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
BinaryStream; class nameRecord extends BinaryStream { public $platformID; public $platformSpecificID; public $languageID; public $nameID; public $length; public $offset; public $string; public static $format = array( "platformID" => self::uint16, "platformSpecificID" => self::uint16, "languageID" => self::uint16, "nameID" => self::uint16, "length" => self::uint16, "offset" => self::uint16, ); public function map($data) { foreach ($data as $key => $value) { $this->$key = $value; } } public function getUTF8() { return $this->string; } public function getUTF16() { return Font::UTF8ToUTF16($this->string); } function __toString() { return $this->string; } }