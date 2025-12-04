<?php get_header(); ?>
<?php
      require_once(get_template_directory() . '/functions/langCheck.php');

      $locale = get_locale();
?>

<div class="thanks_title_wrap">
      <?php get_template_part( 'page-templates/page-title', null, ['bg_img' => '', 'title_en' => langCheck('Contact', 'Contact Us'), 'title_ja' => langCheck('お問い合わせ完了', 'Inquiry completed')] ); ?>
</div>

<section class="section_thanks">
      <div class="thanks_container">
            <div class="thanks_wrap">
                  <p class="thanks_text"><?php echo langCheck('この度はお問い合わせいただき、<br class="sp">誠にありがとうございます。<br>担当者よりご連絡いたしますので、<br class="sp">しばらくお待ちください。', 'Thank you for contacting us.<br>Please wait a moment as we will contact you.'); ?></p>
                  <?php if($locale == 'ja') : ?>
                        <ul class="thanks_list">
                              <li class="thanks_item">・受付時間外にいただいたお問い合わせは、翌営業日以降に順次対応いたします。</li>
                              <li class="thanks_item">・お問い合わせ内容によっては、お時間を頂戴する場合やお返事を差し上げられない場合がございますので、あらかじめご了承ください。</li>
                              <li class="thanks_item">・弊社からお客さまへの回答は、お客さま個人宛にお送りするものでございます。内容の一部または全部の転用、二次利用はご遠慮ください。</li>
                        </ul>
                  <?php endif; ?>
                  <div class="thanks_btn_wrap">
                        <?php get_template_part( 'page-templates/roundFull-btn', null, ['text' => langCheck('トップページへ戻る', 'Back to top page'), 'href' => langCheck(home_url(), get_page_link( 594 )), 'type' => 'outlineGreen'] ); ?>
                  </div>
            </div>
      </div>
</section>
   
<?php get_footer(); ?>