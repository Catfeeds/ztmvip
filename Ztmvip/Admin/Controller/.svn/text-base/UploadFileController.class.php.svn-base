<?php
/**
 * 文件上传控制器
 * author: Tom
 */
namespace Admin\Controller;
class UploadFileController extends BaseController
{
    protected $_max_size = 209715200, //最大文件大小
        $_save_path = './Uploads/', //上传路径
        $upload_model,
        $_allow_exts = array( //允许上传的文件名
        'image' => array('png', 'jpg', 'jpeg', 'gif', 'bmp'),
        'zip' => array('zip','rar','7z'),
        'doc' => array('doc','docx','xls','xlsx','ppt','pptx','txt'),
    );

    function _initialize(){
        parent::_initialize();
        $this->upload_model = D('UploadFile');
    }

    //百度编辑器配置
    public function ueditor(){
        $get = I('get.','','trim');

        switch ( $get['action'] ){
            case 'config':
                layout(false);
                $this->display();
                break;
            case 'uploadimage':
                $this->upload('image',$get['topic']);
                break;
            case 'uploadfile':
                $this->upload('all',$get['topic']);
                break;
            case 'listimage':
                $this->lists('image');
                break;
            case 'listfile':
                $this->lists();
                break;
        }
    }

    //上传文件
    public function upload($type='image',$topic='article'){
        if ( IS_POST ){
            $state = array(
                'state' => true,
                'message' => '恭喜，上传成功'
            );

            try{
                if ( $type == 'all' ){
                    $allow_exts = array();

                    foreach ( $this->_allow_exts as $val ) {
                        $allow_exts = array_merge($allow_exts, $val);
                    }
                }elseif ( !array_key_exists($type,$this->_allow_exts) ){
                    E('抱歉，禁止站外提交数据');
                }else{
                    $allow_exts = $this->_allow_exts[$type];
                }

                $config = array(
                    'maxSize' => $this->_max_size, //设置上传大小
                    'rootPath' => './Uploads/', //设置上传根目录
                    'exts' => $allow_exts, //设置上传类型
                    'subName' => array('date','Ymd'), //子目录创建方式
                );
                $upload = new \Think\Upload($config);// 实例化上传类

                if ( !($info = $upload->upload()) ){// 上传错误提示错误信息
                    E($upload->getError());
                }else{// 上传成功 获取上传文件信息
                    $info = array_shift($info);

                    $data = array(
                        'file_path' => substr($config['rootPath'],1) . $info['savepath'],
                        'file_name' => $info['savename'],
                        'file_type' => $this->get_file_type($info['savename']),
                        'source_name' => $info['name'],
                        'date_add' => time(),
                    );

                    if ( !$this->upload_model->add($data) ){
                        unlink(realpath($info['savepath'] . $info['savename']));
                        E('抱歉，上传失败');
                    }

                    $state['url'] = __ROOT__ . $data['file_path'] . $data['file_name'];
                    $state['title'] = $data['file_name'];
                    $state['original'] = $data['source_name'];
                    $state['type'] = $data['type'];
                    $state['size'] = $info['size'];
                }
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            if ( ACTION_NAME == 'ueditor' ){
                $state['state'] = $state['state'] ? 'SUCCESS' : $state['message'];
                $this->ajaxReturn($state);
            }else{
                $this->assign('state',json_encode($state));
            }
        }

        C('layout_on',false);
        $this->display();
    }

    //文件列表
    public function lists($type=null){
        $get = I('get.','','trim,htmlspecialchars');

        $map = array(
        );

        if ( $type )
            $map['file_type'] = $type;

        if ( ACTION_NAME == 'ueditor' )
            C('VAR_PAGE','start');

        $count = $this->upload_model->where($map)->count();
        $page = $this->page($count,28);
        $list = $this->upload_model->where($map)->order('id DESC')->limit($page->firstRow.','.$page->listRows)->select();

        if ( ACTION_NAME == 'ueditor' ){
            foreach ( $list as &$val ){
                $val = array(
                    'url' => __ROOT__ . $val['file_path'] . $val['file_name'],
                    'mtime' => $val['create_time']
                );
            }

            $this->ajaxReturn(array(
                'state' => 'SUCCESS',
                'list' => $list,
                'start' => $get['start'],
                'total' => $count,
            ));
        }else{
            $this->assign('list',$list);

            C('layout_on',false);
            $this->display();
        }
    }

    //文件名截取文件类型
    private function get_file_type($file){
        $ret = false;
        $ext = substr(strstr($file,'.'),1);

        foreach ( $this->_allow_exts as $key => $val ){
            if ( in_array($ext,$val) ){
                $ret = $key;
                break;
            }
        }

        return $ret;
    }
}