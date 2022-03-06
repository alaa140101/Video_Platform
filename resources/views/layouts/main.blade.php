<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/6da2c478e2.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  
  <link href="{!! asset('theme/css/sb-admin-2.min.css') !!}" rel="stylesheet">

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
          <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
            <a href="{{ route('main') }}" class="nav-link">
              <i class="fas fa-home"></i>
              الصفحة الرئيسة
            </a>
          </li>
          @auth              
          <li class="nav-item {{ request()->is('history') ? 'active' : '' }}">
            <a href="{{route('history')}}" class="nav-link">
              <i class="fas fa-history"></i>
              سجل المشاهدة
            </a>
          </li>
          <li class="nav-item {{ request()->is('videos/create*') ? 'active' : '' }}">
            <a href="{{route('videos.create')}}" class="nav-link">
              <i class="fas fa-upload"></i>
              رفع الفيديو
            </a>
          </li>
          <li class="nav-item {{ request()->is('videos/index') ? 'active' : '' }}">
            <a href="{{route('videos.index')}}" class="nav-link">
              <i class="fas fa-play-circle"></i>
              فيديوهاتي
            </a>
          </li>
          @endauth
          <li class="nav-item {{ request()->is('channels*') ? 'active' : '' }}">
            <a href="{{ route('channels.index') }}" class="nav-link">
              <i class="fas fa-film"></i>
              القنوات
            </a>
          </li>
        </ul>
        <ul class="navbar-nav mr-auto">
          <div class="topbar" style="z-index: 1">
            @auth
            <li class="nav-item dropdown no-arrow alert-dropdown mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bell fa-fw fa-lg"></i>
                  <!-- Counter - Alerts -->
                  <span class="badge badge-danger badge-counter notif-count" data-count="{{ App\Models\Alert::where('user_id', auth()->user()->id)->first()->alert }}">{{ App\Models\Alert::where('user_id', auth()->user()->id)->first()->alert }}</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right text-right mt-2"
                  aria-labelledby="alertsDropdown">                   
                  <div class="alert-body">
                    
                  </div>               
                  <a class="dropdown-item text-center small text-gray-500" href="#">عرض جميع الاشعارات</a>
                </div>
            </li>
            @endauth
          </div>
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
                @can('update-videos')
                  <a href="{{ route('admin.index') }}" class="dropdown-item text-right">لوحة الإدارة</a>
                @endcan                
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
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('6946d34cf373221a6f6e', {
      cluster: 'mt1'
    });
  </script>
  <script src="{{asset('js/pushNotifications.js')}}"></script>
  <script>
    const token = '{{ Session::token() }}';
    const urlNotify = '{{ route('notification')}}';
    
    $('#alertsDropdown').on('click', function(event){
      event.preventDefault();
      let notificationsWrapper = $('.alert-dropdown');
      let notificationsToggle = notificationsWrapper.find('a[data-toggle]');
      let notificationsCountElem = notificationsToggle.find('span[data-count]');

      notificationsCount = 0;
      notificationsCountElem.attr('data-count', notificationsCount);
      notificationsWrapper.find('.notif-count').text(notificationsCount);
      notificationsWrapper.show();

      $.ajax({
        method: 'POST',
        url: urlNotify,
        data: {
          _token: token
        },
        success: function(data) {
          let responseNotifications = "";
          $.each(data.someNotifications, function(i, item) {
            const responseDate = new Date(item.created_at);
            const date = responseDate.getFullYear()+'-'+(responseDate.getMonth()+1)+'-'+responseDate.getDate();
            const time = responseDate.getHours()+':'+(responseDate.getMinutes()+1)+':'+responseDate.getSeconds();

            if (item.success) {
              responseNotifications += `<a class="dropdown-item d-flex align-items-center" href="#">
                                          <div class="ml-3">
                                              <div class="icon-circle bg-secondary">
                                                  <i class="far fa-bell text-white"></i>
                                              </div>
                                          </div>
                                          <div>
                                              <div class="small text-gray-500">`+date + ` الساعة ` + time+`</div>
                                              <span>تهانينا لقد تم معالجة مقطع الفيديو <b>`+item.notification+`</b>بنجاح</span>
                                          </div>
                                        </a>  `;
            }
            $('.alert-body').html(responseNotifications);
          });
        }
      });
    });
  </script>
  @yield('script')
</body>
</html>