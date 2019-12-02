/**
 * 相关 axios 的相关配置
 * 
 * @file axios
 */

import Vue from 'vue';
import axios from 'axios';

import * as chatApi from '@/api/chat';

import { Toast } from 'mint-ui';

let token = localStorage.getItem('token');
axios.defaults.headers.common['token'] = token || '';

// 拦截器
axios.interceptors.request.use(
  config => {
    return config;
  },
  error => {
    return Promise.reject(error);
  }
);

axios.interceptors.response.use(
  response => {
    if (response.data.code === 1) {
      if (response.data.message === '用户登录已失效') {
        localStorage.removeItem('token');
        if (localStorage.getItem('token')) {
          chatApi.outLogin({
            router: null
          });
          window.router.push('/chat/login');
        }
        window.router.push('/chat/login');
      }
      if (response.data.msg === '该账号没有客服权限') {
        Toast({
          message: '该账号没有客服权限',
          position: 'bottom',
          duration: 2000
        });
        window.router.push('/chat/login');
      }
    }
    return response;
  },
  error => {
    return Promise.reject(error);
  }
);

/**
 * Vue对象新增 axios 原型
 */
Vue.prototype.$http = axios;
