<?php
App::uses('AppHelper', 'View/Helper');
/**
 * 管理端视图助手
 *
 * @copyright WechatAdmin
 * @package   app.View.Helper
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class AdminHelper extends AppHelper {

/**
 * 加载助手
 * @var array
 */
	public $helpers = array('Form', 'Html');

/**
 * 显示用户头像
 * 
 * @param string $src 路径
 * @param array $options 参数
 * @return string
 */
	public function showUserAvatar($src = null, $options = array()) {
		if (empty($src)) {
			$src = Configure::read('Default.avatar_src');
		}
		return $this->Html->image($src, $options);
	}

/**
 * 解析字符串url
 * 
 * @param string $url url地址
 * @return array
 */
	public function parseStringUrl($url) {
		$link = explode('/', $url);
		$count = count($link);
		$cakeLink = false;
		switch ($count) {
			case 4:
				$cakeLink = array(
					$link[0] => true,
					'plugin' => $link[1],
					'controller' => $link[2],
					'action' => $link[3]
				);
				break;
			case '3':
				$cakeLink = array(
					$link[0] => true,
					'plugin' => false,
					'controller' => $link[1],
					'action' => $link[2]
				);
				break;
			default:
				break;
		}
		unset($link, $count);
		return $cakeLink;
	}

/**
 * 左侧主菜单导航链接生成
 * 
 * @param array $menu 查询对象
 * @param boolean $hasChildren 是否包含子节点
 * @return string
 */
	public function markMenuLink($menu, $hasChildren = false) {
		$class = !is_null($menu['class']) || $menu['class'] != '' ? $menu['class'] : 'fa fa-th';
		$text = sprintf('<i class="%s"></i> <span>%s</span>', $class, $menu['name']);
		if ($hasChildren === true) {
			$text .= ' <i class="fa fa-angle-left pull-right"></i>';
			$url = 'javascript:;';
		} else {
			$url = $this->parseStringUrl($menu['link']);
		}
		return $this->Html->link($text, $url, array('escape' => false));
	}

/**
 * 左侧子菜单导航链接生成
 * 
 * @param Cake\ORM\Query $menu 查询对象
 * @return string
 */
	public function markMenuChildrenLink($menu) {
		$url = $this->parseStringUrl($menu['link']);
		$class = 'fa fa-angle-double-right';
		$text = sprintf('<i class="%s"></i> <span>%s</span>', $class, $menu['name']);
		return $this->Html->link($text, $url, array('escape' => false));
	}

/**
 * 编辑按钮
 * 
 * @param array $url url数组
 * @param array $options 参数
 * @return string
 */
	public function showEditIconLink($url = array(), $options = array()) {
		$opt = array(
			'data-original-title' => '编辑'
		);
		$options = array_merge($opt, $options);
		return $this->showIconLink('fa fa-pencil-square-o fa-lg', $url, $options);
	}

/**
 * 详细按钮
 * 
 * @param array $url url数组
 * @param array $options 参数
 * @return string
 */
	public function showViewIconLink($url = array(), $options = array()) {
		$opt = array(
			'data-original-title' => '详细'
		);
		$options = array_merge($opt, $options);
		return $this->showIconLink('fa fa-search-plus fa-lg', $url, $options);
	}

/**
 * 删除按钮
 * 
 * @param array $url url数组
 * @param array $options 参数
 * @return string
 */
	public function showDeleteIconLink($url = array(), $options = array()) {
		$opt = array(
			'data-original-title' => '删除'
		);
		$options = array_merge($opt, $options);
		return $this->showIconLink('fa fa-trash-o fa-lg', $url, $options);
	}

/**
 * 显示icon按钮
 * 
 * @param string $icon 图标样式
 * @param array $url url数组
 * @param array $options 参数
 * @return string
 */
	public function showIconLink($icon, $url = array(), $options = array()) {
		$opt = array(
			'escape' => false,
			'data-toggle' => 'tooltip'
		);
		$options = array_merge($opt, $options);
		$text = $this->Html->tag('i', '', array('class' => $icon));
		return $this->Html->tag('div', $this->Html->link($text, $url, $options), array('class' => 'actions', 'escape' => false));
	}

/**
 * 表单字段验证错误信息
 * 
 * @param string $field 字段
 * @return string
 */
	public function error($field) {
		if ($this->Form->isFieldError($field)) {
			return $this->Form->error($field, null, array('wrap' => 'label', 'class' => 'error-label'));
		}
		return null;
	}

/**
 * 错误样式
 * 
 * @param string $field 字段
 * @return string
 */
	public function errorClass($field) {
		if ($this->Form->isFieldError($field)) {
			return ' has-error';
		}
		return null;
	}

/**
 * 返回icon按钮
 * 
 * @param array $url url数组
 * @return string
 */
	public function showNavBackwardLink($url) {
		return $this->Html->link(
			'<i class="fa fa-backward"></i> 返回',
			$url,
			array(
				'class' => 'btn btn-default',
				'escape' => false
			)
		);
	}

/**
 * 编辑icon按钮
 * 
 * @param array $url url数组
 * @return string
 */
	public function showNavEditLink($url) {
		return $this->Html->link(
			'<i class="fa fa-pencil-square-o"></i> 编辑',
			$url,
			array(
				'class' => 'btn btn-primary',
				'escape' => false
			)
		);
	}

/**
 * 删除icon按钮
 * 
 * @param array $url url数组
 * @return string
 */
	public function showNavDeleteLink($url) {
		return $this->Html->link(
			'<i class="fa fa-trash-o"></i> 删除',
			$url,
			array(
				'class' => 'btn btn-danger',
				'escape' => false
			)
		);
	}
}
