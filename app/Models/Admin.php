<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Components\Tools;
use DB;
/**
 * 后台管理员model
 * @author puppet
 */
class Admin extends Model{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'admin';

    /**
     * DB::直接操作的数据库表名
     * @var string
     */
    private $db_table = 'admin';

    /**
     * 主键 默认id。
     *
     * @var string
     */
    public $primaryKey = 'admin_id';
    
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
     * 验证账号
     */
    public function validAdminLogin($username,$password){
        $res = DB::table($this->table)
                ->where('admin_name',$username)
                ->where('password', Tools::passwordEncryption($password))
                ->where('status',1)
                ->first();
        return !empty($res) ? $res : false;
    }
    
    /**
     * 根据用户名，获取单条用户数据
     */
    public function getAdminData($username){
        $res = DB::table($this->table)
                ->where('admin_name',$username)
                ->where('status','>=',0)
                ->first();
        return !empty($res) ? $res : false;
    }
    
    /**
     * 根据admin_id，获取单条用户数据
     */
    public function getData($id){
        $res = DB::table($this->table)
                ->where($this->primaryKey,$id)
                ->where('status','>=',0)
                ->first();
        return !empty($res) ? $res : false;
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
    
    /**
     * 所有管理员信息
     */
    public function getAllData(){
        $sql = "SELECT a.admin_id,a.admin_name,a.real_name,a.mobile,a.create_time,a.status,b.role_name FROM {$this->db_table} a LEFT JOIN admin_role b ON (a.role_id = b.admin_role_id) AND a.`status` >=? AND b.`status`>=? WHERE a.`status` >=?;";
        return DB::select($sql,[0,0,0]);
    }
    
    /**
     * 根据role_id角色编号
     * 获取所有权限名称或者权限url
     */
    public function getUserLimitInfo($role_id,$val = 'limit_name'){
        $result = [];
        if($role_id > 0){
            $oAdminRole = new AdminRole;
            $roleinfo = $oAdminRole->db_get(['admin_role_id' =>['=',$role_id],'status'=>['>=',0]]);
            $limits_ids = !empty($roleinfo['limits_ids']) ? (json_decode($roleinfo['limits_ids'],true)) : [];
            !empty($roleinfo) && $result = Tools::getAdminLimitsNameOrUrl($limits_ids,$val);
        }
        return $result;
    }
}