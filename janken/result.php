<?php
// var_dump関数でPOST送信されてきた情報を見る
// var_dump($_POST);

// # 誤ってGETでアクセスされたら最初の画面に送り返す処理
if($_SERVER['REQUEST_METHOD'] == "GET") {
    header("location: index.html");
    exit;
}
// ↑ header()関数でリダイレクト処理をした後は、基本的に exit; で終了させる。
// exitがないと、それ以降の処理も実行されてしまうため。
// exitを忘れるとバグることもあるらしいので注意！



// # じゃんけん画面(index.html)でユーザーに選択させた手を 変数「 my_hand 」に格納する。
// (POSTで送らて来た値はstringのため、intに変換して格納)
$my_hand = intval($_POST["myselect"]);

// echo gettype($_POST["myselect"]);
// echo gettype($my_hand);
// ↑データ型はgettype()関数で確認できる


// # コンピュータの手を 変数「 pc_hand 」に格納する。
// (コンピューターの手はrand関数を使って乱数で生成)
$pc_hand = rand(0,2);


// # 引数を持ったshowhandという関数を定義
function showhand($hand){
  // 配列を変数janken_arrayに代入
  $janken_array = array("グー","チョキ","パー");

  // 引数の値をインデックスとして、配列の値をshowhand関数の呼び出し元に返す
  return $janken_array[$hand];
}


// # 勝敗判定を行う関数を定義
function judge($player, $computer){
  // ジャンケンアルゴリズムを使用
  // (自分の手 - 相手の手 + 3) % 3
  // 答えが　0なら引き分け、1なら負け、2なら勝ち
  $result = ($player - $computer + 3) % 3;
  $result_array = array("引き分け","負け","勝ち");
  return $result_array[$result];
  // 結果を戻り値として返す
}

// 判定条件分岐を使うパターン
/*
function judge2($player, $computer){
  $result = ($player - $computer + 3) % 3;
  $result_string = "";
  switch($result){
    case 0:
      $result_string = "引き分け";
      break;
    case 1:
      $result_string = "負け";
      break;
    default:
      $result_string = "勝ち";
  }
    return $result_string;
}
*/
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>【結果】じゃんけん</title>
    <meta name="description" content="description">
</head>
<body>
    <h1>PHP:じゃんけんゲーム【結果】</h1>
    <ul>
        <li>あなたの手：<?=showhand($my_hand)?></li>
        <li>コンピューターの手：<?=showhand($pc_hand)?></li>
        <li>勝敗：<?=judge($my_hand,$pc_hand)?></li>
    </ul>
    <p><a href="index.html">もう一回勝負する</a></p>

</body>

</html>