    <div class="clearfix"></div>
    <!-- Footer -->
    <div class="sec-padding section-dark">
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-xs-12 clearfix margin-bottom">
              <div class="footer-logo"><img src="../assets/images/logo/logo.png" alt="" /></div>
              <div class="clearfix"></div>
              <address class="text-light">
                <strong class="text-white">Address:</strong> <br>
                No.28 - 63739 street lorem ipsum, <br>
                ipsum City, Country
              </address>
              <span class="text-light"><strong class="text-white">Phone:</strong> + 1 (234) 567 8901</span><br>
              <span class="text-light"><strong class="text-white">Email:</strong> support@yoursite.com </span><br>
              <span class="text-light"><strong class="text-white">Fax:</strong> + 1 (234) 567 8901</span>
              <ul class="footer-social-icons white left-align icons-plain text-center">
                <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a class="active" href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
              </ul>
            </div>
            <!--end item-->

            <div class="col-md-4 col-xs-12 clearfix margin-bottom">
              <h4 class="text-white less-mar3 font-weight-5">About Us</h4>
              <div class="clearfix"></div>
              <br />
              <ul class="footer-quick-links-4 white">
                <li><a href="#"><i class="fa fa-angle-right"></i> Placerat bibendum</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> Ullamcorper odio nec turpis</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> Aliquam porttitor vestibulum ipsum</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> Lobortis enim nec nisi</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> Placerat bibendum</a></li>
              </ul>
            </div>
            <!--end item-->

            <div class="col-md-4 col-xs-12 clearfix margin-bottom">
              <h4 class="text-white less-mar3 font-weight-5">More Services</h4>
              <div class="clearfix"></div>
              <br />
              <ul class="footer-quick-links-4 white">
                <li><a href="#"><i class="fa fa-angle-right"></i> Placerat bibendum</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> Ullamcorper odio nec turpis</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> Aliquam porttitor vestibulum ipsum</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> Lobortis enim nec nisi</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> Placerat bibendum</a></li>
              </ul>
            </div>
            <!--end item-->
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <!-- Copyright -->
      <section class="sec-padding-6 section-medium-dark">
        <div class="container">
          <div class="row">
            <div class="fo-copyright-holder text-center"> Copyright © 2018 l Codelayers. All rights reserved. </div>
          </div>
        </div>
      </section>
      <div class="clearfix"></div>
      <!-- Scroll to Top -->
      <a href="#" class="scrollup"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
    </div>
    <!--end site wrapper-->
  </div>
  <!--end wrapper boxed-->

  <!-- Scripts -->
  <script src="../assets/js/jquery/jquery.js"></script>
  <script src="../assets/js/bootstrap/bootstrap.min.js"></script>
  <script src="../assets/js/switches/bootstrap-switch.js"></script>

  <script src="../assets/js/less/less.min.js" data-env="development"></script>

  <!-- Scripts END -->

  <!-- Template scripts -->
  <script src="../assets/js/megamenu/js/main.js"></script>
  <script type="text/javascript" src="../assets/js/ytplayer/jquery.mb.YTPlayer.js"></script>
  <script type="text/javascript" src="../assets/js/ytplayer/elementvideo-custom.js"></script>
  <script type="text/javascript" src="../assets/js/ytplayer/play-pause-btn.js"></script>
  <!-- REVOLUTION JS FILES -->
  <script type="text/javascript" src="../assets/js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
  <script type="text/javascript" src="../assets/js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>
  <!-- SLIDER REVOLUTION 5.0 EXTENSIONS -->
  <script type="text/javascript">
    var tpj = jQuery;
    var revapi4;
    tpj(document).ready(function () {
      if (tpj("#rev_slider_4_1").revolution == undefined) {
        revslider_showDoubleJqueryError("#rev_slider_4_1");
      } else {
        revapi4 = tpj("#rev_slider_4_1").show().revolution({
          sliderType: "standard",
          jsFileLocation: "../assets/js/revolution-slider/js/",
          sliderLayout: "auto",
          dottedOverlay: "none",
          delay: 9000,
          navigation: {
            keyboardNavigation: "off",
            keyboard_direction: "horizontal",
            mouseScrollNavigation: "off",
            onHoverStop: "off",
            touch: {
              touchenabled: "on",
              swipe_threshold: 75,
              swipe_min_touches: 1,
              swipe_direction: "horizontal",
              drag_block_vertical: false
            }
            ,
            arrows: {
              style: "zeus",
              enable: true,
              hide_onmobile: true,
              hide_under: 600,
              hide_onleave: true,
              hide_delay: 200,
              hide_delay_mobile: 1200,
              tmp: '<div class="tp-title-wrap">  	<div class="tp-arr-imgholder"></div> </div>',
              left: {
                h_align: "left",
                v_align: "center",
                h_offset: 30,
                v_offset: 0
              },
              right: {
                h_align: "right",
                v_align: "center",
                h_offset: 30,
                v_offset: 0
              }
            }
            ,

            bullets: {
              enable: false,
              hide_onmobile: true,
              hide_under: 600,
              style: "dione",
              hide_onleave: true,
              hide_delay: 200,
              hide_delay_mobile: 1200,
              direction: "horizontal",
              h_align: "center",
              v_align: "bottom",
              h_offset: 0,
              v_offset: 30,
              space: 5,
              tmp: '<span class="tp-bullet-img-wrap">  <span class="tp-bullet-image"></span></span><span class="tp-bullet-title">{{title}}</span>'
            }
          },
          viewPort: {
            enable: true,
            outof: "pause",
            visible_area: "80%"
          },
          responsiveLevels: [1240, 1024, 778, 480],
          gridwidth: [1240, 1024, 778, 480],
          gridheight: [670, 640, 650, 400],
          lazyType: "none",
          parallax: {
            type: "mouse",
            origo: "slidercenter",
            speed: 2000,
            levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50],
          },
          shadow: 0,
          spinner: "off",
          stopLoop: "off",
          stopAfterLoops: -1,
          stopAtSlide: -1,
          shuffle: "off",
          autoHeight: "off",
          hideThumbsOnMobile: "off",
          hideSliderAtLimit: 0,
          hideCaptionAtLimit: 0,
          disableProgressBar: "on",
          hideAllCaptionAtLilmit: 0,
          debugMode: false,
          fallbacks: {
            simplifyAll: "off",
            nextSlideOnWindowFocus: "off",
            disableFocusListener: false,
          }
        });
      }
    });	/*ready*/
  </script>
  <script>
    $(window).load(function () {
      setTimeout(function () {

        $('.loader-live').fadeOut();
      }, 1000);
    })

  </script>
  <script src="../assets/js/parallax/parallax-background.min.js"></script>
  <script>
      (function ($) {
        $('.parallax').parallaxBackground();
      })(jQuery);
  </script>
  <script src="../assets/js/tabs/js/responsive-tabs.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="../assets/js/cubeportfolio/jquery.cubeportfolio.min.js"></script>
  <script type="text/javascript" src="../assets/js/cubeportfolio/main.js"></script>
  <script src="../assets/js/owl-carousel/owl.carousel.js"></script>
  <script src="../assets/js/owl-carousel/custom.js"></script>
  <script src="../assets/js/owl-carousel/owl.carousel.js"></script>
  <script src="../assets/js/accordion/js/smk-accordion.js"></script>
  <script src="../assets/js/accordion/js/custom.js"></script>
  <script src="../assets/js/progress-circle/raphael-min.js"></script>
  <script src="../assets/js/progress-circle/custom.js"></script>
  <script src="../assets/js/progress-circle/jQuery.circleProgressBar.js"></script>
  <script src="../assets/js/functions/functions.js"></script>
  <script src="../assets/js/custom.js"></script>
  <script src="../usersoft/assets/js/custom.js"></script> <!-- Custom Js -->
	<script src="../usersoft/assets/plugins/sweetalert/sweetalert.min.js"></script>

  <script type="text/javascript" src="../home/customers-ajax.js"></script>
</body>

</html>