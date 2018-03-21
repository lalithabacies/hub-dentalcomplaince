<?php
 namespace FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Table; use FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
TrueType<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
File; use FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Font; use FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
BinaryStream; class Table extends BinaryStream { protected $entry; protected $def = array(); public $data; final public function __construct(DirectoryEntry $entry) { $this->entry = $entry; $entry->setTable($this); } public function getFont() { return $this->entry->getFont(); } protected function _encode() { if (empty($this->data)) { Font::d("  >> Table is empty"); return 0; } return $this->getFont()->pack($this->def, $this->data); } protected function _parse() { $this->data = $this->getFont()->unpack($this->def); } protected function _parseRaw() { $this->data = $this->getFont()->read($this->entry->length); } protected function _encodeRaw() { return $this->getFont()->write($this->data, $this->entry->length); } public function toHTML() { return "<pre>" . var_export($this->data, true) . "</pre>"; } final public function encode() { $this->entry->startWrite(); if (false && empty($this->def)) { $length = $this->_encodeRaw(); } else { $length = $this->_encode(); } $this->entry->endWrite(); return $length; } final public function parse() { $this->entry->startRead(); if (false && empty($this->def)) { $this->_parseRaw(); } else { $this->_parse(); } $this->entry->endRead(); } }