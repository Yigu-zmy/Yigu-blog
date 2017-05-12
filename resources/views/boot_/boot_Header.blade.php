<!-- 导航栏部分 -->
<div class="navbar-default ">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1"><span class="sr-only">Toggle navigation</span><span
                        class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>

            <a href="{{ config('app.url') }}"><img src="{{"/images/home/yigu.png"}}" style="width: 75px"></a>

        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/home">主页</a>
                </li>
                <li>
                    <a href="/articles">文章中心</a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::check())
                <li>
                    <a href="/edit">文章发布</a>
                </li>
                    <li>
                        <a href="/updatearticle">文章管理</a>
                    </li>
                @if(\Illuminate\Support\Facades\Auth::user()->email == "479774965@qq.com")
                    <li>
                        <a href="/category">分类管理</a>
                    </li>
                    @endif
                    @endif
                <li>
                    <a href="/about">关于作者</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(\Illuminate\Support\Facades\Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{\Illuminate\Support\Facades\Auth::user()->name}}<strong
                                    class="caret"></strong></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="/auth/logout">Logout</a>
                            </li>
                        </ul>
                    </li>
                @else
                <li>
                    <a href="/auth/login">Login</a>
                </li>
                <li>
                    <a href="/auth/register">Register</a>
                </li>
            </ul>
            @endif
        </div>
        </nav>
    </div>
</div>