<?php 
use App\SettingGeneral;
use App\RoleModel;
use App\TrainingBooking;
use App\Notifikasi;
use App\User;
use App\Blog;
use App\Contact;
use App\Page;
use App\Testimonial;



function AppName(){
	$data = SettingGeneral::select('value')->where('name','app_name')->first();
	return $data->value;
}

function AppLogo(){
    $data = SettingGeneral::select('value')->where('name','logo')->first();
    return $data->value;
}


function AppFutureImageDefault(){
    $data = SettingGeneral::select('value')->where('name','future_image')->first();
    return $data->value;
}


function phone_link(){
    $data = SettingGeneral::select('value')->where('name','phone_link')->first();
    return $data->value;
}

function office_address(){
    $data = SettingGeneral::select('value')->where('name','office_address')->first();
    return $data->value;
}




function getSetting(){
    $get_setting = SettingGeneral::where('status',1)->get();


    $data =[];
    foreach($get_setting as $r){
        $data[$r['name']] = $r['value'];
    }
    return $data;

    
}


function FrontAppTitle(){
    $data = SettingGeneral::select('value')->where('name','front_app_title')->first();
    return $data->value;
}


function AppThemeDashboard(){
    $data = SettingGeneral::select('value')->where('name','dashboard_mode')->first();
    return $data->value;
}

function AppThemeSidebar(){
    $data = SettingGeneral::select('value')->where('name','sidebar_mode')->first();
    return $data->value;
}

function AppThemeBoxes(){
    $data = SettingGeneral::select('value')->where('name','dashboard_boxed')->first();
    return $data->value;
}

function UserRole(){
        $user = auth()->user();
        $roles = RoleModel::pluck('name','name')->all();
        return $userRole = $user->roles->pluck('deskripsi')->first();
}


function imploadValue($types){
	$strTypes = implode(",", $types);
	return $strTypes;
}

	function explodeValue($types){
	$strTypes = explode(",", $types);
	return $strTypes;
}

function random_code(){

	return rand(1111, 9999);
}

function remove_special_char($text) {

    $t = $text;

    $specChars = array(
        ' ' => '-',    '!' => '',    '"' => '',
        '#' => '',    '$' => '',    '%' => '',
        '&amp;' => '',    '\'' => '',   '(' => '',
        ')' => '',    '*' => '',    '+' => '',
        ',' => '',    '₹' => '',    '.' => '',
        '/-' => '',    ':' => '',    ';' => '',
        '<' => '',    '=' => '',    '>' => '',
        '?' => '',    '@' => '',    '[' => '',
        '\\' => '',   ']' => '',    '^' => '',
        '_' => '',    '`' => '',    '{' => '',
        '|' => '',    '}' => '',    '~' => '',
        '-----' => '-',    '----' => '-',    '---' => '-',
        '/' => '',    '--' => '-',   '/_' => '-',   
         
    );

    foreach ($specChars as $k => $v) {
        $t = str_replace($k, $v, $t);
    }

    return $t;
}

function arrStatusActive() {
    return array(1 => __('main.active'), 0 => __('main.inactive'));
}

function arrStatusPublihs() {
    return array('publish' => 'publish', 'draft' => 'draft');
}


function arrTypeTraining(){
    return array('reguler' => 'Reguler', 'non_reguler' => 'Non Reguler');
}

function arrTarget() {
    return array('1' => '_self', '2' => '_blank');
}

function orientate($image, $orientation)
{
    switch ($orientation) {

        // 888888
        // 88
        // 8888
        // 88
        // 88
        case 1:
            return $image;

        // 888888
        //     88
        //   8888
        //     88
        //     88
        case 2:
            return $image->flip('h');


        //     88
        //     88
        //   8888
        //     88
        // 888888
        case 3:
            return $image->rotate(180);

        // 88
        // 88
        // 8888
        // 88
        // 888888
        case 4:
            return $image->rotate(180)->flip('h');

        // 8888888888
        // 88  88
        // 88
        case 5:
            return $image->rotate(-90)->flip('h');

        // 88
        // 88  88
        // 8888888888
        case 6:
            return $image->rotate(-90);

        //         88
        //     88  88
        // 8888888888
        case 7:
            return $image->rotate(-90)->flip('v');

        // 8888888888
        //     88  88
        //         88
        case 8:
            return $image->rotate(90);

        default:
            return $image;
    }
}

function arrMonth($locale) {
    if ($locale == 'id') {
        return array(1 => 'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember');
    } elseif ($locale == 'zh') {
        return array(1 => '一月', 2=>'二月', 3=>'游行', 4=>'四月', 5=>'可能', 6=>'六月', 7=>'七月', 8=>'八月', 9=>'九月', 10=>'十月', 11=>'十一月', 12=>'十二月');
    } elseif ($locale == 'en') {
        return array(1 => 'January', 2=>'February', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'August', 9=>'September', 10=>'October', 11=>'November', 12=>'December');
    }
}

function setUrlSlug($kata){
    $new_string = strip_tags(trim($kata));
    $new_string1 = preg_replace("/[^a-zA-Z0-9-_\s]/", "", $new_string);
    $new_string2 = urlencode($new_string1);
    $new_string3 = str_replace('+','-',$new_string2);
    $new_string4 = str_replace('--','-',$new_string3);

    return strtolower($new_string4);
}


function issetOr($arr, $key)
{
    if (isset($arr[$key])) {
        return $arr[$key];
    } else {
        return null;
    }
}


function rupiah($angka){
    
    $hasil_rupiah = number_format($angka,2,',','.');
    return $hasil_rupiah;

}


function countPaymentPending(){

    $count = TrainingBooking::where('status_booking','reg')
            ->whereNotNull('bukti_transfer')
            ->count();

    return $count;

}


function getNotifikasi(){

    $user = auth()->user();


    $get_notifikasi = Notifikasi::where('id_user',$user->id)
                    ->where('status','un_read')
                    ->count();

    return $get_notifikasi;


}


function formatDate($date){
    
    return $newDate = date("d-M-Y", strtotime($date));

}

function formatDateJadwal($date){
    
    return $newDate = date("d-F-Y", strtotime($date));

}


function formatDateTime($date){
    
    return $newDate = date("d-M-Y h:i:s", strtotime($date));

}



function formatHariJadwal($date){

    $hari = date("D", strtotime($date));
    switch($hari){
        case 'Sun':
            $hari_ini = "Minggu";
        break;
 
        case 'Mon':         
            $hari_ini = "Senin";
        break;
 
        case 'Tue':
            $hari_ini = "Selasa";
        break;
 
        case 'Wed':
            $hari_ini = "Rabu";
        break;
 
        case 'Thu':
            $hari_ini = "Kamis";
        break;
 
        case 'Fri':
            $hari_ini = "Jumat";
        break;
 
        case 'Sat':
            $hari_ini = "Sabtu";
        break;
        
        default:
            $hari_ini = "Tidak di ketahui";     
        break;
    }

    return $hari_ini;

}




function TotalMembers(){

    $roles = RoleModel::pluck('name', 'id')->toArray();  

    $total_members = User::select([
        'id',
        'name',
        'email',
        'status',
        'created_at'
    ])->whereHas('roles', function ($query) use($roles) {
        $query->where('name','=', 'members');
        return $query;
        
    })->count();


    return $total_members;
}




function recent_post(){
    $blogs_all = Blog::select('id', 'published_on', 'slug', 'image')
            ->where('status',1)
            ->orderBy('published_on','DESC')
            ->limit(3)
            ->get();
    return $blogs_all;
}






function getCountInbox(){

    $get_inbox = Contact::where('status_read','N')->count();

    return $get_inbox;

}








