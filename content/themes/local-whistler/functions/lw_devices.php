<?php

  $detect     = new Mobile_Detect;
  $deviceType = ( $detect->isMobile() ? ( $detect->isTablet() ? 'tablet' : 'phone' ) : 'computer' );

?>
