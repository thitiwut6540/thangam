<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Main';
$route['404_override'] = 'PageError';
$route['translate_uri_dashes'] = FALSE;

$route['แกลลอรี่ทั้งหมด'] = 'Gallery';
$route['แกลลอรี่/(:any)'] = 'Gallery/หน่วยงาน/$1';
$route['แกลลอรี่/(:any)/(:any)'] = 'Gallery/รายการ/$1';

$route['ข่าวสารทั้งหมด'] = 'News';
$route['ข่าวสาร/(:any)'] = 'News/ประเภท/$1';
$route['ข่าวสาร/(:any)/(:any)'] = 'News/รายการ/$1';


// backoffice

$route['backoffice/tab/(:any)'] = 'Backoffice';

$route['backoffice/สิทธิการใช้งาน/edit/(:any)'] = 'B_Accesstype/accesstype_edit';
$route['backoffice/สิทธิการใช้งาน'] = 'B_Accesstype';

$route['backoffice/ผู้ใช้งานระบบ/edit/(:any)'] = 'B_User/user_edit';
$route['backoffice/ผู้ใช้งานระบบ/insert'] = 'B_User/user_insert';
$route['backoffice/ผู้ใช้งานระบบ'] = 'B_User';

$route['backoffice/สไลด์โชว์/edit/(:any)'] = 'B_Banner_main/banner_edit';
$route['backoffice/สไลด์โชว์/insert'] = 'B_Banner_main/banner_insert';
$route['backoffice/สไลด์โชว์'] = 'B_Banner_main';

$route['backoffice/ภาพแสดงหน้าแรก/edit/(:any)'] = 'B_Banner_popup/banner_edit';
$route['backoffice/ภาพแสดงหน้าแรก/insert'] = 'B_Banner_popup/banner_insert';
$route['backoffice/ภาพแสดงหน้าแรก'] = 'B_Banner_popup';

$route['backoffice/ภาพประกาศ/edit/(:any)'] = 'B_Banner_top/banner_edit';
$route['backoffice/ภาพประกาศ/insert'] = 'B_Banner_top/banner_insert';
$route['backoffice/ภาพประกาศ'] = 'B_Banner_top';

$route['backoffice/ปุ่มลิงค์หน่วยงาน/edit/(:any)'] = 'B_Link_depart/linkdepart_edit';
$route['backoffice/ปุ่มลิงค์หน่วยงาน/insert'] = 'B_Link_depart/linkdepart_insert';
$route['backoffice/ปุ่มลิงค์หน่วยงาน'] = 'B_Link_depart';

$route['backoffice/ปุ่มลิงค์เมนู/edit/(:any)'] = 'B_Link_menu/linkmenu_edit';
$route['backoffice/ปุ่มลิงค์เมนู/insert'] = 'B_Link_menu/linkmenu_insert';
$route['backoffice/ปุ่มลิงค์เมนู'] = 'B_Link_menu';

$route['backoffice/ข้อมูลเทศบาล'] = 'B_Info';
$route['backoffice/เกี่ยวกับเทศบาล'] = 'B_Info/info_main/เกี่ยวกับเทศบาล';
$route['backoffice/สภาพทั่วไป'] = 'B_Info/info_main/สภาพทั่วไป';
$route['backoffice/วิสัยทัศน์และพันธกิจ'] = 'B_Info/info_main/วิสัยทัศน์และพันธกิจ';
$route['backoffice/โครงสร้างองค์กร'] = 'B_Info/info_main/โครงสร้างองค์กร';
$route['backoffice/อัตรากำลัง'] = 'B_Info/info_main/อัตรากำลัง';
$route['backoffice/อำนาจหน้าที่'] = 'B_Info/info_main/อำนาจหน้าที่';
$route['backoffice/การติดต่อ'] = 'B_Info/info_main/การติดต่อ';
$route['backoffice/แผนที่'] = 'B_Info/info_main/แผนที่';


$route['backoffice/หน่วยงานภายใน/edit/(:any)'] = 'B_Department/department_edit';
$route['backoffice/หน่วยงานภายใน/insert'] = 'B_Department/department_insert';
$route['backoffice/หน่วยงานภายใน'] = 'B_Department/department';

$route['backoffice/โครงการ/edit/(:any)'] = 'B_Department/department_edit';
$route['backoffice/โครงการ/insert'] = 'B_Department/department_insert';
$route['backoffice/โครงการ'] = 'B_Department/department';

$route['backoffice/หน่วยงานในสังกัด/edit/(:any)'] = 'B_Department/department_edit';
$route['backoffice/หน่วยงานในสังกัด/insert'] = 'B_Department/department_insert';
$route['backoffice/หน่วยงานในสังกัด'] = 'B_Department/department';

$route['backoffice/บุคลากร/(:any)/edit/(:any)'] = 'B_Member/member_edit/$1/$2';
$route['backoffice/บุคลากร/(:any)/insert'] = 'B_Member/member_insert/$1';
$route['backoffice/บุคลากร/(:any)/(:any)/edit/(:any)'] = 'B_Member/member_edit/$1/$2/$3';
$route['backoffice/บุคลากร/(:any)/(:any)/insert'] = 'B_Member/member_insert/$1/$2';
$route['backoffice/บุคลากร/(:any)/(:any)'] = 'B_Member/member_depart/$1/$2';
$route['backoffice/บุคลากร/(:any)'] = 'B_Member/member/$1';

$route['backoffice/สถานที่สำคัญ/ประเภท'] = 'B_Landmark/type';
$route['backoffice/สถานที่สำคัญ/edit/(:any)'] = 'B_Landmark/land_edit';
$route['backoffice/สถานที่สำคัญ/insert'] = 'B_Landmark/land_insert';
$route['backoffice/สถานที่สำคัญ'] = 'B_Landmark/land';

$route['backoffice/สินค้าโอทอป/edit/(:any)'] = 'B_Otop/otop_edit';
$route['backoffice/สินค้าโอทอป/insert'] = 'B_Otop/otop_insert';
$route['backoffice/สินค้าโอทอป'] = 'B_Otop';

$route['backoffice/แกลเลอรี่ภาพ/(:any)/edit/(:any)'] = 'B_Gallery/gallery_edit';
$route['backoffice/แกลเลอรี่ภาพ/(:any)/insert'] = 'B_Gallery/gallery_insert';
$route['backoffice/แกลเลอรี่ภาพ/(:any)'] = 'B_Gallery/gallery';
$route['backoffice/แกลเลอรี่ภาพ'] = 'B_Gallery';

$route['backoffice/ข่าวสาร/ประเภทข่าวสาร'] = 'B_News/type';
$route['backoffice/ข่าวสาร/(:any)/edit/(:any)'] = 'B_News/news_edit';
$route['backoffice/ข่าวสาร/(:any)/insert'] = 'B_News/news_insert';
$route['backoffice/ข่าวสาร/(:any)/(:any)'] = 'B_News/news';
$route['backoffice/ข่าวสาร/(:any)'] = 'B_News/news';

$route['backoffice/กฎหมายและระเบียบ/ประเภท'] = 'B_Statute/type';
$route['backoffice/กฎหมายและระเบียบ/(:any)/edit/(:any)'] = 'B_Statute/statute_edit';
$route['backoffice/กฎหมายและระเบียบ/(:any)/insert'] = 'B_Statute/statute_insert';
$route['backoffice/กฎหมายและระเบียบ/(:any)'] = 'B_Statute/statute';

$route['backoffice/แผนงาน/ประเภท'] = 'B_Roadmap/type';
$route['backoffice/แผนงาน/(:any)/edit/(:any)'] = 'B_Roadmap/roadmap_edit';
$route['backoffice/แผนงาน/(:any)/insert'] = 'B_Roadmap/roadmap_insert';
$route['backoffice/แผนงาน/(:any)'] = 'B_Roadmap/roadmap';

$route['backoffice/ผลการดำเนินงาน/(:any)/edit/(:any)'] = 'B_Performance/performance_edit';
$route['backoffice/ผลการดำเนินงาน/(:any)/insert'] = 'B_Performance/performance_insert';
$route['backoffice/ผลการดำเนินงาน/(:any)/(:any)'] = 'B_Performance/performance';
$route['backoffice/ผลการดำเนินงาน/(:any)'] = 'B_Performance/performance';
$route['backoffice/ผลการดำเนินงาน'] = 'B_Performance/performance';

$route['backoffice/ถามและตอบ/edit/(:any)'] = 'B_Qa/qa_edit';
$route['backoffice/ถามและตอบ/insert'] = 'B_Qa/qa_insert';
$route['backoffice/ถามและตอบ'] = 'B_Qa';

$route['backoffice/เอกสารบริการประชาชน/ประเภท'] = 'B_Document/type';
$route['backoffice/เอกสารบริการประชาชน/(:any)/edit/(:any)'] = 'B_Document/document_edit';
$route['backoffice/เอกสารบริการประชาชน/(:any)/insert'] = 'B_Document/document_insert';
$route['backoffice/เอกสารบริการประชาชน/(:any)/(:any)'] = 'B_Document/document';
$route['backoffice/เอกสารบริการประชาชน/(:any)'] = 'B_Document/document';
$route['backoffice/เอกสารบริการประชาชน'] = 'B_Document/document';

$route['backoffice/ร้องเรียนทุจริตและประพฤติมิชอบ'] = 'B_Corrupt';
$route['backoffice/ร้องเรียนทุจริตและประพฤติมิชอบ/(:any)'] = 'B_Corrupt';
$route['backoffice/ร้องเรียนทุจริตและประพฤติมิชอบ/(:any)/ดำเนินการ/(:any)'] = 'B_Corrupt/corrupt_action';

$route['backoffice/ร้องเรียนร้องทุกข์/ประเภท'] = 'B_Complain/type';
$route['backoffice/ร้องเรียนร้องทุกข์'] = 'B_Complain';
$route['backoffice/ร้องเรียนร้องทุกข์/(:any)'] = 'B_Complain';
$route['backoffice/ร้องเรียนร้องทุกข์/(:any)/ดำเนินการ/(:any)'] = 'B_Complain/complain_action';

$route['backoffice/ขอรับบริการออนไลน์/ประเภท'] = 'B_Service/type';
$route['backoffice/ขอรับบริการออนไลน์'] = 'B_Service';
$route['backoffice/ขอรับบริการออนไลน์/รับเรื่อง'] = 'B_Service';
$route['backoffice/ร้องเรียนร้องทุกข์/(:any)/รายละเอียด/(:any)'] = 'B_Service/service_detail';

$route['backoffice/ผลสำรวจความพึงพอใจ'] = 'B_Research';
$route['backoffice/ผลสำรวจความพึงพอใจ/รายการผู้กรอกแบบสำรวจ'] = 'B_Research/list';
$route['backoffice/ผลสำรวจความพึงพอใจ/รายการผู้กรอกแบบสำรวจ/(:any)'] = 'B_Research/detail';

$route['backoffice/webboard'] = 'B_Webboard/webboard';
$route['backoffice/webboard/เพิ่มหัวข้อใหม่'] = 'B_Webboard/webboard_topic_new';
$route['backoffice/webboard/แก้ไขหัวข้อ/(:any)'] = 'B_Webboard/webboard_topic_edit';
$route['backoffice/webboard/topic/(:any)/สร้างหัวข้อย่อย'] = 'B_Webboard/webboard_sub_new';
$route['backoffice/webboard/topic/(:any)/แก้ไขหัวข้อย่อย/(:any)'] = 'B_Webboard/webboard_sub_edit';

$route['backoffice/webboard/topic/(:any)'] = 'B_Webboard/webboard_detail';
$route['backoffice/webboard/topic/(:any)/subtopics/(:any)'] = 'B_Webboard/webboard_detail_sub';

$route['backoffice/ita'] = 'B_Ita/ita_year';
$route['backoffice/ita/รายการประเมินประจำปี'] = 'B_Ita/ita_year';
$route['backoffice/ita/รายการประเมินประจำปี/(:any)'] = 'B_Ita/ita_year_detail';
$route['backoffice/ita/สร้างประเมินประจำปี'] = 'B_Ita/ita_new';

$route['backoffice/lpa'] = 'B_Lpa';
$route['backoffice/lpa/เพิ่มรายการ'] = 'B_Lpa/lpa_new';

$route['backoffice/ทําเนียบ/(:any)/edit/(:any)'] = 'B_History/history_edit';
$route['backoffice/ทําเนียบ/(:any)/insert'] = 'B_History/history_insert';
$route['backoffice/ทําเนียบ/(:any)'] = 'B_History';

$route['backoffice/สมุดลงนาม/รายละเอียด/(:any)'] = 'B_Signbook/signbook_detail';
$route['backoffice/สมุดลงนาม/edit/(:any)'] = 'B_Signbook/signbook_edit';
$route['backoffice/สมุดลงนาม/insert'] = 'B_Signbook/signbook_insert';
$route['backoffice/สมุดลงนาม'] = 'B_Signbook';



