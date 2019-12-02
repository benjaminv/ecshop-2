/**
 * @file chat store
 */

import * as types from '../mutation-type';
import vue from 'Vue';

// chat api file
import * as chatApi from '@/api/chat';

// formatData
import { formatDate } from '@/plugins/formatData';

// socket api
import { sendmsg, insertInfo } from '@/api/socket';

// mint ui
import { Indicator, Toast } from 'mint-ui';

const state = {};

const actions = {
  /**
   * 初始化底部对话 and 访客 消息数量
   * 
   * @param {Function} commit
   * @param {*} o 
   */
  setAvigatorNumber({ commit }, o) {
    commit(types.SET_AVIGATOR_NUMBER, o);
  },
  /**
   * 获取消息
   * 
   * @param {Function} commit 
   * @param {Object} info 
   */
  comeMessage({ commit, rootState, state }, info) {
    let messageListIndex = state.message.messageList[info.from_id];
    if (info.goods_id && messageListIndex) {
      if (Number(messageListIndex.goodsId) !== Number(info.goods_id)) {
        chatApi
          .getGoodsInfo({
            goodsId: info.goods_id
          })
          .then(({ data: { code, goods_info: goodsInfo } }) => {
            if (code === 0) {
              commit(types.COME_MESSAGE, { info, rootState, goodsInfo });
            }
          });
      } else {
        commit(types.COME_MESSAGE, { info, rootState });
      }
    } else {
      commit(types.COME_MESSAGE, { info, rootState });
    }
    commit(types.NEW_DIALOGUE, { info, time: info.time });
  },
  /**
   * 获取待接入时信息
   * 
   * @param {Function} commit 
   * @param {*} info 
   */
  comeWait({ commit }, info) {
    commit(types.COME_WAIT, { info });
  },
  /**
   * 发送信息
   * 
   * @param {Function} commit
   * @param {*} info - 发送的消息
   */
  sendMessage({ commit, rootState, dispatch }, info) {
    let time = formatDate(new Date(), 'hh:mm:ss');
    if (info.msg || info.msg !== '') {
      let { avatar, name } = sendmsg({
        msg: info.msg,
        uid: info.uid,
        goods_id: info.goods_id
      });
      commit(types.SEND_MESSAGE, { info, avatar, name, time, rootState });
      commit(types.NEW_DIALOGUE, { info, time, send: true });
    }
  },
  /**
   * 接入客户、 通知其他人、并修改对话状态
   * 
   * @param {Function} commit
   * @param {Object} info
   */
  insertInfo({ commit }, info) {
    insertInfo(info);
    commit(types.INSERT_INFO, { customerId: info.uid });
  }
};

const mutations = {
  [types.SET_AVIGATOR_NUMBER](state, { chatNum, waitNum }) {
    state.bottomNavigator.navs[0].number = chatNum;
    state.bottomNavigator.navs[1].number = waitNum;
  },
  [types.COME_MESSAGE](state, { info, rootState, goodsInfo }) {
    rootState.chat.message.bScroll = true;
    let messageListIndex = state.message.messageList[info.from_id];
    if (messageListIndex) {
      messageListIndex.list.push({
        add_time: info.time,
        avatar: info.avatar,
        name: info.name,
        status: info.status,
        service_id: info.to_id,
        message: info.message,
        user_type: '2'
      });
      if (goodsInfo) {
        messageListIndex.goodsId = goodsInfo.goods_id;
        messageListIndex.list.push({
          user_type: 0,
          ...goodsInfo
        });
      }
      state.message.messageList = Object.assign({}, state.message.messageList);
    }
  },
  [types.COME_WAIT](state, { info }) {
    let len = state.visitor.visitorList.length;
    let bUser = false;
    for (let i = 0; i < len; i++) {
      if (Number(state.visitor.visitorList[i].fid) === Number(info.from_id)) {
        bUser = true;
        state.visitor.visitorList[i].add_time = info.time;
        state.visitor.visitorList[i].message = info.message;
        state.visitor.visitorList[i].message_list.unshift(info.message);
        state.visitor.visitorList[i].num++;
        state.bottomNavigator.navs[1].number++;
        break;
      }
    }
    if (!bUser) {
      state.visitor.visitorList.unshift({
        user_name: info.name,
        add_time: info.time,
        avatar: info.avatar,
        customer_id: info.from_id,
        goods_id: info.goods_id,
        message: info.message,
        message_list: [info.message],
        num: 1,
        origin: info.origin,
        store_id: info.store_id
      });
      state.bottomNavigator.navs[1].number++;
    }
  },
  [types.SEND_MESSAGE](state, { info, avatar, time, name, rootState }) {
    rootState.chat.message.bScroll = true;
    if (state.message.messageList.hasOwnProperty(info.uid)) {
      state.message.messageList[info.uid].list.push({
        avatar: avatar || '',
        message: info.msg,
        add_time: time,
        user_type: '1',
        name
      });
      state.message.messageList = Object.assign({}, state.message.messageList);
    }
  },
  [types.NEW_DIALOGUE](state, { info, time, send }) {
    let dialogueListLen = state.dialogue.dialogueList.length;
    let uid = info.uid || info.from_id;
    let message = info.msg || info.message;
    for (let i = 0; i < dialogueListLen; i++) {
      if (Number(state.dialogue.dialogueList[i].customer_id) === Number(uid)) {
        if (state.dialogue.dialogueList[i].message instanceof Array) {
          state.dialogue.dialogueList[i].message.unshift(message);
        } else {
          let arr = [state.dialogue.dialogueList[i].message];
          arr.unshift(message);
          state.dialogue.dialogueList[i].message = arr;
        }
        state.dialogue.dialogueList[i].add_time = time;
        if (!send) {
          if (state.dialogue.dialogueList[i].message_sum) {
            state.dialogue.dialogueList[i].message_sum++;
          } else {
            vue.set(state.dialogue.dialogueList[i], 'message_sum', 1);
          }
          state.bottomNavigator.navs[0].number++;
        }
        break;
      }
    }
  },
  [types.INSERT_INFO](state, { customerId }) {
    let visitorListLen = state.visitor.visitorList.length;
    let visitorNum = 0;
    for (let i = 0; i < visitorListLen; i++) {
      if (
        Number(state.visitor.visitorList[i].customer_id) === Number(customerId)
      ) {
        visitorNum = state.visitor.visitorList[i].num;
        state.visitor.visitorList.splice(i, 1);
      }
      break;
    }
    state.bottomNavigator.navs[1].number -= visitorNum;
  }
};

const getters = {};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters,
  modules: {
    /**
     * 底部导航栏数据
     * 
     * @type {Object}
     */
    bottomNavigator: {
      namespaced: true,
      state: {
        /**
         * 是否展示底部导航
         * 
         * @type {boolean}
         */
        show: false,

        /**
         * 导航按钮列表
         * 
         * @type {Array.<Object>}
         */
        navs: [
          {
            // 按钮名称
            name: 'dialogue',

            // 显示的 icon
            icon: 'message',

            // 显示的文字
            text: '对话',

            // 消息数量
            number: 0,

            // 是否当前激活
            active: true,

            // 路由
            route: {
              name: 'chat/dialogue',
              path: '/chat/dialogue'
            }
          },
          {
            // 按钮名称
            name: 'visitor',

            // 显示的 icon
            icon: 'visitors',

            // 显示的文字
            text: '访客',

            // 消息数量
            number: 0,

            // 是否当前激活
            active: false,

            // 路由
            route: {
              name: 'chat/visitor',
              path: '/chat/visitor'
            }
          },
          {
            // 按钮名称
            name: 'setting',

            // 显示的 icon
            icon: 'setting',

            // 显示的文字
            text: '设置',

            // 是否当前激活
            active: false,

            // 路由
            route: {
              name: 'chat/setting',
              path: '/chat/setting'
            }
          }
        ]
      },
      actions: {
        /**
         * 点击导航动态加亮当前路由
         * 
         * @param {Funciton} commit
         * @param {String} name - 导航按钮名称
         */
        activateChatFooterName({ commit }, name) {
          commit(types.ACTIVATE_CHAT_FOOTER_NAV, name);
        },
        /**
         * 是否显示底部导航
         * 
         * @param {Function} commit
         * @param {Boolean} bShow - 显示或者隐藏
         */
        showBottomNav({ commit }, bShow) {
          commit(types.SHOW_BOTTOM_NAV, bShow);
        }
      },
      mutations: {
        [types.ACTIVATE_CHAT_FOOTER_NAV](state, name) {
          state.navs = state.navs.map(nav => {
            nav.active = nav.name === name;
            return nav;
          });
        },
        [types.SHOW_BOTTOM_NAV](state, bShow) {
          state.show = bShow;
        }
      }
    },
    /**
     * dialogue.vue
     * @type {Object}
     */
    dialogue: {
      namespaced: true,
      state: {
        /**
         * 对话列表信息
         * 
         * @param {Array.<Object>}
         */
        dialogueList: []
      },
      actions: {
        /**
         * 获取对话列表
         * 
         * @param {Function} param0 
         * @param {Array.<Object>} list - 对话列表
         */
        getDialogueList({ commit }, list) {
          chatApi
            .getDialogueList()
            .then(({ data: { code, message_list: messageList } }) => {
              let arr = [];
              if (messageList instanceof Array) {
                arr = messageList;
              } else {
                for (let item in messageList) {
                  arr.push(messageList[item]);
                }
              }
              commit(types.GET_DIALOGUE_LIST, arr);
            });
        }
      },
      mutations: {
        [types.GET_DIALOGUE_LIST](state, list) {
          state.dialogueList = list;
        }
      }
    },
    visitor: {
      namespaced: true,
      state: {
        /**
         * 访客列表信息
         * 
         * @param {Array.<Object>}
         */
        visitorList: []
      },
      actions: {
        /**
         * 获取访客列表
         * 
         * @param {Function} commit
         * @param {Array.<Object>} list 
         */
        getVisitorList({ commit, rootState }, list) {
          chatApi.getVisitorList().then(({ data }) => {
            if (data.code === 0) {
              commit(types.GET_VISITOR_LIST, {
                visitorList: data.visit_list
              });
            }
          });
        }
      },
      mutations: {
        [types.GET_VISITOR_LIST](state, { visitorList }) {
          state.visitorList = visitorList;
        }
      }
    },
    /**
     * message list
     */
    message: {
      namespaced: true,
      state: {
        /**
         * 根据该参数判定是否发送信息是否滚动到最底部
         * 
         * @param {Boolean}
         */
        bScroll: false,
        /**
         * 消息id
         * 
         * @param {Number}
         */
        messageId: -1,
        /**
         * 消息
         * 
         * @param {Object}
         */
        messageList: {}
      },
      getters: {
        message: state => {
          if (state.messageList[state.messageId]) {
            return state.messageList[state.messageId].list;
          }
        },
        page: state => {
          if (state.messageList[state.messageId]) {
            return state.messageList[state.messageId].page;
          }
        }
      },
      actions: {
        /**
         * 保存当前messageId
         * 
         * @param {Function} commit 
         * @param {Number} messageId - 保存当前messageId
         */
        setMessageId({ commit }, { messageId }) {
          commit(types.SET_MESSAGE_ID, { messageId });
        },
        /**
         * 获取第一次加载的对话数据
         * 
         * @param {Function} commit
         * @param {Object} o - messageId and messageList
         */
        async setMessageList({ dispatch, commit, state }, o) {
          if (state.messageList.hasOwnProperty(o.id) && o.type === 'default') {
            return false;
          }
          if (o.type === 'default') {
            dispatch('setMessageId', {
              messageId: o.id
            });
          } else {
            await dispatch('changePage');
          }
          Indicator.open({
            text: '加载中...'
          });
          chatApi
            .getMessage({
              id: o.id,
              sid: o.sid,
              type: o.type,
              defaults: o.defaults,
              page: o.page
            })
            .then(({ data: { code, message_list, goods } }) => {
              Indicator.close();
              if (code === 0) {
                let messLen = message_list.length;
                let arr = [];
                if (messLen > 0) {
                  for (let i = messLen - 1; i >= 0; i--) {
                    arr.push(message_list[i]);
                  }
                }
                commit(types.SET_MESSAGE_LIST, {
                  messageId: o.id,
                  messageList: arr,
                  type: o.type,
                  goods
                });
              } else {
                Toast('没有更多了……');
              }
            });
        },
        /**
         * 根据用户id 将该用户的信息变为已读
         * 
         * @param {Function} commit
         * @param {Object} rootState
         * @param {Number} userId - 用户id
         */
        changeToRead({ commit, rootState }, { userId }) {
          chatApi.changeToRead({ userId }).then(() => {
            commit(types.CHANGE_TO_READ, { rootState, userId });
          });
        },
        /**
         * 更改page页数
         */
        async changePage({ commit }) {
          commit(types.CHANGE_PAGE);
        }
      },
      mutations: {
        [types.SET_MESSAGE_ID](state, { messageId }) {
          state.messageId = messageId;
        },
        [types.SET_MESSAGE_LIST](
          state,
          { messageId, messageList, type, goods }
        ) {
          state.bScroll = false;
          if (type === 'default') {
            // 第一次加载
            vue.set(state.messageList, messageId, {
              page: 1,
              list: messageList,
              goodsId: goods ? goods.goods_id : 0
            });
            state.messageList[messageId].list.push({
              user_type: 0,
              ...goods
            });
          } else {
            // 查看更多分页加载
            state.messageList[messageId].list.unshift(...messageList);
            state.messageList = Object.assign({}, state.messageList);
          }
        },
        [types.CHANGE_TO_READ](state, { rootState, userId }) {
          let dialogueListLen = rootState.chat.dialogue.dialogueList.length;
          let num = 0;
          for (let i = 0; i < dialogueListLen; i++) {
            if (
              rootState.chat.dialogue.dialogueList[i].message_sum !== 0 &&
              Number(rootState.chat.dialogue.dialogueList[i].customer_id) ===
                Number(userId)
            ) {
              num = rootState.chat.dialogue.dialogueList[i].message_sum || 0;
              rootState.chat.dialogue.dialogueList[i].message_sum = 0;
              rootState.chat.dialogue = Object.assign(
                {},
                rootState.chat.dialogue
              );
              rootState.chat.bottomNavigator.navs[0].number -= num;
              break;
            }
          }
        },
        [types.CHANGE_PAGE](state) {
          state.messageList[state.messageId].page++;
        }
      }
    },
    /**
     * message 底部悬浮输入框
     */
    messageBottomInput: {
      namespaced: true,
      state: {
        /**
         * 是否显示底部输入框
         * 
         * @type {boolean}
         */
        show: false
      },
      actions: {
        showMessageInput({ commit }, bShow) {
          commit(types.SHOW_MESSAGE_INPUT, bShow);
        }
      },
      mutations: {
        [types.SHOW_MESSAGE_INPUT](state, bShow) {
          state.show = bShow;
        }
      }
    },
    /**
     * settingInfo 设置页信息
     */
    settingInfo: {
      namespaced: true,
      state: {
        userInfo: {
          image: '',
          name: '',
          fit: ''
        },
        account: ''
      },
      actions: {
        getSettingInfo({ commit }) {
          Indicator.open({
            text: '加载中...'
          });
          chatApi.getSetting().then(({ data: { data, code } }) => {
            if (code === 0) {
              commit(types.GET_SETTING_INFO, data);
              Indicator.close();
            }
          });
        }
      },
      mutations: {
        [types.GET_SETTING_INFO](state, data) {
          state.userInfo.name = data.nick_name;
          state.userInfo.image = data.service_avatar;
          state.account = data.user_name;
        }
      }
    }
  }
};
