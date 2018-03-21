<?php
 abstract class Smarty_Internal_CompileBase { public $required_attributes = array(); public $optional_attributes = array(); public $shorttag_order = array(); public $option_flags = array('nocache'); public function getAttributes($compiler, $attributes) { $_indexed_attr = array(); foreach ($attributes as $key => $mixed) { if (!is_array($mixed)) { if (in_array(trim($mixed, '\'"'), $this->option_flags)) { $_indexed_attr[trim($mixed, '\'"')] = true; } else if (isset($this->shorttag_order[$key])) { $_indexed_attr[$this->shorttag_order[$key]] = $mixed; } else { $compiler->trigger_template_error('too many shorthand attributes', $compiler->lex->taglineno); } } else { $kv = each($mixed); if (in_array($kv['key'], $this->option_flags)) { if (is_bool($kv['value'])) { $_indexed_attr[$kv['key']] = $kv['value']; } else if (is_string($kv['value']) && in_array(trim($kv['value'], '\'"'), array('true', 'false'))) { if (trim($kv['value']) == 'true') { $_indexed_attr[$kv['key']] = true; } else { $_indexed_attr[$kv['key']] = false; } } else if (is_numeric($kv['value']) && in_array($kv['value'], array(0, 1))) { if ($kv['value'] == 1) { $_indexed_attr[$kv['key']] = true; } else { $_indexed_attr[$kv['key']] = false; } } else { $compiler->trigger_template_error("illegal value of option flag \"{$kv['key']}\"", $compiler->lex->taglineno); } } else { reset($mixed); $_indexed_attr[key($mixed)] = $mixed[key($mixed)]; } } } foreach ($this->required_attributes as $attr) { if (!array_key_exists($attr, $_indexed_attr)) { $compiler->trigger_template_error("missing \"" . $attr . "\" attribute", $compiler->lex->taglineno); } } if ($this->optional_attributes != array('_any')) { $tmp_array = array_merge($this->required_attributes, $this->optional_attributes, $this->option_flags); foreach ($_indexed_attr as $key => $dummy) { if (!in_array($key, $tmp_array) && $key !== 0) { $compiler->trigger_template_error("unexpected \"" . $key . "\" attribute", $compiler->lex->taglineno); } } } foreach ($this->option_flags as $flag) { if (!isset($_indexed_attr[$flag])) { $_indexed_attr[$flag] = false; } } return $_indexed_attr; } public function openTag($compiler, $openTag, $data = null) { array_push($compiler->_tag_stack, array($openTag, $data)); } public function closeTag($compiler, $expectedTag) { if (count($compiler->_tag_stack) > 0) { list($_openTag, $_data) = array_pop($compiler->_tag_stack); if (in_array($_openTag, (array) $expectedTag)) { if (is_null($_data)) { return $_openTag; } else { return $_data; } } $compiler->trigger_template_error("unclosed {" . $_openTag . "} tag"); return; } $compiler->trigger_template_error("unexpected closing tag", $compiler->lex->taglineno); return; } } ?>