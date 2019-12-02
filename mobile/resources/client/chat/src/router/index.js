/**
 * @file index store
 */
import * as types from '@/store/mutation-type';

import Vue from 'vue';
import Router from 'vue-router';

import axios from 'axios';

// mint ui
import { Toast } from 'mint-ui';

// node module
import url from 'url';
import qs from 'qs';

// chat api
import { appCheckLogin } from '@/api/chat';

/**
 * 异步组件
 */
const ChatDialogue = () => import('@/pages/chat/Dialogue');
const ChatVisitor = () => import('@/pages/chat/Visitor');
const ChatSetting = () => import('@/pages/chat/Setting');
const ChatMessage = () => import('@/pages/chat/Message');
const ChatLogin = () => import('@/pages/chat/Login');
const ChatUpdatePassword = () => import('@/pages/chat/UpdatePassword');

Vue.use(Router);

const router = new Router({
  mode: 'hash',
  routes: [
    {
      path: '/',
      name: '',
      component: ChatDialogue,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/chat',
      name: 'chat',
      component: ChatDialogue,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/chat/dialogue',
      name: 'chat/dialogue',
      component: ChatDialogue,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/chat/visitor',
      name: 'chat/visitor',
      component: ChatVisitor,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/chat/setting',
      name: 'chat/setting',
      component: ChatSetting,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/chat/message',
      name: 'chat/message',
      component: ChatMessage,
      meta: {
        notKeepAlive: true,
        requiresAuth: true
      }
    },
    {
      path: '/chat/login',
      name: 'chat/login',
      component: ChatLogin
    },
    {
      path: '/chat/update/password',
      name: 'chat/update/password',
      component: ChatUpdatePassword,
      meta: {
        requiresAuth: true
      }
    }
  ]
});

/**
 * 切换动画名称
 *
 * @type {string}
 * @const
 */
const SLIDE_LEFT = 'slide-left';

/**
 * 切换动画名称
 *
 * @type {string}
 * @const
 */
const SLIDE_RIGHT = 'slide-right';

router.beforeEach((to, from, next) => {
  if (from.name === 'chat/message' && to.name === 'chat/login') {
    router.push('/chat');
  }
  if (router.app.$store) {
    if (router.app.$store.state.needPageTransition) {
      // 判断前进后退添加不同的过渡动画效果
      let pageTransitionName = isForward(to, from) ? SLIDE_LEFT : SLIDE_RIGHT;
      router.app.$store.commit(types.SET_PAGE_TRANSITION_NAME, {
        pageTransitionName
      });
    }
  } else {
    // 初次加载路由是 将当前路由放入 HISTORY_STACK 中
    isForward(to, from);
  }
  if (to.matched.some(record => record.meta.requiresAuth)) {
    let token = localStorage.getItem('token');
    let urls = url.parse(window.location.href);
    let query = qs.parse(urls.query);
    if (!token) {
      if (
        query.is_admin === '1' &&
        (to.name === 'chat' || to.name === 'chat/dialogue')
      ) {
        let queryDeepCopy = JSON.parse(JSON.stringify(query));
        let path = ''; // 获得新的地址
        ['connect_code', 'user_id', 'is_admin'].forEach(item => {
          delete queryDeepCopy[item];
        });
        for (let item in queryDeepCopy) {
          path += item + '=' + queryDeepCopy[item] + '&';
        }
        path = path.substring(0, path.length - 1);
        path = `${urls.protocol}//${urls.host}${urls.pathname}?${path}#/chat`;
        console.log(path);
        appCheckLogin({
          user_id: query.user_id,
          is_admin: query.is_admin,
          connect_code: query.connect_code
        }).then(({ data: { code, msg, token, user_id } }) => {
          if (code === 0) {
            localStorage.setItem('token', token);
            // 全局配置请求token
            axios.defaults.headers.common['token'] = token || '';
            window.location = path;
          }
        });
      } else {
        Toast({
          message: '请登录后进行操作',
          position: 'middle',
          duration: 1600
        });
        next({
          path: '/chat/login',
          query: { redirect: to.fullPath }
        });
      }
    } else {
      next();
    }
  } else {
    next();
  }
});

/**
 * to 如果在这个列表中，始终采用向右的滑动效果，适用于首页 - 后退
 *
 * @type {Array.<string>}
 * @const
 */
const ALWAYS_BACK_PAGE = ['chat/dialogue'];

/**
 * to 如果在这个列表中，始终采用向左的滑动效果 - 前进
 *
 * @type {Array.<string>}
 * @const
 */
const ALWAYS_FORWARD_PAGE = [];

/**
 * 历史记录，记录访问过的页面的 fullPath
 *
 * @type {Array.<string>}
 * @const
 */
const HISTORY_STACK = [];

/**
 * 判断当前是否前进，true 表示前进，false 表示后退
 * 
 * @param {Object} to - 目标 route
 * @param {Object} from - 源 route
 * @return {Object} 返回 值
 */
function isForward(to, from) {
  // to 如果在这个列表中，始终认为是后退
  if (to.name && ALWAYS_BACK_PAGE.indexOf(to.name) !== -1) {
    // 清空历史
    HISTORY_STACK.length = 0;
    return false;
  }

  // 如果是从 ALWAYS_BACK_PAGE 过来的，那么永远都是前进
  if (from.name && ALWAYS_BACK_PAGE.indexOf(from.name) !== -1) {
    HISTORY_STACK.push(to.fullPath);
    return true;
  }

  // to 如果在这个列表中，始终认为是前进
  if (to.name && ALWAYS_FORWARD_PAGE.indexOf(to.name) !== -1) {
    // to 在这个列表中，始终位前进
    HISTORY_STACK.push(to.fullPath);
    return true;
  }

  // 根据加入 HISTORY_STACK 中的 fullpath 判断当前页面是否被访问过 如果有则改切换属于返回
  let index = HISTORY_STACK.indexOf(to.fullPath);
  if (index !== -1) {
    HISTORY_STACK.length = index + 1;
    return false;
  }

  HISTORY_STACK.push(to.fullPath);
  return true;
}

window.router = router;

export default router;
