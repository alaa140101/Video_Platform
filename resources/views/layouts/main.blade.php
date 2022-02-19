<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/6da2c478e2.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body dir="rtl" style="text-align: right">
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light bg-white">
      <a class="navbar-brand" href="#">فيديو حسوب</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-home"></i>
              الصفحة الرئيسة
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-history"></i>
              سجل المشاهدة
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('videos.create')}}" class="nav-link">
              <i class="fas fa-upload"></i>
              رفع الفيديو
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('videos.index')}}" class="nav-link">
              <i class="fas fa-play-circle"></i>
              فيديوهاتي
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-film"></i>
              القنوات
            </a>
          </li>
        </ul>
        <ul class="navbar-nav mr-auto">
          @guest
            <li class="nav-item mt-2">
              <a href="{{ route('login') }}" class="nav-link">{{__('تسجيل دخول')}}</a>
            </li>  
            @if(Route::has('register'))            
              <li class="nav-item mt-2">
                <a href="{{ route('register') }}" class="nav-link">{{__('إنشاء حساب')}}</a>
              </li>
            @endif 
            @else 
            <li class="nav-item dropdown justify-content-left mt-2">
              <a href="#" class="nav-link" id="navbarDropdown" data-toggle="dropdown">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="h-8 w-8 rounded-full">
              </a>
              <div class="dropdown-menu dropdown-menu-left px-2 text-right mt-2">
                <div class="pt-4 pb-1 border-t border-gray-200">
                  <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                  <div class="pt-2 pb-3 space-y-1">
                      <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                          {{ __('فيديو حسوب') }}
                      </x-jet-responsive-nav-link>
                  </div>
                  </div>
          
                  <!-- Responsive Settings Options -->
                  <div class="pt-4 pb-1 border-t border-gray-200">
                      <div class="flex items-center px-4">
                          @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                              <div class="flex-shrink-0 ml-3">
                                  <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                              </div>
                          @endif
          
                          <div class="ml-3">
                              <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                              <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                          </div>
                      </div>
          
                      <div class="mt-3 space-y-1">
                          <!-- Account Management -->
                          <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                              {{ __('site.profile') }}
                          </x-jet-responsive-nav-link>
          
                          @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                              <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                  {{ __('site.api_token') }}
                              </x-jet-responsive-nav-link>
                          @endif
          
                          <!-- Authentication -->
                          <form method="POST" action="{{ route('logout') }}">
                              @csrf
          
                              <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                             onclick="event.preventDefault();
                                              this.closest('form').submit();">
                                  {{ __('site.logout') }}
                              </x-jet-responsive-nav-link>
                          </form>
          
                          <!-- Team Management -->
                          @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                              <div class="border-t border-gray-200"></div>
          
                              <div class="block px-4 py-2 text-xs text-gray-400">
                                  {{ __('site.manage_team') }}
                              </div>
          
                              <!-- Team Settings -->
                              <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                                  {{ __('site.team_settings') }}
                              </x-jet-responsive-nav-link>
          
                              @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                  <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                      {{ __('site.new_team') }}
                                  </x-jet-responsive-nav-link>
                              @endcan
          
                              <div class="border-t border-gray-200"></div>
          
                              <!-- Team Switcher -->
                              <div class="block px-4 py-2 text-xs text-gray-400">
                                  {{ __('site.team_switch') }}
                              </div>
          
                              @foreach (Auth::user()->allTeams() as $team)
                                  <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                              @endforeach
                            @endif
                        </div>
                    </div>
                </div>                
              </div>
            </li>
          @endguest
        </ul>
      </div>
    </nav>
  </div>
  
  <main class="py-4">
    @if (Session::has('success'))
      <div class="p-3 mb-2 bg-success text-white rounded mx-auto col-8">
        <span class="text-center">{{ session('success') }}</span>
      </div>        
    @endif

    @yield('content')

  </main>
  
  @yield('script')
</body>
</html>