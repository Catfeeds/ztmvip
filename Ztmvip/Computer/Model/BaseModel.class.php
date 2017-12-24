<?php
/**
 * 基础模型
 * author: Tom
 */
namespace Computer\Model;
class BaseModel extends \Think\Model\RelationModel
{
    public function next_primary(){
        $auto_increment = $this->table('information_schema.TABLES')
            ->where(array(
                'TABLE_SCHEMA' => $this->dbName?$this->dbName:C('DB_NAME'),
                'TABLE_NAME' => $this->trueTableName,
            ))->getField('auto_increment');
        return $auto_increment;
    }
}