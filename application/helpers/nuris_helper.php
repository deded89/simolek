<?php
function cmb_dinamis($name,$table,$field,$pk,$selected){
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control'>";
    $data = $ci->db->get($table)->result();
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  ($d->$field)."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

function cmb_dinamiss2($name,$table,$field,$pk,$selected){
    $ci = get_instance();
    $cmb = "<select name='$name' id='$name' class='form-control select2' style='width: 100%'>";
    $data = $ci->db->get($table)->result();
	$cmb .= "<option></option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  ($d->$field)."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

function cmb_db2($name,$table,$field,$pk,$selected){
    $ci = get_instance();
    $ci->db2 = $ci->load->database('db2',TRUE);
    $cmb = "<select name='$name' id='$name' class='form-control select2' style='width: 100%'>";
    $data = $ci->db2->get($table)->result();
	$cmb .= "<option></option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  ($d->$field)."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}


function cmb_dinamiss3($name,$table,$field,$pk,$selected,$w1,$w2,$sort){
    $ci = get_instance();
    $cmb = "<select name='$name' id='$name' class='form-control select2' style='width: 100%'>";
	if ($ci->ion_auth->in_group('admin')) {
		$ci->db->select('*');
		$ci->db->from($table);
	}
	if (!$ci->ion_auth->in_group('admin')) {
		$ci->db->select('*');
		$ci->db->from($table);
		$ci->db->where($w1,$ci->session->userdata($w2));
		$ci->db->order_by($sort,'desc');
	}

    $data = $ci->db->get()->result();
	$cmb .= "<option></option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  ($d->$field)."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

function cmb_list_laporan(){
    $ci = get_instance();
    $cmb = "<select name='id_lap' id='id_lap' class='form-control select2' style='width: 100%'>";
	//if ($ci->ion_auth->in_group('admin')) {
		$ci->db->select('*');
		$ci->db->from('laporan');
		$ci->db->order_by('id_lap','desc');
	/* }else{
	if (!$ci->ion_auth->in_group('admin')) {
		$ci->db->select('*');
		$ci->db->from('laporan l');
		$ci->db->where('l.id_skpd',$ci->session->userdata('id_skpd'));
		$ci->db->or_where('p.id_skpd',$ci->session->userdata('id_skpd'));
		$ci->db->join('pelaporan p', 'l.id_lap=p.id_lap', 'left');
		$ci->db->group_by('l.id_skpd');
		$ci->db->order_by('id_lap','desc');
	}
	} */
    $data = $ci->db->get()->result();
	$cmb .= "<option></option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->id_lap."'";
        $cmb .= 'id_lap'==$d->id_lap?" selected='selected'":'';
        $cmb .=">".  ($d->nama_lap)."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}
