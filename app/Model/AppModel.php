<?php
App::uses('Model', 'Model');
/**
 * 项目全局模型
 * 在此文件内定义的方法可在项目其他模型内调用
 *
 * @copyright WechatAdmin
 * @package   app.Model
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class AppModel extends Model {

/**
 * 加载行为
 * @var array
 */
	public $actsAs = array('Containable');

/**
 * 数据验证前回调方法
 * 
 * @param array $options 参数
 * @return boolean
 */
	public function beforeValidate($options = array()) {
		return true;
	}

/**
 * 数据保存前回调方法
 * 
 * @param array $options 参数
 * @return boolean
 */
	public function beforeSave($options = array()) {
		return true;
	}

/**
 * 开启事务
 * 
 * @return void
 */
	public function begin() {
		$this->getDataSource()->begin();
	}

/**
 * 事务回滚
 * 
 * @return void
 */
	public function rollback() {
		$this->getDataSource()->rollback();
	}

/**
 * 事务提交
 * 
 * @return void
 */
	public function commit() {
		$this->getDataSource()->commit();
	}

/**
 * 清空表数据
 * 
 * @return boolean
 */
	public function truncate() {
		$sql = sprintf('TRUNCATE TABLE %s;', $this->tablePrefix . $this->table);
		return $this->query($sql);
	}
}
