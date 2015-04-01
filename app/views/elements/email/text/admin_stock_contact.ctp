-------------------------------
【在庫問い合わせ】下記内容を確認して対応をお願いします。
-------------------------------
商品ID　：　<?=$content[Item][Item][rac]."\n"?>
商品名　：　<?=$content[Item][Item][item_name]."\n"?>
価格　：　<?=$content[Item][Item][sell_price]?> 円

名前　　　：　<?=$content[name]."\n"?>
フリガナ　：　<?=$content[kana]."\n"?>
電話番号　：　<?=$content[tell]."\n"?>
メール　　：　<?=$content[mail]."\n"?>
都道府県　：　<?=$content[MST_pref][$content[pref]]."\n"?>
住所（市区町村）　　：　<?=$content[address1]."\n"?>
住所（番地・建物名）　　：　<?=$content[address2]."\n"?>

お問い合わせ内容：　<?=$content[message]."\n"?>
-------------------------------
当社理由　：　<?=$content[MST_enquete][$content[enquete]]."\n"?>