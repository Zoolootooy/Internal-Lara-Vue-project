@if(auth()->user()->roles[0]->name === "Admin")
    <div class="vertical-menu">
        <div data-simplebar class="h-100">
            <div id="sidebar-menu">
                <ul class="metismenu list-unstyled" id="side-menu">
                    @auth
                        <li class="menu-title">{{ __('Users') }}</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-users"></i>
                                <span>{{ __('Users') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('user.index') }}">{{ __('Users') }}</a></li>
                                <li><a href="{{ route('user.create') }}">{{ __('Add User') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-user-secret"></i>
                                <span>{{ __('Roles') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('role.index') }}">{{ __('Roles') }}</a></li>
                                <li><a href="{{ route('role.create') }}">{{ __('Add Role') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-universal-access"></i>
                                <span>{{ __('Permissions') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('permission.index') }}">{{ __('Permissions') }}</a></li>
                                <li><a href="{{ route('permission.create') }}">{{ __('Add Permission') }}</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">{{ __('Content') }}</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-file fa-1x"></i>
                                <span>{{ __('Pages') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('page.index') }}">{{ __('Pages') }}</a></li>
                                <li><a href="{{ route('page.create') }}">{{ __('Add Page') }}</a></li>
                                <li><a href="{{ route('pageCategory.index') }}">{{ __('Categories') }}</a></li>
                                <li><a href="{{ route('pageCategory.create') }}">{{ __('Add Category') }}</a></li>
                                <li><a href="{{ route('snippet.index') }}">{{ __('Snippets') }}</a></li>
                                <li><a href="{{ route('snippet.create') }}">{{ __('Add Snippet') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-list"></i>
                                <span>{{ __('Menus') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('menu.index') }}">{{ __('Menus') }}</a></li>
                                <li><a href="{{ route('menu.create') }}">{{ __('Add Menu') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-medium"></i>
                                <span>{{ __('Media') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('mediaFile.index') }}">{{ __('Files') }}</a></li>
                                <li><a href="{{ route('mediaFile.create') }}">{{ __('Add File') }}</a></li>
                                <li><a href="{{ route('mediaCategory.index') }}">{{ __('Categories') }}</a></li>
                                <li><a href="{{ route('mediaCategory.create') }}">{{ __('Add Category') }}</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">{{ __('Modules') }}</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-sliders"></i>
                                <span>{{ __('Slider') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('slider.index') }}">{{ __('Slides') }}</a></li>
                                <li><a href="{{ route('slider.create') }}">{{ __('Add Slide') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-question-circle"></i>
                                <span>{{ __('FAQ') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('faqCategory.index') }}">{{ __('Categories') }}</a></li>
                                <li><a href="{{ route('faqCategory.create') }}">{{ __('Add Category') }}</a></li>
                                <li><a href="{{ route('faqItem.index') }}">{{ __('Items') }}</a></li>
                                <li><a href="{{ route('faqItem.create') }}">{{ __('Add Item') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-quote-right"></i>
                                <span>{{ __('Quotes') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('quote.index') }}">{{ __('Quotes') }}</a></li>
                                <li><a href="{{ route('quote.create') }}">{{ __('Add Quote') }}</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">{{ __('Other') }}</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-envelope"></i>
                                <span>{{ __('Mails') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('mail.index') }}">{{ __('Mails') }}</a></li>
                                <li><a href="{{ route('mail.create') }}">{{ __('Add Mail') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-globe"></i>
                                <span>{{ __('Countries') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('country.index') }}">{{ __('Countries') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-cogs"></i>
                                <span>{{ __('Settings') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('setting.index') }}">{{ __('Settings') }}</a></li>
                                <li><a href="{{ route('setting.create') }}">{{ __('Add Setting') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-folder"></i>
                                <span>{{ __('Units') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('unit.index') }}">{{ __('Units') }}</a></li>
                                <li><a href="{{ route('unit.create') }}">{{ __('Add Unit') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-globe"></i>
                                <span>{{ __('Translations') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('translation.index') }}">{{ __('Translations') }}</a></li>
                                <li><a href="{{ route('translation.create') }}">{{ __('Add Translation') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                <span>{{ __('Articles') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('article.index') }}">{{ __('Article') }}</a></li>
                                <li><a href="{{ route('article.create') }}">{{ __('Add Article') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-list" aria-hidden="true"></i>
                                <span>{{ __('Benefits') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('benefit.index') }}">{{ __('Benefits') }}</a></li>
                                <li><a href="{{ route('benefit.create') }}">{{ __('Add Benefits') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-3x fa-shopping-cart" aria-hidden="true"></i>
                                <span>{{ __('Orders') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('order.index') }}">{{ __('Order') }}</a></li>
                                <li><a href="{{ route('order.create') }}">{{ __('Add Order') }}</a></li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
@endif
@if(auth()->user()->roles[0]->name === "Author")
    <div class="vertical-menu">
        <div data-simplebar class="h-100">
            <div id="sidebar-menu">
                <ul class="metismenu list-unstyled" id="side-menu">
                    @auth
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-medium"></i>
                                <span>{{ __('Media') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('mediaFile.index') }}">{{ __('Files') }}</a></li>
                                <li><a href="{{ route('mediaFile.create') }}">{{ __('Add File') }}</a></li>
                                <li><a href="{{ route('mediaCategory.index') }}">{{ __('Categories') }}</a></li>
                                <li><a href="{{ route('mediaCategory.create') }}">{{ __('Add Category') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-sliders"></i>
                                <span>{{ __('Slider') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('slider.index') }}">{{ __('Slides') }}</a></li>
                                <li><a href="{{ route('slider.create') }}">{{ __('Add Slide') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-question-circle"></i>
                                <span>{{ __('FAQ') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('faqCategory.index') }}">{{ __('Categories') }}</a></li>
                                <li><a href="{{ route('faqCategory.create') }}">{{ __('Add Category') }}</a></li>
                                <li><a href="{{ route('faqItem.index') }}">{{ __('Items') }}</a></li>
                                <li><a href="{{ route('faqItem.create') }}">{{ __('Add Item') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                <span>{{ __('Articles') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('article.index') }}">{{ __('Article') }}</a></li>
                                <li><a href="{{ route('article.create') }}">{{ __('Add Article') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-list" aria-hidden="true"></i>
                                <span>{{ __('Benefits') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('benefit.index') }}">{{ __('Benefits') }}</a></li>
                                <li><a href="{{ route('benefit.create') }}">{{ __('Add Benefits') }}</a></li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
@endif

@if(auth()->user()->roles[0]->name === "Editor")
    <div class="vertical-menu">
        <div data-simplebar class="h-100">
            <div id="sidebar-menu">
                <ul class="metismenu list-unstyled" id="side-menu">
                    @auth
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-3x fa-shopping-cart" aria-hidden="true"></i>
                                <span>{{ __('Orders') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('order.index') }}">{{ __('Order') }}</a></li>
                                <li><a href="{{ route('order.create') }}">{{ __('Add Order') }}</a></li>
                            </ul>
                        </li>
                    @endauth
                </ul>
                <ul class="metismenu list-unstyled" id="side-menu">
                    @auth
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-3x fa-shopping-cart" aria-hidden="true"></i>
                                <span>{{ __('Product') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('product.index') }}">{{ __('Product') }}</a></li>
                                <li><a href="{{ route('product.create') }}">{{ __('Add Product') }}</a></li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
@endif
