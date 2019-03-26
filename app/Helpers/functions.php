<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * 获取权限分组
 */
if (!function_exists('right_group')) {
    function right_group($group = null)
    {
        $rightGroup = Cache::remember('admin_right_group', '600', function () {
            $rightGroup = [
                'system' => [
                    'name' => '系统管理',
                    'en_name' => 'system',
                    'menu' => system_menu()
                ],
                'novel' => [
                    'name' => '小说管理',
                    'en_name' => 'novel',
                    'menu' => novel_menu()
                ],
                'user' => [
                    'name' => '用户管理',
                    'en_name' => 'user',
                    'menu' => user_menu()
                ],
                'finance' => [
                    'name' => '财务管理',
                    'en_name' => 'finance',
                    'menu' => finance_menu()
                ]
            ];
            return $rightGroup;
        });
        if (!empty($group)) {
            $group = explode('@', $group);
            return $rightGroup[$group[0]]['name'] . '-' . $rightGroup[$group[0]]['menu'][$group[1]]['name'] . '-' . $rightGroup[$group[0]]['menu'][$group[1]]['item'][$group[2]];
        }
        return $rightGroup;
    }

    function system_menu()
    {
        return [
            'site' => [
                'name' => '站点设置',
                'en_name' => 'site',
                'icon' => 'icon-system',
                'item' => [
                    'basic' => '基本设置',
                    'password' => '修改密码'
                ],
                'action' => [
                    'basic' => [
                        'url' => url('admin/config/config'),
                        'action' => 'App\Http\Controllers\Admin\ConfigController@config'
                    ],
                    'password' => [
                        'url' => url('admin/admin/editPwd'),
                        'action' => 'App\Http\Controllers\Admin\AdminController@editPwd'
                    ]
                ]
            ],
            'rabc' => [
                'name' => '权限管理',
                'en_name' => 'rabc',
                'icon' => 'icon-menu',
                'item' => [
                    'admin' => '管理员管理',
                    'role' => '角色管理',
                    'systemright' => '权限管理'
                ],
                'action' => [
                    'admin' => [
                        'url' => route('admin.index'),
                        'action' => 'App\Http\Controllers\Admin\AdminController@index'
                    ],
                    'role' => [
                        'url' => route('role.index'),
                        'action' => 'App\Http\Controllers\Admin\RoleController@index'
                    ],
                    'systemright' => [
                        'url' => route('rights.index'),
                        'action' => 'App\Http\Controllers\Admin\SystemRightController@index'
                    ]
                ]
            ],
            'home' => [
                'name' => '系统首页',
                'en_name' => 'home',
                'icon' => 'icon-home',
                'item' => [
                    'home' => '系统首页'
                ],
                'action' => [
                    'home' => [
                        'url' => url('admin/index'),
                        'action' => 'App\Http\Controllers\Admin\IndexController@index'
                    ]
                ]
            ],
            'wechat' => [
                'name' => '公众号管理',
                'en_name' => 'wechat',
                'icon' => 'icon-item',
                'item' => [
                    'info' => '基本信息',
                    'menu' => '公众号菜单',
                ],
                'action' => [
                    'info' => [
                        'url' => url('admin/wechat/info'),
                        'action' => 'App\Http\Controllers\Admin\WechatController@info'
                    ],
                    'menu' => [
                        'url' => route('menu.index'),
                        'action' => 'App\Http\Controllers\Admin\WechatController@menu'
                    ]
                ]
            ]
        ];
    }

    function novel_menu()
    {
        return [
            'novel' => [
                'name' => '小说管理',
                'en_name' => 'novel',
                'icon' => 'icon-menu',
                'item' => [
                    'area' => '发布区域',
                    'item' => '小说分类',
                    'novel' => '小说列表',
                    'banner' => '小说轮播',
                    'recovery' => '小说回收',
                    'comment' => '评论管理'
                ],
                'action' => [
                    'area' => [
                        'url' => url('admin/novel/index'),
                        'action' => 'App\Http\Controllers\Admin\NovelController@index'
                    ],
                    'item' => [
                        'url' => url('admin/novel/index'),
                        'action' => 'App\Http\Controllers\Admin\NovelController@index'
                    ]
                    ,
                    'novel' => [
                        'url' => url('admin/novel/index'),
                        'action' => 'App\Http\Controllers\Admin\NovelController@index'
                    ]
                    ,
                    'banner' => [
                        'url' => url('admin/novel/index'),
                        'action' => 'App\Http\Controllers\Admin\NovelController@index'
                    ]
                    ,
                    'recovery' => [
                        'url' => url('admin/novel/index'),
                        'action' => 'App\Http\Controllers\Admin\NovelController@index'
                    ]
                    ,
                    'comment' => [
                        'url' => url('admin/novel/index'),
                        'action' => 'App\Http\Controllers\Admin\NovelController@index'
                    ]
                ]
            ]
        ];
    }

    function user_menu()
    {
        return [
            'member' => [
                'name' => '会员管理',
                'en_name' => 'member',
                'icon' => 'icon-menu',
                'item' => [
                    'member' => '会员列表',
                ],
                'action' => [
                    'member' => [
                        'url' => url('admin/member/index'),
                        'action' => 'App\Http\Controllers\Admin\MemberController@index'
                    ]
                ]
            ],
            'mch' => [
                'name' => '代理商管理',
                'en_name' => 'mch',
                'icon' => 'icon-menu',
                'item' => [
                    'mch' => '代理商列表'
                ],
                'action' => [
                    'mch' => [
                        'url' => url('admin/mch/index'),
                        'action' => 'App\Http\Controllers\Admin\MchController@index'
                    ]
                ]
            ]
        ];
    }

    function finance_menu()
    {
        return [
            'finance' => [
                'name' => '财务管理',
                'en_name' => 'finance',
                'icon' => 'icon-menu',
                'item' => [
                    'order' => '订单管理',
                    'centos' => '财务统计',
                ],
                'action' => [
                    'order' => [
                        'url' => url('admin/finance/order'),
                        'action' => 'App\Http\Controllers\Admin\FinaceController@order'
                    ],
                    'centos' => [
                        'url' => url('admin/finance/centos'),
                        'action' => 'App\Http\Controllers\Admin\FinaceController@centos'
                    ]
                ]
            ]
        ];
    }
}

/**
 * 获取执行的sql语句
 * 当前方法放在执行的语句前
 */
if (!function_exists('getLastSql')) {
    function getLastSql($file = false)
    {
        DB::listen(function ($query) use ($file) {
            $tmp = str_replace('?', '"' . '%s' . '"', $query->sql);
            $qBindings = [];
            foreach ($query->bindings as $key => $value) {
                if (is_numeric($key)) {
                    $qBindings[] = $value;
                } else {
                    $tmp = str_replace(':' . $key, '"' . $value . '"', $tmp);
                }
            }
            $tmp = vsprintf($tmp, $qBindings);
            $tmp = str_replace("\\", "", $tmp);
            $tmp = 'execution time: ' . $query->time . 'ms; run sql：' . $tmp;
            if ($file === true) {
                Log::channel('sql')->info($tmp . "\n\n\t");
            } else {
                echo $tmp . '<br />';
            }
        });
    }
}

/**
 * 获取权限分组对应权限列表
 */
if (!function_exists('right_group_rights')) {
    function right_group_rights()
    {
        $rightGroupRights = Cache::remember('admin_right_group_rights', '600', function () {
            $rightGroupRights = right_group();
            foreach ($rightGroupRights as $k => $v) {
                foreach ($v['menu'] as $k1 => $v1) {
                    foreach ($v1['item'] as $k2 => $v2) {
                        $key = "{$k}@{$k1}@{$k2}";
                        $rightGroupRights[$k]['menu'][$k1][$k2 . '_rights'] = DB::table("system_right")->where("group", $key)->pluck('name', 'id');
                    }
                }
            }
            return $rightGroupRights;
        });
        return $rightGroupRights;
    }
}

/**
 * 当前权限是否选中
 */
if (!function_exists('right_group_rights_checked')) {
    function right_group_rights_checked($right, $rights)
    {
        if ($rights == 0) {
            return true;
        } else {
            $rights = explode(',', $rights);
            return in_array($right, $rights);
        }
        return false;
    }
}

/**
 * 后端统一格式返回json
 */
if (!function_exists('responseJson')) {
    function responseJson($data)
    {
        if ($data === true) {//保存更新等动作
            $data = [
                'code' => 200,
                'msg' => '操作成功'
            ];
        } else if ($data === false) {//保存更新等动作
            $data = [
                'code' => 201,
                'msg' => '操作失败'
            ];
        } else if (is_numeric($data)) {
            if ($data == 0) {
                $data = [
                    'code' => 201,
                    'msg' => '删除失败'
                ];
            } else {
                $data = [
                    'code' => 200,
                    'msg' => "成功删除{$data}条数据"
                ];
            }
        }
        return response()->json($data);
    }
}

