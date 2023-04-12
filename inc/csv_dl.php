<?php
session_start();
// 出力情報の設定



// 変数の初期化
$storeArry = array();

// データ取得
$storeArry = $_SESSION['storeArry'];


function putCsv($data) {

    try {
		$storeName = $_SESSION['storeName'];
        //CSV形式で情報をファイルに出力のための準備
        $csvFileName = $storeName . '_bk_設置機種一覧' . '.csv';
        $fileName = $storeName . '_設置機種一覧' . '.csv';
        $res = fopen($csvFileName, 'w');
        if ($res === FALSE) {
            throw new Exception('ファイルの書き込みに失敗しました。');
        }

			
        // ループしながら出力
        foreach($data as $dataInfo) {
            // 文字コード変換。エクセルで開けるようにする
            mb_convert_variables('SJIS', 'UTF-8', $dataInfo);
			// ファイルに書き出しをする

			
            fputcsv($res,  $dataInfo);
        }
			
				
        // ファイルを閉じる
        fclose($res);
				//不要なファイルを削除
		    // unlink('./'.$csvFileName);
        // ダウンロード開始

        // ファイルタイプ（csv）
        header('Content-Type: application/octet-stream');

        // ファイル名
        header('Content-Disposition: attachment; filename=' . $fileName); 
        // ファイルのサイズ　ダウンロードの進捗状況が表示
        header('Content-Length: ' . filesize($csvFileName)); 
        header('Content-Transfer-Encoding: binary');
        // ファイルを出力する
        readfile($csvFileName);

    } catch(Exception $e) {

        // 例外処理をここに書きます
        echo $e->getMessage();

    }
};

putCsv($storeArry);
?>