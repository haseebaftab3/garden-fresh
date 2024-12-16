@extends('layouts.master')
@section('title', 'The Pets Medic | Home')
@section('content')
    <div class="axil-dashboard-area axil-section-gap">
        <div class="container">
            <div class="axil-dashboard-warp">

                <div class="py-12">
                    <div class="max-w-7xl mt-4 mx-auto sm:px-6 lg:px-8 space-y-6">
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            @include('profile.partials.update-profile-information-form')

                        </div>

                        <div class="p-4  mt-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            @include('profile.partials.update-password-form')
                        </div>

                        <div class="p-4  mt-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            @include('profile.partials.delete-user-form')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
