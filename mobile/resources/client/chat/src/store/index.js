/**
 * @file index store
 */

import * as types from './mutation-type';

import Vue from 'vue';
import Vuex from 'vuex';
import chat from './modules/chat';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

let state = {
  /**
   * 是否需要页面切换动画功能
   * 
   * @type {boolean}
   */
  needPageTransition: false,

  /**
   * 页面切换效果时的名称
   *
   * @type {string}
   */
  pageTransitionName: '',

  /**
   * 上个页面 scroll 的信息
   *
   * @type {Object}
   */
  historyPageScrollTop: {},

  /**
   * 表情列表
   * 
   * @type {Array}
   */
  aFace: [],

  /**
   * 显示或隐藏表情列表
   * 
   * @type {Boolean}
   */
  bFace: false
};

let actions = {
  /**
   * 保存页面 scroll 高度
   * 
   * @param {} commit
   * @param {string} path - 路由 path
   * @param {Number} scrollTop 
   */
  saveScrollTop({ commit }, { path, scrollTop }) {
    commit(types.SAVE_SCROLL_TOP, { path, scrollTop });
  },
  /**
   * 获取 qq face img
   * 
   * @param {Function} commit
   * @param {String} path - 图片路劲 
   */
  getImageFiles({ commit }) {
    commit(types.GET_IMAGE_FILES);
  },
  /**
   * 
   * @param {} commit
   * @param {Boolean} bShow 
   */
  showFaceDialog({ commit }, { bShow }) {
    // const selectedText = window.getSelection();
    // const currentText = el.querySelector('.input').innerText;
    // console.log(selectedText, currentText);
    commit(types.SHOW_FACE_DIALOG, { bShow });
  }
};

let mutations = {
  [types.SET_PAGE_TRANSITION_NAME](state, { pageTransitionName }) {
    state.pageTransitionName = pageTransitionName;
  },
  [types.SAVE_SCROLL_TOP](state, { path, scrollTop }) {
    state.historyPageScrollTop[path] = scrollTop;
  },
  [types.GET_IMAGE_FILES](state) {
    for (let i = 0; i < 71; i++) {
      state.aFace.push(i);
    }
  },
  [types.SHOW_FACE_DIALOG](state, { bShow }) {
    if (bShow === void 0) {
      state.bFace = !state.bFace;
    } else {
      state.bFace = bShow;
    }
  }
};

export default new Vuex.Store({
  state,
  actions,
  mutations,
  modules: {
    namespaced: true,
    chat
  },
  strict: debug
  // plugins: debug ? [createLogger()] : []
});
