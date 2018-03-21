<?php
 namespace FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
WOFF; use FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
Table<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
DirectoryEntry; class File extends <br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
FontLib<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
TrueType<br />
<b>Warning</b>:  Unexpected character in input:  '\' (ASCII=92) state=1 in <b>E:\WORK!\_www\htdocs\minimize_php\index.php</b> on line <b>32</b><br />
File { function parseHeader() { if (!empty($this->header)) { return; } $this->header = new Header($this); $this->header->parse(); } public function load($file) { parent::load($file); $this->parseTableEntries(); $dataOffset = $this->pos() + count($this->directory) * 20; $fw = $this->getTempFile(false); $fr = $this->f; $this->f = $fw; $offset = $this->header->encode(); foreach ($this->directory as $entry) { $this->f = $fr; $this->seek($entry->offset); $data = $this->read($entry->length); if ($entry->length < $entry->origLength) { $data = gzuncompress($data); } $length = strlen($data); $entry->length = $entry->origLength = $length; $entry->offset = $dataOffset; $this->f = $fw; $this->seek($offset); $offset += $this->write($entry->tag, 4); $offset += $this->writeUInt32($dataOffset); $offset += $this->writeUInt32($length); $offset += $this->writeUInt32($length); $offset += $this->writeUInt32(DirectoryEntry::computeChecksum($data)); $this->seek($dataOffset); $dataOffset += $this->write($data, $length); } $this->f = $fw; $this->seek(0); $this->header = null; $this->directory = array(); $this->parseTableEntries(); } } 