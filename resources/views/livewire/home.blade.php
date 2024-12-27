<div class="w-full h-full">
  {{-- Header --}}
  <header class="md:hidden sticky top-0 bg-white">
    <div class="grid grid-cols-12 gap-2 items-center">
      <div class="col-span-3">
        <img src="{{ asset('assets/Ruski dom Istra logo.png') }}" class="h-5 max-w-lg w-full"
          alt="Ruski dom Istra logo.png">
      </div>
      <div class="col-span-8 flex justify-center px-2">
        <input type="text" placeholder="Поиск"
          class="border-0 outline-none w-full focus:outline-none bg-gray-100 rounded-lg focus:ring-0 hover:ring-0">
      </div>
      <div class="col-span-1 flex justify-center">
        <a href="#">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
              stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>
          </span>
        </a>
      </div>
    </div>
  </header>

  {{-- Main content --}}
  <main class="grid lg:grid-cols-12 gap-8 md:mt-10">
    {{-- Left content --}}
    <aside class="lg:col-span-8 overflow-hidden">
      {{-- Stories --}}
      <section>
        <ul class="flex overflow-x-auto scrollbar-hide items-center gap-2">
          @for ($i = 0; $i < 10; $i++)
        <li class="flex flex-col justify-center w-20 gap-1 p-2">
        <x-avatar story src="{{ asset('profiles/' . $i . '.jpg') }}" class="h-14 w-14  rounded-full bg-gradient-to-r from-red-500 via-yellow-500 to-purple-500 via-blue-500 to-green-500 p-[5px]" />
        <p class="text-xs font-medium truncate">{{ fake()->name }}</p>
        </li>
      @endfor
        </ul>
      </section>

      {{-- Posts --}}
      <section class="mt-10 space-y-8">

        @if ($posts && $posts->isNotEmpty())
      @foreach ($posts->take(10) as $post)
      <livewire:post.item :post="$post" />
    @endforeach
    @else
    <p class="font-bold flex justify-center">No posts</p>
  @endif

      </section>


      </section>

    </aside>

    {{-- Right content (suggestions) --}}
    <aside class="lg:col-span-4 hidden lg:block p-4">
      <div class="flex items-center gap-2">
        <x-avatar story src="{{ asset('profiles//' . $i . '.jpg') }}" class="h-24 w-24   rounded-full bg-gradient-to-r from-red-500 via-yellow-500 to-purple-500 via-blue-500 to-green-500 p-[5px]" />
        <h4 class="font-medium">{{ fake()->name }}</h4>
      </div>

      {{-- Suggestions --}}
      <section class="mt-4">
        <h4 class="font-bold text-gray-700/95">Предложения для вас</h4>
        <ul class="my-2 space-y-3">
          @for ($i = 0; $i < 5; $i++)
        <li class="flex items-center gap-3">
        <x-avatar story src="{{ asset('profiles/' . $i . '.jpg') }}"    class="h-14 w-14 rounded-full bg-gradient-to-r from-red-500 via-yellow-500 to-purple-500 p-[5px]" />
        <div class="grid grid-cols-7 w-full gap-2">
          <div class="col-span-5">
          <h5 class="font-semibold truncate text-sm">{{ fake()->name }}</h5>
          <p class="text-xs truncate">Далее следует {{ fake()->name }}</p>
          </div>
          <div class="col-span-2 flex text-right justify-end">
          <button class="font-bold text-blue-500 ml-auto text-sm">Следовать</button>
          </div>
        </div>
        </li>
      @endfor
        </ul>
      </section>

      {{-- App links --}}
      <section class="mt-10">
        <ol class="flex gap-3.5 p-5 flex-wrap" style="width: 300px;">
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">О нас</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">Помощь</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">API</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">Вакансии</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">Конфиденциальность</a>
          </li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">Условия</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">Локации</a></li>
        </ol>
        <h3 style="margin-left: 40px;" class="text-gray-800/90 mt-6 text-sm"> &copy; 2024 Русский Дом "Истрия" <br>
          <p style="margin-left: 40px;">Все права защищены</p>
          <p style="margin-left: 20px;">Designed by Dusan Jovanovic</p>
        </h3>
      </section>
    </aside>
  </main>
  <img id="background" class="absolute -bottom-0 right-0 max-w-[520px] pointer-events-none"
  src="{{asset('assets/home_svgimage.svg')}}" />

   
</div>
