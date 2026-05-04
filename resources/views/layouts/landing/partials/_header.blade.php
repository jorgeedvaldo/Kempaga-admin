<div class="max-w-[1400px] mx-auto px-6 lg:px-12 relative z-50">
    <nav class="flex items-center justify-between py-6">
        <!-- Logo -->
        <div class="flex items-center cursor-pointer select-none" onclick="window.location.href='{{route('landing-page-home')}}'">
            <img src="{{ dynamicAsset(path: 'public/assets/logo-kempaga.png') }}" alt="Kempaga Logo" class="h-10 lg:h-12 w-auto">
        </div>

        <!-- Links -->
        <div class="hidden md:flex items-center gap-8 text-[1.05rem] font-medium">
            <a href="{{route('landing-page-home')}}" class="text-slate-600 dark:text-gray-300 hover:text-brandBlue transition-colors {{ Request::is('/') ? 'text-brandBlue font-bold' : '' }}">{{translate('Home')}}</a>
            <a href="{{route('pages.about-us')}}" class="text-slate-600 dark:text-gray-300 hover:text-brandBlue transition-colors {{ Request::is('pages/about-us') ? 'text-brandBlue font-bold' : '' }}">{{translate('Sobre Nós')}}</a>
            <a href="{{route('blog')}}" class="text-slate-600 dark:text-gray-300 hover:text-brandBlue transition-colors {{ Request::is('blog*') ? 'text-brandBlue font-bold' : '' }}">{{translate('Blog')}}</a>
            <a href="{{route('faq')}}" class="text-slate-600 dark:text-gray-300 hover:text-brandBlue transition-colors {{ Request::is('faq') ? 'text-brandBlue font-bold' : '' }}">{{translate('FAQ')}}</a>
            <a href="{{route('contact-us')}}" class="text-slate-600 dark:text-gray-300 hover:text-brandBlue transition-colors {{ Request::is('contact-us') ? 'text-brandBlue font-bold' : '' }}">{{translate('Contactos')}}</a>
        </div>

        <!-- Ações -->
        <div class="flex items-center gap-4">
            <button id="theme-toggle" class="p-2.5 rounded-full bg-white dark:bg-gray-900 text-slate-800 dark:text-yellow-400 shadow-sm border border-gray-200 dark:border-gray-800 hover:scale-105 transition-all focus:outline-none">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 4.22a1 1 0 011.415 0l.708.708a1 1 0 01-1.414 1.414l-.708-.708a1 1 0 010-1.414zM16 10a1 1 0 011 1h1a1 1 0 110-2h-1a1 1 0 01-1 1zm-4.22 4.22a1 1 0 010 1.415l-.708.708a1 1 0 01-1.414-1.414l.708-.708a1 1 0 011.415 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-4.22a1 1 0 01-1.415 0l-.708-.708a1 1 0 011.414-1.414l.708.708a1 1 0 010 1.414zM4 10a1 1 0 01-1-1H2a1 1 0 110 2h1a1 1 0 011-1zm4.22-4.22a1 1 0 010-1.415l.708-.708a1 1 0 011.414 1.414l-.708.708a1 1 0 01-1.415 0z"></path><path d="M10 14a4 4 0 100-8 4 4 0 000 8z"></path></svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            </button>

            <a href="{{route('admin.auth.login')}}" class="hidden sm:block text-slate-700 dark:text-white font-semibold hover:text-brandBlue transition-colors px-2">{{translate('Entrar')}}</a>
            <a href="{{route('agent.agent-self-registration')}}" class="bg-brandBlue hover:bg-brandBlueHover text-white text-[1.05rem] font-semibold py-2.5 px-6 rounded-full transition-all duration-300 shadow-[0_0_15px_rgba(0,102,204,0.3)]">
                {{translate('Criar Conta')}}
            </a>
        </div>
    </nav>
</div>
