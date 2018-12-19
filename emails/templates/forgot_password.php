<?php
  include './emails/new_email.php';
  $bodyContent = '
                  <html>
                    <body style="min-height:400px;">
                      <header style="width:100%;height:70px;border-bottom: 3px #f9f9f9 solid;">
                        <a href="http://maspostwarehouse.com">
                          <img src="http://www.maspostwarehouseusers.com/images/maspost-sm.png" height="70px" alt="" border="0">
                        </a>
                      </header>
                      <div style="padding-bottom:10px;">
                        <h1 style="padding-top:20px;">Reestablecer Contrasena</h1>
                        <p>Para reestablecer tu contrasena haz click <a href="http://maspostwarehouseusers.com/reset_password.php?token='.$token.'&email='.$email.'&pmb='.$pmb.'">aqui</a><p>
                      </div>
                    <footer style="width:98%;height:11px;margin-top:10px;background-color:#1c51c6;color:#FFF;padding:20px;">
                      <div style="text-align:center;">+Post Warehouse |  2220 Bassett Ave |  El Paso, TX  |  915.351.8160</div>
                    </footer>
                    </body>
                  </html>';

$mail->Subject    = "Reestablecer Contrasena";
$mail->Body    = $bodyContent;

if (!$mail->send()) {
  echo 'Message could not be sent.';
  echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
  echo"<script>alert(\"Enviado!\")</script>";
  echo"<script> window.location=\"index.php\"</script>";
}
?>