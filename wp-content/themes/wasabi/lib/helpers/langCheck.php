<?php
/**
 * 現在の言語を判定して返す関数
 * 
 * 引数に日本語と英語のテキストを渡し、サイトの言語状態によって返すテキストを切り替える
 * 
 * @param string $jaText 日本語のテキスト
 * @param string $enText 英語のテキスト
 * 
 * @return string $text 日本語または英語のテキスト
 */
function langCheck($jaText = "", $enText = "") {
    $locale = get_locale(); // 言語取得
    if ($locale == 'ja') { // 日本語の場合
        $text = $jaText;
    } else { // 英語の場合
        $text = $enText;
    }

    return $text;
}