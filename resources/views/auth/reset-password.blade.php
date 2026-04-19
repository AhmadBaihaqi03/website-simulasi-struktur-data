<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#F8FAFC] p-4 lg:p-8 relative overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-100/40 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-purple-100/40 rounded-full blur-3xl"></div>

        <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">

            <div class="hidden lg:flex flex-col space-y-8 pl-10">
                <a href="/" class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-xl shadow-indigo-600/20">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">SimuData<span class="text-indigo-600">.C</span></h1>
                </a>

                <div class="space-y-4">
                    <h2 class="text-5xl font-extrabold text-slate-900 leading-[1.1] tracking-tighter">
                        Amankan Kembali <br> <span class="text-indigo-600">Akun Anda.</span>
                    </h2>
                    <p class="text-lg text-slate-500 leading-relaxed max-w-md">
                        Satu langkah lagi untuk kembali mengakses dashboard. Silakan masukkan kata sandi baru yang kuat dan mudah Anda ingat.
                    </p>
                </div>
            </div>

            <div class="w-full max-w-md mx-auto bg-white border border-indigo-50 rounded-[2.5rem] p-10 shadow-[0_25px_70_rgba(79,70,229,0.07)]">
                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-2xl font-bold text-slate-900">Password Baru</h2>
                    <p class="text-sm text-slate-500 mt-2 font-medium">Perbarui kredensial akses Anda</p>
                </div>

                <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="space-y-2">
                        <label for="email" class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Email Sekolah</label>
                        <x-text-input id="email" class="block w-full px-5 py-4 bg-slate-50 border-slate-100 rounded-2xl text-sm font-semibold text-slate-500 cursor-not-allowed"
                            style="color: #64748b !important;" type="email" name="email" :value="old('email', $request->email)" required readonly />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-red-500" />
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Password Baru</label>
                        <x-text-input id="password" class="block w-full px-5 py-4 bg-white border-slate-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500 transition-all text-sm font-semibold"
                            style="color: #757575 !important;" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-red-500" />
                    </div>

                    <div class="space-y-2">
                        <label for="password_confirmation" class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Konfirmasi Password Baru</label>
                        <x-text-input id="password_confirmation" class="block w-full px-5 py-4 bg-white border-slate-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500 transition-all text-sm font-semibold"
                            style="color: #757575 !important;" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs font-bold text-red-500" />
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-indigo-500 py-4 text-white rounded-2xl text-[13px] font-black hover:shadow-2xl hover:shadow-indigo-500/40 transition-all active:scale-[0.98] uppercase tracking-[0.2em] shadow-lg shadow-indigo-100">
                            Perbarui Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
