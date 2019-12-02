/**
 * 相关 match(正则) 的相关写法
 * 
 * @file match
 */

class Match {
  /**
   * 匹配所有 tag 并转为空
   * 
   * @param {String} str 
   */
  delHtmlTag(str) {
    return str.replace(/<[^>]+>/g, '');
  }
  /**
   * 匹配图片标签 并转换为 [图片]
   * 
   * @param {String} str
   */
  updateImageTag(str) {
    return str.replace(/<img [^>]*src=['"][^'"]+[^>]*>/g, '[图片]');
  }
}
export default Match;
