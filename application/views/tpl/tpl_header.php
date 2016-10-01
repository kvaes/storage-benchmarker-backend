<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" context="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Storage Performance Benchmarker [kvaes.be]</title>
    <meta name="description" content="">

	<link rel="stylesheet" href="http://bootswatch.com/superhero/bootstrap.min.css">
    
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	
	<?php if ($script <> "") { echo $script; } ?>
	
    <script type="text/javascript">
        var appInsights=window.appInsights||function(config){
            function r(config){t[config]=function(){var i=arguments;t.queue.push(function(){t[config].apply(t,i)})}}var t={config:config},u=document,e=window,o="script",s=u.createElement(o),i,f;for(s.src=config.url||"//az416426.vo.msecnd.net/scripts/a/ai.0.js",u.getElementsByTagName(o)[0].parentNode.appendChild(s),t.cookie=u.cookie,t.queue=[],i=["Event","Exception","Metric","PageView","Trace"];i.length;)r("track"+i.pop());return r("setAuthenticatedUserContext"),r("clearAuthenticatedUserContext"),config.disableExceptionTracking||(i="onerror",r("_"+i),f=e[i],e[i]=function(config,r,u,e,o){var s=f&&f(config,r,u,e,o);return s!==!0&&t["_"+i](config,r,u,e,o),s}),t
        }({
            instrumentationKey:"ee6fdd55-5748-47ce-92a5-49ff6debd61f"
        });
        
        window.appInsights=appInsights;
        appInsights.trackPageView();
    </script>
	
</head>
<body>
<div class="container">
	<div class="navbar navbar-inverse">
	  <div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?php echo base_url('/'); ?>">Home</a>
	  </div>
	  <div class="navbar-collapse collapse navbar-inverse-collapse">
	    <ul class="nav navbar-nav">
		  <li class="dropdown">
			<a href="https://bitbucket.org/kvaes/storage-performance-benchmarker" target="_blank">Storage Performance Benchmarker Script</a>
		  </li>
		</ul>
		<ul class="nav navbar-nav">
		  <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Data <b class="caret"></b></a>
			<ul class="dropdown-menu">
			  <li class="dropdown-header">Systems</li>
			  <li><a href="/system/">Public Systems</a></li>
			  <li><a href="/Auth/PrivateSystems">My Systems</a></li>
			  <li class="dropdown-header">Authentication</li>
			  <li><a href="/Auth/Login">Login</a></li>
			  <li><a href="/Auth/Profile">Profile</a></li>
			  <li><a href="/Auth/Logout">Logout</a></li>
			</ul>
		  </li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
		  <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Information<b class="caret"></b></a>
			<ul class="dropdown-menu">
			  <li class="dropdown-header">Organization</li>
			  <li><a href="/info/about">About</a></li>
			  <li><a href="/info/privacy">Privacy</a></li>
			  <li><a href="/info/legal">Legal</a></li>
			  <li><a href="/info/contact">Contact</a></li>
			</ul>
		  </li>
		</ul>
	  </div>
	</div>
	