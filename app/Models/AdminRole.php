<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
/**
 * 后台管理员角色model
 * @author puppet
 */
class AdminRole extends Model{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'admin_role';

    /**
     * DB::直接操作的数据库表名
     * @var string
     */
    private $db_table = 'admin_role';

    /**
     * 主键 默认id。
     *
     * @var string
     */
    public $primaryKey = 'admin_role_id';
    
    /**
     * 指定是否模型应该被戳记时间。
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * 数据插入
     * @return true or false
     */
    public function db_insert($data){
        return DB::table($this->table)->insert($data);
    }
    
    /**
     * 数据插入
     * @return $id
     */
    public function db_insertGetId($data){
        return DB::table($this->table)->insertGetId($data);
    }
    
    /**
     * 获取单条数据
     * $data = ['admin_id'=>['=','']]
     */
    public function db_get($data){
        $sql = "SELECT * FROM {$this->db_table} WHERE";
        $tmp = 0;
        $values = [];
        foreach ($data as $key => $val){
            $values[] = $val[1];
            if($tmp == 0)
                $sql .= " $key $val[0] ?";
            else
                $sql .= " AND $key $val[0] ?";
            $tmp++;
        }
        $sql .= " limit 1";
        $data = DB::select($sql,$values);
        return !empty($data) ? $data[0] : false;
    }
    /**
     * 修改
     * $cond_key 条件key
     * $cond_value 条件值
     * $data    修改数据
     */
    public function db_update($cond_key = '',$cond_value,$data){
        if(empty($cond_key))
            return DB::table($this->table)->where($this->primaryKey,$cond_value)->update($data);
        else
            return DB::table($this->table)->where($cond_key,$cond_value)->update($data);
    }
    
    public function getAllData(){
        return DB::table($this->table)->where('status','>=',0)->get();
    }
}