<link rel="stylesheet" href="StyleSheet/post_finish_stylesheet.CSS">

<?php

//DB接続
try{
$pdo = new PDO(
    "mysql:dbname=MyBBS_DB;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
);

//投稿内容登録。
//ID採番
$sql = "SELECT";
$sql .= " MAX(POST_ID) AS POST_ID";
$sql .= " FROM";
$sql .= " T_POST_CONTENTS";
$result = $pdo->prepare($sql);
$result->execute();

if($result){
    foreach($result as $row):
        $id = $row['POST_ID'] + 1;
    endforeach;

}else{
    $id = 1;
}

//名前
if($_POST["name"] == ""){
    $name = "名無し";
}else{
    $name = $_POST["name"];
}

$contents = $_POST["contents"];

//登録SQL
$sql = "INSERT INTO T_POST_CONTENTS";
$sql .= "(POST_ID, POST_NM, POST_DT, CONTENT)";
$sql .= " VALUES (:id,:name,Now(),:contents)";

$regist = $pdo->prepare($sql);
$regist->bindParam(":id", $id);
$regist->bindParam(":name", $name);
$regist->bindParam(":contents", $contents);
$regist->execute();

}catch(PDOException $e){
    echo $e->getMessage();
    
}finally{
    $pdo = null;
}

?>

<!DOCTYPE html>
<meta charset="UTF-8">
<title>掲示板</title>
<section>
    <h2>投稿が完了しました!</h2>
    <button onclick="location.href='index.php'" class="back_botton">戻る</button>
</section>

