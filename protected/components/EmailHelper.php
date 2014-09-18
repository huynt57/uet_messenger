<?php

class EmailHelper {

    public static function sendRecoveryInstructionPassword($user, $newPassword) {
        $mail = new YiiMailer();
        $mail->setLayout('mail');
        $mail->setView('recoveryLink');
        $mail->setData(array('administrator' => $user, 'new_password' => $newPassword));

        $mail->setFrom('quocviet.cntt.bk@gmail.com', Yii::app()->params['SITE_NAME']);
        $mail->setTo($user->username);
        $mail->setSubject(Yii::t(Yii::app()->params['TRANSLATE_FILE'], 'Instruction to recovery password from ' . Yii::app()->params['SITE_NAME'] . ' system'));

        if ($mail->send()) {
            return null;
        } else {
            return $mail->getError();
        }
    }

    public static function sendInviteFriend($user, $link) {
        $mail = new YiiMailer();
        $mail->setLayout('mail');
        $mail->setView('inviteFriend');
        $mail->setData(array('administrator' => 'bluebee', 'link' => $link));
        $mail->Host = "localhost";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mailer->Username = 'activate@bluebee-uet.com';
        $mailer->Password = '123456789';
        $mail->setFrom('huynt57@gmail.com', Yii::app()->params['SITE_NAME']);
        $mail->setTo($user);
        $mail->setSubject("Invite class from Bluebee.com");

        if ($mail->send()) {
            return null;
        } else {
            return $mail->getError();
        }
    }

    public static function sendVerifyAccount($to, $from, $from_name, $subject, $body) {
        $mail = new PHPMailer();      // tạo một đối tượng mới từ class PHPMailer
        $mail->IsSMTP();       // bật chức năng SMTP
        $mail->CharSet = "UTF-8";
        $mail->IsHTML();
        $mail->SMTPDebug = 1;       // kiểm tra ỗi : 1 là  hiển thị lỗi và thông báo cho ta biết, 2 = chỉ thông báo lỗi
        $mail->SMTPAuth = true;      // bật chức năng đăng nhập vào SMTP này
        //$mail->SMTPSecure = 'ssl'; 				// sử dụng giao thức SSL vì gmail bắt buộc dùng cái này
        $mail->Host = 'localhost';   // smtp của gmail
        $mail->Port = 25;       // port của smpt gmail
        $mail->Username = "activate@bluebee-uet.com";
        $mail->Password = "123456789";
        $mail->SetFrom($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        if (!$mail->Send()) {
            $message = 'Gởi mail bị lỗi: ' . $mail->ErrorInfo;
            return false;
        } else {
           
            return true;
        }
    }

    public static function sendRecoveryPasswordEmail($user, $newPassword) {
        $mail = new YiiMailer();
        $mail->setLayout('mail');
        $mail->setView('recoveryPassword');
        $mail->setData(array('administrator' => $user, 'new_password' => $newPassword));

        $mail->setFrom('quocviet.cntt.bk@gmail.com', Yii::app()->params['SITE_NAME']);
        $mail->setTo($user->username);
        $mail->setSubject(Yii::t(Yii::app()->params['TRANSLATE_FILE'], 'Instruction to recovery password from ' . Yii::app()->params['SITE_NAME'] . ' system'));

        if ($mail->send()) {
            return null;
        } else {
            return $mail->getError();
        }
    }

}
