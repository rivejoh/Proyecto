<x-layouts.app>
{{-- Contenedor principal --}}
    <div class="flex justify-center rounded-xl bg-gray-900 p-1 shadow border border-white/10">
        <div id="user-carousel" class="relative w-full max-w-[100px] ">
            {{--
                CONSEJO DE PROPORCIONES:
                Cambiamos las clases fijas 'h-56 md:h-96...' por 'w-full aspect-[16/7]'
                Si prefieres que sea un poco más alto, puedes cambiarlo por 'aspect-[16/7]' o 'aspect-[5/2]' si lo quieres más ancho.
            --}}
            <div class="relative w-full aspect-[5/2] min-h-[360px] overflow-hidden rounded-[10px] bg-gray-900" style="min-height: 800px;">

                <div class="user-carousel-slide absolute inset-0 w-full h-full transition-opacity duration-700 ease-in-out opacity-100 z-20">
                    <img src="{{ asset('image/c1.png') }}"
                        class="w-full h-full object-cover object-center" alt="Artwork 1">
                </div>

                <div class="user-carousel-slide absolute inset-0 w-full h-full transition-opacity duration-700 ease-in-out opacity-0 z-10">
                    <img src="{{ asset('image/c2.png') }}"
                        class="w-full h-full object-cover object-center" alt="Artwork 2">
                </div>

                <div class="user-carousel-slide absolute inset-0 w-full h-full transition-opacity duration-700 ease-in-out opacity-0 z-10">
                    <img src="{{ asset('image/c3.png') }}"
                        class="w-full h-full object-cover object-center" alt="Artwork 3">
                </div>
            </div>

            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
                <button type="button" data-slide="0" class="user-carousel-dot w-3 h-3 rounded-full transition-colors duration-300 bg-white"></button>
                <button type="button" data-slide="1" class="user-carousel-dot w-3 h-3 rounded-full transition-colors duration-300 bg-white/40"></button>
                <button type="button" data-slide="2" class="user-carousel-dot w-3 h-3 rounded-full transition-colors duration-300 bg-white/40"></button>
            </div>

            <button type="button" id="user-carousel-prev" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/20 group-hover:bg-black/40 text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="m15 19-7-7 7-7" />
                    </svg>
                </span>
            </button>

            <button type="button" id="user-carousel-next" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/20 group-hover:bg-black/40 text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="m9 5 7 7-7 7" />
                    </svg>
                </span>
            </button>
        </div>
    </div>

    <script>
        (function () {
            const carousel = document.getElementById('user-carousel');
            if (!carousel) return;

            const slides = carousel.querySelectorAll('.user-carousel-slide');
            const dots = carousel.querySelectorAll('.user-carousel-dot');
            const prevButton = document.getElementById('user-carousel-prev');
            const nextButton = document.getElementById('user-carousel-next');
            let activeIndex = 0;
            const total = slides.length;
            let interval = null;

            function updateCarousel(index) {
                activeIndex = (index + total) % total;
                slides.forEach((slide, idx) => {
                    const isActive = idx === activeIndex;
                    slide.classList.toggle('opacity-100', isActive);
                    slide.classList.toggle('opacity-0', !isActive);
                    slide.classList.toggle('z-20', isActive);
                    slide.classList.toggle('z-10', !isActive);
                });

                dots.forEach((dot, idx) => {
                    dot.classList.toggle('bg-white', idx === activeIndex);
                    dot.classList.toggle('bg-white/40', idx !== activeIndex);
                });
            }

            function nextSlide() {
                updateCarousel(activeIndex + 1);
            }

            function prevSlide() {
                updateCarousel(activeIndex - 1);
            }

            function resetInterval() {
                if (interval) clearInterval(interval);
                interval = setInterval(nextSlide, 4000);
            }

            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    updateCarousel(parseInt(dot.dataset.slide, 10));
                    resetInterval();
                });
            });

            prevButton.addEventListener('click', () => {
                prevSlide();
                resetInterval();
            });

            nextButton.addEventListener('click', () => {
                nextSlide();
                resetInterval();
            });

            updateCarousel(0);
            interval = setInterval(nextSlide, 4000);
        })();
    </script>

    <div class="p-6">
        <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-semibold">Panel de usuario</h1>
                
                <p class="text-sm text-zinc-600 dark:text-zinc-300">Administra tus medicamentos y próximos horarios de toma.</p>
            </div>
<a href="{{ route('user.medicamentos.index') }}" class="btn btn-primary">Ver mis medicamentos</a>
        </div>

        <div class="grid gap-4 xl:grid-cols-3">
            <div class="rounded-xl border border-default bg-white p-6 shadow-sm">
                <p class="text-sm text-zinc-500">Medicamentos registrados</p>
                <p class="mt-2 text-3xl font-semibold">{{ $medicines->count() }}</p>
            </div>
            <div class="rounded-xl border border-default bg-white p-6 shadow-sm">
                <p class="text-sm text-zinc-500">Medicamentos activos</p>
                <p class="mt-2 text-3xl font-semibold">{{ $medicines->where('active', true)->count() }}</p>
            </div>
            <div class="rounded-xl border border-default bg-white p-6 shadow-sm">
                <p class="text-sm text-zinc-500">Próximas tomas</p>
                <p class="mt-2 text-3xl font-semibold">{{ $nextReminders->count() }}</p>
            </div>
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-2">
            <section class="rounded-xl border border-default bg-white p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold">Próximos recordatorios</h2>
                        <p class="text-sm text-zinc-500">Lleva el control de las próximas tomas activas.</p>
                    </div>
                    <a href="{{ route('user.medicamentos.create') }}" class="btn btn-secondary">Agregar medicamento</a>
                </div>

                @if ($nextReminders->isEmpty())
                    <div class="rounded-base border border-default p-6 text-sm text-zinc-700">
                        No hay recordatorios próximos. Agrega un medicamento activo para empezar.
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach ($nextReminders as $medicine)
                            <article class="rounded-xl border border-default p-4">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <p class="text-sm text-zinc-500">{{ $medicine->frequency }}</p>
                                        <h3 class="text-lg font-semibold">{{ $medicine->name }}</h3>
                                    </div>
                                    <span class="rounded-full bg-primary/10 px-3 py-1 text-sm font-medium text-primary">{{ $medicine->schedule_time->format('H:i') }}</span>
                                </div>
                                <p class="mt-2 text-sm text-zinc-600">{{ $medicine->dosage }} · {{ $medicine->instructions ?? 'Sin instrucciones adicionales' }}</p>
                            </article>
                        @endforeach
                    </div>
                @endif
            </section>

            <section class="rounded-xl border border-default bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold">Resumen</h2>
                <p class="mt-2 text-sm text-zinc-500">Consulta tu lista completa y mantente al día con tu tratamiento.</p>

                <div class="mt-6 grid gap-4">
                    @foreach ($medicines->take(4) as $medicine)
                        <div class="rounded-xl border border-default p-4">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="font-semibold">{{ $medicine->name }}</h3>
                                    <p class="text-sm text-zinc-500">{{ $medicine->dosage }}</p>
                                </div>
                                <span class="rounded-full bg-slate-100 px-3 py-1 text-sm text-slate-700">{{ $medicine->schedule_time->format('H:i') }}</span>
                            </div>
                            <p class="mt-3 text-sm text-zinc-600">{{ $medicine->frequency }} · {{ $medicine->active ? 'Activo' : 'Inactivo' }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

</x-layouts.app>
