<!DOCTYPE html>
<html>
  <head>
    @includeif('basic.head')
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
      @includeif('basic.footer')
    </div>
  </body>
</html>
