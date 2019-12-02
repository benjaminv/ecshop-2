
INSERT INTO `dsc_touch_ad_position`(`position_id`, `user_id`, `position_name`, `ad_width`, `ad_height`, `position_desc`, `position_style`, `is_public`, `theme`) VALUES (NUll, '0', '首页红包广告', '360', '180', '', '{foreach $ads as $ad}\r\n<div class=\"swiper-slide\">{$ad}</div>\r\n{/foreach}', '1', 'ecmoban_dsc2017');

--
-- 此处 position_id(3553) 是 SELECT position_id FROM dsc_touch_ad_position WHERE position_name = '首页红包广告'; 查询出来的值
--

INSERT INTO `dsc_touch_ad`(`ad_id`,`position_id`, `media_type`, `ad_name`, `ad_link`, `link_color`, `ad_code`, `start_time`, `end_time`, `link_man`, `link_email`, `link_phone`, `click_count`, `enabled`, `is_new`, `is_hot`, `is_best`, `public_ruid`, `ad_type`, `goods_name`) VALUES (NUll,'3553', '0', '首页红包广告', 'index.php?m=bonus', '', '1508375910448249656.png', '1508374020', '1606696948', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0')