<table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;background-color: #ebedf0;font-family:'Alright Sans LP', 'Avenir Next', 'Helvetica Neue', Helvetica, Arial, 'PingFang SC', 'Source Han Sans SC', 'Hiragino Sans GB', 'Microsoft YaHei', 'WenQuanYi MicroHei', sans-serif;">
  <tbody><tr>
    <td>
      <table width="640" cellspacing="0" cellpadding="0" align="center">
        <tbody><tr>
          <td style="height:20px;"></td>
        </tr>
        
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td>
            <table width="640" cellspacing="0" cellpadding="0">
              <tbody><tr style="line-height: 40px;">
                <td width="80" style="padding-left: 290px;">
                  <a href="http://www.webshowu.com">
                    webshowu
                  </a>
                </td>
              </tr>
            </tbody></table>
          </td>
        </tr>
        <tr>
          <td height="40"></td>
        </tr>
        <tr>
          <td style="background-color: #fff;border-radius:6px;padding:40px 40px 0;">
            <table>
              <tbody><tr height="40">
                <td style="padding-left:25px;padding-right:25px;font-size:18px;font-family:'微软雅黑','黑体',arial;">
                  尊敬的{{ $name }}：
                </td>
              </tr>
              <tr height="15">
                <td></td>
              </tr>
              <tr height="30">
                <td style="padding-left:55px;padding-right:55px;font-family:'微软雅黑','黑体',arial;font-size:14px;line-height:20px;">
                  您的站点 {{ $web_url }} 于 {{ $uptime }} 审核成功，请点击链接： <a style="color:#0c94de" target="_blank" href="http://www.webshowu.com/siteinfo-{{ $web_id }}.html">{{ $web_name }}</a>查看。
                </td>
              </tr>
              <tr height="20">
                <td></td>
              </tr>
              <tr>
                <td style="padding-left:55px;padding-right:55px;font-family:'微软雅黑','黑体',arial;font-size:14px;">
                  此致<br>
                  webshowu团队
                </td>
              </tr>
              <tr height="50">
                <td></td>
              </tr>
            </tbody></table>
          </td>
        </tr>
        <tr>
          <td style="height:40px;"></td>
        </tr>
        <tr>
          <td style="text-align: center;color:#7a8599;font-size: 12px;">
            <p>
              <a target="_blank" href="https://github.com/lambq/webshowu" style="padding:0 5px;">
								<img width="23" src="{{ $message->embed($imgPath) }}">
							</a>
            </p>
            <p style="line-height: 20px;">
              远程操作运营 / QQ群：55725231
            </p>
          </td>
        </tr>
        <tr>
          <td style="height:50px;"></td>
        </tr>
      </tbody></table>
    </td>
  </tr>
</tbody></table>