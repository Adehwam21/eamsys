can you build a php project and make it work ?
this is all the code
 
<?php 
define('CURRENCY', '$'); 
define('WEB_URL', 'http:/manu/apartment/'); 
define('ROOT_PATH', 'C:\xampp\htdocs\manu\apartment/'); 
 
 
define('DB_HOSTNAME', 'localhost'); 
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', ''); 
define('DB_DATABASE', 'ams_db'); 
//$link = mysql_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD) or die(mysql_error());mysql_select_db(DB_DATABASE, $link) or die(mysql_error()); 
$connect = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE); 
 
2. Employee add code  
• <?php  
• include('../header.php'); 
• include('../utility/common.php'); 
• include(ROOT_PATH.'language/'.$lang_code_global.'/lang_add_employee.php'); 
• if(!isset($_SESSION['objLogin'])){ 
•  header("Location: ../logout.php"); 
•  die(); 
• } 
• $success = "none"; 
• $e_name = ''; 
• $e_email = ''; 
• $e_contact = ''; 
• $e_pre_address = ''; 
• $e_per_address = ''; 
• $e_nid = ''; 
• $e_designation = 0; 
• $e_date = ''; 
• $ending_date = ''; 
• $e_status = 0; 
• $e_password = ''; 
• $branch_id = ''; 
• $title = $_data['add_new_employee']; 
• $button_text = $_data['save_button_text']; 
• $successful_msg = $_data['added_employee_successfully']; 
• $form_url = WEB_URL . "employee/addemployee.php"; 
• $id=""; 
• $hdnid="0"; 
• $image_emp = WEB_URL . 'img/no_image.jpg'; 
• $img_track = ''; 
•  
• if(isset($_POST['txtEmpName'])){ 
•  if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){ 
•  $e_password = $_POST['txtPassword']; 
•  $image_url = uploadImage(); 
•  if(isset($_POST['chkEmpStaus'])){ 
•    $e_status = 1; 
•  } 
•  $sql = "INSERT INTO tbl_add_employee(e_name,e_email, e_contact, e_pre_address,e_per_address,e_nid,e_designation,e_date,ending_date,e_password,e_status,image,branch_id) values('$_POST[txtEmpName]','$_POST[txtEmpEmail]','$_POST[txtEmpContact]','$_POST[txtEmpPreAddress]','$_POST[txtEmpPerAddress]','$_POST[txtEmpNID]','$_POST[ddlMemberType]','$_POST[txtEmpDate]','$_POST[txtEndingDate]','$e_password','$e_status','$image_url','" . $_SESSION['objLogin']['branch_id'] . "')"; 
•  mysqli_query($connect,$sql); 
•  mysqli_close($link); 
•  $url = WEB_URL . 'employee/employeelist.php?m=add'; 
•  header("Location: $url"); 
•   
• } 
• else{ 
•  $image_url = uploadImage(); 
•  if($image_url == ''){ 
•   $image_url = $_POST['img_exist']; 
•  } 
•  if(isset($_POST['chkEmpStaus'])){ 
•    $e_status = 1; 
•  } 
•  $sql = "UPDATE tbl_add_employee SET e_name='".$_POST['txtEmpName']."',e_email='".$_POST['txtEmpEmail']."',e_password='".$_POST['txtPassword']."',e_contact='".$_POST['txtEmpContact']."',e_pre_address='".$_POST['txtEmpPreAddress']."',e_per_address='".$_POST['txtEmpPerAddress']."',e_nid='".$_POST['txtEmpNID']."',e_designation='".$_POST['ddlMemberType']."',e_date='".$_POST['txtEmpDate']."',ending_date='".$_POST['txtEndingDate']."',e_status='".$e_status."',image='".$image_url."' WHERE eid='".$_GET['id']."'"; 
•  mysqli_query($connect,$sql); 
•  $url = WEB_URL . 'employee/employeelist.php?m=up'; 
•  header("Location: $url"); 
• } 
•  
• $success = "block"; 
• } 
•  
• if(isset($_GET['id']) && $_GET['id'] != ''){ 
•  $result = mysqli_query($connect,"SELECT * FROM tbl_add_employee where eid = '" . $_GET['id'] . "'"); 
•  while($row = mysqli_fetch_array($result)){ 
•    
•   $e_name = $row['e_name']; 
•   $e_email = $row['e_email']; 
•   $e_contact = $row['e_contact']; 
•   $e_pre_address = $row['e_pre_address']; 
•   $e_per_address = $row['e_per_address']; 
•   $e_nid = $row['e_nid']; 
•   $e_designation = $row['e_designation']; 
•   $e_date = $row['e_date']; 
•   $ending_date = $row['ending_date']; 
•   $e_status = $row['e_status']; 
•   $e_password = $row['e_password']; 
•   if($row['image'] != ''){ 
•    $image_own = '../img/upload/' . $row['image']; 
•    $img_track = $row['image']; 
•   } 
•   $hdnid = $_GET['id'];

Webz, [11/24/2024 8:06 PM]
•   $title = $_data['update_employee']; 
•   $button_text =$_data['update_button_text']; 
•   $successful_msg="Update Employee Successfully"; 
•   $form_url =  "employee/addemployee.php?id=".$_GET['id']; 
•  } 
•   
•  //mysqli_close($link); 
•  
• } 
•  
• //for image upload 
• function uploadImage(){ 
•  if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) { 
•    $filename = basename($_FILES['uploaded_file']['name']); 
•    $ext = substr($filename, strrpos($filename, '.') + 1); 
•    if(($ext == "jpg" && $_FILES["uploaded_file"]["type"] == 'image/jpeg')  ($ext == "png" && $_FILES["uploaded_file"]["type"] == 'image/png')  ($ext == "gif" && $_FILES["uploaded_file"]["type"] == 'image/gif')){    
•     $temp = explode(".",$_FILES["uploaded_file"]["name"]); 
•     $newfilename = NewGuid() . '.' .end($temp); 
•   move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], ROOT_PATH . '/img/upload/' . $newfilename); 
•   return $newfilename; 
•    } 
•    else{ 
•     return ''; 
•    } 
•  } 
•  return ''; 
• } 
• function NewGuid() {  
•     $s = strtoupper(md5(uniqid(rand(),true)));  
•     $guidText =  
•         substr($s,0,8) . '-' .  
•         substr($s,8,4) . '-' .  
•         substr($s,12,4). '-' .  
•         substr($s,16,4). '-' .  
•         substr($s,20);  
•     return $guidText; 
• } 
•   
• ?> 
• <!-- Content Header (Page header) --> 
•  
• <section class="content-header"> 
•     <h1><?php echo $title;?></h1> 
•     <ol class="breadcrumb"> 
•         <li><a href="<?php echo WEB_URL?>/dashboard.php"><i 
•                     class="fa fa-dashboard"></i><?php echo $_data['home_breadcam'];?></a></li> 
•         <li class="active"><?php echo $_data['add_new_employee_information_breadcam'];?></li> 
•         <li class="active"><?php echo $_data['add_new_employee_breadcam'];?></li> 
•     </ol> 
• </section> 
• <!-- Main content --> 
• <section class="content"> 
•     <!-- Full Width boxes (Stat box) --> 
•     <div class="row"> 
•         <div class="col-md-12"> 
•             <div align="right" style="margin-bottom:1%;"> <a class="btn btn-primary" title="" data-toggle="tooltip" 
•                     href="../employee/employeelist.php" data-original-title="<?php echo $_data['back_text'];?>"><i 
•                         class="fa fa-reply"></i></a> </div> 
•             <div class="box box-danger"> 
•                 <div class="box-header"> 
•                     <h3 class="box-title"><?php echo $_data['add_new_employee_entry_form'];?></h3> 
•                 </div> 
•  
•                 <!-- /.box-body --> 
•             </div> 
•             <!-- /.box --> 
•         </div> 
•     </div> 
•     <!-- /.row --> 
•     <script type="text/javascript"> 
•     function validateMe() { 
•         if ($("#txtEmpName").val() == '') { 
•             alert("Employee Name Required !!!"); 
•             $("#txtEmpName").focus(); 
•             return false; 
•         } else if ($("#txtEmpEmail").val() == '') { 
•             alert("Email Required !!!"); 
•             $("#txtEmpEmail").focus(); 
•             return false; 
•         } else if ($("#txtPassword").val() == '') { 
•             alert("Password Required !!!"); 
•             $("#txtPassword").focus(); 
•             return false; 
•         } else if ($("#txtEmpContact").val() == '') { 
•             alert("Contact Number Required !!!"); 
•             $("#txtEmpContact").focus(); 
•             return false; 
•         } else if ($("#txtEmpPreAddress").val() == '') { 
•             alert("Present Address Required !!!"); 
•             $("#txtEmpPreAddress").focus(); 
•             return false; 
•         } else if ($("#txtEmpPerAddress").val() == '') { 
•             alert("Permanent Address Required !!!"); 
•             $("#txtEmpPerAddress").focus();

Webz, [11/24/2024 8:06 PM]
•             return false; 
•         } else if ($("#txtEmpNID").val() == '') { 
•             alert("NID Required !!!"); 
•             $("#txtEmpNID").focus(); 
•             return false; 
•         } else if ($("#ddlMemberType").val() == '') { 
•             alert("Designation Required !!!"); 
•             $("#ddlMemberType").focus(); 
•             return false; 
•         } else if ($("#txtEmpDate").val() == '') { 
•             alert("Joining Date Required !!!"); 
•             $("#txtEmpDate").focus(); 
•             return false; 
•         } else { 
•             return true; 
•         } 
•     } 
•     </script> 
•     <?php include('../footer.php'); ?> 
 
3. Table of employees  
4. ?php  
5. include('../header.php'); 
6. if(!isset($_SESSION['objLogin'])){ 
7.  header("Location: " . WEB_URL . "logout.php"); 
8.  die(); 
9. } 
10. ?> 
11. <?php 
12. include(ROOT_PATH.'language/'.$lang_code_global.'/lang_employee_list.php'); 
13. $delinfo = 'none'; 
14. $addinfo = 'none'; 
15. $msg = ""; 
16. if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){ 
17.  $sqlx= "DELETE FROM tbl_add_employee WHERE eid = ".$_GET['id']; 
18.  mysqli_query($connect,$sqlx);  
19.  $delinfo = 'block'; 
20. } 
21. if(isset($_GET['m']) && $_GET['m'] == 'add'){ 
22.  $addinfo = 'block'; 
23.  $msg = $_data['added_employee_successfully']; 
24. } 
25. if(isset($_GET['m']) && $_GET['m'] == 'up'){ 
26.  $addinfo = 'block'; 
27.  $msg = $_data['update_employee_successfully']; 
28. } 
29. ?> 
30. <!-- Content Header (Page header) --> 
31.  
32. <section class="content-header"> 
33.     <h1><?php echo $_data['employee_list'];?></h1> 
34.     <ol class="breadcrumb"> 
35.         <li><a href="<?php echo WEB_URL?>dashboard.php"><i 
36.                     class="fa fa-dashboard"></i><?php echo $_data['home_breadcam'];?></a></li> 
37.         <li class="active"><?php echo $_data['add_new_employee_information_breadcam'];?></li> 
38.         <li class="active"><?php echo $_data['employee_list'];?></li> 
39.     </ol> 
40. </section> 
41. <!-- Main content --> 
42. <section class="content"> 
43.     <!-- Full Width boxes (Stat box) --> 
44.     <div class="row"> 
45.         <div class="col-xs-12"> 
46.             <div id="me" class="alert alert-danger alert-dismissable" style="display:<?php echo $delinfo; ?>"> 
47.                 <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i 
48.                         class="fa fa-close"></i></button> 
49.                 <h4><i class="icon fa fa-ban"></i> <?php echo $_data['delete_text'];?> !</h4> 
50.                 <?php echo $_data['delete_employee_information'];?> 
51.             </div> 
52.             <div id="you" class="alert alert-success alert-dismissable" style="display:<?php echo $addinfo; ?>"> 
53.                 <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i 
54.                         class="fa fa-close"></i></button> 
55.                 <h4><i class="icon fa fa-check"></i><?php echo $_data['success'];?> !</h4> 
56.                 <?php echo $msg; ?> 
57.             </div> 
58.             <div align="right" style="margin-bottom:1%;"> <a class="btn btn-primary" data-toggle="tooltip" 
59.                     href="../employee/addemployee.php" 
60.                     data-original-title="<?php echo $_data['add_new_employee_breadcam'];?>"><i 
61.                         class="fa fa-plus"></i></a> <a class="btn btn-primary" data-toggle="tooltip" 
62.                     href="../dashboard.php" data-original-title="<?php echo $_data['home_breadcam'];?>"><i 
63.                         class="fa fa-dashboard"></i></a> 
64.             </div> 
65.             <div class="box box-danger"> 
66.                 <div class="box-header">

Webz, [11/24/2024 8:06 PM]
67.                     <h3 class="box-title"><?php echo $_data['employee_list'];?></h3> 
68.                 </div> 
69.                 <!-- /.box-header --> 
70.                 <div class="box-body"> 
71.                     <table class="table sakotable table-bordered table-striped dt-responsive"> 
72.                         <thead> 
73.                             <tr> 
74.                                 <th><?php echo $_data['imgage'];?></th> 
75.                                 <th><?php echo $_data['add_new_form_field_text_1'];?></th> 
76.                                 <th><?php echo $_data['add_new_form_field_text_2'];?></th> 
77.                                 <th><?php echo $_data['add_new_form_field_text_4'];?></th> 
78.                                 <th><?php echo $_data['add_new_form_field_text_8'];?></th> 
79.                                 <th><?php echo $_data['add_new_form_field_text_9'];?></th> 
80.                                 <th><?php echo $_data['action_text'];?></th> 
81.                             </tr> 
82.                         </thead> 
83.                         <tbody> 
84.                             <?php 
85.     $result = mysqli_query($connect,"SELECT *,mt.member_type FROM tbl_add_employee e inner join tbl_add_member_type mt where mt.member_id = e.e_designation and e.branch_id = " . (int)$_SESSION['objLogin']['branch_id'] . ""); 
86.     while($row = mysqli_fetch_array($result)){ 
87.      $image = WEB_URL . 'img/no_image.jpg';  
88.      if(file_exists(ROOT_PATH . '/img/upload/' . $row['image']) && $row['image'] != ''){ 
89.       $image = WEB_URL . 'img/upload/' . $row['image']; 
90.      } 
91.      
92.     ?> 
93.                             <tr> 
94.                                 <td><img class="photo_img_round" style="width:50px;height:50px;" 
95.                                         src="<?php echo $image;  ?>" /></td> 
96.                                 <td><?php echo $row['e_name']; ?></td> 
97.                                 <td><?php echo $row['e_email']; ?></td> 
98.                                 <td><?php echo $row['e_contact']; ?></td> 
99.                                 <td><?php echo $row['member_type']; ?></td> 
100.                                 <td><?php echo $row['e_date']; ?></td> 
101.                                 <td><a class="btn btn-success" data-toggle="tooltip" href="javascript:;" 
102.                                         onClick="$('#nurse_view_<?php echo $row['eid']; ?>').modal('show');" 
103.                                         data-original-title="<?php echo $_data['view_text'];?>"><i 
104.                                             class="fa fa-eye"></i></a> <a class="btn btn-primary" data-toggle="tooltip" 
105.                                         href="<?php echo WEB_URL;?>employee/addemployee.php?id=<?php echo $row['eid']; ?>" 
106.                                         data-original-title="<?php echo $_data['edit_text'];?>"><i 
107.                                             class="fa fa-pencil"></i></a> <a class="btn btn-danger" 
108.                                         data-toggle="tooltip" onClick="deleteEmployee(<?php echo $row['eid']; ?>);" 
109.                                         href="javascript:;" data-original-title="<?php echo $_data['delete_text'];?>"><i 
110.                                             class="fa fa-trash-o"></i></a> 
111.                                     <div id="nurse_view_<?php echo $row['eid']; ?>" class="modal fade" tabindex="-1" 
112.                                         role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
113.                                         <div class="modal-dialog"> 
114.                                             <div class="modal-content">

Webz, [11/24/2024 8:06 PM]
115.                                                 <div class="modal-header orange_header"> 
116.                                                     <button aria-label="Close" data-dismiss="modal" class="close" 
117.                                                         type="button"><span aria-hidden="true"><i 
118.                                                                 class="fa fa-close"></i></span></button> 
119.                                                     <h3 class="modal-title"><?php echo $_data['employee_details'];?> 
120.                                                     </h3> 
121.                                                 </div> 
122.                                                 <div class="modal-body model_view" align="center">&nbsp; 
123.                                                     <div><img class="photo_img_round" style="width:100px;height:100px;" 
124.                                                             src="<?php echo $image;  ?>" /></div> 
125.                                                     <div class="model_title"><?php echo $row['e_name']; ?></div> 
126.                                                 </div> 
127.                                                 <div class="modal-body"> 
128.                                                     <h3 style="text-decoration:underline;"> 
129.                                                         <?php echo $_data['details_information'];?></h3> 
130.                                                     <div class="row"> 
131.                                                         <div class="col-xs-12"> 
132.                                                             <b><?php echo $_data['add_new_form_field_text_1'];?> :</b> 
133.                                                             <?php echo $row['e_name']; ?><br /> 
134.                                                             <b><?php echo $_data['add_new_form_field_text_2'];?> :</b> 
135.                                                             <?php echo $row['e_email']; ?><br /> 
136.                                                             <b><?php echo $_data['add_new_form_field_text_3'];?> :</b> 
137.                                                             <?php echo $row['e_password']; ?><br /> 
138.                                                             <b><?php echo $_data['add_new_form_field_text_4'];?> :</b> 
139.                                                             <?php echo $row['e_contact']; ?><br /> 
140.                                                             <b><?php echo $_data['add_new_form_field_text_5'];?> :</b> 
141.                                                             <?php echo $row['e_pre_address']; ?><br /> 
142.                                                             <b><?php echo $_data['add_new_form_field_text_6'];?> :</b> 
143.                                                             <?php echo $row['e_per_address']; ?><br /> 
144.                                                             <b><?php echo $_data['add_new_form_field_text_7'];?> :</b> 
145.                                                             <?php echo $row['e_nid']; ?><br /> 
146.                                                             <b><?php echo $_data['add_new_form_field_text_8'];?> :</b> 
147.                                                             <?php echo $row['member_type']; ?><br /> 
148.                                                             <b><?php echo $_data['add_new_form_field_text_9'];?> :</b> 
149.                                                             <?php echo $row['e_date']; ?><br /> 
150.                                                         </div> 
151.                                                     </div>

Webz, [11/24/2024 8:06 PM]
152.                                                 </div> 
153.                                             </div> 
154.                                             <!-- /.modal-content --> 
155.                                         </div> 
156.                                     </div> 
157.                                 </td> 
158.                             </tr> 
159.                             <?php } mysqli_close($connect); ?> 
160.                         </tbody> 
161.                     </table> 
162.                 </div> 
163.                 <!-- /.box-body --> 
164.             </div> 
165.             <!-- /.box --> 
166.         </div> 
167.         <!-- /.col --> 
168.     </div> 
169.     <!-- /.row --> 
170.     <script type="text/javascript"> 
171.     function deleteEmployee(Id) { 
172.         var iAnswer = confirm("Are you sure you want to delete this Employee ?"); 
173.         if (iAnswer) { 
174.             window.location = '../employee/employeelist.php?id=' + Id; 
175.         } 
176.     } 
177.  
178.     $(document).ready(function() { 
179.         setTimeout(function() { 
180.             $("#me").hide(300); 
181.             $("#you").hide(300); 
182.         }, 3000); 
183.     }); 
184.     </script> 
185.     <?php include('../footer.php'); ?>
