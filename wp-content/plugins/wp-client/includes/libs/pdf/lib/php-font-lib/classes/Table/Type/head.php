<?php
 namespace FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Table<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Type; use FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Table<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Table; use Exception; class head extends Table { protected $def = array( "tableVersion" => self::Fixed, "fontRevision" => self::Fixed, "checkSumAdjustment" => self::uint32, "magicNumber" => self::uint32, "flags" => self::uint16, "unitsPerEm" => self::uint16, "created" => self::longDateTime, "modified" => self::longDateTime, "xMin" => self::FWord, "yMin" => self::FWord, "xMax" => self::FWord, "yMax" => self::FWord, "macStyle" => self::uint16, "lowestRecPPEM" => self::uint16, "fontDirectionHint" => self::int16, "indexToLocFormat" => self::int16, "glyphDataFormat" => self::int16, ); protected function _parse() { parent::_parse(); if ($this->data["magicNumber"] != 0x5F0F3CF5) { throw new Exception("Incorrect magic number (" . dechex($this->data["magicNumber"]) . ")"); } } }