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
    <!-- BODY -->
    <table class="body-wrap" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;width:100%'>
      <tr style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>
        @yield('content')
      </tr>
    </table>
  </body>
</html>