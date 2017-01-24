<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
  <head>
    <meta name="viewport" content="width=device-width">
    <title>VinoTeam</title>
    <style>
      .btn:hover{background-color:#d54541}
    </style>
    <style type="text/css">
      @media only screen and (max-width: 600px) {
        a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}
        div[class="column"] { width: auto!important; float:none!important;}
        table.social div[class="column"] {
          width:auto!important;
        }
      }
    </style>
  </head>
  <body style='background-color:#d54541; margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;height:100%;width:100% !important'>
    <!-- HEADER -->
    <table class="head-wrap" bgcolor="#FFFFFF" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;width:100%'>
      <tr style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>
        <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'></td>
        <td class="header container" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;display:block !important;max-width:600px !important;margin:0 auto !important;clear:both !important'>
          <div class="content" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;padding:15px;max-width:600px;margin:0 auto;display:block'>
            <table bgcolor="#ffffff" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;width:100%'>
              <tr style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>
                <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'><center style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'><img src="{{ URL::asset('/emails/logo.jpg') }}" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;max-width:100%'></center></td>
              </tr>
            </table>
          </div>
        </td>
        <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'></td>
      </tr>
    </table>
    <!-- /HEADER -->
    <!-- BODY -->
    <table class="body-wrap" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;width:100%'>
      <tr style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>
        <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'></td>
        <td class="container" bgcolor="#FFFFFF" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;display:block !important;max-width:600px !important;margin:0 auto !important;clear:both !important'>
          <div class="content" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;padding:15px;max-width:600px;margin:0 auto;display:block'>
            <table style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;width:100%'>
              <tr>
                <img src="{{ URL::asset('/emails/photo.jpg') }}" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;max-width:100%'>
                <br style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>
                 <br style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'></tr>
                <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>
				          @yield('content')
                  <br style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>
                  <!-- social & contact -->
                  <table class="social" width="100%" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;background-color:#ebebeb;width:100%'>
                    <tr style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>
                      <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>
                        <!-- column 1 -->
                        <table align="left" class="column" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;width:300px;width:100%;width:280px;min-width:279px;float:left'>
                          <tr style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>
                            <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;padding:15px'>
                              <h5 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:900;font-size:17px'>Suivez-nous :</h5>
                              <p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'><a href="https://www.facebook.com/VinoTeam/" class="soc-btn fb" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;color:#d54541;padding:3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color:#FFF;font-weight:bold;display:block;text-align:center;background-color:#3B5998 !important'>Facebook</a> <a href="https://twitter.com/vinoteam" class="soc-btn tw" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;color:#d54541;padding:3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color:#FFF;font-weight:bold;display:block;text-align:center;background-color:#1daced !important'>Twitter</a> <a href="https://plus.google.com/u/0/111971025096502866958" class="soc-btn gp" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;color:#d54541
 ;padding:3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color:#FFF;font-weight:bold;display:block;text-align:center;background-color:#DB4A39 !important'>Google+</a></p>
                            </td>
                          </tr>
                        </table>
                        <!-- /column 1 -->
                        <span class="clear" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;display:block;clear:both'></span>
                      </td>
                    </tr>
                  </table>
                  <!-- /social & contact -->
				        </td>
              </tr>
            </table>
          </div>
          <!-- /content -->
        </td>
        <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'></td>
      </tr>
    </table>
    <!-- /BODY -->
    <!-- FOOTER -->
    <table class="footer-wrap" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;width:100%;clear:both !important'>
      <tr style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>
        <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'></td>
        <td class="container" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;display:block !important;max-width:600px !important;margin:0 auto !important;clear:both !important'>
          <!-- content -->
          <div class="content" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;padding:15px;max-width:600px;margin:0 auto;display:block'>
            <table style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;width:100%'>
              <tr style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>
                <td align="center" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>
                  <p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6;color:#FFFFFF;'>
                    <a style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;color:#d54541;color:#FFFFFF;' href="{{ url('/comment-ca-marche') }}">Termes et conditions</a> |
							<a style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;color:#d54541;color:#FFFFFF;' href="{{ url('/comment-ca-marche') }}">Politique de confidentialité</a> |
							<a style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;color:#d54541;color:#FFFFFF;' href="#"><unsubscribe style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>Désinscription</unsubscribe></a>
                  </p>
                </td>
              </tr>
            </table>
          </div>
          <!-- /content -->
        </td>
        <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'></td>
      </tr>
    </table>
    <!-- /FOOTER -->
  </body>
</html>