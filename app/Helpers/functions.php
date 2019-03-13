<?php

    use Illuminate\Support\Facades\Cache;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;
    /**
     * 获取权限分组
     */
    if(!function_exists('right_group')){
        function right_group ($group = null) {
            $rightGroup = Cache::remember('admin_right_group','600', function () {
                $rightGroup = [
                    'system'=>[
                        'name'=>'系统管理',
                        'en_name'=>'system',
                        'menu'=>system_menu()
                    ],
                    'novel'=>[
                        'name'=>'小说管理',
                        'en_name'=>'novel',
                        'menu'=>novel_menu()
                    ],
                    'user'=>[
                        'name'=>'用户管理',
                        'en_name'=>'user',
                        'menu'=>user_menu()
                    ],
                    'finance'=>[
                        'name'=>'财务管理',
                        'en_name'=>'finance',
                        'menu'=>finance_menu()
                    ]
                ];
                return $rightGroup;
            });
            if(!empty($group)){
                $group = explode('@',$group);
                return $rightGroup[$group[0]]['name'].'-'.$rightGroup[$group[0]]['menu'][$group[1]]['name'];
            }
            return $rightGroup;
        }

        function system_menu()
        {
            return [
                'site'=>[
                    'name'=>'站点设置',
                    'en_name'=>'site',
                    'item'=>[
                        'basic'=>'基本设置',
                        'password'=>'修改密码'
                    ]
                ],
                'rabc'=>[
                    'name'=>'权限管理',
                    'en_name'=>'rabc',
                    'item'=>[
                        'admin'=>'管理员管理',
                        'role'=>'角色管理'
                    ]
                ],
                'menu'=>[
                    'name'=>'菜单管理',
                    'en_name'=>'menu',
                    'item'=>[
                        'menu'=>'菜单列表'
                    ]
                ],
                'home'=>[
                    'name'=>'系统首页',
                    'en_name'=>'home',
                    'item'=>[
                        'home'=>'系统首页'
                    ]
                ]
            ];
        }

        function novel_menu()
        {
            return [
                'novel'=>[
                    'name'=>'小说管理',
                    'en_name'=>'novel',
                    'item'=>[
                        'area'=>'发布区域',
                        'item'=>'小说分类',
                        'novel'=>'小说列表',
                        'banner'=>'小说轮播',
                        'recovery'=>'小说回收',
                        'comment'=>'评论管理'
                    ]
                ]
            ];
        }

        function user_menu()
        {
            return [
                'member'=>[
                    'name'=>'会员管理',
                    'en_name'=>'member',
                    'item'=>[
                        'member'=>'会员列表',
                    ]
                ],
                'mch'=>[
                    'name'=>'代理商管理',
                    'en_name'=>'mch',
                    'item'=>[
                        'mch'=>'代理商列表'
                    ]
                ]
            ];
        }

        function finance_menu()
        {
            return [
                'finance'=>[
                    'name'=>'财务管理',
                    'en_name'=>'finance',
                    'item'=>[
                        'order'=>'订单管理',
                        'centos'=>'财务统计',
                    ]
                ]
            ];
        }
    }

    /**
     * 获取执行的sql语句
     * 当前方法放在执行的语句前
     */
    if(!function_exists('getLastSql')){
        function getLastSql ($file = false) {
            DB::listen(function ($query) use ($file) {
                $tmp = str_replace('?', '"'.'%s'.'"', $query->sql);
                $qBindings = [];
                foreach ($query->bindings as $key => $value) {
                    if (is_numeric($key)) {
                        $qBindings[] = $value;
                    } else {
                        $tmp = str_replace(':'.$key, '"'.$value.'"', $tmp);
                    }
                }
                $tmp = vsprintf($tmp, $qBindings);
                $tmp = str_replace("\\", "", $tmp);
                $tmp = 'execution time: '.$query->time.'ms; run sql：'.$tmp;
                if($file === true){
                    Log::channel('sql')->info($tmp."\n\n\t");
                }else{
                    echo $tmp.'<br />';
                }
            });
        }
    }

    /**
     * 获取权限分组对应权限列表
     */
    if(!function_exists('right_group_rights')){
        function right_group_rights(){
            $rightGroupRights = Cache::remember('admin_right_group_rights','600', function () {
                $rightGroupRights = right_group();
                foreach ($rightGroupRights as $k=>$v){
                    foreach ($v['menu'] as $k1=>$v1){
                        foreach ($v1['item'] as $k2=>$v2){
                            $key = "{$k}@{$k1}@{$k2}";
                            $rightGroupRights[$k]['menu'][$k1]['item'][$k2.'_rights'] = DB::table("system_right")->where("group",$key)->pluck('name','id');
                        }
                    }
                }
                return $rightGroupRights;
            });
            return $rightGroupRights;
        }
    }

