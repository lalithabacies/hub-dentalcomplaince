<?php
 namespace FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Table<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Type; use FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Table<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Table; class maxp extends Table { protected $def = array( "version" => self::Fixed, "numGlyphs" => self::uint16, "maxPoints" => self::uint16, "maxContours" => self::uint16, "maxComponentPoints" => self::uint16, "maxComponentContours" => self::uint16, "maxZones" => self::uint16, "maxTwilightPoints" => self::uint16, "maxStorage" => self::uint16, "maxFunctionDefs" => self::uint16, "maxInstructionDefs" => self::uint16, "maxStackElements" => self::uint16, "maxSizeOfInstructions" => self::uint16, "maxComponentElements" => self::uint16, "maxComponentDepth" => self::uint16, ); function _encode() { $font = $this->getFont(); $this->data["numGlyphs"] = count($font->getSubset()); return parent::_encode(); } }