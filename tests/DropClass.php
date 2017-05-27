<?php
class DropClass {


	/**
	 * 描述格式化
	 * @param  $subject
	 */
	public static function clearCutstr($subject, $length = 0, $dot = '...', $charset = 'utf-8') {
		if ($length) {
			return XUtils::cutstr(strip_tags(str_replace(array("\r\n"), '', $subject)), $length, $dot, $charset);
		} else {
			return strip_tags(str_replace(array("\r\n"), '', $subject));
		}
	}

	/**
	 * 检测是否为英文或英文数字的组合
	 *
	 * @return unknown
	 */
	public static function isEnglist($param) {
		if (!eregi("^[A-Z0-9]{1,26}$", $param)) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * 将自动判断网址是否加http://
	 *
	 * @param $http
	 * @return  string
	 */
	public static function convertHttp($url) {
		if ($url == 'http://' || $url == '')
			return '';

		if (substr($url, 0, 7) != 'http://' && substr($url, 0, 8) != 'https://')
			$str = 'http://' . $url;
		else
			$str = $url;
		return $str;
	}

	/*
	  标题样式格式化
	 */

	public static function titleStyle($style) {
		$text = '';
		if ($style['bold'] == 'Y') {
			$text .='font-weight:bold;';
			$serialize['bold'] = 'Y';
		}

		if ($style['underline'] == 'Y') {
			$text .='text-decoration:underline;';
			$serialize['underline'] = 'Y';
		}

		if (!empty($style['color'])) {
			$text .='color:#' . $style['color'] . ';';
			$serialize['color'] = $style['color'];
		}

		return array('text' => $text, 'serialize' => empty($serialize) ? '' : serialize($serialize));
	}

	// 自动转换字符集 支持数组转换
	static public function autoCharset($string, $from = 'gbk', $to = 'utf-8') {
		$from = strtoupper($from) == 'UTF8' ? 'utf-8' : $from;
		$to = strtoupper($to) == 'UTF8' ? 'utf-8' : $to;
		if (strtoupper($from) === strtoupper($to) || empty($string) || (is_scalar($string) && !is_string($string))) {
			//如果编码相同或者非字符串标量则不转换
			return $string;
		}
		if (is_string($string)) {
			if (function_exists('mb_convert_encoding')) {
				return mb_convert_encoding($string, $to, $from);
			} elseif (function_exists('iconv')) {
				return iconv($from, $to, $string);
			} else {
				return $string;
			}
		} elseif (is_array($string)) {
			foreach ($string as $key => $val) {
				$_key = self::autoCharset($key, $from, $to);
				$string[$_key] = self::autoCharset($val, $from, $to);
				if ($key != $_key)
					unset($string[$key]);
			}
			return $string;
		} else {
			return $string;
		}
	}

	/*
	  标题样式恢复
	 */

	public static function titleStyleRestore($serialize, $scope = 'bold') {
		$unserialize = unserialize($serialize);
		if ($unserialize['bold'] == 'Y' && $scope == 'bold')
			return 'Y';
		if ($unserialize['underline'] == 'Y' && $scope == 'underline')
			return 'Y';
		if ($unserialize['color'] && $scope == 'color')
			return $unserialize['color'];
	}

	/**
	 * 列出文件夹列表
	 *
	 * @param $dirname
	 * @return unknown
	 */
	public static function getDir($dirname) {
		$files = array();
		if (is_dir($dirname)) {
			$fileHander = opendir($dirname);
			while (( $file = readdir($fileHander) ) !== false) {
				$filepath = $dirname . '/' . $file;
				if (strcmp($file, '.') == 0 || strcmp($file, '..') == 0 || is_file($filepath)) {
					continue;
				}
				$files[] = self::autoCharset($file, 'GBK', 'UTF8');
			}
			closedir($fileHander);
		} else {
			$files = false;
		}
		return $files;
	}

	/**
	 * 列出文件列表
	 *
	 * @param $dirname
	 * @return unknown
	 */
	public static function getFile($dirname) {
		$files = array();
		if (is_dir($dirname)) {
			$fileHander = opendir($dirname);
			while (( $file = readdir($fileHander) ) !== false) {
				$filepath = $dirname . '/' . $file;

				if (strcmp($file, '.') == 0 || strcmp($file, '..') == 0 || is_dir($filepath)) {
					continue;
				}
				$files[] = self::autoCharset($file, 'GBK', 'UTF8');
				;
			}
			closedir($fileHander);
		} else {
			$files = false;
		}
		return $files;
	}

	/**
	 * [格式化图片列表数据]
	 *
	 * @return [type] [description]
	 */
	public static function imageListSerialize($data) {

		foreach ((array) $data['file'] as $key => $row) {
			if ($row) {
				$var[$key]['fileId'] = $data['fileId'][$key];
				$var[$key]['file'] = $row;
			}
		}
		return array('data' => $var, 'dataSerialize' => empty($var) ? '' : serialize($var));
	}

	/**
	 * 反引用一个引用字符串
	 * @param  $string
	 * @return string
	 */
	static function stripslashes($string) {
		if (is_array($string)) {
			foreach ($string as $key => $val) {
				$string[$key] = self::stripslashes($val);
			}
		} else {
			$string = stripslashes($string);
		}
		return $string;
	}

	/**
	 * 引用字符串
	 * @param  $string
	 * @param  $force
	 * @return string
	 */
	static function addslashes($string, $force = 1) {
		if (is_array($string)) {
			foreach ($string as $key => $val) {
				$string[$key] = self::addslashes($val, $force);
			}
		} else {
			$string = addslashes($string);
		}
		return $string;
	}

	/**
	 * 格式化内容
	 */
	static function formatHtml($content, $options = '') {
		$purifier = new CHtmlPurifier();
		if ($options != false)
			$purifier->options = $options;
		return $purifier->purify($content);
	}

}

?>