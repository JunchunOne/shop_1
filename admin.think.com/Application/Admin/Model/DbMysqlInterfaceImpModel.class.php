<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/7
 * Time: 0:51
 */

namespace Admin\Model;


class DbMysqlInterfaceImpModel implements DbMysqlInterfaceModel
{

    /**
     * DB connect
     *
     * @access public
     *
     * @return resource connection link
     */
    public function connect()
    {
        // TODO: Implement connect() method.
        echo 'connect';
        exit;
    }

    /**
     * Disconnect from DB
     *
     * @access public
     *
     * @return viod
     */
    public function disconnect()
    {
        // TODO: Implement disconnect() method.
        echo 'disconnect';
        exit;
    }

    /**
     * Free result
     *
     * @access public
     * @param resource $result query resourse
     *
     * @return viod
     */
    public function free($result)
    {
        // TODO: Implement disconnect() method.
        echo 'free';
        exit;
    }

    /**
     * Execute simple query
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return resource|bool query result
     */
    public function query($sql, array $args = array())
    {
        // TODO: Implement disconnect() method.
        $argsArr = func_get_args();
        //将sql模板弹出
        $targetSQL = $this->buliSql($argsArr);
        //这个是查询出多行数据
        return M()->execute($targetSQL);
    }

    /**
     * Insert query method
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return int|false last insert id
     */
    public function insert($sql, array $args = array())
    {
        $params = func_get_args();
        $sql = $params[0];
        $sql =  str_replace('?T',$params[1],$sql);

        //将插入的值的连接
        $values = array();
        foreach($params[2] as $k=>$v){

                $values[] = "$k='$v'";


        }
        $values = implode(',',$values);

        //将插入的值替换到$sql中
        $sql =  str_replace('?%',$values,$sql);

        $result = M()->execute($sql);

        if($result!==false){
            //执行成功之后要返回id
            return M()->getLastInsID();
        }else{
            return false;//执行失败,返回false
        }
    }

    /**
     * Update query method
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return int|false affected rows
     */
    public function update($sql, array $args = array())
    {
        // TODO: Implement disconnect() method.
        echo 'update';
        exit;
    }

    /**
     * Get all query result rows as associated array
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array associated data array (two level array)
     */
    public function getAll($sql, array $args = array())
    {
// TODO: Implement disconnect() method.
        echo 'getAll';
        exit;
    }

    /**
     * Get all query result rows as associated array with first field as row key
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array associated data array (two level array)
     */
    public function getAssoc($sql, array $args = array())
    {
// TODO: Implement disconnect() method.
        echo 'getAssoc';
        exit;
    }

    /**
     * Get only first row from query
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array associated data array
     */
    public function getRow($sql, array $args = array())
    {
// TODO: Implement disconnect() method.
        $argsArr = func_get_args();
        $targetSql = $this->buliSql($argsArr);
        //这个是查询出多行数据
        $row = M()->query($targetSql);

        if (!empty($row)) {
            //实际只要一行数据
            return $row[0];
        }
    }

    public function buliSql($argsArr)
    {

        //将sql模板弹出
        $sql = array_shift($argsArr);

        //使用正则分割成一个数组
        $sqls = preg_split('/\?[FNT]/', $sql);

        //用来保存sql
        $targetSql = '';
        foreach ($sqls as $key => $val) {
            $targetSql .= $val . $argsArr[$key];
        }
        return $targetSql;
    }

    /**
     * Get first column of query result
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array one level data array
     */
    public function getCol($sql, array $args = array())
    {
// TODO: Implement disconnect() method.
        echo 'getCol';
        exit;
    }

    /**
     * Get one first field value from query result
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return string field value
     */
    public function getOne($sql, array $args = array())
    {
// TODO: Implement disconnect() method.
        //........得到所有的参数.................
        $argsArr = func_get_args();

        //............拼sql语句......................
        $targetSql = $this->buliSql($argsArr);

        $result=M()->query($targetSql);
        if($result!==false){
            $num=array_values($result[0]);
            return $num[0];
        }else{
            return false;
        }

    }
}