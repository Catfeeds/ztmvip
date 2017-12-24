<?php
/**
 * 检查用户权限
 * @param $rights 要检查的权限
 * @param bool|true $redirect 是否跳转登录页
 * @return bool 是否拥有权限
 */
function check_admin_rights($rights,$redirect=true){
    $ret = false;

    if ( session('manager.rights') == 'all' || stripos(','. session('manager.rights') .',', ','. $rights .',') !== false )
        $ret = true;

    if ( $redirect && !$ret ){
        if ( IS_AJAX ){
            ob_clean();
            echo json_encode(array(
                'state' => false,
                'message' => '权限不足',
            ));
            exit;
        }else{
            redirect(U('Login/index'));
        }
    }elseif ( !$redirect ){
        return $ret;
    }
}