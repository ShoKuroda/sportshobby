<?php
class ContactsController extends AppController{
	var $uses = array("Contact","Pref","Item","StockContact");
	var $helpers = array('Html', 'Form', 'xformjp', 'Cakeplus.Formhidden');
	var $components = array('Qdmail', 'Qdsmtp','Session');


	function contact(){
		$this->layout = 'no_action';
		
		$pref = $this->Pref->find('list');
		$category = array("1"=>"商品について","2"=>"スポーツホビーについて","3"=>"その他");
		$enquete = array("1"=>"Google","2"=>"Yahoo","3"=>"店舗を知っている","4"=>"その他");
		//都道府県
		$this->set('Pref', $pref);
		
		//問い合わせ種類
		$this->set('Category', $category);
		$this->set('Enquete', $enquete);
		
		if(isset($this->params['form']['confirm'])) { //確認ページ
			if(!empty($this->data)){
				$this->Contact->set($this->data);
				if($this->Contact->validates()) {   //バリデーション問題なし
					$this->Session->write('reload', false);  //リロード対策セッションの登録
					$this->params['xformHelperConfirmFlag'] = true;  //確認画面の表示に切り替える
					$this->render('confirm');
				return;
				}
			$this->render();
			return;
			}
		} else if(isset($this->params['form']['back'])) { //入力ページに戻る
			$this->render();
			return;
		} else if(isset($this->params['form']['finish'])) { //完了ページ
			if(!$this->Session->read('reload')) { //リロードした場合はメール送信しない。
				//メールの内容を変数に入れる
				$mail_data = $this->data["Contact"];
				$mail_data["MST_pref"] = $pref;
				$mail_data["MST_category"] = $category;
				$mail_data["MST_enquete"] = $enquete;
				
				$this->send_mail($this->data["Contact"]["mail"], $this->data["Contact"]["name"], $mail_data,1);  //メールを送信
				$this->Session->write('reload', true);  //リロードフラグを立てる
			}
			$this->render('finish');
			return;
		}
	}
	
	
	function stock_contact(){
		$this->layout = 'no_action';
		
		$item = $this->Item->find('first', array('conditions' => array('Item.rac' => RAKUTEN_SHOPID.$this->params['url']['id'])));
		$pref = $this->Pref->find('list');
		$enquete = array("1"=>"Google","2"=>"Yahoo","3"=>"店舗を知っている","4"=>"その他");
		
		$this->set('Pref', $pref);
		$this->set('Enquete', $enquete);
		$this->set('Item', $item);
		
		if(isset($this->params['form']['confirm'])) { //確認ページ
			if(!empty($this->data)){
				$this->StockContact->set($this->data);
				if($this->StockContact->validates()) {   //バリデーション問題なし
					$this->data["Contact"] = $this->data["StockContact"];
					$this->Session->write('reload', false);  //リロード対策セッションの登録
					$this->params['xformHelperConfirmFlag'] = true;  //確認画面の表示に切り替える
					$this->render('stock_confirm');
				return;
				}
			$this->render();
			return;
			}
		} else if(isset($this->params['form']['back'])) { //入力ページに戻る
			$this->render();
			return;
		} else if(isset($this->params['form']['finish'])) { //完了ページ
			if(!$this->Session->read('reload')) { //リロードした場合はメール送信しない。
				//メールの内容を変数に入れる
				$mail_data = $this->data["StockContact"];
				$mail_data["MST_pref"] = $pref;
				$mail_data["MST_enquete"] = $enquete;
				$mail_data["Item"] = $item;
				
				$this->send_mail($this->data["Contact"]["mail"], $this->data["Contact"]["name"], $mail_data,2);  //メールを送信
				$this->Session->write('reload', true);  //リロードフラグを立てる
			}
			$this->render('stock_finish');
			return;
		}
	}
	
	
	
	
	//メールを送信します。
	function send_mail($email, $name, $mail_data, $template) {
		$this->view = "View";
				
		$mail_param = array(        //SMTPの設定
		'host' => 'smtp.hoge.jp',   //ホスト名
		'port' => 587,              //ポート
		'from' => 'admin@hoge.jp',  //Return-path
		'protocol' => 'SMTP_AUTH',  //認証方式
		'user' => 'admin',          //SMTPサーバーのユーザーID
		'pass' => 'password'        //SMTPサーバーの認証パスワード
		);
		

		$this->Qdmail->reset();  //リセット
		
		//$this->Qdmail->smtp(true);	//SMTP設定
		//$this->Qdmail->smtpServer($mail_param);
		
		if($template == 1){
		//お問い合わせ
			$this->Qdmail->to($email, $name);    //送信先
			$this->Qdmail->subject('【スポーツホビー】お問い合わせを受け付けました');   //件名
			$this->Qdmail->from(MASTER_MAIL, MASTER_NAME);  //送信元
			$this->Qdmail->cakeText($mail_data,'contact');  //ユーザー	
			$this->Qdmail->send();  //メールを送信
			
			
			$this->Qdmail->reset();  //リセット
			$this->Qdmail->to(MASTER_MAIL, MASTER_NAME);    //送信先
			$this->Qdmail->subject('【sportshobby.co.jp】お問い合わせがありました');   //件名
			$this->Qdmail->from(MASTER_MAIL, MASTER_NAME);  //送信元
			$this->Qdmail->cakeText($mail_data,'admin_contact');  //ユーザー	
			$this->Qdmail->send();  //メールを送信
		
		}elseif($template == 2){
		//在庫お問い合わせ
			$this->Qdmail->to($email, $name);    //送信先
			$this->Qdmail->subject('【スポーツホビー】在庫のお問い合わせを受け付けました');   //件名
			$this->Qdmail->from(MASTER_MAIL, MASTER_NAME);  //送信元
			$this->Qdmail->cakeText($mail_data,'stock_contact');  //ユーザー	
			$this->Qdmail->send();  //メールを送信
			
			
			$this->Qdmail->reset();  //リセット
			$this->Qdmail->to(MASTER_MAIL, MASTER_NAME);    //送信先
			$this->Qdmail->subject('【sportshobby.co.jp】在庫のお問い合わせがありました');   //件名
			$this->Qdmail->from(MASTER_MAIL, MASTER_NAME);  //送信元
			$this->Qdmail->cakeText($mail_data,'admin_stock_contact');  //ユーザー	
			$this->Qdmail->send();  //メールを送信
		
		}
	}
	

}
?>