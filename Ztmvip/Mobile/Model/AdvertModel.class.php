<?php
/**
 * 广告模型
 * author: Tom
 */
namespace Mobile\Model;
class AdvertModel extends BaseModel
{
    /**
     * 获取广告列表
     * @param $topic 广告主题
     * @return mixed
     */
    public function advert_list($topic,$offset=0,$pagesize=10000)
    {
        return $this->where(array('topic' => $topic,'disabled' => 'N'))->limit($offset.','.$pagesize)->order('rank desc')->select();
    }
}