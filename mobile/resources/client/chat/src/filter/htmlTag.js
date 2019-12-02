/**
 * 相关 html tag filter
 * 
 * @file axios
 */

import Match from '@/plugins/match';
const match = new Match();

class HtmlTag {
  /**
   * 最新消息 过滤 tag 和 图片
   */
  messageNew(str) {
    let strImg = match.updateImageTag(str);
    return match.delHtmlTag(strImg);
  }
}
export default HtmlTag;
