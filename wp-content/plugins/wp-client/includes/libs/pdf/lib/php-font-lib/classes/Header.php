<?php
 namespace FontLib; use FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
TrueType<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
File; abstract class Header extends BinaryStream { protected $font; protected $def = array(); public $data; public function __construct(File $font) { $this->font = $font; } public function encode() { return $this->font->pack($this->def, $this->data); } public function parse() { $this->data = $this->font->unpack($this->def); } }