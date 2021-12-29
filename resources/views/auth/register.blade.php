<x-guest-layout>
    @section('title')
    Store Register
    @endsection
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <div class="page-content page-auth" id="register">
            <div class="section-store-auth" data-aos="fade-up">
                <div class="container">
                    <div class="row align-items-center justify-content-center row-login">
                        <div class="col-lg-4">
                            <h2>
                            Mulai belanja kebutuhan <br />
                            menjadi lebih mudah
                            </h2>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Name -->
                                <div class="form-group">
                                    <x-label for="name" :value="__('Name')" />

                                    <input id="name" class="form-control @error('name') is-invalid @enderror" v-model="name" type="text" name="name" value="old('name')" required autofocus />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Email Address -->
                                <div class="form-group">
                                    <x-label for="email" :value="__('Email')" />

                                    <input id="email" 
                                    v-model="email"
                                    @change="CheckForEmailAvailability()"
                                    class="form-control @error('email') is-invalid @enderror"
                                    :class="{'is-invalid' : this.email_unavailable }"
                                     type="email" name="email" value="old('email')" required />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <x-label for="password" :value="__('Password')"  />

                                    <x-input id="password" class="form-control @error('password') is-invalid @enderror"
                                                    type="password"
                                                    name="password"
                                                    required autocomplete="new-password" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                                    <x-input id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    type="password"
                                                    name="password_confirmation" required />
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Store</label>
                                    <p class="text-muted">Apakah anda juga ingin membuka toko?</p>
                                    <div
                                    class="custom-control custom-radio custom-control-inline"
                                    >
                                    <input
                                        type="radio"
                                        class="custom-control-input"
                                        name="is_store_open"
                                        id="openStoreTrue"
                                        v-model="is_store_open"
                                        :value="true"
                                    />
                                    <label for="openStoreTrue" class="custom-control-label">
                                        Oke
                                    </label>
                                    </div>
                                    <div
                                    class="custom-control custom-radio custom-control-inline"
                                    >
                                    <input
                                        type="radio"
                                        class="custom-control-input"
                                        name="is_store_open"
                                        id="openStoreFalse"
                                        v-model="is_store_open"
                                        :value="false"
                                    />
                                    <label for="openStoreFalse" class="custom-control-label">
                                        Tidak
                                    </label>
                                    </div>
                                </div>
                                <div class="form-group" v-if="is_store_open">
                                    <label for="">Nama Toko</label>
                                    <input type="text" name="nama_toko" id="nama_toko" class="form-control @error('nama_toko') is-invalid @enderror" required autocomplete autofocus/>
                                    @error('nama_toko')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group" v-if="is_store_open">
                                    <label for="">Kategori</label>
                                    <select name="categories_id" class="form-control" id="category">
                                    <option value="" disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>

                                    <button class="btn btn-success btn-block mt-4"
                                    :disabled="this.email_unavailable">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-auth-card>
    @push('addon-script')
        <script src="/vendor/vue/vue.js"></script>
        <script src="https://unpkg.com/vue-toasted"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script>
        Vue.use(Toasted);

        var register = new Vue({
            el: "#register",
            mounted() {
            AOS.init();
            },
            methods: {
                CheckForEmailAvailability: function(){
                    var self = this;
                    axios.get('{{ route('api-register-check') }}',
                    {
                        params: {
                        email: this.email
                    }
                    })
                    .then(function (response) {

                        if(response.data == 'Available'){
                            self.$toasted.show("Email anda tersedia, silahkan melanjutkan", {
                                position: "top-center",
                                className: "rounded",
                                duration: 6000,
                            });
                            self.email_unavailable = false;
                        }else{
                            self.$toasted.error("Maaf, email yang anda masukkan sudah terdaftar.", {
                            position: "top-center",
                            className: "rounded",
                            duration: 6000,
                            });
                            self.email_unavailable = true;
                        }
                        // handle success
                        console.log(response);
                    });
                }
            },
            data(){
            return {
                name: "",
                email: "",
                is_store_open: true,
                store_name: "",
                email_unavailable: false,
                }
            },
        });
        </script>
    @endpush
</x-guest-layout>