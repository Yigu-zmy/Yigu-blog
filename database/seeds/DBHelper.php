<?php
if ($admin=="" or (strlen($admin)>16) or (strlen($admin)<2)) { 
echo "<SCRIPT language=JavaScript>alert('�������û���(���ܴ���16С��2)');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
if ($password=="" or strlen($password)>16 or strlen($password)<6) { 
echo "<SCRIPT language=JavaScript>alert('���볤��Ϊ6-16���ַ�');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
if ($password=="") { 
echo "<SCRIPT language=JavaScript>alert('ȷ�����벻��Ϊ��');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
}else{ 
if ($password!=$password1) { 
echo "<SCRIPT language=JavaScript>alert('�����ȷ�����벻һ��');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
} 
if ($wt="") { 
echo "<SCRIPT language=JavaScript>alert('�������ⲻ��Ϊ��');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
if ($da="") { 
echo "<SCRIPT language=JavaScript>alert('����𰸲���Ϊ��');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 

} 
if ($qq!="") { 
if (!is_numeric($qq)) { 
echo "<SCRIPT language=JavaScript>alert('QQ�������������');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
} 
if ($youbian=="" or strlen($youbian)!=6) { 
echo "<SCRIPT language=JavaScript>alert('����ȷ�����ʱ�');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
if ($youbian!="") { 
if (!is_numeric($youbian)) { 
echo "<SCRIPT language=JavaScript>alert('�ʱ����������');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
} 
if ($dizhi="") { 
echo "<SCRIPT language=JavaScript>alert('סַ����Ϊ��');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
if ($mail=="") { 
echo "<SCRIPT language=JavaScript>alert('E-mail����Ϊ�գ�');"; 
echo "this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
if ($textarea=="") { 
echo "<SCRIPT language=JavaScript>alert('����˵������Ϊ�գ�');"; 
echo "this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
if ($textarea=="" or strlen(textarea)>150) { 
echo "<SCRIPT language=JavaScript>alert('����˵��Ϊ150���ַ�');"; 
echo"this.location.href='vbscript:history.back()';</SCRIPT>"; 
} 
function doZoom(size) 
{document.getElementById('zoom').style.fontSize=size+'px';} 
?>