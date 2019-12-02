/**
 * @file chat footer mutation types
 */

/**
 * 根级
 */
export const SET_PAGE_TRANSITION_NAME = 'setPageTransitionName';
export const SAVE_SCROLL_TOP = 'saveScrollTop';
export const SET_AVIGATOR_NUMBER = 'setNavigatorNumber';
export const GET_IMAGE_FILES = 'getImageFiles';
export const SHOW_FACE_DIALOG = 'showFaceDialog';

/**
 * chat
 */

// socket对接
export const INSERT_INFO = 'chat/insertInfo';
export const COME_MESSAGE = 'chat/comeMessage';
export const COME_WAIT = 'chat/comeWait';
export const SEND_MESSAGE = 'chat/sendMessage';
export const NEW_DIALOGUE = 'chat/newDialogue';

// 底部导航 footerNav
export const ACTIVATE_CHAT_FOOTER_NAV = 'chat/activateChatFooterNav';
export const SHOW_BOTTOM_NAV = 'chat/showBottomNav';

// 聊天 message 输入框
export const SHOW_MESSAGE_INPUT = 'chat/showMessageInput';

// 对话 dialogue
export const GET_DIALOGUE_LIST = 'chat/getDialogueList';

// 访客 visitor
export const GET_VISITOR_LIST = 'chat/getVisitorList';

// 设置 setting
export const GET_SETTING_INFO = 'setting/getSettingInfo';

// 消息 message
export const SET_MESSAGE_ID = 'message/setMessageId';
export const GET_MESSAGE_LIST = 'message/getMessageList';
export const SET_MESSAGE_LIST = 'message/setMessageList';
export const SET_GOODS_INFO = 'message/setGoodsInfo';
export const CHANGE_TO_READ = 'message/changeToRead';
export const CHANGE_PAGE = 'message/changePage';
