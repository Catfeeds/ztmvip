<?php
/**
 * 文件上传控制器
 * author: Tom
 */
namespace Computer\Controller;
class UploadFileController extends UserBaseController
{
    protected $_max_size = 5242880, //最大文件大小
        $_save_path = './Uploads/', //上传路径
        $upload_model,
        $_allow_exts = array( //允许上传的文件名
        'image' => array('png', 'jpg', 'jpeg', 'gif', 'bmp'),
        'zip' => array('zip', 'rar', '7z'),
        'doc' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'),
    );

    function _initialize()
    {
        parent::_initialize();
        $this->upload_model = D('UserUploadFile');
    }


    //上传文件
    public function upload($type = 'image', $topic = 'article')
    {
        if (IS_POST) {
            $state = array(
                'state' => true,
                'message' => '恭喜，上传成功'
            );

            try {
                if ($type == 'all') {
                    $allow_exts = array();

                    foreach ($this->_allow_exts as $val) {
                        $allow_exts = array_merge($allow_exts, $val);
                    }
                } elseif (!array_key_exists($type, $this->_allow_exts)) {
                    E('抱歉，禁止站外提交数据');
                } else {
                    $allow_exts = $this->_allow_exts[$type];
                }

                $config = array(
                    'maxSize' => $this->_max_size, //设置上传大小
                    'rootPath' => './Uploads/', //设置上传根目录
                    'exts' => $allow_exts, //设置上传类型
                    'subName' => array('date', 'Ymd'), //子目录创建方式
                );
                $upload = new \Think\Upload($config);// 实例化上传类

                if (!($info = $upload->upload())) {// 上传错误提示错误信息
                    E($upload->getError());
                } else {// 上传成功 获取上传文件信息
                    $info = array_shift($info);

                    $data = array(
                        'user_id' => $this->user_id,
                        'relation_topic' => 'userAvatar',
                        'file_size' => $info['size'],
                        'file_path' => substr($config['rootPath'], 1) . $info['savepath'],
                        'file_name' => $info['savename'],
                        'file_type' => $this->get_file_type($info['savename']),
                        'source_name' => $info['name'],
                        'date_add' => time(),
                    );

                    if (!$upfile_id = $this->upload_model->add($data)) {
                        unlink(realpath($info['savepath'] . $info['savename']));
                        E('抱歉，上传失败');
                    }

                    //删除当前用户没有关联id的文件
                    //找到用户上传没有用的图片，删掉
                    $avatar_file_arr = D('UserUploadFile')->field('file_path,file_name')
                        ->where(array('user_id' => $this->user_id, 'relation_topic' => 'userAvatar', 'relation_id' => 0, 'id' => array('neq', $upfile_id)))
                        ->select();

                    foreach ($avatar_file_arr as $key => $val) {
                        $file = '.' . $val['file_path'] . $val['file_name'];
                        if (is_file($file)) {
                            unlink($file);
                        }
                    }
                    D('UserUploadFile')->where(array('user_id' => $this->user_id, 'relation_topic' => 'userAvatar', 'relation_id' => 0, 'id' => array('neq', $upfile_id)))->delete();

                    $state['url'] = __ROOT__ . $data['file_path'] . $data['file_name'];
                    $state['title'] = $data['file_name'];
                    $state['original'] = $data['source_name'];
                    $state['type'] = $data['type'];
                    $state['size'] = $info['size'];
                    $state['upfile_id'] = $upfile_id;
                }
            } catch (\Think\Exception $e) {
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            if (ACTION_NAME == 'ueditor') {
                $state['state'] = $state['state'] ? 'SUCCESS' : $state['message'];
                $this->ajaxReturn($state);
            } else {
                $this->assign('state', json_encode($state));
            }
        }

        C('layout_on', false);
        $this->display();
    }

    //文件名截取文件类型
    private function get_file_type($file)
    {
        $ret = false;
        $ext = substr(strstr($file, '.'), 1);

        foreach ($this->_allow_exts as $key => $val) {
            if (in_array($ext, $val)) {
                $ret = $key;
                break;
            }
        }

        return $ret;
    }

}