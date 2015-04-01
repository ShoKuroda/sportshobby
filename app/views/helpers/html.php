<?php
class HtmlHelper extends AppHelper {
	var $tags = array(
		'meta' => '<meta%s/>',
		'metalink' => '<link href="%s"%s/>',
		'link' => '<a href="%s"%s>%s</a>',
		'mailto' => '<a href="mailto:%s" %s>%s</a>',
		'form' => '<form %s>',
		'formend' => '</form>',
		'input' => '<input name="%s" %s/>',
		'textarea' => '<textarea name="%s" %s>%s</textarea>',
		'hidden' => '<input type="hidden" name="%s" %s/>',
		'checkbox' => '<input type="checkbox" name="%s" %s/>',
		'checkboxmultiple' => '<input type="checkbox" name="%s[]"%s />',
		'radio' => '<input type="radio" name="%s" id="%s" %s />%s',
		'selectstart' => '<select name="%s"%s>',
		'selectmultiplestart' => '<select name="%s[]"%s>',
		'selectempty' => '<option value=""%s>&nbsp;</option>',
		'selectoption' => '<option value="%s"%s>%s</option>',
		'selectend' => '</select>',
		'optiongroup' => '<optgroup label="%s"%s>',
		'optiongroupend' => '</optgroup>',
		'checkboxmultiplestart' => '',
		'checkboxmultipleend' => '',
		'password' => '<input type="password" name="%s" %s/>',
		'file' => '<input type="file" name="%s" %s/>',
		'file_no_model' => '<input type="file" name="%s" %s/>',
		'submit' => '<input %s/>',
		'submitimage' => '<input type="image" src="%s" %s/>',
		'button' => '<button type="%s"%s>%s</button>',
		'image' => '<img src="%s" %s/>',
		'tableheader' => '<th%s>%s</th>',
		'tableheaderrow' => '<tr%s>%s</tr>',
		'tablecell' => '<td%s>%s</td>',
		'tablerow' => '<tr%s>%s</tr>',
		'block' => '<div%s>%s</div>',
		'blockstart' => '<div%s>',
		'blockend' => '</div>',
		'tag' => '<%s%s>%s</%s>',
		'tagstart' => '<%s%s>',
		'tagend' => '</%s>',
		'para' => '<p%s>%s</p>',
		'parastart' => '<p%s>',
		'label' => '<label for="%s"%s>%s</label>',
		'fieldset' => '<fieldset%s>%s</fieldset>',
		'fieldsetstart' => '<fieldset><legend>%s</legend>',
		'fieldsetend' => '</fieldset>',
		'legend' => '<legend>%s</legend>',
		'css' => '<link rel="%s" type="text/css" href="%s" %s/>',
		'style' => '<style type="text/css"%s>%s</style>',
		'charset' => '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />',
		'ul' => '<ul%s>%s</ul>',
		'ol' => '<ol%s>%s</ol>',
		'li' => '<li%s>%s</li>',
		'error' => '<div%s>%s</div>',
		'javascriptblock' => '<script type="text/javascript"%s>%s</script>',
		'javascriptstart' => '<script type="text/javascript">',
		'javascriptlink' => '<script type="text/javascript" src="%s"%s></script>',
		'javascriptend' => '</script>'
	);
	var $_crumbs = array();
	var $__includedScripts = array();
	var $_scriptBlockOptions = array();
	var $__docTypes = array(
		'html4-strict'  => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',
		'html4-trans'  => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
		'html4-frame'  => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">',
		'xhtml-strict' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
		'xhtml-trans' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
		'xhtml-frame' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
		'xhtml11' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'
	);
	function addCrumb($name, $link = null, $options = null) {
		$this->_crumbs[] = array($name, $link, $options);
	}
	function docType($type = 'xhtml-strict') {
		if (isset($this->__docTypes[$type])) {
			return $this->__docTypes[$type];
		}
		return null;
	}
	function meta($type, $url = null, $options = array()) {
		$inline = isset($options['inline']) ? $options['inline'] : true;
		unset($options['inline']);

		if (!is_array($type)) {
			$types = array(
				'rss'	=> array('type' => 'application/rss+xml', 'rel' => 'alternate', 'title' => $type, 'link' => $url),
				'atom'	=> array('type' => 'application/atom+xml', 'title' => $type, 'link' => $url),
				'icon'	=> array('type' => 'image/x-icon', 'rel' => 'icon', 'link' => $url),
				'keywords' => array('name' => 'keywords', 'content' => $url),
				'description' => array('name' => 'description', 'content' => $url),
			);

			if ($type === 'icon' && $url === null) {
				$types['icon']['link'] = $this->webroot('favicon.ico');
			}

			if (isset($types[$type])) {
				$type = $types[$type];
			} elseif (!isset($options['type']) && $url !== null) {
				if (is_array($url) && isset($url['ext'])) {
					$type = $types[$url['ext']];
				} else {
					$type = $types['rss'];
				}
			} elseif (isset($options['type']) && isset($types[$options['type']])) {
				$type = $types[$options['type']];
				unset($options['type']);
			} else {
				$type = array();
			}
		} elseif ($url !== null) {
			$inline = $url;
		}
		$options = array_merge($type, $options);
		$out = null;

		if (isset($options['link'])) {
			if (isset($options['rel']) && $options['rel'] === 'icon') {
				$out = sprintf($this->tags['metalink'], $options['link'], $this->_parseAttributes($options, array('link'), ' ', ' '));
				$options['rel'] = 'shortcut icon';
			} else {
				$options['link'] = $this->url($options['link'], true);
			}
			$out .= sprintf($this->tags['metalink'], $options['link'], $this->_parseAttributes($options, array('link'), ' ', ' '));
		} else {
			$out = sprintf($this->tags['meta'], $this->_parseAttributes($options, array('type'), ' ', ' '));
		}

		if ($inline) {
			return $out;
		} else {
			$view =& ClassRegistry::getObject('view');
			$view->addScript($out);
		}
	}
	function charset($charset = null) {
		if (empty($charset)) {
			$charset = strtolower(Configure::read('App.encoding'));
		}
		return sprintf($this->tags['charset'], (!empty($charset) ? $charset : 'utf-8'));
	}

	function link($title, $url = null, $options = array(), $confirmMessage = false) {
		$escapeTitle = true;
		if ($url !== null) {
			$url = $this->url($url);
		} else {
			$url = $this->url($title);
			$title = $url;
			$escapeTitle = false;
		}

		if (isset($options['escape'])) {
			$escapeTitle = $options['escape'];
		}

		if ($escapeTitle === true) {
			$title = h($title);
		} elseif (is_string($escapeTitle)) {
			$title = htmlentities($title, ENT_QUOTES, $escapeTitle);
		}

		if (!empty($options['confirm'])) {
			$confirmMessage = $options['confirm'];
			unset($options['confirm']);
		}
		if ($confirmMessage) {
			$confirmMessage = str_replace("'", "\'", $confirmMessage);
			$confirmMessage = str_replace('"', '\"', $confirmMessage);
			$options['onclick'] = "return confirm('{$confirmMessage}');";
		} elseif (isset($options['default']) && $options['default'] == false) {
			if (isset($options['onclick'])) {
				$options['onclick'] .= ' event.returnValue = false; return false;';
			} else {
				$options['onclick'] = 'event.returnValue = false; return false;';
			}
			unset($options['default']);
		}
		return sprintf($this->tags['link'], $url, $this->_parseAttributes($options), $title);
	}

	function css($path, $rel = null, $options = array()) {
		$options += array('inline' => true);
		if (is_array($path)) {
			$out = '';
			foreach ($path as $i) {
				$out .= "\n\t" . $this->css($i, $rel, $options);
			}
			if ($options['inline'])  {
				return $out . "\n";
			}
			return;
		}

		if (strpos($path, '://') !== false) {
			$url = $path;
		} else {
			if ($path[0] !== '/') {
				$path = CSS_URL . $path;
			}

			if (strpos($path, '?') === false) {
				if (substr($path, -4) !== '.css') {
					$path .= '.css';
				}
			}
			$url = $this->assetTimestamp($this->webroot($path));

			if (Configure::read('Asset.filter.css')) {
				$pos = strpos($url, CSS_URL);
				if ($pos !== false) {
					$url = substr($url, 0, $pos) . 'ccss/' . substr($url, $pos + strlen(CSS_URL));
				}
			}
		}

		if ($rel == 'import') {
			$out = sprintf($this->tags['style'], $this->_parseAttributes($options, array('inline'), '', ' '), '@import url(' . $url . ');');
		} else {
			if ($rel == null) {
				$rel = 'stylesheet';
			}
			$out = sprintf($this->tags['css'], $rel, $url, $this->_parseAttributes($options, array('inline'), '', ' '));
		}

		if ($options['inline']) {
			return $out;
		} else {
			$view =& ClassRegistry::getObject('view');
			$view->addScript($out);
		}
	}

	function script($url, $options = array()) {
		if (is_bool($options)) {
			list($inline, $options) = array($options, array());
			$options['inline'] = $inline;
		}
		$options = array_merge(array('inline' => true, 'once' => true), $options);
		if (is_array($url)) {
			$out = '';
			foreach ($url as $i) {
				$out .= "\n\t" . $this->script($i, $options);
			}
			if ($options['inline'])  {
				return $out . "\n";
			}
			return null;
		}
		if ($options['once'] && isset($this->__includedScripts[$url])) {
			return null;
		}
		$this->__includedScripts[$url] = true;

		if (strpos($url, '://') === false) {
			if ($url[0] !== '/') {
				$url = JS_URL . $url;
			}
			if (strpos($url, '?') === false && substr($url, -3) !== '.js') {
				$url .= '.js';
			}
			$url = $this->assetTimestamp($this->webroot($url));

			if (Configure::read('Asset.filter.js')) {
				$url = str_replace(JS_URL, 'cjs/', $url);
			}
		}
		$attributes = $this->_parseAttributes($options, array('inline', 'once'), ' ');
		$out = sprintf($this->tags['javascriptlink'], $url, $attributes);

		if ($options['inline']) {
			return $out;
		} else {
			$view =& ClassRegistry::getObject('view');
			$view->addScript($out);
		}
	}

	function scriptBlock($script, $options = array()) {
		$options += array('safe' => true, 'inline' => true);
		if ($options['safe']) {
			$script  = "\n" . '//<![CDATA[' . "\n" . $script . "\n" . '//]]>' . "\n";
		}
		$inline = $options['inline'];
		unset($options['inline'], $options['safe']);
		$attributes = $this->_parseAttributes($options, ' ', ' ');
		if ($inline) {
			return sprintf($this->tags['javascriptblock'], $attributes, $script);
		} else {
			$view =& ClassRegistry::getObject('view');
			$view->addScript(sprintf($this->tags['javascriptblock'], $attributes, $script));
			return null;
		}
	}

	function scriptStart($options = array()) {
		$options += array('safe' => true, 'inline' => true);
		$this->_scriptBlockOptions = $options;
		ob_start();
		return null;
	}

	function scriptEnd() {
		$buffer = ob_get_clean();
		$options = $this->_scriptBlockOptions;
		$this->_scriptBlockOptions = array();
		return $this->scriptBlock($buffer, $options);
	}

	function style($data, $oneline = true) {
		if (!is_array($data)) {
			return $data;
		}
		$out = array();
		foreach ($data as $key=> $value) {
			$out[] = $key.':'.$value.';';
		}
		if ($oneline) {
			return join(' ', $out);
		}
		return implode("\n", $out);
	}

	function getCrumbs($separator = '&raquo;', $startText = false) {
		if (!empty($this->_crumbs)) {
			$out = array();
			if ($startText) {
				$out[] = $this->link($startText, '/');
			}

			foreach ($this->_crumbs as $crumb) {
				if (!empty($crumb[1])) {
					$out[] = $this->link($crumb[0], $crumb[1], $crumb[2]);
				} else {
					$out[] = $crumb[0];
				}
			}
			return join($separator, $out);
		} else {
			return null;
		}
	}

	function image($path, $options = array()) {
		if (is_array($path)) {
			$path = $this->url($path);
		} elseif (strpos($path, '://') === false) {
			if ($path[0] !== '/') {
				$path = IMAGES_URL . $path;
			}
			$path = $this->assetTimestamp($this->webroot($path));
		}

		if (!isset($options['alt'])) {
			$options['alt'] = '';
		}

		$url = false;
		if (!empty($options['url'])) {
			$url = $options['url'];
			unset($options['url']);
		}

		$image = sprintf($this->tags['image'], $path, $this->_parseAttributes($options, null, '', ' '));

		if ($url) {
			return sprintf($this->tags['link'], $this->url($url), null, $image);
		}
		return $image;
	}

	function tableHeaders($names, $trOptions = null, $thOptions = null) {
		$out = array();
		foreach ($names as $arg) {
			$out[] = sprintf($this->tags['tableheader'], $this->_parseAttributes($thOptions), $arg);
		}
		return sprintf($this->tags['tablerow'], $this->_parseAttributes($trOptions), join(' ', $out));
	}

	function tableCells($data, $oddTrOptions = null, $evenTrOptions = null, $useCount = false, $continueOddEven = true) {
		if (empty($data[0]) || !is_array($data[0])) {
			$data = array($data);
		}

		if ($oddTrOptions === true) {
			$useCount = true;
			$oddTrOptions = null;
		}

		if ($evenTrOptions === false) {
			$continueOddEven = false;
			$evenTrOptions = null;
		}

		if ($continueOddEven) {
			static $count = 0;
		} else {
			$count = 0;
		}

		foreach ($data as $line) {
			$count++;
			$cellsOut = array();
			$i = 0;
			foreach ($line as $cell) {
				$cellOptions = array();

				if (is_array($cell)) {
					$cellOptions = $cell[1];
					$cell = $cell[0];
				} elseif ($useCount) {
					$cellOptions['class'] = 'column-' . ++$i;
				}
				$cellsOut[] = sprintf($this->tags['tablecell'], $this->_parseAttributes($cellOptions), $cell);
			}
			$options = $this->_parseAttributes($count % 2 ? $oddTrOptions : $evenTrOptions);
			$out[] = sprintf($this->tags['tablerow'], $options, implode(' ', $cellsOut));
		}
		return implode("\n", $out);
	}

	function tag($name, $text = null, $options = array()) {
		if (is_array($options) && isset($options['escape']) && $options['escape']) {
			$text = h($text);
			unset($options['escape']);
		}
		if (!is_array($options)) {
			$options = array('class' => $options);
		}
		if ($text === null) {
			$tag = 'tagstart';
		} else {
			$tag = 'tag';
		}
		return sprintf($this->tags[$tag], $name, $this->_parseAttributes($options, null, ' ', ''), $text, $name);
	}

	function div($class = null, $text = null, $options = array()) {
		if (!empty($class)) {
			$options['class'] = $class;
		}
		return $this->tag('div', $text, $options);
	}

	function para($class, $text, $options = array()) {
		if (isset($options['escape'])) {
			$text = h($text);
		}
		if ($class != null && !empty($class)) {
			$options['class'] = $class;
		}
		if ($text === null) {
			$tag = 'parastart';
		} else {
			$tag = 'para';
		}
		return sprintf($this->tags[$tag], $this->_parseAttributes($options, null, ' ', ''), $text);
	}
	function nestedList($list, $options = array(), $itemOptions = array(), $tag = 'ul') {
		if (is_string($options)) {
			$tag = $options;
			$options = array();
		}
		$items = $this->__nestedListItem($list, $options, $itemOptions, $tag);
		return sprintf($this->tags[$tag], $this->_parseAttributes($options, null, ' ', ''), $items);
	}

	function __nestedListItem($items, $options, $itemOptions, $tag) {
		$out = '';

		$index = 1;
		foreach ($items as $key => $item) {
			if (is_array($item)) {
				$item = $key . $this->nestedList($item, $options, $itemOptions, $tag);
			}
			if (isset($itemOptions['even']) && $index % 2 == 0) {
				$itemOptions['class'] = $itemOptions['even'];
			} else if (isset($itemOptions['odd']) && $index % 2 != 0) {
				$itemOptions['class'] = $itemOptions['odd'];
			}
			$out .= sprintf($this->tags['li'], $this->_parseAttributes($itemOptions, array('even', 'odd'), ' ', ''), $item);
			$index++;
		}
		return $out;
	}
	
	//dateを変換する	
	function dateFormat($date,$format = "Y年m月d日") {
		return date($format,strtotime($date));
	}
	function df($date,$format = "Y年m月d日") {
		return $this->dateFormat($date,$format);
	}
	
	function df2($date,$format = "m/d") {
		return $this->dateFormat($date,$format);
	}
	//楽天の画像をsplitしてn番を表示させる
	function img_split($v,$n=null){
		$item_url = split(' ',$v);
		if(isset($item_url[$n])){
			return $item_url[$n];
		}else{
			return false;
		}
	}
	//楽天のカテゴリーを[\]でスプリットして最後を表示
	function last_category($v){
		$item_category = explode("\\",$v);
		return array_pop($item_category);
	}
	
	//楽天のカテゴリーを[\]でスプリットして最後を表示
	function last_category_haifun($v){
		$item_category = explode("-",$v);
		return array_pop($item_category);
	}
	
	//楽天のカテゴリーの[\]を[-]に変換
	function make_category_link($v, $title){
		if(!$title){
			$link = str_replace("\\","-",$v);
		}else{
			$link = str_replace("-"," > ",$v);
		}
		
		return $link;
	}
		
	//pankuzu
	function item_pankuzu($v){
		//アイテムリスト
		if(strstr($v,"-")){
			$pankuzu_list = explode("-",$v);
			$type = 1;
		//アイテム詳細
		}elseif(strstr($v,"\\")){
			$pankuzu_list = explode("\\",$v);
			$type = 2;
		}else{
			$pankuzu_list = explode("-",$v);
			$type = 1;
		}
		
		$link = "";
		foreach($pankuzu_list as $val){ 
			if($val == $pankuzu_list[0]){
				$link .= $val;
			}else{
				$link .= '-'.$val;
			}
			
			if($type == 1){
				if(end($pankuzu_list) == $val){
					echo "　>　";
					echo $val;
				}else{
					echo "　>　";
					echo '<a href="/';
					echo $link;
					echo '/">';
					echo $val;
					echo '</a>';
				}
			}elseif($type == 2){
				echo "　>　";
				echo '<a href="/';
				echo $link;
				echo '/">';
				echo $val;
				echo '</a>';
			}
        }
	}
	
	//カテゴリーの背景にカラーを適用
	function bg_category($v){
		if(strstr($v,'飛行機')){
			$bg_category = 1;
		}elseif(strstr($v,'ヘリコプター')){
			$bg_category = 2;
		}elseif(strstr($v,'ラジコンカー')){
			$bg_category = 3;
		}elseif(strstr($v,'鉄道模型Ｎゲージ')){
			$bg_category = 4;
		}elseif(strstr($v,'ガン')){
			$bg_category = 5;
		}elseif(strstr($v,'雑貨')){
			$bg_category = 6;
		}else{
			$bg_category = 7;
		}
		return $bg_category;
	}

	function item_name_link($v){
		$all_vowels = array("/", "│", " ", "　", "(", ")", "（", "）", "・", "%", "\"", "#");
		return str_replace($all_vowels, "-", $v);
		
	}
	
	function disp_category($v){
		$obj = ClassRegistry::init('Category');
		$result = $obj->select_category($v);
		
		return $result;
		
	}
	
	function disp_item_list($v){
		$obj = ClassRegistry::init('Item');
		$result = $obj->item_list($v);
		
		return $result;
	
	}
		
}
