<link rel="stylesheet" href="StyleSheet/index_stylesheet.CSS">

<?php

//DB接続
try{
$pdo = new PDO(
    "mysql:dbname=MyBBS_DB;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
);

//投稿内容取得
$sql = "SELECT";
$sql .= " *";
$sql .= " FROM";
$sql .= " T_POST_CONTENTS";
$sql .= " ORDER BY POST_ID DESC";

$result = $pdo->prepare($sql);
$result->execute();

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
    <form action="post_finish.php" method="post">
        <!--投稿一覧-->
        <h1>投稿一覧</h1>
            <table class="data_table">
			    <thead>
					<tr>
						<th class="name_cell">名前</th>
						<th class="date_cell">投稿日時</th>
						<th class="content_cell">本文</th>
					</tr>
			    </thead>

				<tbody>
                    <?php foreach($result as $row):?>
                        <tr>
                            <td class="name_cell"><?= $row['POST_NM'] ?></td>
						    <td class="date_cell"><?= $row['POST_DT'] ?></td>
						    <td class="content_cell"><?= $row['CONTENT'] ?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>

            <!--名前、本文-->
            <table>
                <tr>
				    <th class="table_label">名前</th>
				    <td><input type="text" name="name" value="" maxlength=20 class="name_box"></td>
                </tr>
                <tr>
				    <th class="table_label">本文</th>
				    <td><textarea name="contents" rows="5" cols="20" maxlength=100 class="content_box"></textarea></td>
                </tr>
            </table>
            
        <button type="submit" >投稿</button>
    </form>
</section>