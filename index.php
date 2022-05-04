<?php
$qun = $_POST["qun"];
if ($qun <> ""){
    $url = "https://admin.qun.qq.com/cgi-bin/qun_admin/get_join_link";//请求URL
    $post_data = array (
        "bkn" => "1285407349",
        "gc" => $qun,
        "qrsize" => "4"
        );//请求参数
    $cookie = "uin=你的QQ; skey=你的密钥（不是QQ密码）;";//Cookie
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    $output = curl_exec($ch);
    
    $data = json_decode($output, true);
    $url = $data['url'];
    $img = $data['qrcode'];
    $urr = str_ireplace("_wv=1027&", "", $url);//这一行有没有都可以
    
    $out = '加群链接<br/>
    <div style="font-size:14px;">'.$urr.'</div><br/>
    加群二维码<br/>
    <img src="'.$img.'" style="width: 128px;">
    <img src="http://qr.f0f.cc/?m=2&p=8&t='.$urr.'" style="width: 128px;"><br/>
    群头像<br/><br/>
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
        </div>
    </body>
</html>
