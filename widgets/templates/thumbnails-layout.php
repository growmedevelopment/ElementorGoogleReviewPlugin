<?php
/** @var array $settings Elementor settings */
/** @var array $reviews  Enriched items — each has: stars_html, relative_date, + original fields */

if (! defined('ABSPATH')) {
    exit;
}

$hideDate  = ($settings['hide_review_date'] ?? '') === 'yes';
$hideLogo  = ($settings['hide_google_logo'] ?? '') === 'yes';
$badgeUrl  = esc_url(GOOGLE_REVIEWS_PLUGIN_URL . 'assets/images/points-badges_local_guides.webp');
$logoClass = $hideLogo ? '--hidden' : '';
$colsD     = esc_attr($settings['static_columns'] ?? '3');
$colsT     = esc_attr($settings['static_columns_tablet'] ?? $colsD);
$colsM     = esc_attr($settings['static_columns_mobile'] ?? $colsT);
?>
<div class="review-cards --thumbnails"
     data-cols-desktop="<?= $colsD ?>"
     data-cols-tablet="<?= $colsT ?>"
     data-cols-mobile="<?= $colsM ?>">
  <?php foreach ($reviews as $item): ?>
    <div class="review-card">
      <div class="user-container">
        <div class="user">

          <?php if (! empty($item['avatar_url'])): ?>
            <img class="avatar"
                 src="<?= esc_url($item['avatar_url']) ?>"
                 alt="<?= esc_attr($item['text']) ?>"
                 height="40" width="40">
          <?php else: ?>
            <div class="initial-container">
              <div class="initial">
                <?= esc_html($item['link']) ?>
                <?php if (($item['is_local_guide'] ?? '') === 'yes'): ?>
                  <img class="local-guide-badge"
                       src="<?= $badgeUrl ?>"
                       alt="<?= esc_attr__('Local Guide', 'google-review') ?>"
                       width="18" height="18">
                <?php endif ?>
              </div>
            </div>
          <?php endif ?>

          <div class="user-info">
            <p class="name"><?= esc_html($item['text']) ?></p>
            <?php if (! empty($item['subtitle'])): ?>
              <p class="subtitle"><?= esc_html($item['subtitle']) ?></p>
            <?php endif ?>
            <?php if (! $hideDate && ($item['relative_date'] ?? '') !== ''): ?>
              <p class="date"><?= esc_html($item['relative_date']) ?></p>
            <?php endif ?>
          </div>

        </div>

        <div class="icon-googleLogo">
          <svg class="<?= esc_attr($logoClass) ?>" width="20px" height="20px" viewBox="-3 0 262 262" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid">
            <path d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" fill="#4285F4"/>
            <path d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" fill="#34A853"/>
            <path d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782" fill="#FBBC05"/>
            <path d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" fill="#EB4335"/>
          </svg>
        </div>
      </div>

      <div class="rating"><?= $item['stars_html'] ?></div>

      <div class="review-text"><?= wp_kses_post($item['review_description'] ?? '') ?></div>
    </div>
  <?php endforeach ?>
</div>
