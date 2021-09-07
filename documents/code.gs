function doPost(e){
  let mail_to = e.parameter.mail_to;
  let txt = e.parameter.msg;
  let subject = "基礎プログラミング演習　質問システム　投稿通知"

  let log_txt= 
    "webhook受け取り:\n"+
    "送信先:"+mail_to+"\n"+
    "テキスト:\n"+txt+"\n";
  
  console.log(log_txt);

  GmailApp.sendEmail(mail_to, subject, txt);

  log_txt +="send_mail = done";
  console.log(log_txt);

  return log_txt;

}
