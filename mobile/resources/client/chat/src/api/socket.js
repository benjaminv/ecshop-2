/**
 * @file socket
 */
// chat api file
import {
  outLogin
} from '@/api/chat';

import { MessageBox } from 'mint-ui';

let ws = null;
let obj = null;
let timer = null;

/**
 * 初始化项目
 */
function init(o) {
  obj = o;
  let {
    vue,
    listen_route: listenRoute,
    port,
    avatar,
    name,
    uid,
    store_id,
    is_ssl
  } = obj;
  ws = new WebSocket(`${isSsl(is_ssl)}:${listenRoute}:${port}`);
  ws.onopen = () => {
    ws.send(JSON.stringify({
      name: name,
      avatar: avatar,
      origin: isPc() ? 'pc' : 'phone',
      store_id: store_id,
      uid: uid,
      type: 'login',
      user_type: 'service'
    }));
  };
  ws.onclose = () => {
    console.log('关闭关闭');
  };
  ws.onmessage = (e) => {
    let info = JSON.parse(e.data);
    switch (info.message_type) {
      case 'come': // 有客服登录
        if (info.uid === obj.user.user_id) break;
        // dscmallEvent.init();
        break;
      case 'leave': // 有客服登出
        if (info.uid === obj.user_id || info.uid !== '') break;
        break;
      case 'init': // 取得客服列表
        // if (info.msg) this.status = 1;
        // console.log(info);
        break;
      case 'come_msg': // 获取到消息
        vue.comeMessage(info);
        break;
      case 'come_wait': // 待接入消息
        vue.comeWait(info);
        break;
      case 'robbed': // 获取被抢客户
        // dscmallEvent.get_robbed(info);
        break;
      case 'user_robbed': // 通知用户已被接入
        // dscmallEvent.get_service(info);
        break;
      case 'uoffline': // 用户已下线
        // dscmallEvent.uoffline(info.message);
        break;
      case 'close_link': // 客服已断开
        // dscmallEvent.close_link(info);
        break;
      case 'others_login': // 异地登录
        MessageBox({
          title: '提示',
          message: '您已被强迫下线！',
          cancelButtonText: '退出登录',
          confirmButtonText: '强制登录',
          showConfirmButton: true,
          showCancelButton: true,
          closeOnClickModal: false
        }).then(res => {
          if (res === 'cancel') {
            outLogin({
              router: obj.vue.$router,
              ws: true
            });
          } else {
            window.location.reload();
          }
        });
        break;
      case 'change_service': // 切换客服
        // dscmallEvent.switch_service(info);
        break;
    }
  };
  ws.onclose = () => {
    console.log("连接断开，尝试重连");
    init(o);
  };
  clearInterval(timer);
  timer = setInterval(function () {
    ws.send('{"type":"ping"}');
  }, 15000);
}

/**
 * 
 * @param {String} msg - 发送信息
 * @param {Number} uid - 发送给某个用户的 id
 * @param {Number} goods_id - 商品id
 * @returns {Object}
 */
function sendmsg({ msg, uid, goods_id }) {
  if (!msg || msg === '' || obj === {} || obj.uid === '' || obj.uid === void 0) {
    return false;
  }
  ws.send(JSON.stringify({
    avatar: obj.avatar,
    goods_id,
    msg,
    origin: isPc() ? 'pc' : 'phone',
    store_id: obj.store_id,
    to_id: uid,
    type: 'sendmsg'
  }));
  return {
    avatar: obj.avatar,
    name: obj.name
  };
}

function close() {
  ws.close();
}

/**
 * 接入客户、 通知其他人、并修改对话状态
 * 
 * @param {Number} goods_id - 商品id
 * @param {Number} uid - 客户id
 * @param {Number} store_id - 店铺id
 */
function insertInfo({ goods_id, uid, store_id }) {
  ws.send(JSON.stringify({
    from_id: obj.uid,
    goods_id,
    msg: uid,
    store_id,
    to_id: null,
    type: 'info'
  }));
}

/**
 * 判断是否是pc
 */
function isPc() {
  let userAgentInfo = navigator.userAgent;
  let agents = ['Android', 'iPhone', 'SymbianOS', 'Windows Phone', 'iPad', 'iPod'];
  let flag = true;
  for (let v = 0; v < agents.length; v++) {
    if (userAgentInfo.indexOf(agents[v]) > 0) {
      flag = false;
      break;
    }
  }
  return flag;
}
/**
 * 判断协议是否为https或http
 */
function isSsl(isSsl) {
  return isSsl ? 'wss' : 'ws';
}

export {
  init,
  close,
  sendmsg,
  insertInfo
};
