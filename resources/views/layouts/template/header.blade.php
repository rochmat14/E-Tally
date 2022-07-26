<div class="app-header header top-header">
	<div class="container-fluid">
		<div class="d-flex">
			<a class="header-brand" href="index.html">
				<img src="/images/logo/{{ AppLogo() }}" class="header-brand-img desktop-lgo" alt="Dashtic logo">
				<img src="/images/logo/{{ AppLogo() }}" class="header-brand-img dark-logo" alt="Dashtic logo">
				<img src="/images/logo/{{ AppLogo() }}" class="header-brand-img mobile-logo" alt="Dashtic logo">
				<img src="/images/logo/{{ AppLogo() }}" class="header-brand-img darkmobile-logo" alt="Dashtic logo">
			</a>
			<div class="dropdown side-nav">
				<div class="app-sidebar__toggle" data-toggle="sidebar">
					<a class="open-toggle" href="#">
						<svg class="header-icon mt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
					</a>
					<a class="close-toggle" href="#">
						<svg class="header-icon mt-1" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>
					</a>
				</div>
			</div>
			
			<div class="d-flex order-lg-2 ml-auto">
				

				<div class="dropdown   header-fullscreen pl-5" >
					<a  class="nav-link icon full-screen-link p-0"  id="fullscreen-button">
						<svg class="header-icon" x="1008" y="1248" viewBox="0 0 24 24"  height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false"><path d="M7,14 L5,14 L5,19 L10,19 L10,17 L7,17 L7,14 Z M5,10 L7,10 L7,7 L10,7 L10,5 L5,5 L5,10 Z M17,17 L14,17 L14,19 L19,19 L19,14 L17,14 L17,17 Z M14,5 L14,7 L17,7 L17,10 L19,10 L19,5 L14,5 Z"></path></svg>
					</a>
				</div>
				<div class="dropdown header-notify pl-4">
					
				</div>


				<div class="dropdown profile-dropdown">
					<a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
						<span>
							<img src="{{ Auth::user()->images != '' ? asset('/images/users').'/'. Auth::user()->images : asset('/images/no-user.jpg') }}" alt="img" class="avatar avatar-md brround">
						</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
						<div class="text-center">
							<a href="#" class="dropdown-item text-center user pb-0 font-weight-bold">{{ Auth::user()->name }}</a>
							<span class="text-center user-semi-title">{{ UserRole() }}</span>
							<div class="dropdown-divider"></div>
						</div>

						@if (auth()->user()->can('profile-index')) 
						<a class="dropdown-item d-flex" href="{{ route('profile.index') }}">
							<svg class="header-icon mr-3" x="1008" y="1248" viewBox="0 0 24 24"  height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
								<path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 16c-2.69 0-5.77 1.28-6 2h12c-.2-.71-3.3-2-6-2z" opacity=".3"/><circle cx="12" cy="8" opacity=".3" r="2"/><path d="M12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm-6 4c.22-.72 3.31-2 6-2 2.7 0 5.8 1.29 6 2H6zm6-6c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0-6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z"/>
							</svg>
							<div class="mt-1">Profile</div>
						</a>
						@endif
						
						<a class="dropdown-item d-flex" href="{{ route('logout') }}" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
							<svg class="header-icon mr-3" x="1008" y="1248" viewBox="0 0 24 24"  height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
								<path d="M0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none"/><path d="M6 20h12V10H6v10zm2-6h3v-3h2v3h3v2h-3v3h-2v-3H8v-2z" opacity=".3"/><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM8.9 6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2H8.9V6zM18 20H6V10h12v10zm-7-1h2v-3h3v-2h-3v-3h-2v3H8v2h3z"/>
							</svg>
							<div class="mt-1">Sign Out</div>
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				            @csrf
				        </form>

						

        
					</div>
				</div>
			</div>
		</div>
	</div>
</div>