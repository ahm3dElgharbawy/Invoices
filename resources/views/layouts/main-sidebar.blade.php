<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/' . $page='home') }}"><img
                src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ url('/' . $page='home') }}"><img
                src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='home') }}"><img
                src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='home') }}"><img
                src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.png')}}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{Auth::user()->name}}</h4>
                    <span class="mb-0 text-muted">{{Auth::user()->email}}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category">برنامج الفواتير</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . $page='home') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 576 512">
                        <path
                            d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/>
                    </svg>
                    <span class="side-menu__label">الصفحة الرئيسية</span></a>
            </li>

            @can('الفواتير')
                <li class="side-item side-item-category">الفواتير</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 384 512">
                            <path
                                d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM64 80c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm128 72c8.8 0 16 7.2 16 16v17.3c8.5 1.2 16.7 3.1 24.1 5.1c8.5 2.3 13.6 11 11.3 19.6s-11 13.6-19.6 11.3c-11.1-3-22-5.2-32.1-5.3c-8.4-.1-17.4 1.8-23.6 5.5c-5.7 3.4-8.1 7.3-8.1 12.8c0 3.7 1.3 6.5 7.3 10.1c6.9 4.1 16.6 7.1 29.2 10.9l.5 .1 0 0 0 0c11.3 3.4 25.3 7.6 36.3 14.6c12.1 7.6 22.4 19.7 22.7 38.2c.3 19.3-9.6 33.3-22.9 41.6c-7.7 4.8-16.4 7.6-25.1 9.1V440c0 8.8-7.2 16-16 16s-16-7.2-16-16V422.2c-11.2-2.1-21.7-5.7-30.9-8.9l0 0c-2.1-.7-4.2-1.4-6.2-2.1c-8.4-2.8-12.9-11.9-10.1-20.2s11.9-12.9 20.2-10.1c2.5 .8 4.8 1.6 7.1 2.4l0 0 0 0 0 0c13.6 4.6 24.6 8.4 36.3 8.7c9.1 .3 17.9-1.7 23.7-5.3c5.1-3.2 7.9-7.3 7.8-14c-.1-4.6-1.8-7.8-7.7-11.6c-6.8-4.3-16.5-7.4-29-11.2l-1.6-.5 0 0c-11-3.3-24.3-7.3-34.8-13.7c-12-7.2-22.6-18.9-22.7-37.3c-.1-19.4 10.8-32.8 23.8-40.5c7.5-4.4 15.8-7.2 24.1-8.7V232c0-8.8 7.2-16 16-16z"/>
                        </svg>
                        <span class="side-menu__label">الفواتير</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{ url('/' . $page='invoices') }}">قائمة الفواتير</a></li>
                        <li><a class="slide-item" href="{{ url('/' . $page='paid-invoices') }}">الفواتير المدفوعة</a></li>
                        <li><a class="slide-item" href="{{ url('/' . $page='unpaid-invoices') }}">الفواتير الغير مدفوعة</a></li>
                        <li><a class="slide-item" href="{{ url('/' . $page='partially-paid-invoices') }}">الفواتير المدفوعة جزئيا</a></li>
                        <li><a class="slide-item" href="{{ url('/' . $page='archive') }}">ارشيف الفواتير</a></li>
                    </ul>
                </li>
            @endcan
            <li class="side-item side-item-category">التقارير</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M4 12c0 4.08 3.06 7.44 7 7.93V4.07C7.05 4.56 4 7.92 4 12z" opacity=".3"/>
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86zm2-15.86c1.03.13 2 .45 2.87.93H13v-.93zM13 7h5.24c.25.31.48.65.68 1H13V7zm0 3h6.74c.08.33.15.66.19 1H13v-1zm0 9.93V19h2.87c-.87.48-1.84.8-2.87.93zM18.24 17H13v-1h5.92c-.2.35-.43.69-.68 1zm1.5-3H13v-1h6.93c-.04.34-.11.67-.19 1z"/>
                    </svg>
                    <span class="side-menu__label">التقارير</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ url('/' . $page='invoices-reports') }}">تقارير الفواتير</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='customers-reports') }}">تقارير العملاء</a></li>
                </ul>
            </li>
            <li class="side-item side-item-category">المستخدمين</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 640 512">
                        <path
                            d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z"/>
                    </svg>

                    <span class="side-menu__label">المستخدمين</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ url('/' . $page='users') }}">قائمة المستخدمين</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='roles') }}">صلاحيات المستخدمين</a></li>
                </ul>
            </li>
            <li class="side-item side-item-category">الاعدادات</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 512 512">
                        <path
                            d="M481.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-30.9 28.1c-7.7 7.1-11.4 17.5-10.9 27.9c.1 2.9 .2 5.8 .2 8.8s-.1 5.9-.2 8.8c-.5 10.5 3.1 20.9 10.9 27.9l30.9 28.1c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-39.7-12.6c-10-3.2-20.8-1.1-29.7 4.6c-4.9 3.1-9.9 6.1-15.1 8.7c-9.3 4.8-16.5 13.2-18.8 23.4l-8.9 40.7c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-8.9-40.7c-2.2-10.2-9.5-18.6-18.8-23.4c-5.2-2.7-10.2-5.6-15.1-8.7c-8.8-5.7-19.7-7.8-29.7-4.6L69.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l30.9-28.1c7.7-7.1 11.4-17.5 10.9-27.9c-.1-2.9-.2-5.8-.2-8.8s.1-5.9 .2-8.8c.5-10.5-3.1-20.9-10.9-27.9L8.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l39.7 12.6c10 3.2 20.8 1.1 29.7-4.6c4.9-3.1 9.9-6.1 15.1-8.7c9.3-4.8 16.5-13.2 18.8-23.4l8.9-40.7c2-9.1 9-16.3 18.2-17.8C213.3 1.2 227.5 0 242 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l8.9 40.7c2.2 10.2 9.4 18.6 18.8 23.4c5.2 2.7 10.2 5.6 15.1 8.7c8.8 5.7 19.7 7.7 29.7 4.6l39.7-12.6c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM242 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/>
                    </svg>
                    <span class="side-menu__label">الاعدادات</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ url('/' . $page='sections') }}">{{__("الاقسام")}} </a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='products') }}">{{__("المنتجات")}}</a></li>

                </ul>
            </li>
        </ul>
    </div>
</aside>
<!-- main-sidebar -->
