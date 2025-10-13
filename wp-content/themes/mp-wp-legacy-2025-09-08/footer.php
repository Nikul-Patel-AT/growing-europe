<?php
$footer_section_title       = get_field('footer_section_title', 'option');
$footer_section_description = get_field('footer_section_description', 'option');
$photo_section_title = get_field('photos_section_title','option');
$contact_info_title = get_field('contact_info_title','option');
$footer_left                = get_field('footer_left_section', 'option');
$footer_right               = get_field('footer_right_section', 'option');
$copyright                  = get_field('footer_copyright', 'option');
$section_id                  = get_field('section_id', 'option');
?>

<footer id="<?php echo $section_id; ?>">
  <div class="footer primary_background">
    <div class="container footer__flex_container">

      <!-- Main Footer Section -->
      <div class="footer__section white_background">

        <!-- heading Section -->
        <?php if ( ! empty( $photo_section_title ) ) : ?>
          <h2 class="footer-section-title font--h2-600"><?php echo esc_html( $photo_section_title ); ?></h2>
        <?php endif; ?>
        
        <!-- Left Section -->
        <?php if ($footer_left): ?>
          <div class="footer__left footer__right">
            <?php if (!empty($footer_left['heading'])): ?>
              <p class="font--p-16 blue_secound_color"><?php echo esc_html($footer_left['heading']); ?></p>
            <?php endif; ?>

            <?php if (!empty($footer_left['social_links'])): ?>
              <div class="social-icons">
                <?php foreach ($footer_left['social_links'] as $link):
                  if ($link['social_icon'] && $link['social_url']): ?>
                    <a href="<?php echo esc_url($link['social_url']); ?>" target="_blank" rel="noopener" class="btn btn--primary btn--icon">
                      <img src="<?php echo esc_url($link['social_icon']['url']); ?>" alt="<?php echo esc_attr($link['social_icon']['alt'] ?: 'icon'); ?>">
                    </a>
                <?php endif;
                endforeach; ?>
              </div>
            <?php endif; ?>

            
            <div class="footer-left-image-sec">
              <?php if (!empty($footer_left['global_contact_name'])): ?>
                <h3 class="font--h4-500 blue_secound_color"><?php echo esc_html($footer_left['global_contact_name']); ?></h3>
              <?php endif; ?>  
              <?php if ($footer_left['global_left_image']): ?>
                <div class="left-side-image">
                  <img src="<?php echo esc_url($footer_left['global_left_image']['url']); ?>" alt="<?php echo esc_url($footer_left['global_left_image']['alt']); ?>" width="200" height="200">
                </div>
              <?php endif; ?>
              <div class="left-content-sec">
                <?php if (!empty($footer_left['global_email'])): ?>
                  <div class="contact-email-box">
                    <span class="btn btn--primary btn--icon">
                      <!-- Email SVG icon -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none">
                        <path d="M12.0012 15.5722C14.0094 15.5722 15.6372 13.9443 15.6372 11.9363C15.6372 9.92819 14.0094 8.30029 12.0012 8.30029C9.99313 8.30029 8.36523 9.92819 8.36523 11.9363C8.36523 13.9443 9.99313 15.5722 12.0012 15.5722Z"
                          stroke="white" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round" />
                        <path d="M16.8288 19.2092C15.2086 20.2845 13.2756 20.7879 11.3367 20.6396C9.39772 20.4912 7.56388 19.6997 6.12607 18.3904C4.68826 17.0811 3.72884 15.3292 3.40007 13.4126C3.0713 11.496 3.392 9.52455 4.31128 7.81095C5.23057 6.09736 6.69578 4.73986 8.47445 3.95381C10.2531 3.16778 12.2433 2.99823 14.1292 3.47208C16.0153 3.94593 17.6889 5.03604 18.8849 6.56943C20.0807 8.1028 20.7303 9.99167 20.7305 11.9363C20.7305 13.9445 20.0032 15.5726 18.185 15.5726C16.3668 15.5726 15.6395 13.9445 15.6395 11.9363V8.29989"
                          stroke="white" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round" />
                      </svg>
                    </span>
                    <div class="email-label-box">
                      <?php if (!empty($footer_left['global_email_label'])): ?>
                        <p class="font--p-16 blue_secound_color">
                          <?php echo esc_html($footer_left['global_email_label']); ?>
                        </p>
                      <?php endif; ?>
                      <a href="mailto:<?php echo esc_attr($footer_left['global_email']); ?>"
                        class="font--h4-500 primary-color">
                        <?php echo esc_html($footer_left['global_email']); ?>
                      </a>
                    </div>
                  </div>
                <?php endif; ?>
                <?php if (!empty($footer_left['global_phone_number'])): ?>
                  <div class="contact-phone-box">
                    <span class="btn btn--primary btn--icon">
                      <!-- Phone SVG icon -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07A19.5 19.5 0 0 1 3.1 12.81 19.8 19.8 0 0 1 .03 4.18 2 2 0 0 1 2 2h3a2 2 0 0 1 2 1.72c.12.93.38 1.84.77 2.68a2 2 0 0 1-.45 2.11L6.1 9.9a16 16 0 0 0 7 7l1.39-1.22a2 2 0 0 1 2.11-.45c.84.39 1.75.65 2.68.77A2 2 0 0 1 22 16.92z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                    </span>
                    <div class="email-label-box">
                      <?php if (!empty($footer_left['global_phone_number_label'])): ?>
                        <p class="font--p-16 blue_secound_color">
                          <?php echo esc_html($footer_left['global_phone_number_label']); ?>
                        </p>
                      <?php endif; ?>
                      <a href="tel:<?php echo esc_attr($footer_right['phone_number']); ?>" class="font--h4-500 primary-color">
                        <?php echo esc_html($footer_left['global_phone_number']); ?>
                      </a>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <!-- Right Section -->
        <?php if ($footer_right): ?>
          <div class="footer__right">
            <?php if (!empty($footer_right['heading'])): ?>
              <p class="font--p-16 blue_secound_color"><?php echo esc_html($footer_right['heading']); ?></p>
            <?php endif; ?>

            
            <div class="footer-right-image-sec"> 
              <?php if (!empty($footer_right['contact_name'])): ?>
                <h3 class="font--h4-500 blue_secound_color"><?php echo esc_html($footer_right['contact_name']); ?></h3>
              <?php endif; ?>
              <?php if ($footer_right['footer_right_image']): ?>
                <div class="right-side-image">
                  <img src="<?php echo esc_url($footer_right['footer_right_image']['url']); ?>" alt="<?php echo esc_url($footer_right['footer_right_image']['alt']); ?>" width="200" height="200">
                </div>
              <?php endif; ?>
              <div class="left-content-sec"> 
                <?php if (!empty($footer_right['contact_email'])): ?>
                  <div class="contact-email-box">
                    <span class="btn btn--primary btn--icon">
                      <!-- Email SVG icon -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M12.0012 15.5722C14.0094 15.5722 15.6372 13.9443 15.6372 11.9363C15.6372 9.92819 14.0094 8.30029 12.0012 8.30029C9.99313 8.30029 8.36523 9.92819 8.36523 11.9363C8.36523 13.9443 9.99313 15.5722 12.0012 15.5722Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M16.8288 19.2092C15.2086 20.2845 13.2756 20.7879 11.3367 20.6396C9.39772 20.4912 7.56388 19.6997 6.12607 18.3904C4.68826 17.0811 3.72884 15.3292 3.40007 13.4126C3.0713 11.496 3.392 9.52455 4.31128 7.81095C5.23057 6.09736 6.69578 4.73986 8.47445 3.95381C10.2531 3.16778 12.2433 2.99823 14.1292 3.47208C16.0153 3.94593 17.6889 5.03604 18.8849 6.56943C20.0807 8.1028 20.7303 9.99167 20.7305 11.9363C20.7305 13.9445 20.0032 15.5726 18.185 15.5726C16.3668 15.5726 15.6395 13.9445 15.6395 11.9363V8.29989" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                    </span>
                    <div class="email-label-box">
                      <?php if (!empty($footer_right['email_label'])): ?>
                        <p class="font--p-16 blue_secound_color"><?php echo esc_html($footer_right['email_label']); ?></p>
                      <?php endif; ?>
                      <a href="mailto:<?php echo esc_attr($footer_right['contact_email']); ?>" class="font--h4-500 primary-color">
                        <?php echo esc_html($footer_right['contact_email']); ?>
                      </a>
                    </div>
                  </div>
                <?php endif; ?>
                <?php if (!empty($footer_right['phone_number'])): ?>
                  <div class="contact-phone-box">
                    <span class="btn btn--primary btn--icon">
                      <!-- Phone SVG icon -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07A19.5 19.5 0 0 1 3.1 12.81 19.8 19.8 0 0 1 .03 4.18 2 2 0 0 1 2 2h3a2 2 0 0 1 2 1.72c.12.93.38 1.84.77 2.68a2 2 0 0 1-.45 2.11L6.1 9.9a16 16 0 0 0 7 7l1.39-1.22a2 2 0 0 1 2.11-.45c.84.39 1.75.65 2.68.77A2 2 0 0 1 22 16.92z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                    </span>
                    <div class="email-label-box">
                      <?php if (!empty($footer_right['phone_number_label'])): ?>
                        <p class="font--p-16 blue_secound_color">
                          <?php echo esc_html($footer_right['phone_number_label']); ?>
                        </p>
                      <?php endif; ?>
                      <a href="tel:<?php echo esc_attr($footer_right['phone_number']); ?>" class="font--h4-500 primary-color">
                        <?php echo esc_html($footer_right['phone_number']); ?>
                      </a>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>        
          </div>
        <?php endif; ?>
      </div>

      <div class="footer__section white_background">

        <?php if ( ! empty( $contact_info_title ) ) : ?>
          <h2 class="footer-section-title font--h2-600"><?php echo esc_html( $contact_info_title ); ?></h2>
        <?php endif; ?>

        <?php if ($footer_section_description): ?>
          <div class="footer__decscription font--p-16 blue_secound_color"><?php echo wp_kses_post($footer_section_description); ?></div>
        <?php endif; ?>
      </div>

      <!-- Copyright -->
      <?php if ($copyright): ?>
        <div class="footer-copyright font--p-16 white_color">
          <?php echo wp_kses_post($copyright); ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
</footer>


<!-- About Summit Pop Up Section -->
<?php
$summit_image   = get_field('summit_image', 'option');
$summit_content = get_field('summit_content', 'option');
$banner_image  = get_field('travel_accommodation_banner_image', 'option');
$travel_accommodation_content = get_field('travel_accommodation_content', 'option');
$research_banner_image  = get_field('research_banner_image', 'option');
$research_content = get_field('research_content', 'option');
$organizing_institutions_image  = get_field('organizing_institutions_image', 'option');
$organizing_institutions_content = get_field('organizing_institutions_content', 'option');
$save_every_newborn_image  = get_field('save_every_newborn_image', 'option');
$save_every_newborn_content = get_field('save_every_newborn_content', 'option');
?>

<div id="about-summit-popup" class="popup" style="display:none;">
  <div class="popup__main-container">
    <div class="popup-inner">
      <?php if ($summit_image): ?>
        <img src="<?php echo esc_url($summit_image['url']); ?>" alt="<?php echo esc_attr($summit_image['alt']); ?>" class="popup-image">
      <?php endif; ?>

      <?php if ($summit_content): ?>
        <div class="popup-content"><?php echo apply_filters('the_content', $summit_content); ?></div>
      <?php endif; ?>

      <button class="popup-close btn btn--primary btn--icon close_icon_color">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path d="M8.25729 7.75736L16.7426 16.2426M16.7426 7.75736L8.25729 16.2426" stroke="#492447" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="bevel" />
        </svg>
      </button>
    </div>
  </div>
</div>

<!-- Travel & Accommodation Pop Up Section -->
<div id="travel-accommodation-popup" class="popup" style="display:none;">
  <div class="popup__main-container">
    <div class="popup-inner">
      <?php if ($travel_accommodation_content): ?>
        <div class="popup-content"><?php echo apply_filters('the_content', $travel_accommodation_content); ?></div>
      <?php endif; ?>

      <button class="popup-close btn btn--primary btn--icon close_icon_color">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path d="M8.25729 7.75736L16.7426 16.2426M16.7426 7.75736L8.25729 16.2426" stroke="#492447" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="bevel" />
        </svg>
      </button>
    </div>
  </div>
</div>

<!-- Research Pop Up Section -->
<div id="research" class="popup" style="display:none;">
  <div class="popup__main-container">
    <div class="popup-inner">
      <?php if ($research_banner_image): ?>
        <img src="<?php echo esc_url($research_banner_image['url']); ?>" alt="<?php echo esc_attr($research_banner_image['alt']); ?>" class="popup-image">
      <?php endif; ?>

      <?php if ($research_content): ?>
        <div class="popup-content"><?php echo apply_filters('the_content', $research_content); ?></div>
      <?php endif; ?>

      <button class="popup-close btn btn--primary btn--icon close_icon_color">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path d="M8.25729 7.75736L16.7426 16.2426M16.7426 7.75736L8.25729 16.2426" stroke="#492447" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="bevel" />
        </svg>
      </button>
    </div>
  </div>
</div>

<!-- Organizing Institutions Pop Up Section -->
<div id="organizing-institutions" class="popup" style="display:none;">
  <div class="popup__main-container">
    <div class="popup-inner">
      <?php if ($organizing_institutions_image): ?>
        <img src="<?php echo esc_url($organizing_institutions_image['url']); ?>" alt="<?php echo esc_attr($organizing_institutions_image['alt']); ?>" class="popup-image">
      <?php endif; ?>

      <?php if ($organizing_institutions_content): ?>
        <div class="popup-content"><?php echo apply_filters('the_content', $organizing_institutions_content); ?></div>
      <?php endif; ?>

      <button class="popup-close btn btn--primary btn--icon close_icon_color">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path d="M8.25729 7.75736L16.7426 16.2426M16.7426 7.75736L8.25729 16.2426" stroke="#492447" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="bevel" />
        </svg>
      </button>
    </div>
  </div>
</div>

<!-- Save Every Newborn Pop Up Section -->
<div id="save-every-newborn" class="popup" style="display:none;">
  <div class="popup__main-container">
    <div class="popup-inner">
      <?php if ($save_every_newborn_image): ?>
        <img src="<?php echo esc_url($save_every_newborn_image['url']); ?>" alt="<?php echo esc_attr($save_every_newborn_image['alt']); ?>" class="popup-image">
      <?php endif; ?>

      <?php if ($save_every_newborn_content): ?>
        <div class="popup-content"><?php echo apply_filters('the_content', $save_every_newborn_content); ?></div>
      <?php endif; ?>

      <button class="popup-close btn btn--primary btn--icon close_icon_color">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path d="M8.25729 7.75736L16.7426 16.2426M16.7426 7.75736L8.25729 16.2426" stroke="#492447" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="bevel" />
        </svg>
      </button>
    </div>
  </div>
</div>

<?php wp_footer(); ?>
</body>

</html>