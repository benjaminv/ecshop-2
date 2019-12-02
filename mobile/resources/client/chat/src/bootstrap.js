/**
 * @file bootstrap
 */

import Vue from 'vue';
import '@/plugins/axios';
import HtmlTag from '@/filter/htmlTag';

const htmlTag = new HtmlTag();

/**
 * 生成请求 url 前缀 
 */
if (process.env.NODE_ENV !== 'production') {
  /**
   * 请求 url 链接
   * 
   * @param {String} url - 请求后缀
   * @return {String} 完整请求地址
   */
  window.requestUrl = function (url) {
    return `/mobile/index.php?m=${url}`;
  };
} else {
  window.requestUrl = function (url) {
    if (window.ROOT_URL) {
      return `${window.ROOT_URL}index.php?m=${url}`;
    } else {
      return `https://www.16too.com/index.php?m=${url}`;
    }
  };
}

/**
 * 路由切换不保存滚动位置
 * 
 * @type {Array.<String>}
 * @const
 */
const NO_SAVE_SCROLLTOP = ['chat/message'];

/**
 * 全局注入
 */
Vue.mixin({
  /**
   * 路由切换时，跳到指定滚动条位置 
   */
  beforeRouteEnter(to, from, next) {
    next(vm => {
      if (NO_SAVE_SCROLLTOP.indexOf(to.name) === -1) {
        vm.$el.scrollTop = vm.$store.state.historyPageScrollTop[to.fullPath] || 0;
      }
    });
  },
  /**
   * 路由离开时，保存当前页面的滚动位置
   */
  beforeRouteLeave(to, from, next) {
    if (NO_SAVE_SCROLLTOP.indexOf(from.name) === -1) {
      this.$store.dispatch('saveScrollTop', { path: from.fullPath, scrollTop: this.$el.scrollTop });
    }
    next();
  }
});

/**
 * 未发布状态下，引用本地服务器地址
 */
process.env.NODE_ENV !== 'production' ? Vue.prototype.release = false : Vue.prototype.release = true;

// img 前缀
window.imgHttp = Vue.prototype.release ? '' : '';

/**
 * filter
 */

Vue.filter('messageNew', htmlTag.messageNew);
