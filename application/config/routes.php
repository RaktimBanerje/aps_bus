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
$route['default_controller'] = 'Loginc';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['dashboard']='Admin/dashboard';
$route['feesetup']='Admin/setup';
$route['feeinsert']='Admin/feeinc';
$route['admission']='Admin/studentadmission';
$route['ins-admission']='Admin/insertadmission';
$route['feeselect']='Admin/feesel';
$route['feedel/(:any)']='Admin/feedel/$1';
$route['feeedit/(:any)']='Admin/feeedit/$1';
$route['feeupd']='Admin/feeupd';
$route['selectadmission']='Admin/selectadmission';
$route['deleteadmission/(:any)']='Admin/deleteadmission/$1';
$route['editadmission/(:any)']='Admin/editadmissionfn/$1';
$route['updadmission']='Admin/updadmission';
$route['busfeereceipts']='Admin/busfeereceipts';
$route['ins-busfeereceipts']='Admin/insbusfeereceipts';
$route['showfeereceipt(/:num)?(/:num)?']='Admin/showfeereceipt';
$route['printreceipt/(:any)']='Admin/printreceipt/$1';
$route['printadmission/(:any)']='Admin/printadmission/$1';

$route['showdaybook']='Admin/showdaybook';
$route['day_book']='Admin/day_book';

$route['logincheck']="Loginc/logincheck";


$route['logout']="Loginc/logout";
$route['pendingfees']='Admin/pendingfees';


$route['busajax']='Admin/busreceivedajax';
$route['busajax1']='Admin/busreceivedajax1';
$route['fundtransfer']='Admin/fundtransfer';
$route['insfundtransfer']='Admin/insfundtransfer';
$route['list-fundtransfer']='Admin/fundtransfertable';
$route['fundtransferdata']='Admin/fundtransferdata';
$route['pendingfeesdownload']='Admin/pendingfeesdown';
$route['student_statement']='Admin/student_statement';
$route['sts_print']='Admin/sts_print';

$route['stdprint']='Admin/stdprint';
$route['pending-csv'] = 'Admin/pendingcsv';
$route['student-csv'] = 'Admin/studentscsv';
$route['student-payment-records-csv'] = 'Admin/studentPaymentRecordscsv';

$route["payment"]["GET"] = "PaymentController/create";
$route["payment/student/(:any)"]["GET"] = "PaymentController/show_student/$1";
$route["payment/store"]["POST"] = "PaymentController/store";
$route["payment/verify"]["POST"] = "PaymentController/verify";


$route["discount"]["GET"] = "Admin/student_list";
$route["updiscount"]["GET"] = "Admin/student_discount_update";
