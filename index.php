<?php
$qun = $_POST["qun"];
if ($qun == ""){$qun = "749609639";}
if ($qun <> ""){
    $url = 'https://admin.qun.qq.com/cgi-bin/qun_admin/get_join_link';
    $header = '
Host: admin.qun.qq.com
Accept: */*
User-Agent: QQ/9.5.9.28650 (Windows NT 10.0)
Connection: Keep-Alive
Cache-Control: no-cache
Cookie: uin=746515005; skey=你的Cookie;
Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
    $post_data = 'bkn=2085173833&gc='.$qun.'&qrsize=5';
    $options = array(
        'http' => array(
        'method' => 'POST',
        'header' => $header,
        'content' => $post_data,
        'timeout' => 15 * 60
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    $data = json_decode($result, true);
    $url = $data['url'];
    $img = $data['qrcode'];
    $urr = str_ireplace("_wv=1027&", "", $url);
    
    $out = '加群链接<br/>
                <div style="font-size:14px;">'.$urr.'</div><br/>加群二维码<br/>
                <img src="'.$img.'" style="width: 128px;">
                <img src="http://qr.f0f.cc/?m=2&p=8&t='.$urr.'" style="width: 128px;"><br/>群头像<br/><br/>
                <img src="http://p.qlogo.cn/gh/'.$qun.'/'.$qun.'/0" style="width: 256px;">';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>获取加群链接及群头像</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <style>
            .input-text {
                width: 256px;
                outline: none;
                border:1px solid #fff0;
                padding: 10px;
                border-radius: 4px;
                font-size: 14px;
                transition: 0.3s all;
                text-align: center;
            }
            .input-text:focus {
                border: 1px solid #ddd;
                background: #fff;
            }
        </style>
    </head>
    <body>
        <div style="max-width: 360px;margin: auto;text-align: center;"><br/><h3>获取加群链接</h3>
            <form method="post">
                <input type="mail" name="qun" placeholder="群号" class="input-text"><br/><br/>
                <input type="submit" value="获取" class="input-text" style="background-color: #448EF6;color: #fff;" onclick="post()"><br/><br/>
            </form>
            <div><?php echo $out;?></div>
            <a href="https://github.com/WOLF4096/Get-QQ-group-QR-code" target="_blank" style="font-size:14px;text-decoration:none;color:#777;">Github</a>
        </div>
    </body>
</html>
