<?php
/**
 * リンク先/外部リンクの場合は別タブで開くかを判定する関数
 * 
 * リンク先URL（絶対パス）を渡し、同一ドメインの場合はtarget属性を設定しない。
 * リンク先の拡張子がpdfの場合は、同一ドメインであってもtarget属性を設定する。
 * 
 * @param string $URL 設定したいリンク先のURL
 * 
 * @return string $href href属性とtarget属性の文字列
 */
function hrefSetting($URL) {
    if ($URL) { // リンクがある場合
        $domain = $_SERVER['HTTP_HOST']; // ドメイン取得
        if( strpos( $URL, $domain ) ) { // リンクが同一ドメインの場合

            if( pathinfo($URL, PATHINFO_EXTENSION) == 'pdf' ) {
                $href = 'href="' . $URL . '" target="_blank" rel="noopener noreferrer"';
            }else{
                $href = 'href="' . $URL . '"';
            }

        } else {
            $href = 'href="' . $URL . '" target="_blank" rel="noopener noreferrer"';
        }
    } else { // リンクがない場合
        $href = '';
    }

    return $href;
}