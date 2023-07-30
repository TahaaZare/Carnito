<header class="sidenav" id="sidenav">

    <!-- close -->
    <div class="sidenav__close">
        <button class="sidenav__close-button" id="sidenav__close-button" aria-label="close sidenav">
            <i class="ui-close sidenav__close-icon"></i>
        </button>
    </div>

    <!-- Nav -->
    <nav class="sidenav__menu-container">
        <ul class="sidenav__menu" role="menubar">
            <li>
                <a href="#" class="sidenav__menu-url">صفحه اصلی</a>
            </li>
            <li>
                <a href="#" class="sidenav__menu-url">لینک های مفید</a>
                <button class="sidenav__menu-toggle" aria-haspopup="true" aria-label="Open dropdown"><i
                        class="ui-arrow-down"></i></button>
                <ul class="sidenav__menu-dropdown">
                    <li><a href="{{route('about-us')}}" class="sidenav__menu-url">درباره ما</a></li>
                    <li><a href="{{route('contactUs')}}" class="sidenav__menu-url">تماس با ما</a></li>
                </ul>
            </li>

            <!-- Categories -->
      
           
        </ul>
    </nav>
</header> <!-- end sidenav -->
