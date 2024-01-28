<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KSA SHopping - @yield('title')</title>
    <meta name="description" content="@yield('meta_desc')">
    <meta name="keywords" content="@yield('meta_keyword')">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
   
   
    <!-- CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/css/alertify.rtl.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="{{ url('/') }}/css/alertify.rtl.min.css"/>
    <link rel="stylesheet" href="{{ url('/') }}/fonts/icomoon/style.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/jquery-ui.css">
    <!-- owl for sliders -->
    <link rel="stylesheet" href="{{ url('/') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/owl.theme.default.min.css">
    <!-- lightbox for prduct's images -->
    <link rel="stylesheet" href="{{ url('/') }}/lightbox/css/lightbox.css">


    <link rel="stylesheet" href="{{ url('/') }}/css/aos.css">

    <link rel="stylesheet" href="{{ url('/') }}/css/style.css?v={{ time() }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
 
    <livewire:styles />
    <script>
      window.addEventListener('message', event => {
         var delay = alertify.get('notifier','delay');
         if(event.detail){
          alertify.set('notifier','delay', 10);
          alertify.set('notifier','position', 'top-left'); 
          alertify.notify(event.detail.text,event.detail.type);
          alertify.set('notifier','delay', delay); 
        }
         
     })
   </script>
</head>

<body>

  <div class="site-wrap">

    <!-- Page Header Start-->
     @include('website.layout.header')
    <!-- Page Header Ends -->

    
  
    <!-- Page Body Start-->
    @yield('body')
    <!-- Page Body End-->
    
    <!-- start footer-->
    @include('website.layout.footer')
     <!-- end footer-->

  </div>
 <!-- latest jquery-->
    <script src="{{ url('/') }}/js/jquery-3.7.1.min.js"></script>
    <script src="{{ url('/') }}/js/jquery-ui.js"></script>
    <script src="{{ url('/') }}/js/popper.min.js"></script>
    <!-- Bootstrap js-->
    <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
    <!-- lightbox for prduct's images -->
    <script src="{{ url('/') }}/lightbox/js/lightbox.js"></script>
    <!-- owl for sliders -->
    <script src="{{ url('/') }}/js/owl.carousel.min.js"></script>
    @yield('script')

    <script src="{{ url('/') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ url('/') }}/js/aos.js"></script>

    <script src="{{ url('/') }}/js/main.js"></script>
   <!-- notify -->
   <script src="{{ url('/') }}/js/alertify.min.js"></script>
   <script>
     // var delay = alertify.get('notifier','delay');
      //alertify.set('notifier','delay', 100);
      //alertify.set('notifier','position', 'top-left');
      //alertify.success('Current delay : ' + alertify.get('notifier','delay') + ' seconds');
      //alertify.set('notifier','delay', delay);
  </script>

      
<livewire:scripts />
@stack('scripts')
 @yield('script')

</body>


</html>
