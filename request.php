<?php
header("Content-type:text/html;charset=utf-8");
#require '/php/req.php';
function _encode($arr)
{
  $na = array();
  foreach ( $arr as $k => $value ) {   
    $na[_urlencode($k)] = _urlencode ($value);   
  }
  return addcslashes(urldecode(json_encode($na)),"\r\n");
}
 
function _urlencode($elem)
{
  if(is_array($elem)&&(!(empty($elem)))){
    foreach($elem as $k=>$v){
      $na[_urlencode($k)] = _urlencode($v);
    }
    return $na;
  }
  if(is_array($elem)&&empty($elem)){
	  return $elem;
  }
  return urlencode($elem);
}

$key=$_GET["action"];
//echo $key;
switch ($key){
case "login":
//login message:
//require data structure:
        //var map={
        //    action:"login",
        //    name:$("#Username_Input").val(),
        //    password:$("#Password_Input").val()
        //};
//return data structure:
        //usrinfo={
        //  status:"true",
        //  text:"login successfully",
        //  key: "1234567",
        //  admin: "true"
        //};
$usr = $_GET["name"];
$usrinfo;
	if($usr == "admin"){
		$usrinfo=array(
        'status'=>'true',
        'text'=>'login successfully',
        'key'=> '1234567',
        'admin'=> 'true'
		);
    }else if($usr=="user"){
        $usrinfo=array(
        'status'=>'true',
        'text'=>'login successfully',
        'key'=> '7654321',
        'admin'=> 'false'
		);
    }else if($usr=="黄"){
             $usrinfo=array(
             'status'=>'true',
             'text'=>'login successfully',
             'key'=> '1111111',
             'admin'=> 'false'
     		);
    }
    else{
        $usrinfo=array(
        'status'=>'false',
        'text'=>'no this user or password faile',
        'key'=> '',
        'admin'=> ''
		);
    }
    $jsonencode = json_encode($usrinfo);
	echo $jsonencode; break;

		
case "UserInfo":
// get User Information after login
//require data structure:
        /*var map={
                action:"UserInfo",
                session: session
                };*/
//return data structure:
        /*var user = {
                    id:1234567,
                    name:"admin",
                    admin:true,
                    city: "�Ϻ�"
                }
                var retval={
                                status:retstatus,
                                ret: user
                            };*/
				//echo $key;
	$session = $_GET["session"];
    $user=null;
    if($session == "1234567"){
        $user = array(
			'id'=> '1234567',
			'name'=> 'admin',
            'admin'=> 'true',
            'city'=> ("上海")
		);
    }
    if($session == "7654321"){
        $user = array(
            'id'=>'7654321',
            'name'=>'user',
            'admin'=>'false',
            'city'=>("上海")
        );
    }
    if($session == "1111111"){
            $user = array(
                'id'=>'7654321',
                'name'=>'黄',
                'admin'=>'false',
                'city'=>("上海")
            );
        }
    $retstatus = 'true';
    if($user==null) $retstatus = 'false';
    $retval=array(
		'status'=>$retstatus,
		'ret'=>($user)
	);
    $jsonencode = (_encode($retval));
	echo $jsonencode; 
	break;
case "ProjectPGList":
//Get the Project & Project Group list which will be use in user auth
//require data structure:
        /*var map={
                  action:"ProjectPGList",
                  user:usr.id
              };*/
//return data structure:
        /*var temp = {
          id: (i),
          name: "��Ŀ��"+i
          }
          proj_pg_list.push(temp);
          var retval={
          status:"true",
          ret: proj_pg_list
          };
          */
    $proj_pg_list=array();
	for($i=0;$i<14;$i++){
		$temp = array(
			'id'=>(string)$i,
			'name'=>'项目'.(string)$i
		);
		array_push($proj_pg_list,$temp);
	}
	for($i=0;$i<4;$i++){
		$temp = array(
			'id'=>"x".(string)($i),
			'name'=>"项目组".(string)($i)
		);
		array_push($proj_pg_list,$temp);
	}
	$retval=array(
		'status'=>'true',
		'ret'=>$proj_pg_list
	);
	$jsonencode = _encode($retval);
	echo $jsonencode; break;

case "ProjectList":
//Get the Project list
//require data structure:
        /*var map={
                  action:"ProjectList",
                  user:usr.id
              };*/
//return data structure:
/*          var temp = {
                id: (i),
                name: "��Ŀ��"+i
            }
            projlist.push(temp);
            var retval={
                status:"true",
                ret: projlist
            };*/
	$projlist = array();
	for($i=0;$i<14;$i++){
		$temp = array(
			'id'=> (string)($i),
			'name'=> "项目".(string)$i
		);
		array_push($projlist,$temp);
	}
	$retval=array(
		'status'=>'true',
		'ret'=> $projlist
	);
	$jsonencode = _encode($retval);
	echo $jsonencode; break;

case "UserNew":
// new user
//require data structure:
/*var map={
        action:"UserNew",
                          name: user.name,
                          nickname: user.nickname,
                          password: user.password,
                          mobile: user.mobile,
                          mail: user.mail,
                          type: user.type,
                          memo: user.memo,
                          auth: auth
    };*/
//return data structure:
/*  var retval={
       status:"true",
       msg:""
    };*/
	$auth = array() ;
    if(isset($_GET['auth'])) $auth= $_GET['auth'];
	$retval=array(
		'status'=>'true',
		'msg'=>$auth
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;

case "UserMod":
// modify user
//require data structure:
/*var map={
        action:"UserMod",
        id: user.id,
        name: user.name,
        nickname: user.nickname,
        password: user.password,
        mobile: user.mobile,
        mail: user.mail,
        type: user.type,
        memo: user.memo,
        auth: auth
    };*/
//return data structure:
/*  var retval={
       status:"true",
       msg:""
    };*/
	$retval=array(
		'status'=>'true',
		'msg'=>''
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
case "UserDel":
// modify user
//require data structure:
/*var map={
        action:"UserDel",
        id: id
    };*/
//return data structure:
/*  var retval={
       status:"true",
       msg:""
    };*/
$retval=array(
                'status'=>'true',
                'msg'=>''
            );
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
case "UserTable":
// query user table
//require data structure:
/*var map={
        action:"UserTable",
        startseq: start,
        length:length
    };
 //return data structure:
      /*  var temp = {
                              id: (start+(i+1)),
                              name: "username"+(start+i),
                              nickname: "�û�"+(start+i),
                              mobile: "139139"+(start+i),
                              mail: "139139"+(start+i)+"@cmcc.com",
                              type: type,
                              date: "2016-01-01 12:12:12",
                              memo: "��ע����"+(start+i)
                          }
                          usertable.push(temp);


                          var retval={
                                          status:"true",
                                          start: start,
                                          total: total,
                                          length:query_length,
                                          ret: usertable
                                      };*/
	$total = 94;
    $query_length = (int)($_GET['length']);
    $start = (int)($_GET['startseq']);
    if($query_length> $total-$start){$query_length = $total-$start;}
    $usertable = array();
    for($i=0;$i<$query_length;$i++){
        $type="false";
        if(($i%7)==0) $type= "true";
		$temp = array(
			'id'=>(string)($start+($i+1)),
			'name'=>"username".(string)($start+$i),
			'nickname'=>"用户".(string)($start+$i),
			'mobile'=>"139139".(string)($start+$i),
			'mail'=>"139139".(string)($start+$i)."@cmcc.com",
			'type'=>(string)$type,
			'date'=>"2016-01-01 12:12:12",
			'memo'=>"备注".(string)($start+$i)
		);
		array_push($usertable,$temp);
    }
	$retval=array(
		'status'=>'true',
		'start'=> (string)$start,
		'total'=> (string)$total,
		'length'=>(string)$query_length,
		'ret'=> $usertable
	);
	$jsonencode = _encode($retval);
	echo $jsonencode; break;
case "UserProj":
// query project list belong to one user
//require data structure:
/*      var map={
          action:"UserProj",
          userid: user
      };
 //return data structure:
        var temp = {
                     id: (i+1),
                     name: "��Ŀ��"+i
                 }
                 userproj.push(temp);
                 var retval={
                                 status:"true",
                                 ret: userproj
                             };*/
							 
	$userproj = array();
	for($i=0;$i<4;$i++){
		$temp = array(
			'id'=>(string)($i+1),
			'name'=>"项目".(string)$i
		);
		array_push($userproj,$temp);
	}
	$retval= array(
		'status'=>"true",
		'ret'=>$userproj
	);
	$jsonencode = _encode($retval);
	echo $jsonencode; break;

case "PGTable":
// query project group table
//require data structure:
/*      var map={
        action:"PGTable",
        startseq: start,
        length:length,
        user:usr.id
    };
 //return data structure:
 var temp = {
                     PGCode: (start+(i+1)),
                     PGName:"��Ŀ��"+(start+i),
                     ChargeMan:"�û�"+(start+i),
                     Telephone:"139139"+(start+i),
                     Department:"��λ"+(start+i),
                     Address:"��ַ"+(start+i),
                     Stage:"��ע"+(start+i)
                 };
                 pgtable.push(temp);
                 var retval={
                                 status:"true",
                                 start: start,
                                 total: total,
                                 length:query_length,
                                 ret: pgtable
                             };*/
	$total = 14;
    $query_length = (int)($_GET['length']);
    $start = (int)($_GET['startseq']);
    if($query_length> $total-$start){$query_length = $total-$start;}
	$pgtable = array();
	for($i=0;$i<$query_length;$i++){
		$temp = array(
			'PGCode'=>(string)($start+($i+1)),
			'PGName'=>"项目组".(string)($start+$i),
			'ChargeMan'=>"用户".(string)($start+$i),
			'Telephone'=>"139139".(string)($start+$i),
			'Department'=>"单位".(string)($start+$i),
			'Address'=>"地址".(string)($start+$i),
			'Stage'=>"备注".(string)($start+$i)
		);
		array_push($pgtable,$temp);
	}
	$retval=array(
		'status'=>'true',
		'start'=> (string)$start,
		'total'=> (string)$total,
		'length'=>(string)$query_length,
		'ret'=> $pgtable
	);
	$jsonencode = _encode($retval);
	echo $jsonencode; break;
case "PGNew":
//create a new project group
//require data structure:
/*      var map={
                action:"PGNew",
                PGCode: pg.PGCode,
                PGName:pg.PGName,
                ChargeMan:pg.ChargeMan,
                Telephone:pg.Telephone,
                Department:pg.Department,
                Address:pg.Address,
                Stage:pg.Stage,
                Projlist: projlist,
                user:usr.id
            };
 //return data structure:

var retval={
                status:"true",
                msg:""
            };*/
	$retval=array(
		'status'=>'true',
		'msg'=>''
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;

case "PGMod":
//modify project group
//require data structure:
/*      var map={
                action:"PGMod",
                PGCode: pg.PGCode,
                PGName:pg.PGName,
                ChargeMan:pg.ChargeMan,
                Telephone:pg.Telephone,
                Department:pg.Department,
                Address:pg.Address,
                Stage:pg.Stage,
                Projlist: projlist,
                user:usr.id
            };
 //return data structure:

var retval={
                status:"true",
                msg:""
            };*/
	$retval=array(
		'status'=>'true',
		'msg'=>''
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
case "PGDel":
//delete project group
             //require data structure:
             /*
var map={
        action:"PGDel",
        id: id,
        user:usr.id
    };
     //return data structure:

    var retval={
                    status:"true",
                    msg:""
                };*/
	$retval=array(
		'status'=>'true',
		'msg'=>''
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
case "PGProj":
// query project list belong to one project group
//require data structure:
/*var map={
        action:"PGProj",
        id: pgid
    };
//return data structure:
    var temp = {
    id: (i+1),
    name: "��Ŀ"+i
    }
    PGProj.push(temp);
    var retval={
    status:"true",
    ret: PGProj
}*/
	$PGProj = array();
	for($i=0;$i<4;$i++){
		$temp = array(
			'id'=> (string)($i+1),
			'name'=> "项目".(string)$i
		);
		array_push($PGProj,$temp);
	}
	$retval=array(
		'status'=>'true',
		'ret'=> $PGProj
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
case "ProjTable":
// query project table
//require data structure:
/*
var map={
        action:"ProjTable",
        startseq: start,
        length:length,
        user:usr.id
    };

//return data structure:
    var temp = {
    ProjCode: (start+(i+1)),
    ProjName:"��Ŀ"+(start+i),
    ChargeMan:"�û�"+(start+i),
     Telephone:"139139"+(start+i),
      Department:"��λ"+(start+i),
      Address:"��ַ"+(start+i),
      ProStartTime:"2016-01-01",
       Stage:"��ע"+(start+i)
    };
    projtable.push(temp);

    var retval={
                    status:"true",
                    start: start,
                    total: total,
                    length:query_length,
                    ret: projtable
                };*/
	$total = 14;
    $query_length = (int)($_GET['length']);
    $start = (int)($_GET['startseq']);
    if($query_length> $total-$start){$query_length = $total-$start;}
    $projtable = array();
    for($i=0;$i<$query_length;$i++){
		$temp = array(
			'ProjCode'=> (string)($start+($i+1)),
			'ProjName'=>"项目".(string)($start+$i),
			'ChargeMan'=>"用户".(string)($start+$i),
			'Telephone'=>"139139".(string)($start+$i),
			'Department'=>"单位".(string)($start+$i),
			'Address'=>"地址".(string)($start+$i),
			'ProStartTime'=>"2016-01-01",
			'Stage'=>"备注".(string)($start+$i)
		);
		array_push($projtable,$temp);
	}
	$retval=array(
		'status'=>'true',
		'start'=> (string)$start,
		'total'=> (string)$total,
		'length'=>(string)$query_length,
		'ret'=> $projtable
	);
	$jsonencode = _encode($retval);
	echo $jsonencode; break;
case "ProjNew":
// create a new project
//require data structure:
/*
var map={
        action:"ProjNew",
        ProjCode: project.ProjCode,
        ProjName:project.ProjName,
        ChargeMan:project.ChargeMan,
        Telephone:project.Telephone,
        Department:project.Department,
        Address:project.Address,
        ProStartTime:project.ProStartTime,
        Stage:project.Stage,
        user:usr.id
    };
//return data structure:
var retval={
                status:"true",
                msg:""
            };*/
	$retval=array(
		'status'=>'true',
		'msg'=>''
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
case "ProjMod":
// modify project
//require data structure:
/*
var map={
        action:"ProjMod",
        ProjCode: project.ProjCode,
        ProjName:project.ProjName,
        ChargeMan:project.ChargeMan,
        Telephone:project.Telephone,
        Department:project.Department,
        Address:project.Address,
        ProStartTime:project.ProStartTime,
        Stage:project.Stage,
        user:usr.id
    };
//return data structure:
var retval={
                status:"true",
                msg:""
            };*/
	$retval=array(
		'status'=>'true',
		'msg'=>''
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
case "ProjDel":
//delete a project
             //require data structure:
             /*
var map={
        action:"ProjDel",
        ProjCode: ProjCode,
        user:usr.id
    };
    //return data structure:
    var retval={
                    status:"true",
                    msg:""
                };*/
	$retval=array(
		'status'=>'true',
		'msg'=>''
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
case "ProjPoint":
//get Monitor Point under a proj
             //require data structure:
             /*
var map={
        action:"ProjPoint"
    };
    //return data structure:
 var temp = {
                    id: i+1,
                    name: "�۲��"+(i+1),
                    ProjCode: projcode
                }
                ProjPoint.push(temp);
var retval={
                status:"true",
                ret: ProjPoint
            };    */
	$ProjPoint = array();
	for($i=0;$i<40;$i++){
		$projcode = ($i)%14;
		$temp = array(
			'id'=> (string)($i+1),
			'name'=> "测量点".(string)($i+1),
			'ProjCode'=> $projcode
		);
		array_push($ProjPoint,$temp);
	}
	$retval=array(
		'status'=>'true',
		'ret'=> $ProjPoint
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;

case "PointProj":
/*
var map={
        action:"PointProj",
        ProjCode: ProjCode
    };*/
    $projcode = $_GET["ProjCode"];
    $ProjPoint = array();
	for($i=0;$i<4;$i++){
		$temp = array(
			'id'=> (string)($i+1),
			'name'=> "测量点".(string)($i+1),
			'ProjCode'=> $projcode
		);
		array_push($ProjPoint,$temp);
	}
	$retval=array(
		'status'=>'true',
		'ret'=> $ProjPoint
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
break;
case "PointTable":
// query project table
//require data structure:
/*
var map={
        action:"PointTable",
        startseq: start,
        length:length,
        user:usr.id
    };
    };
    //return data structure:
var temp = {
                    StatCode: (start+(i+1)),
                    StatName:"������"+(start+i),
                    ProjCode: projcode,
                    ChargeMan:"�û�"+(start+i),
                    Telephone:"139139"+(start+i),
                    Longitude:"121.0000",
                    Latitude:"31.0000",
                    Department:"��λ"+(start+i),
                    Address:"��ַ"+(start+i),
                    Country:"����"+(start+i),
                    Street:"����"+(start+i),
                    Square:"10000",
                    ProStartTime:"2016-01-01",
                    Stage:"��ע"+(start+i)
                };
                projtable.push(temp);
var retval={
                status:"true",
                start: start,
                total: total,
                length:query_length,
                ret: projtable
            };*/
	$total = 40;
    $query_length = (int)($_GET['length']);
    $start = (int)($_GET['startseq']);
    if($query_length> $total-$start){$query_length = $total-$start;}
    $pointtable = array();
	for($i=0;$i<$query_length;$i++){
		
	$projcode = ($start+$i)%14;
		$temp = array(
			'StatCode'=> (string)($start+($i+1)),
			'StatName'=>"测量点".(string)($start+$i),
			'ProjCode'=> $projcode,
			'ChargeMan'=>"用户".(string)($start+$i),
			'Telephone'=>"139139".(string)($start+$i),
			'Longitude'=>"121.0000",
			'Latitude'=>"31.0000",
			'Department'=>"单位".(string)($start+$i),
			'Address'=>"地址".(string)($start+$i),
			'Country'=>"区县".(string)($start+$i),
			'Street'=>"街镇".(string)($start+$i),
			'Square'=>"10000",
			'ProStartTime'=>"2016-01-01",
			'Stage'=>"备注".(string)($start+$i)
		);
		array_push($pointtable,$temp);
	}
	$retval=array(
		'status'=>'true',
		'start'=> (string)$start,
		'total'=> (string)$total,
		'length'=>(string)$query_length,
		'ret'=> $pointtable
	);
	$jsonencode = _encode($retval);
	echo $jsonencode; break;
case "PointDetail":
//abandon
break;
case "PointNew":
// create a new monitor point
//require data structure:
/*var map={
          action:"PointNew",
          StatCode: point.StatCode,
          StatName:point.StatName,
          ProjCode: point.ProjCode,
          ChargeMan:point.ChargeMan,
          Telephone:point.Telephone,
          Longitude:point.Longitude,
          Latitude:point.Latitude,
          Department:point.Department,
          Address:point.Address,
          Country:point.Country,
          Street:point.Street,
          Square:point.Square,
          ProStartTime:point.ProStartTime,
          Stage:point.Stage,
          user:usr.id
      };
//return data structure:
var retval={
                status:"true",
                msg:""
            };*/
	$retval=array(
		'status'=>'true',
		'msg'=>''
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
case "PointMod":
// modify a new monitor point
//require data structure:
/*var map={
          action:"PointMod",
          StatCode: point.StatCode,
          StatName:point.StatName,
          ProjCode: point.ProjCode,
          ChargeMan:point.ChargeMan,
          Telephone:point.Telephone,
          Longitude:point.Longitude,
          Latitude:point.Latitude,
          Department:point.Department,
          Address:point.Address,
          Country:point.Country,
          Street:point.Street,
          Square:point.Square,
          ProStartTime:point.ProStartTime,
          Stage:point.Stage,
          user:usr.id
      };
//return data structure:
var retval={
                status:"true",
                msg:""
            };*/
	$retval=array(
		'status'=>'true',
		'msg'=>''
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
case "PointDel":
//delete a Monitor point
//require data structure:
/*
var map={
        action:"PointDel",
        StatCode: StatCode,
        user:usr.id
    };
    //return data structure:
    var retval={
                    status:"true",
                    msg:""
                };*/
	$retval=array(
		'status'=>'true',
		'msg'=>''
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
case "PointDev":
//get Dev list  under a monitor point
             //require data structure:
             /*
var map={
        action:"PointDev",
        StatCode: StatCode
    };
    //return data structure:
var temp = {
                    id: (i+1),
                    name: "�豸"+i
                }
                projdev.push(temp);
var retval={
                status:"true",
                ret: projdev
            };*/
	$projdev = array();
	for($i=0;$i<4;$i++){
		$temp = array(
			'id'=> (string)($i+1),
			'name'=> "设备".(string)$i
		);
		array_push($projdev,$temp);
	}
	$retval=array(
		'status'=>"true",
		'ret'=> $projdev
	);
	$jsonencode = _encode($retval);
	echo $jsonencode; break;
case "DevTable":
// query device table
//require data structure:
/*
var map={
        action:"DevTable",
        startseq: start,
        length:length,
        user:usr.id
    };
//return data structure:
var temp = {
                    //�豸��� DevCode
                    //������ StatCode
                    //��װʱ�� StartTime
                    //Ԥ�ƽ���ʱ�� PreEndTime
                    //ʵ�ʽ���ʱ�� EndTime
                    //�豸�Ƿ���� DevStatus
                    //��Ƶ��ַ VideoURL
                    DevCode: (start+(i+1)),
                    StatCode:statcode,
                    ProjCode: projcode,
                    StartTime:"2016-01-01",
                    PreEndTime:"2017-01-01",
                    EndTime:"2099-12-31",
                    DevStatus:true,
                    VideoURL:"www.tokoyhot.com"
                };
                projtable.push(temp);
                var retval={
                                status:"true",
                                start: start,
                                total: total,
                                length:query_length,
                                ret: projtable
                            };*/
	$total = 204;
    $query_length = (int)($_GET["length"]);
    $start = (int)($_GET["startseq"]);
    if($query_length> $total-$start){$query_length = $total-$start;}
    $devtable = array();
	for($i=0;$i<$query_length;$i++){
		$statcode = ($start+$i+1)%40;
		$projcode = ($statcode-1)%14;
		$temp = array(
			'DevCode'=> (string)($start+($i+1)),
			'StatCode'=> $statcode,
			'ProjCode'=> $projcode,
			'StartTime'=>"2016-01-01",
			'PreEndTime'=>"2017-01-01",
			'EndTime'=>"2099-12-31",
			'DevStatus'=>'true',
			'VideoURL'=>"www.tokoyhot.com",
			'MAC'=>'mac',
            'IP'=>"127.0.0.1"
		);
		array_push($devtable,$temp);
	}
	$retval=array(
		'status'=>'true',
		'start'=> (string)$start,
		'total'=> (string)$total,
		'length'=>(string)$query_length,
		'ret'=> $devtable
	);
	$jsonencode = _encode($retval);
	echo $jsonencode; break;
case "DevNew":
// create a new device
//require data structure:
/*var map={
          action:"DevNew",
          DevCode: device.DevCode,
          StatCode:device.StatCode,
          StartTime:device.StartTime,
          PreEndTime:device.PreEndTime,
          EndTime:device.EndTime,
          DevStatus:device.DevStatus,
          VideoURL:device.VideoURL,
          user:usr.id
      };
//return data structure:
            var retval={
                            status:"true",
                            msg:""
                        };*/
	$retval=array(
		'status'=>'true',
		'msg'=>''
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
case "DevMod":
// modify a  device
//require data structure:
/*var map={
          action:"DevMod",
          DevCode: device.DevCode,
          StatCode:device.StatCode,
          StartTime:device.StartTime,
          PreEndTime:device.PreEndTime,
          EndTime:device.EndTime,
          DevStatus:device.DevStatus,
          VideoURL:device.VideoURL,
          user:usr.id
      };
//return data structure:
            var retval={
                            status:"true",
                            msg:""
                        };*/
	$retval=array(
		'status'=>'true',
		'msg'=>''
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
case "DevDel":
// delete a  device
//require data structure:
/*
var map={
        action:"DevDel",
        DevCode: DevCode,
        user:usr.id
    };
//return data structure:
            var retval={
                            status:"true",
                            msg:""
                        };*/
	$retval=array(
		'status'=>'true',
		'msg'=>''
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
case "DevAlarm":
// get last alarm by a device on map
//require data structure:
/*
var map={
            action:"DevAlarm",
            StatCode: monitor_selected.StatCode
        };
//return data structure:
var map1 = {
                AlarmName: "扬尘",
                AlarmEName: "Dust",  <= 图标映射
                AlarmValue:GetRandomNum(10,110),
                AlarmUnit:"DB",
                WarningTarget:"false"
            };
            alarmlist.push(map1);
            var vcr_list= new Array();
                        for(var i=0;i>10;i++){
                            var map={
                                vcrname: "录像"+i,
                                vcraddress: "127.0.0.1:8888/"
                            }
                            vcr_list.push(map);
                        }

                        var retval={
                            status:"true",
                            ret:alarmlist,
                            vcr:vcr_list
                        };*/
	$StatCode =$_GET["StatCode"];
	$alarmlist= array();
	$map1 = array(
		'AlarmName'=>"噪声",
		'AlarmEName'=> "Noise",
		'AlarmValue'=>(string)rand(10,110),
		'AlarmUnit'=>"DB",
		'WarningTarget'=>"false"
	);
	array_push($alarmlist,$map1);
	$map2 = array(
		'AlarmName'=>"风向",
		'AlarmEName'=> "WD",
		'AlarmValue'=>(string)rand(1,100),
		'AlarmUnit'=>"mg/m3",
		'WarningTarget'=>"false"
	);
	array_push($alarmlist,$map2);
	$map3 = array(
		'AlarmName'=>"湿度",
		'AlarmEName'=> "Wet",
		'AlarmValue'=>(string)rand(1,100),
		'AlarmUnit'=>"%",
		'WarningTarget'=>"false"
	);
	array_push($alarmlist,$map3);
	$map4 = array(
		'AlarmName'=>"温度",
		'AlarmEName'=> "Temperature",
		'AlarmValue'=>(string)rand(10,50),
		'AlarmUnit'=>"C",
		'WarningTarget'=>"false"
	);
	array_push($alarmlist,$map4);
	$map5 = array(
		'AlarmName'=>"细颗粒物",
		'AlarmEName'=> "PM",
		'AlarmValue'=>(string)rand(10,400),
		'AlarmUnit'=>"ug/m3",
		'WarningTarget'=>"false"
	);
	array_push($alarmlist,$map5);
	$map6 = array(
		'AlarmName'=>"录像",
		'AlarmEName'=> "VCR",
		'AlarmValue'=>(string)rand(10,150),
		'AlarmUnit'=>"菌群",
		'WarningTarget'=>"false"
	);
	array_push($alarmlist,$map6);
	$map7 = array(
		'AlarmName'=>"GPS",
		'AlarmEName'=> "GPS",
		'AlarmValue'=>(string)rand(10,30),
		'AlarmUnit'=>"ug/L",
		'WarningTarget'=>"true"
	);
	array_push($alarmlist,$map7);
	$map8 = array(
		'AlarmName'=>"风速",
		'AlarmEName'=> "WS",
		'AlarmValue'=>(string)rand(10,150),
		'AlarmUnit'=>"km/h",
		'WarningTarget'=>"false"
	);
	array_push($alarmlist,$map8);
    $vcr_list= array();
    for($i=0;$i<10;$i++){
        $map=array(
           'vcrname'=> "录像".(string)$i,
           'vcraddress'=> "127.0.0.1/"
        );
        array_push($vcr_list,$map);
    }

	$retval=array(
		'status'=>'true',
		'StatCode'=>$StatCode,
		'ret'=> $alarmlist,
		'vcr'=>$vcr_list
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
case "MonitorList":
// get monitorList in map by user id
//require data structure:
/*
var map={
        action:"MonitorList",
        id: usr.id
    };
    //return data structure:
    var map18={
                    StatCode:"120101020",
                    StatName:"�ٸ۳�Ͷ����",
                    ChargeMan:"����",
                    Telephone:"13912345678",
                    Department:"",
                    Address:"������һ·333��",
                    Country:"�ֶ�����",
                    Street:"",
                    Square:"0",
                    Flag_la:"N",
                    Latitude:"30.900796",
                    Flag_lo:"E",
                    Longitude:"121.933166",
                    ProStartTime:"2015-11-30",
                    Stage:""
                };
                stat_list.push(map18);
                var retval={
                    status:"true",
                    id: userid,
                    ret: stat_list
                };*/
	$userid = $_GET["id"];
	$stat_list = array();
	$map1=array(
		'StatCode'=>"120101001",
		'StatName'=>"浦东环球金融中心工程",
		'ChargeMan'=>"张三",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"世纪大道100号",
		'Country'=>"浦东新区",
		'Street'=>"",
		'Square'=>"40000",
		'Flag_la'=>"N",
		'Latitude'=>"31.240246",
		'Flag_lo'=>"E",
		'Longitude'=>"121.514168",
		'ProStartTime'=>"2015-01-01",
		'Stage'=>""
	);
	array_push($stat_list,$map1);
	$map2=array(

		'StatCode'=>"120101002",
		'StatName'=>"港运大厦",
		'ChargeMan'=>"张三",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"杨树浦路1963弄24号",
		'Country'=>"虹口区",
		'Street'=>"",
		'Square'=>"0",
		'Flag_la'=>"N",
		'Latitude'=>"31.255719",
		'Flag_lo'=>"E",
		'Longitude'=>"121.517700",
		'ProStartTime'=>"2016-04-01",
		'Stage'=>""
	);
	array_push($stat_list,$map1);
	$map3= array(

		'StatCode'=>"120101003",
		'StatName'=>"万宝国际广场",
		'ChargeMan'=>"张三",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"延安西路500号",
		'Country'=>"长宁区",
		'Street'=>"",
		'Square'=>"0",
		'Flag_la'=>"N",
		'Latitude'=>"31.223441",
		'Flag_lo'=>"E",
		'Longitude'=>"121.442703",
		'ProStartTime'=>"2016-04-01",
		'Stage'=>""
	);
	array_push($stat_list,$map3);
	$map4= array(

		'StatCode'=>"120101004",
		'StatName'=>"金桥创科园",
		'ChargeMan'=>"李四",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"桂桥路255号",
		'Country'=>"浦东新区",
		'Street'=>"",
		'Square'=>"0",
		'Flag_la'=>"N",
		'Latitude'=>"31.248271",
		'Flag_lo'=>"E",
		'Longitude'=>"121.615476",
		'ProStartTime'=>"2016-04-01",
		'Stage'=>""
	);
	array_push($stat_list,$map4);
	$map5= array(

		'StatCode'=>"120101006",
		'StatName'=>"江湾体育场",
		'ChargeMan'=>"李四",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"国和路346号",
		'Country'=>"杨浦区",
		'Street'=>"",
		'Square'=>"0",
		'Flag_la'=>"N",
		'Latitude'=>"31.313004",
		'Flag_lo'=>"E",
		'Longitude'=>"121.525701",
		'ProStartTime'=>"2016-04-13",
		'Stage'=>""
	);
	array_push($stat_list,$map5);
	$map6= array(

		'StatCode'=>"120101007",
		'StatName'=>"滨海新村",
		'ChargeMan'=>"李四",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"同泰北路100号",
		'Country'=>"宝山区",
		'Street'=>"",
		'Square'=>"0",
		'Flag_la'=>"N",
		'Latitude'=>"31.382624",
		'Flag_lo'=>"E",
		'Longitude'=>"121.501387",
		'ProStartTime'=>"2016-02-01",
		'Stage'=>""

	);
	array_push($stat_list,$map6);
	$map7= array(
		'StatCode'=>"120101008",
		'StatName'=>"银都苑",
		'ChargeMan'=>"李四",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"银都路3118弄",
		'Country'=>"闵行区",
		'Street'=>"",
		'Square'=>"0",
		'Flag_la'=>"N",
		'Latitude'=>"31.101605",
		'Flag_lo'=>"E",
		'Longitude'=>"121.404873",
		'ProStartTime'=>"2016-02-01",
		'Stage'=>""

	);
	array_push($stat_list,$map7);
	$map8= array(
		'StatCode'=>"120101009",
		'StatName'=>"万科花园小城",
		'ChargeMan'=>"王五",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"龙吴路5710号",
		'Country'=>"闵行区",
		'Street'=>"",
		'Square'=>"0",
		'Flag_la'=>"N",
		'Latitude'=>"31.043827",
		'Flag_lo'=>"E",
		'Longitude'=>"121.476450",
		'ProStartTime'=>"2016-02-18",
		'Stage'=>""

	);
	array_push($stat_list,$map8);
	$map9= array(
		'StatCode'=>"120101010",
		'StatName'=>"合生国际花园",
		'ChargeMan'=>"王五",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"长兴东路1290",
		'Country'=>"松江区",
		'Street'=>"",
		'Square'=>"0",
		'Flag_la'=>"N",
		'Latitude'=>"31.088973",
		'Flag_lo'=>"E",
		'Longitude'=>"121.295459",
		'ProStartTime'=>"2016-02-18",
		'Stage'=>""

	);
	array_push($stat_list,$map9);
	$map10= array(
		'StatCode'=>"120101011",
		'StatName'=>"江南国际会议中心",
		'ChargeMan'=>"王五",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"青浦区Y095(阁游路)",
		'Country'=>"青浦区",
		'Street'=>"",
		'Square'=>"0",
		'Flag_la'=>"N",
		'Latitude'=>"31.127234",
		'Flag_lo'=>"E",
		'Longitude'=>"121.062241",
		'ProStartTime'=>"2016-02-18",
		'Stage'=>""
	);
	array_push($stat_list,$map10);
	$map11= array(

		'StatCode'=>"120101012",
		'StatName'=>"佳邸别墅",
		'ChargeMan'=>"王五",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"盈港路1555弄",
		'Country'=>"青浦区",
		'Street'=>"",
		'Square'=>"0",
		'Flag_la'=>"N",
		'Latitude'=>"31.164430",
		'Flag_lo'=>"E",
		'Longitude'=>"121.102934",
		'ProStartTime'=>"2016-02-18",
		'Stage'=>""
	);
	array_push($stat_list,$map11);
	$map12= array(

		'StatCode'=>"120101013",
		'StatName'=>"西郊河畔家园",
		'ChargeMan'=>"王五",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"繁兴路469弄",
		'Country'=>"闵行区",
		'Street'=>"华漕镇",
		'Square'=>"0",
		'Flag_la'=>"N",
		'Latitude'=>"31.218057",
		'Flag_lo'=>"E",
		'Longitude'=>"121.297076",
		'ProStartTime'=>"2016-02-18",
		'Stage'=>""
	);
	array_push($stat_list,$map12);
	$map13= array(

		'StatCode'=>"120101014",
		'StatName'=>"东视大厦",
		'ChargeMan'=>"赵六",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"东方路2000号",
		'Country'=>"浦东新区",
		'Street'=>"南码头",
		'Square'=>"0",
		'Flag_la'=>"N",
		'Latitude'=>"31.203650",
		'Flag_lo'=>"E",
		'Longitude'=>"121.526288",
		'ProStartTime'=>"2016-02-18",
		'Stage'=>""

	);
	array_push($stat_list,$map13);
	$map14= array(
		'StatCode'=>"120101015",
		'StatName'=>"曙光大厦",
		'ChargeMan'=>"赵六",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"普安路189号",
		'Country'=>"黄埔区",
		'Street'=>"淮海中路街道",
		'Square'=>"0",
		'Flag_la'=>"N",
		'Latitude'=>"31.228283",
		'Flag_lo'=>"E",
		'Longitude'=>"121.485388",
		'ProStartTime'=>"2016-02-29",
		'Stage'=>""

	);
	array_push($stat_list,$map14);
	$map15= array(
		'StatCode'=>"120101017",
		'StatName'=>"上海贝尔",
		'ChargeMan'=>"赵六",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"西藏北路525号",
		'Country'=>"闸北区",
		'Street'=>"芷江西路街道",
		'Square'=>"0",
		'Flag_la'=>"N",
		'Latitude'=>"31.256691",
		'Flag_lo'=>"E",
		'Longitude'=>"121.475583",
		'ProStartTime'=>"2016-03-15",
		'Stage'=>""

	);
	array_push($stat_list,$map15);
	$map16= array(
		'StatCode'=>"120101018",
		'StatName'=>"嘉宝大厦",
		'ChargeMan'=>"赵六",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"洪德路1009号",
		'Country'=>"嘉定区",
		'Street'=>"马陆镇",
		'Square'=>"0",
		'Flag_la'=>"N",
		'Latitude'=>"31.357885",
		'Flag_lo'=>"E",
		'Longitude'=>"121.256060",
		'ProStartTime'=>"2015-03-19",
		'Stage'=>""

	);
	array_push($stat_list,$map16);
	$map17= array(
		'StatCode'=>"120101019",
		'StatName'=>"金山豪庭",
		'ChargeMan'=>"赵六",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"卫清东路2988",
		'Country'=>"金山区",
		'Street'=>"",
		'Square'=>"0",
		'Flag_la'=>"N",
		'Latitude'=>"30.739094",
		'Flag_lo'=>"E",
		'Longitude'=>"121.360693",
		'ProStartTime'=>"2015-08-25",
		'Stage'=>""

	);
	array_push($stat_list,$map17);
	$map18= array(
		'StatCode'=>"120101020",
		'StatName'=>"临港城投大厦",
		'ChargeMan'=>"赵六",
		'Telephone'=>"13912345678",
		'Department'=>"",
		'Address'=>"环湖西一路333号",
		'Country'=>"浦东新区",
		'Street'=>"",
		'Square'=>"0",
		'Flag_la'=>"N",
		'Latitude'=>"30.900796",
		'Flag_lo'=>"E",
		'Longitude'=>"121.933166",
		'ProStartTime'=>"2015-11-30",
		'Stage'=>""
	);
	array_push($stat_list,$map18);
	$retval=array(
		'status'=>'true',
		'id'=>$userid,
		'ret'=> $stat_list
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
case "AlarmQuery":
// query one point one date alarm by minute/hour/day
//require data structure:
/*
var map={
        action:"AlarmQuery",
        id: usr.id,
        StatCode: alarm_selected.StatCode,
        date: date,
        type:type
    };
   //return data structure:
    var minute_alarm = new Array();
     var minute_head = new Array();
                for(var i=0;i<(60*24);i++){
                    minute_alarm.push(GetRandomNum(10,110));
                    minute_head.push((string)i);
                }
                var hour_alarm = new Array();
                var hour_head = new Array();
                for(var i=0;i<(7*24);i++){
                    hour_alarm.push(GetRandomNum(10,110));
                    hour_head.push((string)i);
                }
                var day_alarm = new Array();
                var day_head = new Array();
                for(var i=0;i<30;i++){
                    day_alarm.push(GetRandomNum(10,110));
                    day_head.push((string)i);
                }

                var retval={
                    status:"true",
                    StatCode: StatCode,
                    date: date,
                    AlarmName: AlarmName,
                    AlarmUnit: AlarmUnit,
                    WarningTarget:WarningTarget,
                    minute_alarm: minute_alarm,
                    hour_alarm: hour_alarm,
                    day_alarm: day_alarm
                };*/
	$user = $_GET["id"];
	$StatCode = $_GET["StatCode"];
	$query_date = $_GET["date"];
	$query_type = $_GET["type"];
	$AlarmName= "噪声";
	$AlarmUnit="DB";
	$WarningTarget='65';
	$minute_alarm = array();
	$minute_head = array();
	for($i=0;$i<(60*24);$i++){
		array_push($minute_alarm,rand(10,110));
		array_push($minute_head,(string)$i);
	}
	$hour_alarm = array();
	$hour_head = array();
	for($i=0;$i<(7*24);$i++){
		array_push($hour_alarm,rand(10,110));
		array_push($hour_head,(string)$i);
	}
	$day_alarm = array();
	$day_head = array();
	for($i=0;$i<30;$i++){
		array_push($day_alarm,rand(10,110));
		array_push($day_head,(string)$i);
	}

	$retval= array(
		'status'=>"true",
		'StatCode'=> $StatCode,
		'date'=> $query_date,
		'AlarmName'=> $AlarmName,
		'AlarmUnit'=> $AlarmUnit,
		'WarningTarget'=>$WarningTarget,
		'minute_head'=>$minute_head,
		'day_head'=>$day_head,
		'hour_head'=>$hour_head,
		'minute_alarm'=> $minute_alarm,
		'hour_alarm'=> $hour_alarm,
		'day_alarm'=> $day_alarm
	);
	$jsonencode = json_encode($retval,JSON_UNESCAPED_UNICODE);
	echo $jsonencode; break;
case "AlarmType":
	$ret = array();
	$map = array(
		'id'=>(string)0,
		'name'=>"噪音"
	);
	array_push($ret,$map);
	$map = array(
		'id'=>(string)1,
		'name'=>"扬尘"
	);
	array_push($ret,$map);
	$map = array(
		'id'=>(string)2,
		'name'=>"湿度"
	);
	array_push($ret,$map);
	$map = array(
		'id'=>(string)3,
		'name'=>"温度"
	);
	array_push($ret,$map);
	$map = array(
		'id'=>(string)4,
		'name'=>"细颗粒物"
	);
	array_push($ret,$map);
	$map = array(
		'id'=>(string)5,
		'name'=>"水质"
	);
	array_push($ret,$map);
	$map = array(
		'id'=>(string)6,
		'name'=>"SO2"
	);
	array_push($ret,$map);
	$map = array(
		'id'=>(string)7,
		'name'=>"风速"
	);
	array_push($ret,$map);
	$retval=array(
		'status'=>'true',
		'typelist'=> $ret
	);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
// get all alarm type in system
//require data structure:
/*
var map={
        action:"AlarmType"
    };
//return data structure:
    var map = {
                    id:0,
                    name:"����"
                }
                ret.push(map);
    ret.push(map);
                var retval={
                    status:"true",
                    typelist: ret
                };*/
case "TableQuery":
// input tablename =>string
// condition =>array
// every condition 
/*
		ConditonName: "AlarmDate",
        Equal:"",
        GEQ:end_date,
        LEQ:start_date*/
            $TableName = $_GET["TableName"];
            $Condition = $_GET["Condition"];
            //$Filter = $_GET["Filter"];
            $column = 16;
            $row = 40;
            $column_name = array();
            $row_content = array();
            for( $i=0;$i<$column;$i++){
				array_push($column_name,"第".(string)($i+1)."列");
            }
            for($i=0;$i<$row;$i++){
                $one_row = array();
				array_push($one_row,(string)($i+1));
				array_push($one_row,"备注".(string)($i+1));
                for($j=0;$j<($column-6);$j++) array_push($one_row,rand(10,110));
				
                //one_row.push("地址"+(i+1)+"xxxxx路"+(i+1)+"xxxxx号");
				array_push($one_row,"地址".((string)($i+1))."xxxxx路".((string)($i+1))."xxxxx号");
                //one_row.push("测试");
				array_push($one_row,"测试");
                //one_row.push("名称");
				array_push($one_row,"名称");
                //one_row.push("长数据长数据长数据"+(i+1)+"xxxxx路"+(i+1)+"xxxxx号");
				array_push($one_row,"长数据长数据长数据".((string)($i+1))."xxxxx路".((string)($i+1))."xxxxx号");
				array_push($row_content,$one_row);
                //row_content.push(one_row);
            }
			$retval=array(
				'status'=>'true',
				'ColumnName'=> $column_name,
                'TableData'=>$row_content
			);
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
case "SensorList":
	$ret = array();
	$map = array(
                'id'=>"101",
                'name'=>"PM2.5",
                'nickname'=>"PM2.5",
                'memo'=>"PM2.5传感器",
                'code'=>""
            );
            array_push($ret,$map);
            $map = array(
                'id'=>"201",
                'name'=>"temperature",
                'nickname'=>"温度",
                'memo'=>"温度传感器",
                'code'=>""
            );
            array_push($ret,$map);
            $map = array(
                'id'=>"301",
                'name'=>"hum'id'ity",
                'nickname'=>"湿度",
                'memo'=>"湿度传感器",
                'code'=>""
            );
            array_push($ret,$map);
            $map = array(
                'id'=>"401",
                'name'=>"windspeed",
                'nickname'=>"风速",
                'memo'=>"风速传感器",
                'code'=>""
            );
            array_push($ret,$map);
            $map = array(
                'id'=>"501",
                'name'=>"winddir",
                'nickname'=>"风向",
                'memo'=>"风向传感器",
                'code'=>""
            );
            array_push($ret,$map);
            $map = array(
                'id'=>"601",
                'name'=>"PM2.5",
                'nickname'=>"PM2.5",
                'memo'=>"PM2.5传感器",
                'code'=>""
            );
            array_push($ret,$map);
            $map = array(
                'id'=>"701",
                'name'=>"noise",
                'nickname'=>"噪声",
                'memo'=>"噪声传感器",
                'code'=>""
            );
            array_push($ret,$map);
            $map = array(
                'id'=>"901",
                'name'=>"emc",
                'nickname'=>"emc",
                'memo'=>"EMC传感器"
            );
            array_push($ret,$map);
            $map = array(
                'id'=>"901",
                'name'=>"emc",
                'nickname'=>"emc",
                'memo'=>"EMC传感器",
                'code'=>""
            );
            array_push($ret,$map);
            $map = array(
                'id'=>"a01",
                'name'=>"airpressure",
                'nickname'=>"气压",
                'memo'=>"气压传感器",
                'code'=>""
            );
            array_push($ret,$map);
            $map = array(
                'id'=>"b01",
                'name'=>"rain",
                'nickname'=>"降雨",
                'memo'=>"降雨传感器",
                'code'=>""
            );
            array_push($ret,$map);
			$retval=array(
				'status'=>'true',
                'SensorList'=>$ret
			);
		$jsonencode = _encode($retval);
		echo $jsonencode; break;
	case "DevSensor":
		$DevCode = $_GET["DevCode"];
		$paralist = array();
		for ($i=0;$i<10;$i++){
                $temp = array(
                    'name'=>"Parameter_".(string)$i,
                    'memo'=>"Parameter".(string)$i,
                    'value'=>"10"
                );
                array_push($paralist,$temp);
            }
		$ret = array();
		$map = array(
                'id'=>"101",
                'status'=>"true",
                'para'=>$paralist
            );
            array_push($ret,$map);
		$temp = array();
        $map = array(
                'id'=>"201",
                'status'=>"true",
                'para'=>$temp
            );
            array_push($ret,$map);
         $map = array(
                'id'=>"a01",
                'status'=>"false",
                'para'=>$temp
            );
            array_push($ret,$map);
		$retval=array(
				'status'=>'true',
                'ret'=>$ret
			);
		$jsonencode = json_encode($retval,JSON_UNESCAPED_UNICODE);
		echo $jsonencode; break;
	case "SensorUpdate":
        $DevCode = $_GET["DevCode"];
        $SensorCode = $_GET["SensorCode"];
        $status = $_GET["status"];
        $ParaList = $_GET["ParaList"];
        $retval=array(
            'status'=>'true',
            'msg'=>''
        );
        $jsonencode = _encode($retval);
        echo $jsonencode; break;
    case "SetUserMsg":
    /*
            var usr = data.id;
            var Msg = data.msg;
            var ifdev = data.ifdev;
            var retval={
                status:"true",
                msg:""
            };*/
        $usr = $_GET["id"];
        $msg = $_GET["msg"];
        $ifdev = $_GET["ifdev"];
        $retval=array(
            'status'=>'true',
            'msg'=>''
        );
        $jsonencode = _encode($retval);
        echo $jsonencode; break;
    case "GetUserMsg":
    /*
        var usr = data.id;
        var retval={
            status:"true",
            msg:"您好，今天是xxxx号，欢迎领导前来视察，今天的气温是 今天的PM2.5是....",
            ifdev:"true"
        };*/
        $usr = $_GET["id"];
        $retval=array(
            'status'=>'true',
            'msg'=>'您好，今天是xxxx号，欢迎领导前来视察，今天的气温是 今天的PM2.5是....',
            'ifdev'=>"true"
        );
        $jsonencode = _encode($retval);
        echo $jsonencode; break;
    case "ShowUserMsg":
    /*
        var usr = data.id;
        var temp = GetRandomNum(1000,9999);
        var retval={
                status:"true",
                msg:temp+"您好，今天是"+temp+"号，欢迎领导前来视察，今天的气温是 今天的PM2.5是.xxx.yyy.zzz."
            };*/
       $usr = $_GET["id"];
       $StatCode = $_GET["StatCode"];
       $temp =(string)rand(1000,9999);
       $retval=array(
             'status'=>'true',
             'msg'=>$temp.'您好，今天是'.$temp.'号，欢迎领导前来视察，今天的气温是 今天的PM2.5是....'
       );

        $jsonencode = _encode($retval);
        echo $jsonencode; break;
    case "GetUserImg":
    /*
                var usr = data.id;
                var ImgList= new Array();
                for(var i=1;i<6;i++){
                    var map={
                        name :"test"+i+".jpg",
                        url:"assets/img/test"+i+".jpg"
                    };
                    ImgList.push(map);
                }
                var retval={
                    status:"true",
                    img: ImgList
                };*/
        $usr = $_GET["id"];
        $ImgList = array();
        for ($i=1;$i<6;$i++){
            $map = array(
                'name'=>"test".(string)$i.".jpg",
                'url'=>"assets/img/test".(string)$i.".jpg"
            );
            array_push($ImgList,$map);
        }
        $retval=array(
             'status'=>'true',
             'img'=>$ImgList
        );
        $jsonencode = _encode($retval);
        echo $jsonencode; break;
    case "ClearUserImg":
    /*
        var usr = data.id;
        var retval={
            status:"true"
        };*/
        $usr = $_GET["id"];
        $retval=array(
             'status'=>'true'
        );
        $jsonencode = _encode($retval);
        echo $jsonencode; break;
    case "GetStaticMonitorTable":
        /*
        var retval={
            status:"true",
            ColumnName: column_name,
            TableData:row_content
        };*/
        $usr = $_GET["id"];
    $column = 16;
    $row = 40;
    $column_name = array();
    $row_content = array();
    for( $i=0;$i<$column;$i++){
        array_push($column_name,"第".(string)($i+1)."列");
    }
    for($i=0;$i<$row;$i++){
        $one_row = array();
        array_push($one_row,(string)($i+1));
        array_push($one_row,"备注".(string)($i+1));
        for($j=0;$j<($column-6);$j++) array_push($one_row,rand(10,110));

        //one_row.push("地址"+(i+1)+"xxxxx路"+(i+1)+"xxxxx号");
        array_push($one_row,"地址".((string)($i+1))."xxxxx路".((string)($i+1))."xxxxx号");
        //one_row.push("测试");
        array_push($one_row,"测试");
        //one_row.push("名称");
        array_push($one_row,"名称");
        //one_row.push("长数据长数据长数据"+(i+1)+"xxxxx路"+(i+1)+"xxxxx号");
        array_push($one_row,"长数据长数据长数据".((string)($i+1))."xxxxx路".((string)($i+1))."xxxxx号");
        array_push($row_content,$one_row);
        //row_content.push(one_row);
    }
    $retval=array(
        'status'=>'true',
        'ColumnName'=> $column_name,
        'TableData'=>$row_content
    );
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
    case "GetVideoList":
    /*
            var usr = data.id;
            var StatCode = data.StatCode;
            var date = data.date;
            var hour = data.hour;
            var VideoList = new Array();
            for(var j=0;j<5;j++) {
                var map = {
                    id: "Video_" + StatCode + "_" + date + "_" + hour + "_" + j,
                    attr: "视频属性"
                }
                VideoList.push(map);
            }
            var retval={
                status:"true",
                ret: VideoList
            };
            return JSON.stringify(retval);
    */
    $usr = $_GET["id"];
    $StatCode = $_GET["StatCode"];
    $date = $_GET["date"];
    $hour = $_GET["hour"];
    $VideoList = array();
    for($j=0;$j<5;$j++) {

        $map = array(
            'id'=>"Video_" .$StatCode . "_"  .$date ."_" .$hour ."_" .(string)$j,
            'attr'=>"Video_" .$StatCode . "_"  .$date ."_" .$hour ."_" .(string)$j."视频属性"
        );
        array_push($VideoList,$map);
    }
    $retval=array(
        'status'=>'true',
        'ret'=> $VideoList
    );
    $jsonencode = _encode($retval);
	echo $jsonencode; break;

    case "GetVideo":
    /*
            var videoid = data.id;
            var number = GetRandomNum(1,10);
            if(number ==10){
                var retval={
                    status:"true",
                    url:"/video/avorion.mp4"
                }
                return JSON.stringify(retval);
            }else{
                var retval={
                    status:"true",
                    url:"downloading"
                }
                return JSON.stringify(retval);
            }
    */
    $videoid = $_GET["id"];
    $number = rand(1,11);
    if($number == 10){
        $retval=array(
            'status'=>'true',
            'url'=> "avorion.mp4"
        );
        $jsonencode = _encode($retval);
    	echo $jsonencode; break;
    }else{
        $retval=array(
            'status'=>'true',
            'url'=> "downloading"
        );
        $jsonencode = _encode($retval);
        echo $jsonencode; break;
    }

    case "GetVersionList":
    /*
    var verlist = new Array();
    for (var i=0;i<10;i++){
        verlist.push("Ver "+(i+1)+".00");
    }
    var retval={
        status:"true",
        ret: verlist
    }
    return JSON.stringify(retval);
    */
    $verlist = array();
    for ($i=0;$i<10;$i++){
        array_push($verlist,"Ver ".(string)($i+1).".00");
    }
    $retval=array(
        'status'=>'true',
        'ret'=> $verlist
    );
    $jsonencode = _encode($retval);
    echo $jsonencode; break;

    case "GetProjDevVersion":
    /*
                var ProjCode = data.ProjCode;
                var projdev = new Array();
                for(var i=0;i<5;i++){
                    for(var j=0;j<4;j++){
                        var temp = {
                            DevCode: i+"_"+j,
                            ProjName: "测量点"+i,
                            version: "Ver 1.00"
                        }
                        projdev.push(temp);
                    }
                }
                var retval={
                    status:"true",
                    ret: projdev
                };
                return JSON.stringify(retval);
    */
        $ProjCode = $_GET["ProjCode"];
        $projdev = array();
        for($i=0;$i<5;$i++){
            for($j=0;$j<4;$j++){
                $temp = array(
                    'DevCode'=> $ProjCode."_".(string)$i."_".(string)$j,
                    'ProjName'=> "测量点".(string)$i,
                    'version'=> "Ver 1.00"
                );
                array_push($projdev,$temp);
            }
        }
        $retval=array(
            'status'=>'true',
            'ret'=> $projdev
        );
        $jsonencode = _encode($retval);
        echo $jsonencode; break;

    case "UpdateDevVersion":
            /*
            var usr = data.id;
            var list = data.list;
            var version = data.version;
            var retval={
                status:"true"
            }
            return JSON.stringify(retval);
            */
    $usr = $_GET["id"];
    $list = $_GET["list"];
    $version = $_GET["version"];
    $retval=array(
        'status'=>'true'
    );
    $jsonencode = _encode($retval);
    echo $jsonencode; break;
case "GetCameraStatus":
    /*
                var usr = data.id;
                var StatCode = data.StatCode;
                var videocode = GetRandomNum(1,5);
                var camerastatus={
                    h:"120~",
                    v:"120~",
                    url:"/video/screenshot/"+videocode+".png"
                }
                var retval={
                    status:"true",
                    ret:camerastatus
                }
                return JSON.stringify(retval);
    */
        $usr = $_GET["id"];
        $StatCode = $_GET["StatCode"];
        $videocode = rand(1,5);
        $camerastatus=array(
                   'v'=>"120~",
                   'h'=>"120~",
                   'url'=>"./video/screenshot/".(string)$videocode.".png"
                );
            $retval=array(
                'status'=>'true',
                'ret'=>$camerastatus
            );
            $jsonencode = _encode($retval);
            echo $jsonencode; break;

case "GetCameraUnit":
    /*
            var camera={
                v:"3~",
                h:"3~"
            }
            var retval={
                status:"true",
                ret: camera
            }
            return JSON.stringify(retval);
    */
    $camera=array(
               'v'=>"3~",
               'h'=>"3~",
            );
        $retval=array(
            'status'=>'true',
            'ret'=>$camera
        );
        $jsonencode = _encode($retval);
        echo $jsonencode; break;




case "CameraVAdj":
    /*
    var usr = data.id;
    var StatCode = data.StatCode;
    var adj = data.adj;
    var videocode = GetRandomNum(1,5);
    var camerastatus={
        h:"120~",
        v:"120~",
        url:"/video/screenshot/"+videocode+".png"
    }
    var retval={
        status:"true",
        ret:camerastatus
    }
    return JSON.stringify(retval);
    */
            $usr = $_GET["id"];
            $StatCode = $_GET["StatCode"];
            $adj = $_GET["adj"];
            $videocode = rand(1,5);
            $camerastatus=array(
                       'v'=>"120~",
                       'h'=>"120~",
                       'url'=>"./video/screenshot/".(string)$videocode.".png"
                    );
                $retval=array(
                    'status'=>'true',
                    'ret'=>$camerastatus
                );
                $jsonencode = _encode($retval);
                echo $jsonencode; break;
case "CameraHAdj":
    /*
            var usr = data.id;
            var StatCode = data.StatCode;
            var adj = data.adj;
            var videocode = GetRandomNum(1,5);
            var camerastatus={
                h:"120~",
                v:"120~",
                url:"/video/screenshot/"+videocode+".png"
            }
            var retval={
                status:"true",
                ret:camerastatus
            }
            return JSON.stringify(retval);
    */
                $usr = $_GET["id"];
                $StatCode = $_GET["StatCode"];
                $adj = $_GET["adj"];
                $videocode = rand(1,5);
                $camerastatus=array(
                           'v'=>"120~",
                           'h'=>"120~",
                           'url'=>"./video/screenshot/".(string)$videocode.".png"
                        );
                    $retval=array(
                        'status'=>'true',
                        'ret'=>$camerastatus
                    );
                    $jsonencode = _encode($retval);
                    echo $jsonencode; break;
    case "OpenLock":
        $usr = $_GET["id"];
        $StatCode = $_GET["StatCode"];
        $auth = rand(1,4);
        if($auth == 3) $auth = "false";
        else $auth="true";
        $retval=array(
                        'status'=>'true',
                        'auth'=>$auth,
                        'msg'=>"1231231"
                    );
        $jsonencode = _encode($retval);
        echo $jsonencode; break;
    case "UserKey":
        $usr = $_GET["userid"];
        $usr_keylist = array();
        $temp = array(
            'id'=>"xxx1",
        	'name'=>"0440",
        	'domain'=>"区域2"
        );
        array_push($usr_keylist,$temp);
        $temp = array(
            'id'=>"xxx2",
            'name'=>"0440",
            'domain'=>"区域2"
        );
        array_push($usr_keylist,$temp);
        $temp = array(
            'id'=>"xxx1",
            'name'=>"0440",
            'domain'=>"区域3"
        );
        array_push($usr_keylist,$temp);
        $retval=array(
            'status'=>'true',
            'ret'=>$usr_keylist
        );
        $jsonencode = _encode($retval);
        echo $jsonencode; break;
    case "ProjKeyList":
        $proj_keylist = array();
        for($i=0;$i<40;$i++){
            $projcode = ($i)%14;
            $temp = array(
                'id'=> (string)($i+1),
                'name'=> "钥匙".(string)($i+1),
                'ProjCode'=> $projcode,
                'username'=>"巡检员".(string)($i+1)
            );
            array_push($proj_keylist,$temp);
        }
        $retval=array(
            'status'=>'true',
            'ret'=> $proj_keylist
        );


        $jsonencode = _encode($retval);
        echo $jsonencode; break;
    case "ProjKey":
        $projcode = $_GET["ProjCode"];
        $proj_keylist = array();


        $proj_keylist = array();
        $temp = array(
            'id'=>"0440",
            'name'=>"0440",
            'username'=>"巡检员1"
        );
        array_push($proj_keylist,$temp);
        $temp = array(
            'id'=>"04433",
            'name'=>"04433",
            'username'=>"巡检员2"
        );
        array_push($proj_keylist,$temp);
        $temp = array(
            'id'=>"0xh0",
            'name'=>"0xh0",
            'username'=>"未授予"
        );
        array_push($proj_keylist,$temp);
        $retval=array(
            'status'=>'true',
            'ret'=>$proj_keylist
        );
        $jsonencode = _encode($retval);
        echo $jsonencode; break;
	case "ProjUserList":
        $proj_userlist = array();
        for($i=0;$i<40;$i++){
            $projcode = ($i)%14;
            $temp = array(
                'id'=> (string)($i+1),
                'name'=> "巡检员".(string)($i+1),
                'ProjCode'=> $projcode
            );
            array_push($proj_userlist,$temp);
        }
        $retval=array(
            'status'=>'true',
            'ret'=> $proj_userlist
        );


        $jsonencode = _encode($retval);
        echo $jsonencode; break;
    case "KeyTable":
        $total = 94;
        $query_length = (int)($_GET['length']);
        $start = (int)($_GET['startseq']);
        if($query_length> $total-$start){$query_length = $total-$start;}
        $keytable = array();
        for($i=0;$i<$query_length;$i++){
            $type="R";
            if(($i%7)==0) $type= "B";
            if(($i%5)==0) $type= "P";
            if(($i%11)==0) $type= "I";
    		$temp = array(
    			'KeyCode'=>(string)($start+($i+1)),
    			'KeyName'=>"key".(string)($start+($i+1)),
    			'KeyType'=>$type,
    			'HardwareCode'=>"xdsdsd",
    			'KeyProj'=>(string)($start%5),
    			'KeyProjName'=>"区域".(string)($start+$i),
				'KeyUser'=>"user",
    			'KeyUserName'=>"user",
    			'Memo'=>"备注".(string)($start+$i)
    		);
    		array_push($keytable,$temp);
        }
    	$retval=array(
    		'status'=>'true',
    		'start'=> (string)$start,
    		'total'=> (string)$total,
    		'length'=>(string)$query_length,
    		'ret'=> $keytable
    	);
    	$jsonencode = _encode($retval);
    	echo $jsonencode; break;
    case "KeyNew":
    /*var map={
        action:"KeyNew",
        KeyCode: key.KeyCode,
        KeyName:key.KeyName,
		KeyProj:key.KeyProj,
        KeyType:key.KeyType,
        HardwareCode:key.HardwareCode,
        Memo:key.Memo,
        user:usr.id
    };*/
    	$retval=array(
    		'status'=>'true',
    		'msg'=>''
    	);
        $jsonencode = _encode($retval);
    	echo $jsonencode; break;
	case "KeyMod":
    /*var map={
        action:"KeyMod",
        KeyCode: key.KeyCode,
        KeyName:key.KeyName,
		KeyProj:key.KeyProj,
        KeyType:key.KeyType,
        HardwareCode:key.HardwareCode,
        Memo:key.Memo,
        user:usr.id
    };*/
    	$retval=array(
    		'status'=>'true',
    		'msg'=>''
    	);
        $jsonencode = _encode($retval);
    	echo $jsonencode; break;
    case "KeyDel":
            /*var map={
                    action:"KeyDel",
                    'id'=>KeyId
                    'user'=>userid
                };*/
    	$retval=array(
    		'status'=>'true',
    		'msg'=>''
    	);
        $jsonencode = _encode($retval);
    	echo $jsonencode; break;
    case "DomainAuthlist":
    /*action:DomainAuthlist
      DomainCode:0
    */
        $DomainCode=$_GET['DomainCode'];
        $authlist = array();
        for($i=0;$i<5;$i++){
                    $temp = array(
                        'AuthId'=>(string)($i),
                        'DomainId'=>"区域".(string)($i),
                        'DomainName'=>"区域".(string)($i),
                        'KeyId'=>"钥匙".(string)($i),
                        'KeyName'=>"钥匙".(string)($i),
                        'UserId'=>"用户".(string)($i),
                        'UserName'=>"用户".(string)($i),
                        'AuthWay'=>"sssssss"
                    );
                    array_push($authlist,$temp);
        }
        $retval=array(
                    'status'=>'true',
                    'ret'=>$authlist
                );
                $jsonencode = _encode($retval);
                echo $jsonencode; break;
    case "KeyAuthlist":
        $keyid=$_GET['KeyId'];
        $authlist = array();
        for($i=0;$i<5;$i++){
            		$temp = array(
                        'AuthId'=>(string)($i),
                        'DomainId'=>"区域".(string)($i),
                        'DomainName'=>"区域".(string)($i),
                        'KeyId'=>"钥匙".(string)($i),
                        'KeyName'=>"钥匙".(string)($i),
                        'UserId'=>"用户".(string)($i),
                        'UserName'=>"用户".(string)($i),
                        'AuthWay'=>"sssssss"
            		);
            		array_push($authlist,$temp);
        }
        $retval=array(
                    'status'=>'true',
                    'ret'=>$authlist
                );
                $jsonencode = _encode($retval);
                echo $jsonencode; break;
    case "KeyGrant":
            /*action:KeyGrant
              KeyId:1
              UserId:none
              id:1234567*/
        	$retval=array(
        		'status'=>'true',
        		'msg'=>''
        	);
            $jsonencode = _encode($retval);
        	echo $jsonencode; break;
    case "KeyAuthNew":
        /*var map={
                    action:"KeyAuthNew",
                    'KeyId'=>keyid,
                    'DomainId'=>StatCode,
                    'AuthWay'=>"always",
					user:usr.id
                };*/
        $retval=array(
            'status'=>'true',
            'msg'=>''
        );
        $jsonencode = _encode($retval);
        echo $jsonencode; break;
	case "KeyAuthDel":
        /*var map={
                    action:"KeyAuthDel",
                    'AuthId'=>Authid,
					user:usr.id
                };*/
        $retval=array(
            'status'=>'true',
            'msg'=>''
        );
        $jsonencode = _encode($retval);
        echo $jsonencode; break;
    case "KeyHistory":
/*action:KeyHistory
  condition[ProjCode]:2
  condition[Time]:1
  condition[KeyWord]:asda
  id:1234567
    var condition = {
        ProjCode:Query_project,
        Time:Query_time,
        KeyWord:Query_word
    };
    var map={
        action:"KeyHistory",
        condition:"condition",
        id:usr.id
    };
        var retval={
            status:"true",
            ColumnName: column_name,
            TableData:row_content
        };*/
        $usr = $_GET["id"];
        $condition = $_GET["condition"];
    $column = 16;
    $row = 40;
    $column_name = array();
    $row_content = array();
    for( $i=0;$i<$column;$i++){
        array_push($column_name,"第".(string)($i+1)."列");
    }
    for($i=0;$i<$row;$i++){
        $one_row = array();
        array_push($one_row,(string)($i+1));
        array_push($one_row,"备注".(string)($i+1));
        for($j=0;$j<($column-6);$j++) array_push($one_row,rand(10,110));

        //one_row.push("地址"+(i+1)+"xxxxx路"+(i+1)+"xxxxx号");
        array_push($one_row,"地址".((string)($i+1))."xxxxx路".((string)($i+1))."xxxxx号");
        //one_row.push("测试");
        array_push($one_row,"测试");
        //one_row.push("名称");
        array_push($one_row,"名称");
        //one_row.push("长数据长数据长数据"+(i+1)+"xxxxx路"+(i+1)+"xxxxx号");
        array_push($one_row,"长数据长数据长数据".((string)($i+1))."xxxxx路".((string)($i+1))."xxxxx号");
        array_push($row_content,$one_row);
        //row_content.push(one_row);
    }
    $retval=array(
        'status'=>'true',
        'ColumnName'=> $column_name,
        'TableData'=>$row_content
    );
    $jsonencode = _encode($retval);
	echo $jsonencode; break;
	default:
	break;
}


?>