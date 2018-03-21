<?php
 namespace FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Glyph; use FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Table<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Type<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
glyf; use FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
TrueType<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
File; use FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
BinaryStream; class Outline extends BinaryStream { protected $table; protected $offset; protected $size; public $numberOfContours; public $xMin; public $yMin; public $xMax; public $yMax; public $raw; static function init(glyf $table, $offset, $size) { $font = $table->getFont(); $font->seek($offset); if ($font->readInt16() > -1) { $glyph = new OutlineSimple($table, $offset, $size); } else { $glyph = new OutlineComposite($table, $offset, $size); } $glyph->parse(); return $glyph; } function getFont() { return $this->table->getFont(); } function __construct(glyf $table, $offset = null, $size = null) { $this->table = $table; $this->offset = $offset; $this->size = $size; } function parse() { $font = $this->getFont(); $font->seek($this->offset); if (!$this->size) { return; } $this->raw = $font->read($this->size); } function parseData() { $font = $this->getFont(); $font->seek($this->offset); $this->numberOfContours = $font->readInt16(); $this->xMin = $font->readFWord(); $this->yMin = $font->readFWord(); $this->xMax = $font->readFWord(); $this->yMax = $font->readFWord(); } function encode() { $font = $this->getFont(); return $font->write($this->raw, strlen($this->raw)); } function getSVGContours() { } function getGlyphIDs() { return array(); } } 