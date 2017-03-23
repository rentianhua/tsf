<?php

namespace Api\Controller;

use Common\Controller\ShuipFCMS;

class IndexController extends ShuipFCMS {

    public function token() {
        $token = \Libs\Util\Encrypt::authcode($_POST['token'], 'DECODE', C('CLOUD_USERNAME'));
        if (!empty($token)) {
            S($this->Cloud->getTokenKey(), $token, 3600);
            $this->success('验证通过');
            exit;
        }
        $this->error('验证失败');
    }
	
	//生成添加代码
	public function data_add(){
		
		
		
		echo '<div style="width:1000px;word-break:break-all;margin:0 auto;">';echo "<br>";
		echo "注意：生成此代码，表中至少有一行数据";echo "<br>";echo "<br>";
		
		$tablename = $_GET['table'];
		$rst = M($tablename)->find();
		$sql = "SHOW FULL COLUMNS FROM tsf_".$tablename;
		$rst  = M()->query($sql);
		$counts = count($rst)-1;
		echo "<br><br>";
		echo "JSON数据格式：";echo "<br>";echo "<br>";
		echo "{";echo "<br>";
		foreach($rst as $k => $v){
			if($v['field'] != 'id'){
				echo '&nbsp;&nbsp;&nbsp;&nbsp;"'.$v["field"].'":"'.$v["comment"].'"';
				if($counts != $k){
				echo ',';echo "<br>";
					}
				
				}			
			}
		echo "<br>";	
		echo "}";
		echo "<br><br>";
		echo "public function ".$tablename."_add(){";echo "<br>";
		echo "&nbsp;&nbsp;if(IS_POST){";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$db = M('".$tablename."');";echo "<br>";
		foreach($rst as $k => $v){
			if($v != 'id'){
				echo "&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;\$data['".$v['field']."'] = \$_POST['".$v['field']."'];&nbsp;&nbsp;&nbsp;&nbsp;//".$v['comment'];echo "<br>";
				}			
			}
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//开始添加数据";	echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$rst = \$db -> add(\$data);";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(\$rst){";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$this->success(\"添加成功\",\"跳转的地址\");";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;}else{"	;echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$this->display();";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;}";echo "<br>";
		echo "&nbsp;&nbsp;}";echo "<br>";echo "<br>";
		
		
		
		
		//生成编辑代码
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//开始编辑数据";	echo "<br>";
		echo "public function ".$tablename."_edit(){";echo "<br>";
		echo "&nbsp;&nbsp;if(IS_POST){";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$u['id'] = \$_POST['id'];";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$db = M('".$tablename."');";echo "<br>";
		foreach($rst as $k => $v){
			if($v[''] != 'id'){
				echo "&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;\$data['".$v['field']."'] = \$_POST['".$v['field']."'];&nbsp;&nbsp;&nbsp;&nbsp;//".$v['comment'];echo "<br>";
				}			
			}
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//开始保存数据";	echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$rst = \$db -> where(\$u) -> save(\$data);";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(\$rst){";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$this->success(\"保存成功\",\"跳转的地址\");";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;}else{"; echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$id = \$_GET['id'];";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$info = \$db -> where('id='.\$id) -> find();";echo "<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$this->assign('info',\$info);";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$this->display();";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;}";echo "<br>";
		echo "&nbsp;&nbsp;}";
		echo "<br>";echo "<br>";
		
		//生成删除代码
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//删除数据";	echo "<br>";
		echo "public function ".$tablename."_del(){";echo "<br>";
		echo "&nbsp;&nbsp;if(IS_GET){";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$u['id'] = \$_GET['id'];";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$db = M('".$tablename."');";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//开始保存数据";	echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$rst = \$db -> where(\$u) -> delete();";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(\$rst){";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$this->success(\"删除成功\",\"跳转的地址\");";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}";echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;}";echo "<br>";
		echo "&nbsp;&nbsp;}";
		echo "<br>";echo "<br>";
		echo "</div>";
		}

}
