<footer class="bg-white dark:bg-[#050505] border-t border-gray-100 dark:border-gray-900 pt-16 pb-8">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mb-12">
            
            <!-- Coluna 1: Marca -->
            <div>
                <div class="flex items-center cursor-pointer select-none mb-4" onclick="window.location.href='{{route('landing-page-home')}}'">
                    <img src="{{ dynamicAsset(path: 'public/assets/logo-kempaga.png') }}" alt="Kempaga Logo" class="h-10 w-auto">
                </div>
                <p class="text-textMutedLight dark:text-textMutedDark text-sm leading-relaxed mb-6 max-w-xs">
                    {{translate('A sua carteira digital completa em Angola. Pague com facilidade, viva com liberdade.')}}
                </p>
                <!-- Sociais -->
                <div class="flex gap-4">
                    @php($socialMedia = \App\Models\SocialMedia::where('status', 1)->get())
                    @if (isset($socialMedia))
                        @foreach ($socialMedia as $social)
                            <a href="{{ $social->link }}" target="_blank" class="text-gray-400 hover:text-brandBlue transition-colors"><i class="bi bi-{{ $social->name }}"></i></a>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Coluna 2: Empresa -->
            <div>
                <h4 class="font-bold mb-4">{{translate('Empresa')}}</h4>
                <ul class="space-y-2 text-sm text-textMutedLight dark:text-textMutedDark">
                    <li><a href="{{route('pages.about-us')}}" class="hover:text-brandBlue transition-colors">{{translate('Sobre Nós')}}</a></li>
                    <li><a href="{{route('blog')}}" class="hover:text-brandBlue transition-colors">{{translate('Blog')}}</a></li>
                    <li><a href="{{route('contact-us')}}" class="hover:text-brandBlue transition-colors">{{translate('Contactos')}}</a></li>
                </ul>
            </div>

            <!-- Coluna 3: Suporte -->
            <div>
                <h4 class="font-bold mb-4">{{translate('Suporte')}}</h4>
                <ul class="space-y-2 text-sm text-textMutedLight dark:text-textMutedDark">
                    <li><a href="{{route('faq')}}" class="hover:text-brandBlue transition-colors">{{translate('FAQ')}}</a></li>
                    <li><a href="{{route('pages.terms-conditions')}}" class="hover:text-brandBlue transition-colors">{{translate('Termos de Uso')}}</a></li>
                    <li><a href="{{route('pages.privacy-policy')}}" class="hover:text-brandBlue transition-colors">{{translate('Privacidade')}}</a></li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-200 dark:border-gray-800 pt-8 flex flex-col md:flex-row items-center justify-between text-sm text-textMutedLight dark:text-textMutedDark">
            <p>&copy; {{ date('Y') }} {{ \App\Models\BusinessSetting::where(['key' => 'business_name'])->first()->value }}. {{translate('Todos os direitos reservados.')}}</p>
            <div class="flex gap-4 mt-4 md:mt-0">
                <span class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-brandGreenBright"></div>
                    {{translate('Kempaga Digital Wallet')}}
                </span>
            </div>
        </div>
    </div>
</footer>
