$(document).ready(() => {
  /**
   * Sticky Block Settings
   */
  // #region
  const screenWidth = $(window).width();

  if (screenWidth > 1440) {
    const $container = $('.container'); // change it your container
    const $stickyBlock = $('.sticky-block'); // change it to block is sticky

    if ($stickyBlock.length && $container.length) {
      $(window).on('scroll', () => {
        handleScroll($stickyBlock, $container);
      });
    }
  }

  const handleScroll = ($stickyBlock, $container) => {
    const scrollPosition = $(window).scrollTop();
    const containerOffsetTop = $container.offset().top;
    const containerHeight = $container.height();
    const containerBottom = containerOffsetTop + containerHeight;
    const stickyBlockHeight = $stickyBlock.outerHeight(true);
    const stickyBlockBottom = scrollPosition + stickyBlockHeight;

    if (scrollPosition > containerOffsetTop) {
      if (stickyBlockBottom < containerBottom) {
        setSticky($stickyBlock);
      } else {
        setBottomPosition($stickyBlock, containerHeight, stickyBlockHeight);
      }
    } else {
      resetPosition($stickyBlock);
    }
  };

  const setSticky = ($stickyBlock) => {
    $stickyBlock.css({
      position: 'fixed',
      top: '50px',
      'z-index': '9',
    });
  };

  const setBottomPosition = ($stickyBlock, containerHeight, stickyBlockHeight) => {
    $stickyBlock.css({
      position: 'absolute',
      top: `${containerHeight - stickyBlockHeight}px`,
      'z-index': '9',
    });
  };

  const resetPosition = ($stickyBlock) => {
    $stickyBlock.css({
      position: '',
      top: '',
    });
  };
  // #endregion
});
