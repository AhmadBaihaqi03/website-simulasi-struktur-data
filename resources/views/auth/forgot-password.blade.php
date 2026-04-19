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
                        Jangan Khawatir, <br> <span class="text-indigo-600">Kami Siap Bantu.</span>
                    </h2>
                    <p class="text-lg text-slate-500 leading-relaxed max-w-md">
                        Cukup masukkan email sekolah Anda yang terdaftar, dan kami akan mengirimkan instruksi untuk mengatur ulang kata sandi Anda dengan mudah.
                    </p>
                </div>
            </div>

            <div class="w-full max-w-md mx-auto bg-white border border-indigo-50 rounded-[2.5rem] p-10 shadow-[0_25px_70px_rgba(79,70,229,0.07)]">
                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-2xl font-bold text-slate-900">Atur Ulang Password</h2>
                    <p class="text-sm text-slate-500 mt-3 leading-relaxed font-medium">
                        Lupa kata sandi? Beritahu kami email Anda dan kami akan mengirimkan tautan reset password agar Anda bisa memilih yang baru.
                    </p>
                </div>

                <x-auth-session-status class="mb-6" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-2">
                        <label for="email" class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Email Sekolah</label>
                        <x-text-input id="email" class="block w-full px-5 py-4 bg-white border-slate-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-sm font-semibold"
                            style="color: #757575 !important;" type="email" name="email" :value="old('email')" required autofocus placeholder="nama@guru.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-red-500" />
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-indigo-500 py-4 text-white rounded-2xl text-[13px] font-black hover:shadow-2xl hover:shadow-indigo-500/40 transition-all active:scale-[0.98] uppercase tracking-[0.2em] shadow-lg shadow-indigo-100">
                            Kirim Link Reset
                        </button>
                    </div>
                </form>

                <div class="mt-10 text-center pt-8 border-t border-slate-50">
                    <a href="{{ route('login') }}" class="text-[11px] font-bold text-indigo-600 uppercase tracking-widest hover:underline transition-all">
                        ← Kembali ke Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
