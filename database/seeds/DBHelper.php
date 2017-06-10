<?php
if ($admin=="" or (strlen($admin)>16) or (strlen($admin)<2)) { 
echo "<SCRIPT language=JavaScript>alert('请输入用户名(不能大于16小于2)');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
if ($password=="" or strlen($password)>16 or strlen($password)<6) { 
echo "<SCRIPT language=JavaScript>alert('密码长度为6-16个字符');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
if ($password=="") { 
echo "<SCRIPT language=JavaScript>alert('确认密码不能为空');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
}else{ 
if ($password!=$password1) { 
echo "<SCRIPT language=JavaScript>alert('密码和确认密码不一致');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
} 
if ($wt="") { 
echo "<SCRIPT language=JavaScript>alert('密码问题不能为空');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
if ($da="") { 
echo "<SCRIPT language=JavaScript>alert('问题答案不能为空');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 

} 
if ($qq!="") { 
if (!is_numeric($qq)) { 
echo "<SCRIPT language=JavaScript>alert('QQ号码必须是数字');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
} 
if ($youbian=="" or strlen($youbian)!=6) { 
echo "<SCRIPT language=JavaScript>alert('请正确输入邮编');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
if ($youbian!="") { 
if (!is_numeric($youbian)) { 
echo "<SCRIPT language=JavaScript>alert('邮编必须是数字');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
} 
if ($dizhi="") { 
echo "<SCRIPT language=JavaScript>alert('住址不能为空');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
if ($mail=="") { 
echo "<SCRIPT language=JavaScript>alert('E-mail不能为空！');"; 
echo "this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
if ($textarea=="") { 
echo "<SCRIPT language=JavaScript>alert('个人说明不能为空！');"; 
echo "this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
if ($textarea=="" or strlen(textarea)>150) { 
echo "<SCRIPT language=JavaScript>alert('个人说明为150个字符');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
function doZoom(size) 
{document.getElementById('zoom').style.fontSize=size+'px';} 
?>