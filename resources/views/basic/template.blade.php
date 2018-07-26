<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bootflat-Admin Template</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="favicon_16.ico"/>
    <link rel="bookmark" href="favicon_16.ico"/>
    <!-- site css -->
    <link rel="stylesheet" href="public/css/site.min.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
    <!-- <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'> -->
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="public/js/site.min.js"></script>
  </head>
  <body>
    @includeif('basic.top_menu')
    
    <!--header-->
    <div class="container-fluid">
    <!--documents-->
        <div class="row row-offcanvas row-offcanvas-left">
          <div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
            @includeif('basic.left_menu')
          </div>
          <div class="col-xs-12 col-sm-9 content"> 
            @includeif('basic.central_panel')
        </div><!-- content -->
      </div>
    </div>
    <!--footer-->
    <div class="site-footer">
      <div class="container">
        <div class="download">
          <span class="download__infos">You simply have to <b>try it</b>.</span>&nbsp;&nbsp;&nbsp;&nbsp;
          <a class="btn btn-primary" href="https://github.com/silverbux/bootflat-admin/archive/master.zip">Download Bootflat-Admin</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <!-- SmartAddon BEGIN -->
            <!-- <script type="text/javascript">
            (function() {
            var s=document.createElement('script');s.type='text/javascript';s.async = true;
            s.src='http://s1'+'.smartaddon.com/share_addon.js';
            var j =document.getElementsByTagName('script')[0];j.parentNode.insertBefore(s,j);
            })();
            </script> -->

            <a href="http://www.smartaddon.com/?share" title="Share Button" onclick="return sa_tellafriend('','bookmarks')"><img alt="Share" src="http://bootflat.github.io/img/share.gif" border="0" /></a>
            <!-- SmartAddon END -->
        </div>
        <hr class="dashed" />
        <div class="row">
          <div class="col-md-4">
            <h3>Get involved</h3>
            <p>Bootflat is hosted on <a href="https://github.com/silverbux/bootflat-admin" target="_blank" rel="external nofollow">GitHub</a> and open for everyone to contribute. Please give us some feedback and join the development!</p>
          </div>
          <div class="col-md-4">
            <h3>Contribute</h3>
            <p>You want to help us and participate in the development or the documentation? Just fork Bootflat on <a href="https://github.com/silverbux/bootflat-admin" target="_blank" rel="external nofollow">GitHub</a> and send us a pull request.</p>
          </div>
          <div class="col-md-4">
            <h3>Found a bug?</h3>
            <p>Open a <a href="https://github.com/silverbux/bootflat-admin/issues" target="_blank" rel="external nofollow">new issue</a> on GitHub. Please search for existing issues first and make sure to include all relevant information.</p>
          </div>
        </div>
        <hr class="dashed" />
        <div class="row">
          <div class="col-md-6">
            <h3>Talk to us</h3>
            <ul>
              <li>Tweet us at <a href="https://twitter.com" target="_blank">@YourTwitter</a>&nbsp;&nbsp;&nbsp;&nbsp;Email us at <span class="connect">info@yourdomain.com</span></li>
              <li>
                <a title="Twitter" href="https://twitter.com" target="_blank" rel="external nofollow"><i class="icon" data-icon="&#xe121"></i></a>
                <a title="Facebook" href="https://www.facebook.com" target="_blank" rel="external nofollow"><i class="icon" data-icon="&#xe10b"></i></a>
                <a title="Google+" href="https://plus.google.com/" target="_blank" rel="external nofollow"><i class="icon" data-icon="&#xe110"></i></a>
                <a title="Github" href="https://github.com/alexquiambao" target="_blank" rel="external nofollow"><i class="icon" data-icon="&#xe10e"></i></a>
              </li>
            </ul>
          </div>
          <div class="col-md-6">
            <!-- Begin MailChimp Signup Form -->
            <link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
            <div id="mc_embed_signup">
            <h3 style="margin-bottom: 15px;">Newsletter</h3>
            <form action="" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" novalidate>
                <input style="margin-bottom: 10px;" type="email" value="" name="EMAIL" class="email form-control" id="mce-EMAIL" placeholder="email address" required>
                <span class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary"></span>
            </form>
            </div>
            <!--End mc_embed_signup-->
          </div>
        </div>
        <hr class="dashed" />
        <div class="copyright clearfix">
          <p><b>Bootflat</b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="getting-started.html">Getting Started</a>&nbsp;&bull;&nbsp;<a href="index.html">Documentation</a>&nbsp;&bull;&nbsp;<a href="https://github.com/Bootflat/Bootflat.UI.Kit.PSD/archive/master.zip">Free PSD</a>&nbsp;&bull;&nbsp;<a href="colors.html">Color Picker</a></p>
          <p>Code licensed under <a href="http://opensource.org/licenses/mit-license.html" target="_blank" rel="external nofollow">MIT License</a>, documentation under <a href="http://creativecommons.org/licenses/by/3.0/" rel="external nofollow">CC BY 3.0</a>.</p>
        </div>
      </div>
    </div>
  </body>
</html>
