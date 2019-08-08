<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 03.08.2019
 * Time: 22:05
 */

class User extends Model
{
    private $_isLoggedIn, $_sessionName, $_cookieName, $_confirm;
    public static $currentLoggedInUser = null;
    public $id,$username,$email,$password,$fname,$lname,$acl,$deleted = 0;

    public function __construct($user='') {
        $table = 'users';
        parent::__construct($table);
        $this->_sessionName = CURRENT_USER_SESSION_NAME;
        $this->_cookieName = REMEMBER_ME_COOKIE_NAME;
        $this->_softDelete = true;
        $this->_modelName = 'User';
        if($user != '') {
            if(is_int($user)) {
                $u = $this->_db->findFirst('users',['conditions'=>'id = ?', 'bind'=>[$user]],'App\Models\Users');
            } else {
                $u = $this->_db->findFirst('users', ['conditions'=>'username = ?','bind'=>[$user]],'App\Models\Users');
            }
            if($u) {
                foreach($u as $key => $val) {
                    $this->$key = $val;
                }
            }
        }
    }
        public function  findByUsername($username){
            var_dump($username);
            return $this->findFirst(['conditions'=>"username = ?", 'bind'=>[$username]]);
            }

        public function login($rememberMe=false) {
            Session::set($this->_sessionName, $this->id);
            if($rememberMe) {
                $hash = md5(uniqid() + rand(0, 100));
                $user_agent = Session::uagent_no_version();
                Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
                $fields = ['session'=>$hash, 'user_agent'=>$user_agent, 'user_id'=>$this->id];
                $this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);
                $this->_db->insert('user_sessions', $fields);
            }
        }


}