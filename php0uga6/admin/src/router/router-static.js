import Vue from 'vue';
//配置路由
import VueRouter from 'vue-router'
Vue.use(VueRouter);
//1.创建组件
import Index from '@/views/index'
import Home from '@/views/home'
import Login from '@/views/login'
import NotFound from '@/views/404'
import UpdatePassword from '@/views/update-password'
import pay from '@/views/pay'
import register from '@/views/register'
import center from '@/views/center'
    import discusstoupiaoxiangmu from '@/views/modules/discusstoupiaoxiangmu/list'
    import news from '@/views/modules/news/list'
    import huodongfenlei from '@/views/modules/huodongfenlei/list'
    import shetuanhuodong from '@/views/modules/shetuanhuodong/list'
    import storeup from '@/views/modules/storeup/list'
    import jiangliqingkuang from '@/views/modules/jiangliqingkuang/list'
    import toupiaoxiangmu from '@/views/modules/toupiaoxiangmu/list'
    import discussshetuanhuodong from '@/views/modules/discussshetuanhuodong/list'
    import baomingxinxi from '@/views/modules/baomingxinxi/list'
    import yonghu from '@/views/modules/yonghu/list'
    import qiandaodengji from '@/views/modules/qiandaodengji/list'
    import toupiaoxinxi from '@/views/modules/toupiaoxinxi/list'
    import config from '@/views/modules/config/list'


//2.配置路由   注意：名字
const routes = [{
    path: '/index',
    name: '首页',
    component: Index,
    children: [{
      // 这里不设置值，是把main作为默认页面
      path: '/',
      name: '首页',
      component: Home,
      meta: {icon:'', title:'center'}
    }, {
      path: '/updatePassword',
      name: '修改密码',
      component: UpdatePassword,
      meta: {icon:'', title:'updatePassword'}
    }, {
      path: '/pay',
      name: '支付',
      component: pay,
      meta: {icon:'', title:'pay'}
    }, {
      path: '/center',
      name: '个人信息',
      component: center,
      meta: {icon:'', title:'center'}
    }
      ,{
	path: '/discusstoupiaoxiangmu',
        name: '投票项目评论',
        component: discusstoupiaoxiangmu
      }
      ,{
	path: '/news',
        name: '公告信息',
        component: news
      }
      ,{
	path: '/huodongfenlei',
        name: '活动分类',
        component: huodongfenlei
      }
      ,{
	path: '/shetuanhuodong',
        name: '社团活动',
        component: shetuanhuodong
      }
      ,{
	path: '/storeup',
        name: '我的收藏管理',
        component: storeup
      }
      ,{
	path: '/jiangliqingkuang',
        name: '奖励情况',
        component: jiangliqingkuang
      }
      ,{
	path: '/toupiaoxiangmu',
        name: '投票项目',
        component: toupiaoxiangmu
      }
      ,{
	path: '/discussshetuanhuodong',
        name: '社团活动评论',
        component: discussshetuanhuodong
      }
      ,{
	path: '/baomingxinxi',
        name: '报名信息',
        component: baomingxinxi
      }
      ,{
	path: '/yonghu',
        name: '用户',
        component: yonghu
      }
      ,{
	path: '/qiandaodengji',
        name: '签到登记',
        component: qiandaodengji
      }
      ,{
	path: '/toupiaoxinxi',
        name: '投票信息',
        component: toupiaoxinxi
      }
      ,{
	path: '/config',
        name: '轮播图管理',
        component: config
      }
    ]
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {icon:'', title:'login'}
  },
  {
    path: '/register',
    name: 'register',
    component: register,
    meta: {icon:'', title:'register'}
  },
  {
    path: '/',
    name: '首页',
    redirect: '/index'
  }, /*默认跳转路由*/
  {
    path: '*',
    component: NotFound
  }
]
//3.实例化VueRouter  注意：名字
const router = new VueRouter({
  mode: 'hash',
  /*hash模式改为history*/
  routes // （缩写）相当于 routes: routes
})

export default router;
