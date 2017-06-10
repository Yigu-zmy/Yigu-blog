<?php
class Helper {

	/**
	 * �Ѻ���ʾvar_dump
	 */
	static public function dump($var, $echo = true, $label = null, $strict = true) {
		$label = ( $label === null ) ? '' : rtrim($label) . ' ';
		if (!$strict) {
			if (ini_get('html_errors')) {
				$output = print_r($var, true);
				$output = "<pre>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
			} else {
				$output = $label . print_r($var, true);
			}
		} else {
			ob_start();
			var_dump($var);
			$output = ob_get_clean();
			if (!extension_loaded('xdebug')) {
				$output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
				$output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
			}
		}
		if ($echo) {
			echo $output;
			return null;
		} else
			return $output;
	}

	/**
	 * ��ȡ�ͻ���IP��ַ
	 */
	static public function getClientIP() {
		static $ip = NULL;
		if ($ip !== NULL)
			return $ip;
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$pos = array_search('unknown', $arr);
			if (false !== $pos)
				unset($arr[$pos]);
			$ip = trim($arr[0]);
		} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (isset($_SERVER['REMOTE_ADDR'])) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		// IP��ַ�Ϸ���֤
		$ip = ( false !== ip2long($ip) ) ? $ip : '0.0.0.0';
		return $ip;
	}

	/**
	 * ѭ������Ŀ¼
	 */
	static public function mkdir($dir, $mode = 0777) {
		if (is_dir($dir) || @mkdir($dir, $mode))
			return true;
		if (!mk_dir(dirname($dir), $mode))
			return false;
		return @mkdir($dir, $mode);
	}

	/**
	 * ��ʽ����λ
	 */
	static public function byteFormat($size, $dec = 2) {
		$a = array("B", "KB", "MB", "GB", "TB", "PB");
		$pos = 0;
		while ($size >= 1024) {
			$size /= 1024;
			$pos++;
		}
		return round($size, $dec) . " " . $a[$pos];
	}

	/**
	 * �����򣬵�ѡ��ť �Զ�ѡ��
	 *
	 * @param $string �����ַ�
	 * @param $param  ����
	 * @param $type   ����
	 *            selected checked
	 * @return string
	 */
	static public function selected($string, $param = 1, $type = 'select') {

		if (is_array($param)) {
			$true = in_array($string, $param);
		} elseif ($string == $param) {
			$true = true;
		}
		if ($true)
			$return = $type == 'select' ? 'selected="selected"' : 'checked="checked"';

		echo $return;
	}

	/**
	 * �����Դ���� post get
	 *
	 * @return unknown
	 */
	static public function method() {
		return strtoupper(isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET' );
	}

	/**
	 * ��ʾ��Ϣ
	 */
	static public function message($action = 'success', $content = '', $redirect = 'javascript:history.back(-1);', $timeout = 4) {

		switch ($action) {
			case 'success':
				$titler = '�������';
				$class = 'message_success';
				$images = 'message_success.png';
				break;
			case 'error':
				$titler = '����δ���';
				$class = 'message_error';
				$images = 'message_error.png';
				break;
			case 'errorBack':
				$titler = '����δ���';
				$class = 'message_error';
				$images = 'message_error.png';
				break;
			case 'redirect':
				header("Location:$redirect");
				break;
			case 'script':
				if (empty($redirect)) {
					exit('<script language="javascript">alert("' . $content . '");window.history.back(-1)</script>');
				} else {
					exit('<script language="javascript">alert("' . $content . '");window.location=" ' . $redirect . '   "</script>');
				}
				break;
		}

		// ��Ϣͷ��
		$header = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>������ʾ</title>
<style type="text/css">
body{font:12px/1.7 "\5b8b\4f53",Tahoma;}
html,body,div,p,a,h3{margin:0;padding:0;}
.tips_wrap{ background:#F7FBFE;border:1px solid #DEEDF6;width:780px;padding:50px;margin:50px auto 0;}
.tips_inner{zoom:1;}
.tips_inner:after{visibility:hidden;display:block;font-size:0;content:" ";clear:both;height:0;}
.tips_inner .tips_img{width:80px;float:left;}
.tips_info{float:left;line-height:35px;width:650px}
.tips_info h3{font-weight:bold;color:#1A90C1;font-size:16px;}
.tips_info p{font-size:14px;color:#999;}
.tips_info p.message_error{font-weight:bold;color:#F00;font-size:16px; line-height:22px}
.tips_info p.message_success{font-weight:bold;color:#1a90c1;font-size:16px; line-height:22px}
.tips_info p.return{font-size:12px}
.tips_info .time{color:#f00; font-size:14px; font-weight:bold}
.tips_info p a{color:#1A90C1;text-decoration:none;}
</style>
</head>

<body>';
		// ��Ϣ�ײ�
		$footer = '</body></html>';

		$body = '<script type="text/javascript">
        function delayURL(url) {
        var delay = document.getElementById("time").innerHTML;
        //alert(delay);
        if(delay > 0){
        delay--;
        document.getElementById("time").innerHTML = delay;
    } else {
    window.location.href = url;
    }
    setTimeout("delayURL(\'" + url + "\')", 1000);
    }
    </script><div class="tips_wrap">
    <div class="tips_inner">
        <div class="tips_img">
            <img src="' . Yii::app()->baseUrl . '/static/images/' . $images . '"/>
        </div>
        <div class="tips_info">

            <p class="' . $class . '">' . $content . '</p>
            <p class="return">ϵͳ�Զ���ת��  <span class="time" id="time">' . $timeout . ' </span>  ����������ȴ���<a href="' . $redirect . '">���������ת</a></p>
        </div>
    </div>
</div><script type="text/javascript">
    delayURL("' . $redirect . '");
    </script>';

		exit($header . $body . $footer);
	}
?>