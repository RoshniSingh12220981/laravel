<!-- resources/views/layouts/navigation.blade.php -->
<nav class="bg-blue-600 text-white">
    <div class="container">
        <div class="flex justify-between items-center py-3">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="font-bold text-xl">
                    PowerPulse
                </a>
                
                @auth
                    <div class="ml-10 space-x-4">
                        <a href="{{ route('dashboard') }}" class="hover:text-blue-200 {{ request()->routeIs('dashboard') ? 'text-white font-bold' : 'text-blue-100' }}">
                            Dashboard
                        </a>
                        
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.feedback.index') }}" class="hover:text-blue-200 {{ request()->routeIs('admin.feedback.*') ? 'text-white font-bold' : 'text-blue-100' }}">
                                Manage Feedback
                            </a>
                            <a href="{{ route('admin.statistics') }}" class="hover:text-blue-200 {{ request()->routeIs('admin.statistics') ? 'text-white font-bold' : 'text-blue-100' }}">
                                Statistics
                            </a>
                        @else
                            <a href="{{ route('user.feedback.create') }}" class="hover:text-blue-200 {{ request()->routeIs('user.feedback.create') ? 'text-white font-bold' : 'text-blue-100' }}">
                                Submit Feedback
                            </a>
                            <a href="{{ route('user.feedback.index') }}" class="hover:text-blue-200 {{ request()->routeIs('user.feedback.index') ? 'text-white font-bold' : 'text-blue-100' }}">
                                My Feedback
                            </a>
                        @endif
                    </div>
                @endauth
            </div>
            
            <div>
                @auth
                    <div class="flex items-center space-x-4">
                        <span>{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm bg-blue-700 hover:bg-blue-800 px-3 py-1 rounded">
                                Log Out
                            </button>
                        </form>
                    </div>
                @else
                    <div class="space-x-2">
                        <a href="{{ route('login') }}" class="text-sm hover:text-blue-200">Log in</a>
                        <a href="{{ route('register') }}" class="text-sm bg-blue-700 hover:bg-blue-800 px-3 py-1 rounded">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>