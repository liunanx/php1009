<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/14
 * Time: 21:27
 */

namespace Admin\Model;


use Admin\Model\DbMysqlInterfaceModel;

class DbMysqlInterfaceImplModel implements DbMysqlInterfaceModel
{
    public function connect()
    {
        // TODO: Implement connect() method.
        echo 'connect..';
        exit;
    }

    public function disconnect()
    {
        // TODO: Implement disconnect() method.
        echo 'disconnect..';
        exit;
    }

    public function free($result)
    {
        // TODO: Implement free() method.
        echo 'free';
        exit;
    }

    public function query($sql, array $args = array())
    {
        // TODO: Implement query() method.
        //构建拼装sql语句
        $rows = $this->buildSql(func_get_args());
        //执行
        return M()->execute($rows);
    }

    public function insert($sql, array $args = array())
    {
        // TODO: Implement insert() method.
        //获取实际传过来的参数,得到一个数组
        $params = func_get_args();
        //从数组中弹出sql语句
        $sql = array_shift($params);
        //取出表名
        $table_name = array_shift($params);
        //字符串替换，将sql语句中的?T替换成表名
        $sql =str_replace('?T',$table_name,$sql);

        //取出数据
        $params = array_shift($params);
        //构建拼接sql语句
        $values = '';
        foreach($params as $k=>$v){
            $values.="{$k}='{$v}',";
        }
        //去掉最后一个逗号
        $values = rtrim($values,',');
        $sql = str_replace('?%',$values,$sql);
//        dump($sql);
//        exit;
        //执行sql
        $model = M();
        $result = $model->execute($sql);
        //执行成功，返回最后插入这条数据的id，失败 返回false
        if($result===false){
            return false;
        }else{
            return $model->getLastInsID();
        }
    }

    public function update($sql, array $args = array())
    {
        // TODO: Implement update() method.
        echo 'update';
        exit;
    }

    public function getAll($sql, array $args = array())
    {
        // TODO: Implement getAll() method.
        echo 'getAll';
        exit;
    }

    public function getAssoc($sql, array $args = array())
    {
        // TODO: Implement getAssoc() method.
        echo 'getAssoc';
        exit;
    }

    public function getRow($sql, array $args = array())
    {
        // TODO: Implement getRow() method.
        //构建sql语句
        $tempSql = $this->buildSql(func_get_args());
        //执行sql语句
        $rows = M()->query($tempSql);
        return empty($rows)?false:$rows[0];
    }

    public function getCol($sql, array $args = array())
    {
        // TODO: Implement getCol() method.
        echo 'getCol';
        exit;
    }

    public function getOne($sql, array $args = array())
    {
        // TODO: Implement getOne() method.
        //构建sql语句
        $tempSql = $this->buildSql(func_get_args());
        //执行sql语句
        $rows = M()->query($tempSql);
        //结果为一个二维数组，获取内部数组的值
        $row = $rows[0];
        $values = array_values($row);
        return $values[0];
    }

    private function buildSql($params){
        //从实际传入的参数数组中弹出sql语句
        $sql =array_shift($params);
        //将sql语句分解放入数组中
        $sqls = preg_split('/\?[FTN]/',$sql);
        //拼接sql语句
        $tempSql = '';
        foreach($sqls as $k=>$v){
            $tempSql .= $v.$params[$k];
        }
        return $tempSql;
    }

}