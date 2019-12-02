INSERT INTO `dsc_shop_config` ( `parent_id` , `code` , `type` , `value` , `sort_order` ) VALUES ( 2, 'merchants_prefix', 'text', 'ecmoban_', '1' );

INSERT INTO `dsc_shop_config` (`parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES ('7', 'show_rank_price', 'select', '1,0', '', '0', '1');

UPDATE `dsc_mail_templates` SET `template_subject` = '会员注册模板', `template_content` = '<table width="700" cellspacing="0" border="0" align="center" style="width:700px;">
    <tbody>
        <tr>
            <td>
            <div style="width:700px;margin:0 auto;border-bottom:1px solid #ccc;margin-bottom:30px;">
            <table width="700" height="39" cellspacing="0" cellpadding="0" border="0" style="font:12px Tahoma, Arial, 宋体;">
                <tbody>
                    <tr>
                        <td width="210">&nbsp;</td>
                    </tr>
                </tbody>
            </table>
            </div>
            <div style="width:680px;padding:0 10px;margin:0 auto;">
            <div style="line-height:1.5;font-size:14px;margin-bottom:25px;color:#4d4d4d;"><strong style="display:block;margin-bottom:15px;">                         亲爱的会员：                         <span style="color:#f60;font-size: 16px;">{$user_name}</span>您好！                     </strong>                      <strong style="display:block;margin-bottom:15px;">                         您正在修改邮箱，请在验证码输入框中输入： <span style="color:#f60;font-size: 24px"><span style="border-bottom-width: 1px; border-bottom-style: dashed; border-bottom-color: rgb(204, 204, 204); z-index: 1; position: static;" t="7" onclick="return false;" data="459351" isout="1">{$register_code}</span></span>，以完成操作。                     </strong></div>
            <div style="margin-bottom:30px;"><small style="display:block;margin-bottom:20px;font-size:12px;">
            <p style="color:#747474;">注意：此操作可能会修改您的密码、登录邮箱或绑定手机。如非本人操作，请及时登录并修改密码以保证帐户安全                             <br />
            （工作人员不会向你索取此验证码，请勿泄漏！)</p>
            </small></div>
            </div>
            <div style="width:700px;margin:0 auto;">
            <div style="padding:10px 10px 0;border-top:1px solid #ccc;color:#747474;margin-bottom:20px;line-height:1.3em;font-size:12px;">
            <p>此为系统邮件，请勿回复<br />
            请保管好您的邮箱，避免账号被他人盗用</p>
            <p>大商创版权所有2005<span style="border-bottom-width: 1px; border-bottom-style: dashed; border-bottom-color: rgb(204, 204, 204); z-index: 1; position: static;" t="7" onclick="return false;" data="1999-2014">-2016</span></p>
            </div>
            </div>
            </td>
        </tr>
    </tbody>
</table>' WHERE `template_code` = 'user_register';

UPDATE `dsc_mail_templates` SET `template_subject` = '商家店铺升级', `template_content` = '亲爱的{$grade.shop_name}。你好！</br></br>关于您的您的{$grade.grade_name}申请我们已经认真查看核对，感谢对我们的信任。经过我们的认真考虑我们{$grade.confirm}您的请求。</br>{$grade.merchants_message}</br>{$send_date}' WHERE `template_code` = 'merchants_allpy_grade';