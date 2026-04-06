@extends('admin.layouts.base')




@section('content')

<div class="content">

    <x-admin.content-header :title="__('Users')" />



    <div class="content-box">

        <div class="content-box-top">



            <x-admin.link href="{{ route('admin.users.index') }}" class="admin-link">

                <svg class="admin-link-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>


                <span>

                    {{__('admin.button.back')}}

                </span>

            </x-admin.link>

        </div>



        <div class="content__item">
            <div class="card">

                <h3 class="card__title title-h3">

                    {{__('Create User')}}

                </h3>

                <div class="card-body">


                    <x-admin.errors />

                    <x-admin.form action="{{ route('admin.users.store') }}" method="POST" class="card-form">


                        <div class="card-body__group">

                            <x-admin.form-item>
                                <x-admin.label> {{ __('admin.label.name')}} </x-admin.label>
                                <x-admin.input name="name" />
                            </x-admin.form-item>
                            <x-admin.form-item>
                                <x-admin.label> {{ __('admin.label.email')}} </x-admin.label>
                                <x-admin.input name="email" />
                            </x-admin.form-item>
                            <x-admin.form-item>
                                <x-admin.label> {{ __('Password (min 12)')}} </x-admin.label>
                                <x-admin.input name="password" id="password_field" value="{{ $generatedPassword }}" />

                            </x-admin.form-item>

                            <div class="buttons-box">

                                <button type="button" class="btn btn-view" onclick="generatePass()">Generate</button>
                                <button type="button" class="btn btn-edit" onclick="copyPass(this)" data-text="Copied">Copy</button>
                            </div>
                        </div>





                        <div class="buttons-box">

                            <x-admin.button type="submit" class="btn-create">

                                {{ __('admin.button.create') }}

                            </x-admin.button>

                        </div>



                    </x-admin.form>


                    <script>
                        function generatePass() {
                                    
                            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";
        
                            let retVal = "";
        
                            for (let i = 0; i < 12; ++i) {
            
                                retVal += charset.charAt(Math.floor(Math.random() * charset.length));
        
                            }
        
                            document.getElementById("password_field").value = retVal;
    
                        }

    
                        let timerId = null;
                        function copyPass(btn) {

        
                            const copyText = document.getElementById("password_field");
        
                            copyText.select();
        
                            navigator.clipboard.writeText(copyText.value);

                            const btnText = btn.textContent;
                            const btnCopyText = btn.getAttribute('data-text');

                            btn.textContent = btnCopyText;
                            
                            timerId = setTimeout(() => {
                                
                                clearTimeout(timerId);
                                btn.textContent = btnText;
        
                                
        
                               
    
                            }, 1000);
                       
   
                        }
                    </script>


                </div>

            </div>

        </div>







    </div>


</div>

@endsection