  <!-- Navigation -->

    <nav class="navbar navbar-default" style = "margin-bottom: 0px;">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">LOGO</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="page-scroll">
                        @if(Auth::check())
                        	<a href="profile">
                        		Hi, {{Auth::user()->username}}
                        	</a>
                        @endif
                    </li>
                   
                    <li class="page-scroll">
                        @if(Auth::check())
                        	@if(Auth::user()->role == 0)
                        		<a href="profile">
                        			dashboard
                        		</a>
                        	@else
                        		@if (Auth::user()->role == 1)
                        		<a href="customer-invited">
                        			dashboard
                        		</a>
                        		
                        		@else
                        		<a href="admin-manage-builders">
                        			dashboard
                        		</a>
                        		@endif
                        	@endif
                        	
                        @else
                        	<a href="register-builder">
                        		Tradespeople Here
                        	</a>
                        @endif
                        
                    </li>
                    
                       
                     
                    <li class="page-scroll">
                    	@if(Auth::check())
                        	<a href="{{URL::route('logout')}}">logout</a>
                        @else
                        	<a href="login">
                        		login
                        	</a>
                        @endif
                        
                    </li>
                    <li class="page-scroll">
                    	@if(Auth::check())
                    		@if(Auth::user()->role == '0')
                        	<a href="{{URL::route('postjob-page')}}">PostJob</a>
                        	@endif	
                        @else
                        	<a href="{{URL::route('login')}}"> PostJob </a>
                        @endif
                        
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>  
        <!-- /.container-fluid -->
    </nav>