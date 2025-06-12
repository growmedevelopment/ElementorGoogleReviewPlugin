<?php

$cols_d = esc_attr($settings['static_columns'] ?? '3');
$cols_t = esc_attr($settings['static_columns_tablet'] ?? $cols_d);
$cols_m = esc_attr($settings['static_columns_mobile'] ?? $cols_t);
?>


<div class="review-cards --thumbnails"
     data-cols-desktop="<?= $cols_d ?>"
     data-cols-tablet="<?= $cols_t ?>"
     data-cols-mobile="<?= $cols_m ?>">
  <?php foreach ( $settings['list'] as $item ) : ?>
    <div class="review-card">
      <div class="user-container">
        <div class="user">

          <?php if (!empty($item['avatar_url'])) : ?>
            <img class="avatar" src="<?=$item['avatar_url']?>" alt="<?= $item['text']; ?>" height="40px" width="40px">
          <?php else:?>
            <div class="initial"><?= $item['link']; ?></div>
          <?php endif?>

          <div class="user-info">
            <p class="name"><?= strip_tags($item['text']); ?></p>

            <?php if (!empty($item['subtitle'])) : ?>
              <p class="subtitle"><?= strip_tags($item['subtitle']); ?></p>
            <?php endif?>

            <p class="date <?= $settings['hide_review_date'] === 'yes' ? '--hidden' :'' ?>"><?= $item['date']; ?></p>

          </div>

        </div>
        <div class="icon-googleLogo"><svg class="<?= $settings['hide_google_logo'] === 'yes' ? '--hidden' :'' ?>" width="20px" height="20px" viewBox="-3 0 262 262" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid"><path d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" fill="#4285F4"/><path d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" fill="#34A853"/><path d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782" fill="#FBBC05"/><path d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" fill="#EB4335"/></svg></div>
      </div>

      <div class="rating">
        <?php
        $fullNumber = filter_var($item['stars'], FILTER_VALIDATE_INT  | FILTER_VALIDATE_FLOAT);

        for ($i = 1; $i <= $item['stars']; $i++){
          echo $full_star;
        }
        if (!$fullNumber) {
          echo $half_of_star;
        }
        for ($i = 1; $i <= round(5 - ceil($item['stars'])); $i++){
          echo $empty_star;
        }
        echo $verified_tick;
        ?>

      </div>
      <div class="review-text"><?= strip_tags($item['review_description']); ?>  </div>
    </div>
  <?php endforeach; ?>
</div>