<div class="app-sidebar app-sidebar2">
	<div class="app-sidebar__logo">
		<a class="header-brand" href="{{ route('dashboard.index') }}">
			<img src="{{ url('/images/logo') }}/{{ AppLogo() }}" class="header-brand-img desktop-lgo" alt="Covido logo">
			<img src="{{ url('/images/logo') }}/{{ AppLogo() }}" class="header-brand-img dark-logo" alt="Covido logo">
			<img src="{{ url('/images/logo') }}/{{ AppLogo() }}" class="header-brand-img mobile-logo" alt="Covido logo">
			<img src="{{ url('/images/logo') }}/{{ AppLogo() }}" class="header-brand-img darkmobile-logo" alt="Covido logo">
		</a>
	</div>
</div>
<aside class="app-sidebar app-sidebar3">
	<div class="app-sidebar__user">
		<div class="dropdown user-pro-body text-center">
			<div class="user-pic">
				<img src="{{ Auth::user()->images != '' ? asset('/images/users').'/'. Auth::user()->images : asset('/images/no-user.jpg') }}" alt="user-img" class="avatar-xl rounded-circle mb-1">
			</div>
			<div class="user-info">
				<h5 class=" mb-1 font-weight-bold">{{ Auth::user()->name }}</h5>
				<span class="text-muted app-sidebar__user-name text-sm">{{ UserRole() }}</span>
			</div>
		</div>
	</div>
	<ul class="side-menu">
		@if (auth()->user()->can('dashboard-index')) 
		<li class="slide">
			<a class="side-menu__item" href="{{ route('dashboard.index') }}">
				<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
				<span class="side-menu__label">Dashboard</span>
			</a>
		</li>
		@endif

		
		<li class="slide">
			<a class="side-menu__item" href="{{ route('manifest.index') }}">
				<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
				<span class="side-menu__label">Manifest Data</span>
			</a>
		</li>

		@if (auth()->user()->can('inbox-index')) 
		<li class="slide">
			<a class="side-menu__item" href="{{ route('inbox.index') }}">
				<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
				<span class="side-menu__label">Inbox</span>
				@if(getCountInbox() >=1)
				<span class="badge badge-primary">{{ getCountInbox() }}</span>
				@endif
				
			</a>
		</li>
		@endif

		

		



		



		

		
		

		<li class="slide">
			<a class="side-menu__item" data-toggle="slide" href="#">

			<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>

			<span class="side-menu__label">Masters Data</span><i class="angle fa fa-angle-right"></i></a>
			<ul class="slide-menu">
				@if (auth()->user()->can('users_members-index')) 
					<li>
						<a href="{{ route('users_members.index') }}" class="slide-item">Members</a>
					</li>
				@endif

				@if (auth()->user()->can('users_pengguna-index')) 
					<li>
						<a href="{{ route('users_pengguna.index') }}" class="slide-item">All User Data</a>
					</li>
				@endif


				@if (auth()->user()->can('bank-index')) 
					<li>
						<a href="{{ route('bank.index') }}" class="slide-item">Bank Data</a>
					</li>
				@endif

				@if (auth()->user()->can('satuan-index')) 
					<li>
						<a href="{{ route('satuan.index') }}" class="slide-item">Data Satuan</a>
					</li>
				@endif

				@if (auth()->user()->can('product_category-index')) 
					<li>
						<a href="{{ route('product_category.index') }}" class="slide-item">Product Category</a>
					</li>
				@endif

				@if (auth()->user()->can('location-index')) 
					<li>
						<a href="{{ route('location.index') }}" class="slide-item">Location From To</a>
					</li>
				@endif
				

				@if (auth()->user()->can('kapal-index')) 
					<li>
						<a href="{{ route('kapal.index') }}" class="slide-item">Data Kapal</a>
					</li>
				@endif
				
				@if (auth()->user()->can('ship_agent-index'))
					<li>
						<a href="{{ route('ship_agent.index') }}" class="slide-item">Ship Agent</a>
					</li>
				@endif
				
				@if (auth()->user()->can('vassel-index'))
					<li>
						<a href="{{ route('vassel.index') }}" class="slide-item">Vassel</a>
					</li>
				@endif

				@if (auth()->user()->can('stevedoring-index'))
					<li>
						<a href="{{ route('stevedoring.index') }}" class="slide-item">Stevedoring</a>
					</li>
				@endif
				
			</ul>
		</li>



		
		
		
		@if (
				auth()->user()->can('slider-index') || 
				auth()->user()->can('news-index') ||
				auth()->user()->can('pages-index') ||
				auth()->user()->can('category-index') ||
				auth()->user()->can('tags-index') ||
				auth()->user()->can('client-index') ||
				auth()->user()->can('infobox-index') ||
				auth()->user()->can('testimonial-index') 
			)

		<li class="slide">
			<a class="side-menu__item" data-toggle="slide" href="#">

			<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>

			<span class="side-menu__label">CMS System</span><i class="angle fa fa-angle-right"></i></a>
			<ul class="slide-menu">
				
				@if (auth()->user()->can('slider-index')) 
				<li>
					<a href="{{ route('slider.index') }}" class="slide-item">Slider</a>
				</li>
				@endif
				@if (auth()->user()->can('news-index')) 
				<li>
					<a href="{{ route('news.index') }}" class="slide-item">News</a>
				</li>
				@endif

				@if (auth()->user()->can('pages-index')) 
				<li>
					<a href="{{ route('pages.index') }}" class="slide-item">Pages</a>
				</li>
				@endif

				@if (auth()->user()->can('category-index')) 
				<li>
					<a href="{{ route('category.index') }}" class="slide-item">Category</a>
				</li>
				@endif

				@if (auth()->user()->can('tags-index')) 
				<li>
					<a href="{{ route('tags.index') }}" class="slide-item">Tags</a>
				</li>
				@endif

				@if (auth()->user()->can('client-index')) 
				<li>
					<a href="{{ route('client.index') }}" class="slide-item">Client / Partnership</a>
				</li>
				@endif

				@if (auth()->user()->can('testimonial-index')) 
				<li>
					<a href="{{ route('testimonial.index') }}" class="slide-item">Testimonial</a>
				</li>
				@endif

				

				@if (auth()->user()->can('infobox-index')) 
				<li>
					<a href="{{ route('infobox.index') }}" class="slide-item">Box INFO</a>
				</li>
				@endif

				
				
				
			</ul>
		</li>

		@endif

		@if (auth()->user()->can('roles-index') || auth()->user()->can('permissions-index')) 		
		<li class="slide">
			<a class="side-menu__item" data-toggle="slide" href="#">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon">
				<path d="M11.99 2c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm3.61 6.34c1.07 0 1.93.86 1.93 1.93 0 1.07-.86 1.93-1.93 1.93-1.07 0-1.93-.86-1.93-1.93-.01-1.07.86-1.93 1.93-1.93zm-6-1.58c1.3 0 2.36 1.06 2.36 2.36 0 1.3-1.06 2.36-2.36 2.36s-2.36-1.06-2.36-2.36c0-1.31 1.05-2.36 2.36-2.36zm0 9.13v3.75c-2.4-.75-4.3-2.6-5.14-4.96 1.05-1.12 3.67-1.69 5.14-1.69.53 0 1.2.08 1.9.22-1.64.87-1.9 2.02-1.9 2.68zM11.99 20c-.27 0-.53-.01-.79-.04v-4.07c0-1.42 2.94-2.13 4.4-2.13 1.07 0 2.92.39 3.84 1.15-1.17 2.97-4.06 5.09-7.45 5.09z"/></svg>

			<span class="side-menu__label">Level Otorisasi</span><i class="angle fa fa-angle-right"></i></a>
			<ul class="slide-menu">

				

				

				@if (auth()->user()->can('roles-index')) 
				<li><a href="{{ route('roles.index') }}" class="slide-item">Roles</a></li>
				@endif

				@if (auth()->user()->can('permissions-index')) 
				<li><a href="{{ route('permissions.index') }}" class="slide-item">Permission</a></li>
				@endif
			</ul>
		</li>
		@endif



		@if (auth()->user()->can('setting_general-index')) 
		<li class="slide">
			<a class="side-menu__item" href="{{ route('setting_general.index') }}">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon">
				<path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/></svg>

				<span class="side-menu__label">Pengaturan System</span>
			</a>
		</li>
		@endif

		
		
	</ul>
</aside>