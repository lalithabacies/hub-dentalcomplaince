<?php
 namespace FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Table<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Type; use FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Table<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Table; class hmtx extends Table { protected function _parse() { $font = $this->getFont(); $offset = $font->pos(); $numOfLongHorMetrics = $font->getData("hhea", "numOfLongHorMetrics"); $numGlyphs = $font->getData("maxp", "numGlyphs"); $font->seek($offset); $data = array(); for ($gid = 0; $gid < $numOfLongHorMetrics; $gid++) { $advanceWidth = $font->readUInt16(); $leftSideBearing = $font->readUInt16(); $data[$gid] = array($advanceWidth, $leftSideBearing); } if ($numOfLongHorMetrics < $numGlyphs) { $lastWidth = end($data); $data = array_pad($data, $numGlyphs, $lastWidth); } $this->data = $data; } protected function _encode() { $font = $this->getFont(); $subset = $font->getSubset(); $data = $this->data; $length = 0; foreach ($subset as $gid) { $length += $font->writeUInt16($data[$gid][0]); $length += $font->writeUInt16($data[$gid][1]); } return $length; } }