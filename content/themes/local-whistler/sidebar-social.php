<?php $options = get_option('lw_options'); ?>
<?php global $social_links; ?>

<div id="links" class="sidebar">
  <div class="widget business__links">
    <h3 class="widget-title">Social Links</h3>
    <ul>
      <?php foreach ( $social_links as $social ) : ?>
      <?php if ( empty( $options[$social] ) ) : continue; endif; ?>

        <li>
          <a
            href="<?php echo $options[$social]; ?>"
            target="blank"
            class="business__social__item">
            <i class="icon-<?php echo $social; ?> icon--before icon--sign"></i>
            <?php echo ucwords( str_replace('-', ' ', $social) ); ?>
          </a>
        </li>

      <?php endforeach; ?>
    </ul>
  </div>
</div>
