<!--
______                            _              _                                     _
| ___ \                          | |            | |                                   | |
| |_/ /___ __      __ ___  _ __  | |__   _   _  | |      __ _  _ __  __ _ __   __ ___ | |
|  __// _ \\ \ /\ / // _ \| '__| | '_ \ | | | | | |     / _` || '__|/ _` |\ \ / // _ \| |
| |  | (_) |\ V  V /|  __/| |    | |_) || |_| | | |____| (_| || |  | (_| | \ V /|  __/| |
\_|   \___/  \_/\_/  \___||_|    |_.__/  \__, | \_____/ \__,_||_|   \__,_|  \_/  \___||_|
                                          __/ |
                                         |___/
  ========================================================
                                           shequ.dimianzhan.com

  --------------------------------------------------------
  Powered by PHPHub
-->

<!DOCTYPE html>
<html lang="zh">
	<head>

		<meta charset="UTF-8">

		<title>@section('title')DimianZhan地面站社区 - 高品质的 PX4/ArduPilot 无人机开发者社区@show</title>

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

		<meta name="keywords" content="无人机,PX4,开源,ArduPilot" />
        <meta name="author" content="PHPHub" />
        <meta name="description" content="@section('description') 我们是高品质的无人机开发者社区，致力于为 PX4/ArduPilot 开发者提供一个分享创造、结识伙伴、协同互助的平台。 @show" />
        <meta name="_token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{ cdn(elixir('assets/css/styles.css')) }}">

        <link rel="shortcut icon" href="{{ cdn('favicon1.png') }}"/>
        <link rel="stylesheet" href="https://cdn.bootcss.com/KaTeX/0.10.0/katex.min.css" integrity="sha384-9eLZqc9ds8eNjO3TmqPeYcDj8n+Qfa4nuSiGYa6DjLNcv9BtN69ZIulL9+8CqC9Y" crossorigin="anonymous">
        <script defer src="https://cdn.bootcss.com/KaTeX/0.10.0/katex.min.js" integrity="sha384-K3vbOmF2BtaVai+Qk37uypf7VrgBubhQreNQe9aGsz9lB63dIFiQVlJbr92dw2Lx" crossorigin="anonymous"></script>
        <script defer src="https://cdn.bootcss.com/KaTeX/0.10.0/contrib/auto-render.min.js" integrity="sha384-kmZOZB5ObwgQnS/DuDg6TScgOiWWBiVt0plIRkZCmE6rDZGrEOQeHM5PcHi+nyqe" crossorigin="anonymous"></script>
        <script type="text/javascript" async src="https://cdn.bootcss.com/mathjax/2.7.5/MathJax.js?config=TeX-AMS-MML_HTMLorMML&delayStartupUntil=configured""></script>
        
        <script>
            Config = {
                'cdnDomain': '{{ get_cdn_domain() }}',
                'user_id': {{ $currentUser ? $currentUser->id : 0 }},
                'user_avatar': {!! $currentUser ? '"'.$currentUser->present()->gravatar() . '"' : '""' !!},
                'user_link': {!! $currentUser ? '"'. route('users.show', $currentUser->id) . '"' : '""' !!},
                'user_badge': '{{ $currentUser ? ($currentUser->present()->hasBadge() ? $currentUser->present()->badgeName() : '') : '' }}',
                'user_badge_link': "{{ $currentUser ? (route('roles.show', [$currentUser->present()->badgeID()])) : '' }}",
                'routes': {
                    'notificationsCount' : '{{ route('notifications.count') }}',
                    'upload_image' : '{{ route('upload_image') }}'
                },
                'token': '{{ csrf_token() }}',
                'environment': '{{ app()->environment() }}',
                'following_users': [],
                'qa_category_id': '{{ config('phphub.qa_category_id') }}'
            };

			var ShowCrxHint = '{{isset($show_crx_hint) ? $show_crx_hint : 'no'}}';
        </script>

	    @yield('styles')

		<meta http-equiv="x-pjax-version" content="{{ elixir('assets/css/styles.css') }}">

        <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?c603edeb4406f4968468c1649a006787";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
        </script>

	</head>
	<body id="body" class="{{ route_class() }}">

		<div id="wrap">

			@include('layouts.partials.nav')

			<div class="container main-container {{ (Request::is('blogs*') || Request::is('articles*')) || is_route('wildcard') ? 'blog-container' : '' }}">

                @if(Auth::check() && !Auth::user()->verified && !Request::is('email-verification-required'))
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        邮箱未激活，请前往 {{ Auth::user()->email }} 查收激活邮件，激活后才能完整地使用社区功能，如发帖和回帖。未收到邮件？请前往 <a href="{{ route('email-verification-required') }}">重发邮件</a> 。
                    </div>
                @elseif (Auth::check() && empty(Auth::user()->password) )
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        未设置登录密码，请前往 <a href="{{ route('users.edit_password', [Auth::id()]) }}">修改密码</a> 页面进行设置。设置后将可以在移动设备上使用邮箱登录网站。
                    </div>
                @endif

				@include('flash::message')

				@yield('content')

			</div>

@include('layouts.partials.footer')

		</div>



        <script src="{{ cdn(elixir('assets/js/scripts.js')) }}"></script>

	    @yield('scripts')

        @if (App::environment() == 'production')
        @if (false)
		<script>
          ga('create', '{{ getenv('GA_Tracking_ID') }}', 'auto');
          ga('send', 'pageview');
        </script>
        @endif

		<script>
		// Baidu link submit
		(function(){
		    var bp = document.createElement('script');
		    var curProtocol = window.location.protocol.split(':')[0];
		    if (curProtocol === 'https') {
		        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
		    }
		    else {
		        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
		    }
		    var s = document.getElementsByTagName("script")[0];
		    s.parentNode.insertBefore(bp, s);
		})();
		</script>
        @endif


<script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js" type="text/javascript" charset="utf-8"></script>

@if (!empty($topic)) 
<script type="text/javascript">
  var shareDesc = {!! json_encode($topic->excerpt) !!};
</script>
@endif

@if (empty($topic)) 
<script type="text/javascript">
  var shareDesc = location.href;
</script>
@endif

<script type="text/javascript">

        var shareLinkUlr = location.href.split("#")[0]; // 获取当前的url 去掉 # 之后的部分
shareLinkUlr = shareLinkUlr.replace(/\&/g, '%26'); // 将 & 替换成 %26 
var shareImgUrl = 'http://shequ.dimianzhan.com/qingbaozhan.jpg'; // 分享的图片地址
var shareTitle = document.title;


// 获取 config 的内容
function getjssdkconfig(apis,debug,json,link){
    var xhr = new XMLHttpRequest();
    var url = 'http://shequ.dimianzhan.com/jssdkconfig'; // 这个就是之前配置的路由
    var data = "apis="+apis+"&debug="+debug+"&json="+json+"&url="+link; // 拼接 get 参数
    xhr.open('GET',url+"?"+data);
    xhr.onreadystatechange = function(){
        if(xhr.readyState===4 && (xhr.status >=200 && xhr.status <=300)){
            // 获取 config 之后，进行一些操作
            // 需要进行 JSON.parse 获取对象
            configJsSDKAndDoSomething(JSON.parse(xhr.responseText));
        }
    };
    xhr.send();
}
// 获取config 之后进行的操作
// 因为是使用 ajax 进行config内容，这个方法是在上面运行的
function configJsSDKAndDoSomething(config){
    wx.config(config);
    wx.ready(function() {
        // 其他的一些操作
    //alert(JSON.stringify(config));
    wx.onMenuShareAppMessage({ 
        title: shareTitle, // 分享标题
        desc: shareDesc, // 分享描述
        link: shareLinkUlr, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
        imgUrl: shareImgUrl, // 分享图标
        success: function () {
          //alert(shareImgUrl);
        }
    });

    wx.onMenuShareTimeline({
        title: shareTitle, // 分享标题
        link: shareLinkUlr, // 分享链接，该链接域名必须与当前企业的可信域名一致
        imgUrl: shareImgUrl, // 分享图标
        success: function () {
            // 用户确认分享后执行的回调函数
        },
        cancel: function () {
            // 用户取消分享后执行的回调函数
        }
    });

    wx.onMenuShareQQ({
        title: shareTitle, // 分享标题
        desc: shareDesc, // 分享描述
        link: shareLinkUlr, // 分享链接
        imgUrl: shareImgUrl, // 分享图标
        success: function () {
           // 用户确认分享后执行的回调函数
        },
        cancel: function () {
           // 用户取消分享后执行的回调函数
        }
    });
    
    });

    wx.error(function(error){
        alert(error);
    });

    
}
// 页面加载完之后进行操作
$(document).ready(function(){
    // 注意这里的参数
    // apis 使用的参数是 字符串的拼接 这个是和 php 的方法中的处理相对应的
    getjssdkconfig("onMenuShareAppMessage,onMenuShareTimeline,onMenuShareQQ",false,false,shareLinkUlr);
    renderMathInElement(
        document.body,{
            delimiters: [
                  {left: "$$", right: "$$", display: true},
                  {left: "\\[", right: "\\]", display: true},
                  {left: "$", right: "$", display: false},
                  {left: "\\(", right: "\\)", display: false}
              ],
            errorCallback: try_mathjax()
          }
    );
    function try_mathjax() {
        console.log("try MathJax");
        MathJax.Hub.Configured();
    };
    MathJax.Hub.Config({
      tex2jax: {
        inlineMath: [ ['$','$']],
        displayMath: [ ['$$','$$'] ],
        processEnvironments: false
      },
      TeX: { equationNumbers: { autoNumber: "AMS" } }
    });
});
</script>
	</body>
</html>