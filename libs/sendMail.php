<?php
class sendMail {
    
    private static $sInstance = null;
    
    public function createHTML($init,$body,$end){
        $cuerpoTabla='';
        foreach ($body as $key => $val) {
            $cuerpoTabla=$cuerpoTabla.'<tr>
                                           <td><label>'.$key.'</label></td><td><input type="text" value="'.$val.'" readonly></td>
                                       </tr>';            
        }
        $texto = '
                <html>
                <head>
                  <title>Contact</title>
                </head>
                <body>
                  '.$init.'
                  <table>
                       '.$cuerpoTabla.'
                  </table>
                  '.$end.'                  
                </body>
                </html>
                ';
        return $texto;
    }
    public function send($subject,$txt,$from){
        $header = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/plain; charset=UTF-8' . "\r\n".'From: '.$from. "\r\n";
        mail('info@e-ssisa.com', '=?UTF-8?B?'.base64_encode($subject).'?=', $txt, $header);
        mail("cvirtual2003@hotmail.com",'=?UTF-8?B?'.base64_encode($subject).'?=',$txt);  
        mail("carlos.mazariegos@e-ssisa.com",$subject,$txt,$from);        
    }
    public static function getMe(){
        if(self::$sInstance == null){
            self::$sInstance = new sendMail();
        }
        return self::$sInstance;
    }    
}
