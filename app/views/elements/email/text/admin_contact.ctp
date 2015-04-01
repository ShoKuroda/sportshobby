-------------------------------
【問い合わせ】下記内容を確認して対応をお願いします。
-------------------------------
名前　　　：　<?=$content[name]."\n"?>
フリガナ　：　<?=$content[kana]."\n"?>
電話番号　：　<?=$content[tell]."\n"?>
メール　　：　<?=$content[mail]."\n"?>
都道府県　：　<?=$content[MST_pref][$content[pref]]."\n"?>
住所（市区町村）　　：　<?=$content[address1]."\n"?>
住所（番地・建物名）　　：　<?=$content[address2]."\n"?>

お問い合わせ種類	　：　<?=$content[MST_category][$content[category]]."\n"?>
お問い合わせ内容：　<?=$content[message]."\n"?>
-------------------------------
当社理由　：　<?=$content[MST_enquete][$content[enquete]]."\n"?>