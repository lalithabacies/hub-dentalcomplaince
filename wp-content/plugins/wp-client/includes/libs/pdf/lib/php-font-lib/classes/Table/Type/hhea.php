<?php
 namespace FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Table<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Type; use FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Table<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Table; class hhea extends Table { protected $def = array( "version" => self::Fixed, "ascent" => self::FWord, "descent" => self::FWord, "lineGap" => self::FWord, "advanceWidthMax" => self::uFWord, "minLeftSideBearing" => self::FWord, "minRightSideBearing" => self::FWord, "xMaxExtent" => self::FWord, "caretSlopeRise" => self::int16, "caretSlopeRun" => self::int16, "caretOffset" => self::FWord, self::int16, self::int16, self::int16, self::int16, "metricDataFormat" => self::int16, "numOfLongHorMetrics" => self::uint16, ); function _encode() { $font = $this->getFont(); $this->data["numOfLongHorMetrics"] = count($font->getSubset()); return parent::_encode(); } }