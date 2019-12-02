/**
 * chat 相关 api 请求
 * 
 * @file chat
 */

import axios from 'axios';
import qs from 'qs';

import * as socket from '@/api/socket';

import {
  Indicator,
  Toast
} from 'mint-ui';

/**
 * 获取对话列表
 * 
 * @return promise
 */
function getDialogueList() {
  return axios.post(window.requestUrl('chat&c=adminp'));
}

/**
 * 获取访客列表
 * 
 * @return promise
 */
function getVisitorList() {
  return axios.get(window.requestUrl('chat&c=adminp&a=visit'));
}

/**
 * 根据 id 获取当前对话的聊天信息
 * 
 * @param {Number} id - message id
 */
function getMessage({ id, sid, type, page, defaults }) {
  return axios.post(window.requestUrl('chat&c=adminp&a=chatlist'), qs.stringify({
    type: type || void 0,
    page: page || void 0,
    default: defaults || void 0,
    user_id: id,
    store_id: sid
  }));
}

/**
 * 验证用户名密码登录
 * 
 * @param {String} username 
 * @param {String} password 
 */
function checkLogin({ username, password, vue }) {
  Indicator.open();
  axios.post(window.requestUrl('chat&c=login'), qs.stringify({
    username,
    password
  })).then(({
    data: { code, msg, token, user_id }
  }) => {
    Indicator.close();
    Toast({
      message: msg,
      position: 'middle',
      iconClass: code === 1 ? 'iconfont icon-error' : 'iconfont icon-success',
      duration: 1600
    });
    if (code === 0) {
      localStorage.setItem('token', token);
      // 全局配置请求token
      axios.defaults.headers.common['token'] = token || '';
      vue.$router.push({
        path: vue.$route.query.redirect || '/chat'
      });
      socketInit(vue);
    }
  });
}

function appCheckLogin({ user_id, is_admin, connect_code, router }) {
  return axios
    .post(
      window.requestUrl('chat&c=login'),
      qs.stringify({
        login_type: 'app_admin_login',
        user_id,
        is_admin,
        connect_code
      })
    );
}

/**
 * 获取用户设置信息
 * 
 * @return promise
 */
function getSetting() {
  return axios.post(window.requestUrl('chat&c=adminp&a=serviceinfo'));
}

/**
 * 退出登录
 * 
 * @param {Function} router - 路由
 * @param {Boolean} ws - 是否有socket执行退出
 */
function outLogin({ router, ws }) {
  Indicator.open();
  if (!ws) {
    socket.close();
  }
  axios.get(window.requestUrl('chat&c=adminp&a=logout')).then(({
    data: { message, code }
  }) => {
    Indicator.close();
    Toast({
      message: message,
      position: 'middle',
      duration: 2000
    });
    if (code === 0) {
      let token = localStorage.getItem('token');
      if (token) {
        localStorage.removeItem('token');
      }
      if (router) {
        router.push({
          path: '/chat/login'
        });
      }
      window.location.reload();
    }
  });
}

/**
 * 根据用户id 将该用户的信息变为已读
 * 
 * @param {Number} userId - 用户id
 * @return promise
 */
function changeToRead({ userId }) {
  return axios.get(window.requestUrl(`chat&c=adminp&a=changemessagestatus&id=${userId}`));
}

/**
 * 根据商品id 获取商品信息
 * 
 * @param {Number} goodsId - 商品id
 * @return promise
 */
function getGoodsInfo({ goodsId }) {
  return axios.post(window.requestUrl(`chat&c=adminp&a=goodsinfo`), qs.stringify({
    gid: goodsId
  }));
}

/**
 * socket init data
 */
function socketInit(vue) {
  axios.post(window.requestUrl('chat&c=adminp&a=initinfo')).then(({
    data: { code, message, data }
  }) => {
    if (code === 0) {
      vue.setAvigatorNumber({
        chatNum: data.chat_num,
        waitNum: data.wait_num
      });
      socket.init({
        vue,
        listen_route: data.listen_route,
        port: data.port,
        avatar: data.avatar,
        name: data.user_name,
        uid: data.user_id,
        store_id: data.store_id,
        is_ssl: data.is_ssl
      });
    }
  });
}

export {
  getDialogueList,
  getVisitorList,
  getMessage,
  getGoodsInfo,
  appCheckLogin,
  checkLogin,
  socketInit,
  getSetting,
  changeToRead,
  outLogin
};
