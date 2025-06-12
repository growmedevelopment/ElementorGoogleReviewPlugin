<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$settings = $this->get_settings_for_display();
$reviews  = $this->fetchReviews();

if ( empty( $reviews ) ) {
  echo '<p>No reviews available.</p>';
  return;
}

$hideText   = $settings['show_only_reviews'] === 'yes';
$hideLogo   = $settings['hide_google_logo'] === 'yes';
$hideDate   = $settings['hide_review_date'] === 'yes';
?>

<div class="google-review-widget" data-settings='<?= wp_json_encode( $settings ); ?>'>
  <?php foreach ( $reviews as $review ) : ?>
    <div class="google-review-item">
      <div class="google-review-header">
        <?php if ( $settings['show_image'] && ! empty( $review['profile_photo_url'] ) ) : ?>
          <img src="<?= esc_url( $review['profile_photo_url'] ); ?>" class="profile-image" alt="<?= esc_attr( $review['author_name'] ); ?>" />
        <?php endif; ?>

        <?php if ( $settings['show_name'] ) : ?>
          <strong class="author-name"><?= esc_html( $review['author_name'] ); ?></strong>
        <?php endif; ?>

        <?php if ( $settings['show_verified'] ) : ?>
          <?= $this->renderVerifiedTick(); ?>
        <?php endif; ?>
      </div>

      <?php if ( $settings['show_rating'] && isset( $review['rating'] ) ) : ?>
        <div class="google-review-rating">
          <?= $this->renderStars( $review['rating'] ); ?>
        </div>
      <?php endif; ?>

      <?php if ( ! $hideText && ! empty( $review['text'] ) ) : ?>
        <p class="review-text"><?= esc_html( $review['text'] ); ?></p>
      <?php endif; ?>

      <?php if ( ! $hideDate && ! empty( $review['relative_time_description'] ) ) : ?>
        <small class="review-date"><?= esc_html( $review['relative_time_description'] ); ?></small>
      <?php endif; ?>

      <?php if ( ! $hideLogo ) : ?>
        <div class="google-logo">Google</div>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
</div>